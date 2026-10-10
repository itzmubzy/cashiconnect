<?php

function cc_distribute_project_profit($conn, $project_id, $admin_id = null)
{
    $project_stmt = mysqli_prepare($conn, "SELECT fp.id, fp.title, fp.required_budget, fp.profit_distributed_at, fp.farmer_id,
                    u.name AS farmer_name
             FROM farming_projects fp
             JOIN farmer_profiles fpa ON fp.farmer_id = fpa.id
             JOIN users u ON fpa.user_id = u.id
             WHERE fp.id = ? AND fp.status = 'completed'
             FOR UPDATE");
    if (!$project_stmt) {
        throw new Exception("Database error: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($project_stmt, "i", $project_id);
    if (!mysqli_stmt_execute($project_stmt)) {
        throw new Exception("Failed to load project: " . mysqli_stmt_error($project_stmt));
    }
    $project_res = mysqli_stmt_get_result($project_stmt);
    $project = $project_res ? mysqli_fetch_assoc($project_res) : null;

    if (!$project) {
        throw new Exception("Project is not eligible for profit distribution (not completed).");
    }
    if (!empty($project["profit_distributed_at"])) {
        throw new Exception("This project has already had its profit distributed.");
    }

    $harvest_stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS harvest_count, COALESCE(SUM(estimated_value), 0) AS total_revenue
             FROM harvests
             WHERE project_id = ?");
    if (!$harvest_stmt) {
        throw new Exception("Database error: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($harvest_stmt, "i", $project_id);
    if (!mysqli_stmt_execute($harvest_stmt)) {
        throw new Exception("Failed to calculate harvest revenue: " . mysqli_stmt_error($harvest_stmt));
    }
    $harvest_res = mysqli_stmt_get_result($harvest_stmt);
    $harvest_row = $harvest_res ? mysqli_fetch_assoc($harvest_res) : null;

    $harvest_count = $harvest_row ? (int)$harvest_row["harvest_count"] : 0;
    $total_revenue = round((float)($harvest_row["total_revenue"] ?? 0), 2);
    $required_budget = round((float)$project["required_budget"], 2);
    $profit = round($total_revenue - $required_budget, 2);

    if ($harvest_count < 1) {
        throw new Exception("Project must have at least one harvest record before profit distribution.");
    }
    if ($profit <= 0) {
        throw new Exception("Project shows no profit to distribute (revenue ≤ required budget).");
    }

    $investor_pool = round($profit * 0.60, 2);
    $farmer_share = round($profit * 0.395, 2);
    $platform_share = round($profit * 0.005, 2);

    $investment_stmt = mysqli_prepare($conn, "SELECT i.id, i.amount, i.investor_id, u.name AS investor_name
             FROM investments i
             JOIN investor_profiles ip ON i.investor_id = ip.id
             JOIN users u ON ip.user_id = u.id
             WHERE i.project_id = ? AND i.status = 'confirmed'
             ORDER BY i.amount DESC, i.id ASC
             FOR UPDATE");
    if (!$investment_stmt) {
        throw new Exception("Database error: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($investment_stmt, "i", $project_id);
    if (!mysqli_stmt_execute($investment_stmt)) {
        throw new Exception("Failed to load confirmed investments: " . mysqli_stmt_error($investment_stmt));
    }
    $investment_res = mysqli_stmt_get_result($investment_stmt);
    $investment_rows = [];
    while ($row = mysqli_fetch_assoc($investment_res)) {
        $investment_rows[] = $row;
    }

    if (count($investment_rows) < 1) {
        throw new Exception("No confirmed investments found for this project.");
    }

    $confirmed_total = 0.0;
    foreach ($investment_rows as $row) {
        $confirmed_total += (float)$row["amount"];
    }
    $confirmed_total = round($confirmed_total, 2);
    if ($confirmed_total <= 0) {
        throw new Exception("No confirmed investment amount available for distribution.");
    }

    $distribution_rows = [];
    $allocated_to_investors = 0.0;
    foreach ($investment_rows as $row) {
        $raw_share = ((float)$row["amount"] / $confirmed_total) * $investor_pool;
        $profit_share = round($raw_share, 2);
        $distribution_rows[] = [
            "investment_id" => (int)$row["id"],
            "investor_id" => (int)$row["investor_id"],
            "investor_name" => $row["investor_name"],
            "amount" => round((float)$row["amount"], 2),
            "profit_share" => $profit_share,
        ];
        $allocated_to_investors += $profit_share;
    }

    $investor_remainder = round($investor_pool - $allocated_to_investors, 2);
    if (abs($investor_remainder) >= 0.01) {
        $distribution_rows[0]["profit_share"] = round($distribution_rows[0]["profit_share"] + $investor_remainder, 2);
        $allocated_to_investors = round($allocated_to_investors + $investor_remainder, 2);
    }

    $distributed_total = round($allocated_to_investors + $farmer_share + $platform_share, 2);
    $reconciliation_diff = round($profit - $distributed_total, 2);

    if (abs($reconciliation_diff) >= 0.01) {
        throw new Exception("Rounding reconciliation failed before save: diff = " . $reconciliation_diff);
    }

    $update_share_stmt = mysqli_prepare($conn, "UPDATE investments SET profit_share = ? WHERE id = ? AND status = 'confirmed'");
    if (!$update_share_stmt) {
        throw new Exception("Database error: " . mysqli_error($conn));
    }
    foreach ($distribution_rows as $row) {
        mysqli_stmt_bind_param($update_share_stmt, "di", $row["profit_share"], $row["investment_id"]);
        if (!mysqli_stmt_execute($update_share_stmt)) {
            throw new Exception("Failed to save investor profit share: " . mysqli_stmt_error($update_share_stmt));
        }
        if (mysqli_stmt_affected_rows($update_share_stmt) < 1) {
            throw new Exception("One or more investment rows could not be updated.");
        }
    }

    $project_update_stmt = mysqli_prepare($conn, "UPDATE farming_projects
             SET total_profit = ?, farmer_profit_share = ?, platform_profit_share = ?, profit_distributed_at = NOW(), settled_by_admin_id = ?
             WHERE id = ? AND profit_distributed_at IS NULL");
    if (!$project_update_stmt) {
        throw new Exception("Database error: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($project_update_stmt, "dddii", $profit, $farmer_share, $platform_share, $admin_id, $project_id);
    if (!mysqli_stmt_execute($project_update_stmt)) {
        throw new Exception("Failed to finalize shareout: " . mysqli_stmt_error($project_update_stmt));
    }
    if (mysqli_stmt_affected_rows($project_update_stmt) < 1) {
        throw new Exception("Project was already finalized or changed before save.");
    }

    return [
        "project_id" => $project_id,
        "project_title" => $project["title"],
        "farmer_name" => $project["farmer_name"],
        "harvest_count" => $harvest_count,
        "total_revenue" => $total_revenue,
        "required_budget" => $required_budget,
        "profit" => $profit,
        "investor_pool" => $investor_pool,
        "farmer_share" => $farmer_share,
        "platform_share" => $platform_share,
        "investor_remainder" => $investor_remainder,
        "distributed_total" => $distributed_total,
        "reconciliation_diff" => $reconciliation_diff,
        "investor_rows" => $distribution_rows,
    ];
}
?>

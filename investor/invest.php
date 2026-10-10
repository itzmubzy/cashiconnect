<?php

session_start();
include("../db.php");

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "investor")
{
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION["id"];
$username = $_SESSION["username"];

$message = "";
$message_class = "";

$inv_stmt = mysqli_prepare($conn, "SELECT id FROM investor_profiles WHERE user_id=?");
mysqli_stmt_bind_param($inv_stmt, "i", $user_id);
mysqli_stmt_execute($inv_stmt);
$inv_res = mysqli_stmt_get_result($inv_stmt);
$investor = mysqli_fetch_assoc($inv_res);
if (!$investor) {
    die("Investor profile not found.");
}
$investor_profile_id = $investor['id'];

$project_id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$stmt = mysqli_prepare($conn, "SELECT fp.id, fp.title, fp.crop, fp.required_budget, fp.current_funding, fp.status, fp.land_id,
                                      u.name AS farmer_name
                               FROM farming_projects fp
                               JOIN farmer_profiles fpa ON fp.farmer_id = fpa.id
                               JOIN users u ON fpa.user_id = u.id
                               WHERE fp.id = ? AND fp.status IN ('approved', 'active')");
mysqli_stmt_bind_param($stmt, "i", $project_id);
mysqli_stmt_execute($stmt);
$project_res = mysqli_stmt_get_result($stmt);
$project = mysqli_fetch_assoc($project_res);

if (!$project) {
    $message = "This project does not exist or is not open for investment.";
    $message_class = "error-message";
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && $project) {
    $amount_raw = isset($_POST["amount"]) ? trim($_POST["amount"]) : "";

    mysqli_begin_transaction($conn);

    try {
        $lock_stmt = mysqli_prepare($conn, "SELECT current_funding, required_budget, status, land_id FROM farming_projects WHERE id=? FOR UPDATE");
        mysqli_stmt_bind_param($lock_stmt, "i", $project_id);
        mysqli_stmt_execute($lock_stmt);
        $lock_res = mysqli_stmt_get_result($lock_stmt);
        $locked = mysqli_fetch_assoc($lock_res);

        if (!$locked) {
            throw new Exception("Project not found.");
        }
        if (!in_array($locked['status'], ['approved', 'active'], true)) {
            throw new Exception("This project is no longer open for investment (status: " . $locked['status'] . ").");
        }

        if ($amount_raw === "" || !is_numeric($amount_raw)) {
            throw new Exception("Please enter a valid investment amount.");
        }
        $amount = round((float)$amount_raw, 2);
        if ($amount <= 0) {
            throw new Exception("Investment amount must be greater than zero.");
        }

        $remaining = (float)$locked['required_budget'] - (float)$locked['current_funding'];
        if ($amount > $remaining) {
            throw new Exception("Investment amount (৳" . number_format($amount, 2) . ") exceeds the remaining budget of ৳" . number_format($remaining, 2) . " for this project.");
        }

        $confirmation_code = bin2hex(random_bytes(16));
        $ins_stmt = mysqli_prepare($conn, "INSERT INTO investments (investor_id, project_id, amount, status, confirmation_code) VALUES (?, ?, ?, 'confirmed', ?)");
        mysqli_stmt_bind_param($ins_stmt, "iids", $investor_profile_id, $project_id, $amount, $confirmation_code);
        if (!mysqli_stmt_execute($ins_stmt)) {
            throw new Exception("Database error while recording the investment.");
        }

        $new_funding = round((float)$locked['current_funding'] + $amount, 2);
        $will_complete = ($new_funding >= (float)$locked['required_budget']);

        $upd_stmt = mysqli_prepare($conn, "UPDATE farming_projects SET current_funding = ?, status = IF(? >= required_budget, 'completed', status) WHERE id = ?");
        mysqli_stmt_bind_param($upd_stmt, "ddi", $new_funding, $new_funding, $project_id);
        if (!mysqli_stmt_execute($upd_stmt)) {
            throw new Exception("Database error while updating project funding.");
        }
        if ($will_complete) {
            $lease_stmt = mysqli_prepare($conn, "UPDATE hiring_requests SET lease_paid_at = NOW() WHERE land_id = ? AND status = 'accepted' AND lease_paid_at IS NULL");
            mysqli_stmt_bind_param($lease_stmt, "i", $locked['land_id']);
            if (!mysqli_stmt_execute($lease_stmt)) {
                throw new Exception("Database error while marking the land lease as paid.");
            }
        }

        mysqli_commit($conn);
        header("Location: invest.php?id=" . $project_id . "&success=1&amount=" . urlencode(number_format($amount, 2)));
        exit();
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $message = $e->getMessage();
        $message_class = "error-message";
    }
}

if (isset($_GET["success"]) && $_GET["success"] === "1" && isset($_GET["amount"])) {
    $message = "Investment of ৳" . htmlspecialchars($_GET["amount"]) . " confirmed successfully!";
    $message_class = "registration-message";
}

if ($project) {
    $remaining_now = (float)$project['required_budget'] - (float)$project['current_funding'];
}

require __DIR__ . '/_invest-view.php';

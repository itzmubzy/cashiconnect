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

$stmt = mysqli_prepare($conn, "SELECT * FROM investor_profiles WHERE user_id=?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$investor_res = mysqli_stmt_get_result($stmt);
$investor = ($investor_res && mysqli_num_rows($investor_res) > 0) ? mysqli_fetch_assoc($investor_res) : null;

$total_invested = 0;
$active_investments = 0;
$investments_list = [];

if ($investor) {
    $investor_id = $investor['id'];

    $inv_stmt = mysqli_prepare($conn, "SELECT SUM(amount) as total, COUNT(*) as count FROM investments WHERE investor_id=?");
    mysqli_stmt_bind_param($inv_stmt, "i", $investor_id);
    mysqli_stmt_execute($inv_stmt);
    $inv_res = mysqli_stmt_get_result($inv_stmt);
    if ($inv_res && $i_row = mysqli_fetch_assoc($inv_res)) {
        $total_invested = (float)($i_row['total'] ?? 0);
        $active_investments = (int)($i_row['count'] ?? 0);
    }

    $list_stmt = mysqli_prepare($conn, "SELECT i.id as investment_id, i.amount, i.invested_at, i.status as investment_status,
                                               fp.id as project_id, fp.title as project_title, fp.crop, fp.status as project_status,
                                               l.title as land_title, l.location as land_location
                                        FROM investments i
                                        JOIN farming_projects fp ON i.project_id = fp.id
                                        JOIN lands l ON fp.land_id = l.id
                                        WHERE i.investor_id = ?
                                        ORDER BY i.invested_at DESC
                                        LIMIT 10");
    mysqli_stmt_bind_param($list_stmt, "i", $investor_id);
    mysqli_stmt_execute($list_stmt);
    $list_res = mysqli_stmt_get_result($list_stmt);
    if ($list_res) {
        while ($row = mysqli_fetch_assoc($list_res)) {
            $investments_list[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Investor Dashboard | ChasiConnect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary": "#ffffff",
                        "surface-bright": "#fcf9f8",
                        "background": "#fcf9f8",
                        "on-surface-variant": "#414844",
                        "outline-variant": "#c1c8c2",
                        "surface-container-high": "#eae7e7",
                        "primary-fixed": "#c1ecd4",
                        "surface-container-low": "#f6f3f2",
                        "on-error": "#ffffff",
                        "on-tertiary-container": "#75b393",
                        "on-tertiary-fixed-variant": "#0e5138",
                        "inverse-on-surface": "#f3f0ef",
                        "tertiary-container": "#00452e",
                        "error": "#ba1a1a",
                        "on-tertiary": "#ffffff",
                        "on-background": "#1c1b1b",
                        "primary": "#012d1d",
                        "secondary-fixed": "#a1f4c8",
                        "inverse-surface": "#313030",
                        "surface-container": "#f0eded",
                        "inverse-primary": "#a5d0b9",
                        "surface-tint": "#3f6653",
                        "tertiary-fixed": "#b1f0ce",
                        "on-primary-container": "#86af99",
                        "on-secondary-fixed-variant": "#005236",
                        "on-secondary-container": "#1b724f",
                        "on-tertiary-fixed": "#002114",
                        "surface-container-highest": "#e5e2e1",
                        "outline": "#717973",
                        "error-container": "#ffdad6",
                        "primary-fixed-dim": "#a5d0b9",
                        "on-surface": "#1c1b1b",
                        "surface-container-lowest": "#ffffff",
                        "tertiary-fixed-dim": "#95d4b3",
                        "surface-variant": "#e5e2e1",
                        "surface-dim": "#dcd9d9",
                        "secondary-container": "#a1f4c8",
                        "on-primary-fixed": "#002114",
                        "tertiary": "#002d1c",
                        "secondary": "#116c4a",
                        "primary-container": "#1b4332",
                        "secondary-fixed-dim": "#86d7ad",
                        "surface": "#fcf9f8",
                        "on-primary": "#ffffff",
                        "on-primary-fixed-variant": "#274e3d",
                        "on-error-container": "#93000a",
                        "on-secondary-fixed": "#002113"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "stack-sm": "8px",
                        "stack-md": "16px",
                        "margin-desktop": "40px",
                        "base": "8px",
                        "margin-mobile": "16px",
                        "stack-lg": "32px",
                        "container-max": "1440px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "label-md": ["Hanken Grotesk", "sans-serif"],
                        "body-sm": ["Hanken Grotesk", "sans-serif"],
                        "display-lg": ["Manrope", "sans-serif"],
                        "headline-md": ["Manrope", "sans-serif"],
                        "headline-lg": ["Manrope", "sans-serif"],
                        "headline-sm": ["Manrope", "sans-serif"],
                        "body-md": ["Hanken Grotesk", "sans-serif"],
                        "body-lg": ["Hanken Grotesk", "sans-serif"],
                        "numeric-kpi": ["Hanken Grotesk", "sans-serif"]
                    },
                    "fontSize": {
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "numeric-kpi": ["28px", { "lineHeight": "32px", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
<style>
        body { font-family: 'Hanken Grotesk', sans-serif; background-color: theme('colors.surface-bright'); }
        h1, h2, h3, h4, h5, h6, .font-headline-lg, .font-headline-md, .font-headline-sm, .font-display-lg { font-family: 'Manrope', sans-serif; }
        .ambient-shadow { box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06); }
        .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0px 8px 24px rgba(27, 67, 50, 0.10); }
</style>
</head>
<body class="text-on-surface antialiased min-h-screen flex flex-col">
<!-- Top Navigation Header -->
<header class="bg-surface-container-lowest border-b border-surface-dim sticky top-0 z-50">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop h-20 flex items-center justify-between">
<div class="flex items-center gap-4">
    <a href="dashboard.php" class="flex items-center gap-3">
        <div class="flex items-center justify-center w-10 h-10 bg-primary-container rounded-lg">
            <span class="material-symbols-outlined text-on-primary" style="font-variation-settings: 'FILL' 1;">agriculture</span>
        </div>
        <div>
            <h1 class="font-headline-sm text-headline-sm font-bold text-primary">ChasiConnect</h1>
            <p class="font-label-md text-label-md text-on-surface-variant uppercase">Investor Dashboard</p>
        </div>
    </a>
</div>
<div class="flex items-center gap-6">
    <div class="hidden md:flex items-center gap-3">
        <div class="text-right">
            <p class="font-body-md text-body-md text-primary font-semibold"><?php echo htmlspecialchars($username); ?></p>
            <p class="font-body-sm text-body-sm text-on-surface-variant">Verified Investor</p>
        </div>
        <div class="w-10 h-10 rounded-full bg-primary-container/20 text-primary flex items-center justify-center font-bold text-sm border border-surface-dim">
            <?php echo strtoupper(substr($username, 0, 2)); ?>
        </div>
    </div>
    <a href="../home.php" class="text-on-surface-variant hover:text-primary transition-colors text-sm hidden sm:inline">Home</a>
    <a href="../logout.php" class="flex items-center gap-2 text-on-surface-variant hover:text-error transition-colors">
        <span class="material-symbols-outlined">logout</span>
        <span class="font-label-md text-label-md uppercase hidden md:inline">Logout</span>
    </a>
</div>
</div>
</header>

<!-- Main Dashboard Container -->
<main class="flex-1 max-w-[1440px] mx-auto w-full px-margin-mobile md:px-margin-desktop py-stack-lg flex flex-col gap-stack-lg">
<!-- Header Section -->
<section class="flex flex-col gap-1">
    <h2 class="font-display-lg text-display-lg text-primary">Portfolio Overview</h2>
    <p class="font-body-lg text-body-lg text-on-surface-variant">Welcome back, <strong><?php echo htmlspecialchars($username); ?></strong>. Track your active agricultural investments and explore new verified projects.</p>
</section>

<!-- KPI Metrics Grid -->
<section class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
<div class="bg-surface-container-lowest rounded-xl p-stack-md md:p-gutter border border-surface-dim ambient-shadow flex items-center justify-between hover-lift">
<div>
<p class="font-label-md text-label-md text-on-surface-variant uppercase mb-2">Total Invested</p>
<p class="font-numeric-kpi text-numeric-kpi text-primary">৳<?php echo number_format($total_invested, 2); ?></p>
</div>
<div class="w-12 h-12 rounded-full bg-secondary-fixed/20 flex items-center justify-center">
<span class="material-symbols-outlined text-secondary text-2xl" style="font-variation-settings: 'FILL' 1;">account_balance</span>
</div>
</div>

<div class="bg-surface-container-lowest rounded-xl p-stack-md md:p-gutter border border-surface-dim ambient-shadow flex items-center justify-between hover-lift">
<div>
<p class="font-label-md text-label-md text-on-surface-variant uppercase mb-2">Investments Made</p>
<p class="font-numeric-kpi text-numeric-kpi text-primary"><?php echo $active_investments; ?> <?php echo $active_investments === 1 ? 'Project' : 'Projects'; ?></p>
</div>
<div class="w-12 h-12 rounded-full bg-secondary-fixed/20 flex items-center justify-center">
<span class="material-symbols-outlined text-secondary text-2xl" style="font-variation-settings: 'FILL' 1;">forest</span>
</div>
</div>
</section>

<!-- Navigation Action Buttons -->
<section class="flex flex-col sm:flex-row gap-4 items-center">
<a href="projects.php" class="w-full sm:w-auto bg-primary-container text-on-primary px-8 py-3.5 rounded-lg font-label-md text-label-md uppercase tracking-wider hover:bg-primary transition-colors flex items-center justify-center gap-2 shadow-sm">
    <span class="material-symbols-outlined">search</span>
    Browse Projects
</a>
<a href="my-investments.php" class="w-full sm:w-auto border-[1.5px] border-primary-container text-primary px-8 py-3.5 rounded-lg font-label-md text-label-md uppercase tracking-wider hover:bg-surface-container-low transition-colors flex items-center justify-center gap-2">
    <span class="material-symbols-outlined">folder_open</span>
    My Portfolio
</a>
</section>

<!-- Current Investments Table Section -->
<section class="flex flex-col gap-stack-md">
<!-- Header row with "View All" deep-link to the full portfolio page -->
<div class="flex items-center justify-between">
    <h3 class="font-headline-md text-headline-md text-primary">Recent Investments</h3>
    <a href="my-investments.php" class="text-sm font-semibold text-secondary hover:text-primary transition-colors">View All &rarr;</a>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-surface-dim ambient-shadow overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse min-w-[800px]">
<thead>
<tr class="bg-surface-container-low border-b border-surface-dim">
<th class="p-4 font-label-md text-label-md text-on-surface-variant uppercase">Project Name</th>
<th class="p-4 font-label-md text-label-md text-on-surface-variant uppercase">Location</th>
<th class="p-4 font-label-md text-label-md text-on-surface-variant uppercase">Amount Invested</th>
<th class="p-4 font-label-md text-label-md text-on-surface-variant uppercase">Status</th>
<th class="p-4 font-label-md text-label-md text-on-surface-variant uppercase text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-dim">
<?php if (count($investments_list) > 0): ?>
    <?php foreach ($investments_list as $inv): ?>
        <tr class="hover:bg-surface-bright transition-colors group">
        <td class="p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded bg-primary-fixed/30 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">eco</span>
                </div>
                <div>
                    <span class="font-body-md text-body-md font-semibold text-primary block"><?php echo htmlspecialchars($inv['project_title']); ?></span>
                    <span class="text-xs text-on-surface-variant">Crop: <?php echo htmlspecialchars($inv['crop']); ?></span>
                </div>
            </div>
        </td>
        <td class="p-4 font-body-md text-body-md text-on-surface-variant">
            <?php echo htmlspecialchars($inv['land_location']); ?>
            <span class="block text-xs text-on-surface-variant/70"><?php echo htmlspecialchars($inv['land_title']); ?></span>
        </td>
        <td class="p-4 font-body-md text-body-md text-primary font-semibold">৳<?php echo number_format((float)$inv['amount'], 2); ?></td>
        <td class="p-4">
            <?php if ($inv['project_status'] === 'active'): ?>
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-secondary-fixed/40 text-secondary font-label-md text-label-md uppercase">Active</span>
            <?php elseif ($inv['project_status'] === 'completed'): ?>
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-surface-dim text-on-surface-variant font-label-md text-label-md uppercase">Completed</span>
<!-- Empty state shown when the investor has no investments yet;
     encourages browsing active projects. -->
<?php else: ?>
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-[#FEF08A] text-[#854D0E] font-label-md text-label-md uppercase"><?php echo htmlspecialchars($inv['project_status']); ?></span>
            <?php endif; ?>
        </td>
        <td class="p-4 text-right">
            <a href="project-details.php?id=<?php echo (int)$inv['project_id']; ?>" class="text-primary-container hover:text-primary transition-colors p-2 rounded hover:bg-surface-container-high inline-block" title="View Project Details">
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
        </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="5" class="p-8 text-center text-on-surface-variant">
            <span class="material-symbols-outlined text-4xl text-outline mb-2">savings</span>
            <p class="font-body-md text-body-md">You have not made any investments yet.</p>
            <a href="projects.php" class="inline-block mt-3 bg-primary-container text-on-primary px-6 py-2 rounded-lg font-label-md text-label-md uppercase">Browse Active Projects</a>
        </td>
    </tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
</section>
</main>
</body>
</html>

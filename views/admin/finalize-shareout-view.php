<?php
extract($GLOBALS['_admin_finalize_shareout_data']);
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Finalize Shareout - ChasiConnect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Hanken+Grotesk:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-container": "#f0eded",
                    "on-tertiary-container": "#75b393",
                    "tertiary-fixed-dim": "#95d4b3",
                    "on-primary-container": "#86af99",
                    "tertiary-fixed": "#b1f0ce",
                    "outline-variant": "#c1c8c2",
                    "secondary": "#116c4a",
                    "primary-fixed-dim": "#a5d0b9",
                    "on-background": "#1c1b1b",
                    "on-secondary-fixed-variant": "#005236",
                    "on-error": "#ffffff",
                    "surface-variant": "#e5e2e1",
                    "inverse-on-surface": "#f3f0ef",
                    "on-secondary-fixed": "#002113",
                    "inverse-surface": "#313030",
                    "primary-container": "#1b4332",
                    "tertiary": "#002d1c",
                    "on-secondary-container": "#1b724f",
                    "secondary-fixed-dim": "#86d7ad",
                    "on-surface": "#1c1b1b",
                    "surface-dim": "#dcd9d9",
                    "background": "#fcf9f8",
                    "secondary-container": "#a1f4c8",
                    "on-primary": "#ffffff",
                    "secondary-fixed": "#a1f4c8",
                    "outline": "#717973",
                    "surface-bright": "#fcf9f8",
                    "surface-tint": "#3f6653",
                    "inverse-primary": "#a5d0b9",
                    "on-primary-fixed": "#002114",
                    "on-tertiary-fixed": "#002114",
                    "surface-container-low": "#f6f3f2",
                    "primary-fixed": "#c1ecd4",
                    "error-container": "#ffdad6",
                    "on-surface-variant": "#414844",
                    "primary": "#012d1d",
                    "on-primary-fixed-variant": "#274e3d",
                    "surface": "#fcf9f8",
                    "on-secondary": "#ffffff",
                    "surface-container-lowest": "#ffffff",
                    "on-tertiary-fixed-variant": "#0e5138",
                    "on-tertiary": "#ffffff",
                    "on-error-container": "#93000a",
                    "surface-container-high": "#eae7e7",
                    "error": "#ba1a1a",
                    "tertiary-container": "#00452e",
                    "surface-container-highest": "#e5e2e1"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "margin-mobile": "16px",
                    "stack-sm": "8px",
                    "stack-lg": "32px",
                    "base": "8px",
                    "container-max": "1440px",
                    "margin-desktop": "40px",
                    "stack-md": "16px",
                    "gutter": "24px"
            },
            "fontFamily": {
                    "body-md": ["hankenGrotesk", "sans-serif"],
                    "body-lg": ["hankenGrotesk", "sans-serif"],
                    "numeric-kpi": ["hankenGrotesk", "sans-serif"],
                    "headline-md": ["manrope", "sans-serif"],
                    "display-lg": ["manrope", "sans-serif"],
                    "body-sm": ["hankenGrotesk", "sans-serif"],
                    "headline-sm": ["manrope", "sans-serif"],
                    "headline-lg": ["manrope", "sans-serif"],
                    "label-md": ["hankenGrotesk", "sans-serif"]
            },
            "fontSize": {
                    "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                    "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                    "numeric-kpi": ["28px", { "lineHeight": "32px", "fontWeight": "600" }],
                    "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                    "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                    "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                    "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                    "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                    "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }]
            }
          },
        },
      }
</script>
<style>
        body { font-family: 'Hanken Grotesk', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-headline-lg, .font-headline-md, .font-headline-sm, .font-display-lg { font-family: 'Manrope', sans-serif; }
        .premium-shadow { box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06); }
        .premium-hover-shadow:hover { box-shadow: 0px 8px 30px rgba(27, 67, 50, 0.10); transform: translateY(-2px); }
</style>
</head>
<body class="bg-background text-on-surface font-body-md min-h-screen flex flex-col md:flex-row antialiased">
<!-- SideNavBar -->
<aside class="hidden lg:flex flex-col h-full p-6 bg-primary text-on-primary fixed left-0 top-0 w-[280px] shadow-sm z-50">
<div class="flex items-center gap-3 mb-12">
    <a href="admin-dashboard.php" class="flex items-center gap-3 text-on-primary">
        <img src="../logo.png" alt="ChasiConnect Logo" class="h-8 w-auto object-contain brightness-0 invert">
        <div>
            <h1 class="font-headline-sm text-headline-sm font-bold text-on-primary">ChasiConnect</h1>
            <p class="font-label-md text-label-md text-primary-fixed-dim">Admin Portal</p>
        </div>
    </a>
</div>
<nav class="flex-1 flex flex-col gap-2">
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="admin-dashboard.php">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="manage-users.php">
<span class="material-symbols-outlined">group</span>
<span class="font-label-md text-label-md">Manage Users</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="manage-project.php">
<span class="material-symbols-outlined">inventory_2</span>
<span class="font-label-md text-label-md">Manage Projects</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="verify-farmer.php">
<span class="material-symbols-outlined">verified</span>
<span class="font-label-md text-label-md">Verify Farmers</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="reports.php">
<span class="material-symbols-outlined">assessment</span>
<span class="font-label-md text-label-md">Reports</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 bg-primary-container text-on-primary font-semibold rounded-lg shadow-sm" href="finalize-shareout.php">
<span class="material-symbols-outlined">payments</span>
<span class="font-label-md text-label-md">Finalize Shareout</span>
</a>
</nav>
<div class="mt-auto flex flex-col gap-2 pt-6 border-t border-on-primary/10">
<a class="flex items-center gap-3 px-4 py-2 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/30 transition-colors" href="../home.php">
<span class="material-symbols-outlined text-sm">home</span>
<span class="font-label-md text-label-md">Back to Site</span>
</a>
<a class="flex items-center gap-3 px-4 py-2 rounded-lg text-on-primary-fixed-variant hover:text-error hover:bg-error-container/20 transition-colors" href="../logout.php">
<span class="material-symbols-outlined text-sm">logout</span>
<span class="font-label-md text-label-md">Logout</span>
</a>
</div>
</aside>

<!-- Main Content Area -->
<main class="flex-1 w-full lg:ml-[280px] min-h-screen bg-background flex flex-col">
<!-- TopNavBar -->
<header class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop h-16 bg-surface border-b border-outline-variant z-40 sticky top-0">
<div class="flex items-center gap-3">
    <a href="admin-dashboard.php" class="lg:hidden flex items-center gap-2">
        <img src="../logo.png" alt="ChasiConnect" class="h-7 w-auto">
        <span class="font-headline-sm text-headline-sm font-bold text-primary">ChasiConnect</span>
    </a>
    <span class="hidden lg:block font-headline-sm text-headline-sm font-bold text-primary">Profit Distribution</span>
</div>
<div class="flex items-center gap-4">
    <a href="../home.php" class="text-on-surface-variant hover:text-primary transition-colors text-sm">Public Home</a>
    <a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors flex items-center gap-1 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">logout</span>
        <span>Logout</span>
    </a>
</div>
</header>

<div class="p-margin-mobile md:p-margin-desktop max-w-container-max mx-auto w-full flex-grow">
<!-- Header Section -->
<header class="mb-stack-lg">
<h1 class="font-display-lg text-display-lg text-on-background mb-stack-sm">Finalize Shareout</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Admin-triggered financial reconciliation and automated payout execution for completed projects.</p>
</header>

<?php if (!empty($message)): ?>
    <div class="mb-6 p-4 rounded-lg <?php echo $message_class === "registration-message" ? "bg-secondary-container/40 text-secondary border border-secondary/30" : "bg-error-container text-error border border-error/20"; ?> text-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5"><?php echo $message_class === "registration-message" ? "check_circle" : "error"; ?></span>
        <div class="font-medium"><?php echo htmlspecialchars($message); ?></div>
    </div>
<?php endif; ?>

<?php if ($latest_distribution): ?>
    <!-- Content Section: Financials (Reconciliation Summary) -->
    <section class="mb-stack-lg">
    <h2 class="font-headline-md text-headline-md text-on-surface mb-stack-md">Latest Reconciliation Summary</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mb-stack-md">
    <!-- Revenue -->
    <div class="bg-surface-container-lowest rounded-xl p-6 premium-shadow border border-outline-variant/30 flex flex-col">
        <span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-2">Total Revenue</span>
        <span class="font-numeric-kpi text-numeric-kpi text-on-background mb-1">৳<?php echo number_format((float)$latest_distribution["total_revenue"], 2); ?></span>
        <span class="font-body-sm text-body-sm text-secondary flex items-center gap-1 mt-auto">
            From <?php echo (int)$latest_distribution["harvest_count"]; ?> recorded harvests
        </span>
    </div>
    <!-- Required Budget -->
    <div class="bg-surface-container-lowest rounded-xl p-6 premium-shadow border border-outline-variant/30 flex flex-col">
        <span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-2">Required Budget</span>
        <span class="font-numeric-kpi text-numeric-kpi text-on-background mb-1">৳<?php echo number_format((float)$latest_distribution["required_budget"], 2); ?></span>
        <span class="font-body-sm text-body-sm text-on-surface-variant mt-auto">Reimbursed capital cost</span>
    </div>
    <!-- Investor Pool -->
    <div class="bg-surface-container-lowest rounded-xl p-6 premium-shadow border border-outline-variant/30 flex flex-col">
        <span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-2">Investor Pool (60%)</span>
        <span class="font-numeric-kpi text-numeric-kpi text-primary mb-1">৳<?php echo number_format((float)$latest_distribution["investor_pool"], 2); ?></span>
        <span class="font-body-sm text-body-sm text-on-surface-variant mt-auto">Distributed proportionally</span>
    </div>
    <!-- Farmer Share -->
    <div class="bg-surface-container-lowest rounded-xl p-6 premium-shadow border border-outline-variant/30 flex flex-col">
        <span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-2">Farmer & Platform</span>
        <span class="font-numeric-kpi text-numeric-kpi text-secondary mb-1">৳<?php echo number_format((float)$latest_distribution["farmer_share"], 2); ?></span>
        <span class="font-body-sm text-body-sm text-on-surface-variant mt-auto">Platform: ৳<?php echo number_format((float)$latest_distribution["platform_share"], 2); ?></span>
    </div>
    </div>

    <!-- Breakdown Table -->
    <div class="mb-stack-lg bg-surface-container-lowest rounded-xl premium-shadow border border-outline-variant/30 overflow-hidden">
        <div class="p-6 border-b border-outline-variant/30">
            <h3 class="font-headline-sm text-headline-sm text-on-background">Investor Payout Breakdown &mdash; Project #<?php echo (int)$latest_distribution["project_id"]; ?></h3>
        </div>
        <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-surface-container-low font-body-sm text-body-sm text-on-surface-variant uppercase">
            <tr>
                <th class="py-4 px-6 font-bold tracking-wider">Investor Name</th>
                <th class="py-4 px-6 font-bold tracking-wider">Principal Invested</th>
                <th class="py-4 px-6 font-bold tracking-wider text-right">Profit Payout</th>
            </tr>
            </thead>
            <tbody class="font-body-md text-body-md text-on-surface divide-y divide-outline-variant/20">
            <?php foreach ($latest_distribution["investor_rows"] as $row): ?>
                <tr class="hover:bg-surface-container-low/50 transition-colors">
                <td class="py-4 px-6 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-primary-container/20 flex items-center justify-center text-primary font-bold text-xs">
                        <?php echo strtoupper(substr($row["investor_name"], 0, 2)); ?>
                    </div>
                    <?php echo htmlspecialchars($row["investor_name"]); ?>
                </td>
                <td class="py-4 px-6">৳<?php echo number_format((float)$row["amount"], 2); ?></td>
                <td class="py-4 px-6 text-right font-numeric-kpi text-[20px] text-secondary font-semibold">৳<?php echo number_format((float)$row["profit_share"], 2); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
    </section>
<?php endif; ?>

<!-- Section: Actionable Completed Projects -->
<?php
foreach ($projects_res as $_k => $_p) {
    $revenue       = round((float)$_p["total_revenue"], 2);
    $budget        = round((float)$_p["required_budget"], 2);
    $confirmed_inv = round((float)$_p["confirmed_investment"], 2);
    $projects_res[$_k]["_net_profit"] = round($revenue - $budget, 2);
    $projects_res[$_k]["_eligible"]   = ((int)$_p["harvest_count"] >= 1) && ($revenue - $budget > 0) && $confirmed_inv > 0;
    if ((int)$_p["harvest_count"] < 1) {
        $projects_res[$_k]["_blocked_reason"] = "No harvest records — final revenue unknown. Farmer must log harvests first.";
    } elseif ($revenue - $budget <= 0) {
        $projects_res[$_k]["_blocked_reason"] = "No distributable profit (revenue ≤ required budget).";
    } elseif ($confirmed_inv <= 0) {
        $projects_res[$_k]["_blocked_reason"] = "No confirmed investments found.";
    } else {
        $projects_res[$_k]["_blocked_reason"] = "";
    }
}
unset($_k, $_p, $revenue, $budget, $confirmed_inv);
?>
<section class="mb-stack-lg bg-surface-container-lowest rounded-xl premium-shadow border border-outline-variant/30 overflow-hidden">
<div class="p-6 border-b border-outline-variant/30 flex items-center justify-between">
    <h3 class="font-headline-sm text-headline-sm text-on-background">Settlement Pending Projects</h3>
    <span class="bg-amber-100 text-amber-800 font-label-md text-label-md px-3 py-1 rounded-full">
        <?php echo count($projects_res); ?> Settlement Pending
    </span>
</div>

<?php if (count($projects_res) > 0): ?>
    <div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
    <thead class="bg-surface-container-low font-body-sm text-body-sm text-on-surface-variant uppercase">
    <tr>
        <th class="py-4 px-6 font-bold tracking-wider">Project</th>
        <th class="py-4 px-6 font-bold tracking-wider">Farmer</th>
        <th class="py-4 px-6 font-bold tracking-wider">Landowner</th>
        <th class="py-4 px-6 font-bold tracking-wider">Status</th>
        <th class="py-4 px-6 font-bold tracking-wider">Investors</th>
        <th class="py-4 px-6 font-bold tracking-wider">Confirmed Investment (Principal)</th>
        <th class="py-4 px-6 font-bold tracking-wider">Required Budget</th>
        <th class="py-4 px-6 font-bold tracking-wider">Final Revenue</th>
        <th class="py-4 px-6 font-bold tracking-wider">Net Profit</th>
        <th class="py-4 px-6 font-bold tracking-wider">Planned Distribution</th>
        <th class="py-4 px-6 font-bold tracking-wider text-right">Action</th>
    </tr>
    </thead>
<!-- SPLIT:TBODY -->
    <tbody class="font-body-md text-body-md text-on-surface divide-y divide-outline-variant/20">
    <?php foreach ($projects_res as $project): ?>
        <?php
            $profit       = (float)$project["_net_profit"];
            $inv_pool     = round($profit * 0.60, 2);
            $farmer_amt   = round($profit * 0.395, 2);
            $platform_amt = round($profit * 0.005, 2);
        ?>
        <tr class="hover:bg-surface-container-low/50 transition-colors">
            <td class="py-4 px-6">
                <div class="font-semibold text-primary"><?php echo htmlspecialchars($project["title"]); ?></div>
                <div class="text-xs text-on-surface-variant">Crop: <?php echo htmlspecialchars($project["crop"]); ?> &middot; #<?php echo (int)$project["id"]; ?></div>
            </td>
            <td class="py-4 px-6 font-body-sm text-body-sm text-on-surface"><?php echo htmlspecialchars($project["farmer_name"]); ?></td>
            <td class="py-4 px-6 font-body-sm text-body-sm text-on-surface">
                <?php echo htmlspecialchars($project["landowner_name"]); ?>
                <div class="text-xs text-on-surface-variant">Fixed lease only &middot; 0% profit share</div>
            </td>
            <td class="py-4 px-6">
                <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Completed</span>
                <div class="text-xs text-on-surface-variant mt-1">Settlement Pending</div>
            </td>
            <td class="py-4 px-6 font-body-sm text-body-sm"><?php echo (int)$project["investor_count"]; ?></td>
            <td class="py-4 px-6 font-body-sm text-body-sm">৳<?php echo number_format((float)$project["confirmed_investment"], 2); ?></td>
            <td class="py-4 px-6 font-body-sm text-body-sm text-on-surface-variant">৳<?php echo number_format((float)$project["required_budget"], 2); ?></td>
            <td class="py-4 px-6 font-body-sm text-body-sm">
                ৳<?php echo number_format((float)$project["total_revenue"], 2); ?>
                <div class="text-xs text-on-surface-variant"><?php echo (int)$project["harvest_count"]; ?> harvest row(s)</div>
            </td>
            <td class="py-4 px-6 font-numeric-kpi text-[16px] <?php echo $profit >= 0 ? "text-secondary" : "text-error"; ?>">
                ৳<?php echo number_format($profit, 2); ?>
            </td>
            <td class="py-4 px-6 text-xs text-on-surface">
                Inv (60%): ৳<?php echo number_format($inv_pool, 2); ?><br>
                Farmer (39.5%): ৳<?php echo number_format($farmer_amt, 2); ?><br>
                Platform (0.5%): ৳<?php echo number_format($platform_amt, 2); ?><br>
                Landowner: ৳0.00
            </td>
            <td class="py-4 px-6 text-right">
                <?php if ($project["_eligible"]): ?>
                <form method="post" onsubmit="return confirm('Execute final profit shareout for project #<?php echo (int)$project['id']; ?>? This reconciles DB records, distributes profit and marks it settled. It can only be done ONCE.');" class="m-0 inline-block">
                    <input type="hidden" name="project_id" value="<?php echo (int)$project["id"]; ?>">
                    <input type="hidden" name="action" value="finalize">
                    <button type="submit" class="bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md py-2 px-5 rounded-lg shadow-sm transition-all flex items-center gap-1.5 cursor-pointer">
                        <span class="material-symbols-outlined text-[18px]">payments</span>
                        Finalize Shareout
                    </button>
                </form>
                <?php else: ?>
                    <span class="inline-flex items-center gap-2 text-xs text-error bg-error-container px-3 py-2 rounded-lg max-w-[240px] text-left">
                        <span class="material-symbols-outlined text-[16px]">block</span>
                        <?php echo htmlspecialchars($project["_blocked_reason"]); ?>
                    </span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    </div>
<?php else: ?>
    <div class="p-12 text-center text-on-surface-variant">
        <span class="material-symbols-outlined text-4xl text-secondary mb-2">task_alt</span>
        <p class="font-body-md text-body-md font-medium">No completed projects are currently pending profit shareout.</p>
    </div>
<?php endif; ?>
</section>
</div>
</main>
</body>
</html>

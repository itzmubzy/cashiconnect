<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/AdminController.php';

Auth::requireRole('admin');

$adminController = new AdminController();
$adminController->dashboard();
extract($GLOBALS['_admin_dashboard_data']);

$user_id = Auth::userId();
$username = Auth::username();
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin Dashboard - ChasiConnect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-variant": "#e5e2e1",
                        "inverse-surface": "#313030",
                        "error": "#ba1a1a",
                        "on-tertiary-fixed": "#002114",
                        "primary-fixed": "#c1ecd4",
                        "primary-fixed-dim": "#a5d0b9",
                        "secondary-container": "#a1f4c8",
                        "primary-container": "#1b4332",
                        "outline-variant": "#c1c8c2",
                        "surface-container": "#f0eded",
                        "on-secondary-container": "#1b724f",
                        "on-tertiary": "#ffffff",
                        "error-container": "#ffdad6",
                        "tertiary-fixed": "#b1f0ce",
                        "surface-tint": "#3f6653",
                        "on-primary-container": "#86af99",
                        "on-secondary": "#ffffff",
                        "on-surface": "#1c1b1b",
                        "surface": "#fcf9f8",
                        "surface-container-low": "#f6f3f2",
                        "surface-dim": "#dcd9d9",
                        "surface-container-high": "#eae7e7",
                        "on-secondary-fixed": "#002113",
                        "inverse-on-surface": "#f3f0ef",
                        "on-tertiary-fixed-variant": "#0e5138",
                        "secondary-fixed": "#a1f4c8",
                        "primary": "#012d1d",
                        "on-tertiary-container": "#75b393",
                        "on-primary-fixed-variant": "#274e3d",
                        "surface-bright": "#fcf9f8",
                        "on-surface-variant": "#414844",
                        "inverse-primary": "#a5d0b9",
                        "surface-container-lowest": "#ffffff",
                        "on-background": "#1c1b1b",
                        "on-error-container": "#93000a",
                        "outline": "#717973",
                        "secondary": "#116c4a",
                        "surface-container-highest": "#e5e2e1",
                        "on-secondary-fixed-variant": "#005236",
                        "tertiary": "#002d1c",
                        "tertiary-container": "#00452e",
                        "secondary-fixed-dim": "#86d7ad",
                        "on-error": "#ffffff",
                        "on-primary": "#ffffff",
                        "on-primary-fixed": "#002114",
                        "background": "#fcf9f8",
                        "tertiary-fixed-dim": "#95d4b3"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "stack-sm": "8px",
                        "base": "8px",
                        "margin-mobile": "16px",
                        "margin-desktop": "40px",
                        "stack-md": "16px",
                        "stack-lg": "32px",
                        "gutter": "24px",
                        "container-max": "1440px"
                    },
                    "fontFamily": {
                        "body-lg": ["hankenGrotesk", "sans-serif"],
                        "headline-lg": ["manrope", "sans-serif"],
                        "label-md": ["hankenGrotesk", "sans-serif"],
                        "numeric-kpi": ["hankenGrotesk", "sans-serif"],
                        "headline-sm": ["manrope", "sans-serif"],
                        "body-md": ["hankenGrotesk", "sans-serif"],
                        "display-lg": ["manrope", "sans-serif"],
                        "body-sm": ["hankenGrotesk", "sans-serif"],
                        "headline-md": ["manrope", "sans-serif"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "numeric-kpi": ["28px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }]
                    },
                    boxShadow: {
                        'diffused': '0px 4px 20px rgba(27, 67, 50, 0.06)',
                        'diffused-hover': '0px 8px 30px rgba(27, 67, 50, 0.10)',
                    }
                },
            },
        }
    </script>
<style>
        body { font-family: 'Hanken Grotesk', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-headline-lg, .font-headline-md, .font-headline-sm, .font-display-lg { font-family: 'Manrope', sans-serif; }
</style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col">
<!-- TopNavBar -->
<header class="bg-surface font-body-md text-body-md top-0 border-b border-outline-variant shadow-sm sticky z-50">
<div class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop py-4 max-w-container-max mx-auto">
<div class="flex items-center gap-3">
    <a href="admin-dashboard.php" class="flex items-center gap-2">
        <img src="../logo.png" alt="ChasiConnect Logo" class="h-8 w-auto object-contain">
        <span class="font-headline-md text-headline-md font-bold text-primary">ChasiConnect Admin</span>
    </a>
</div>
<nav class="hidden md:flex gap-gutter items-center">
<a class="text-primary font-bold border-b-2 border-primary pb-1" href="admin-dashboard.php">Dashboard</a>
<a class="text-on-surface-variant hover:text-primary transition-colors" href="manage-users.php">Users</a>
<a class="text-on-surface-variant hover:text-primary transition-colors" href="manage-project.php">Projects</a>
<a class="text-on-surface-variant hover:text-primary transition-colors" href="verify-farmer.php">Verifications</a>
<a class="text-on-surface-variant hover:text-primary transition-colors" href="reports.php">Reports <?php if ($pending_reports > 0): ?><span class="bg-error text-white text-xs px-2 py-0.5 rounded-full font-bold ml-1"><?php echo $pending_reports; ?></span><?php endif; ?></a>
<a class="text-on-surface-variant hover:text-primary transition-colors" href="finalize-shareout.php">Shareout</a>
</nav>
<div class="flex items-center gap-4">
<a href="../home.php" class="text-on-surface-variant hover:text-primary transition-colors text-sm">Home</a>
<a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors font-label-md text-label-md flex items-center gap-base cursor-pointer">
<span>Logout</span>
<span class="material-symbols-outlined" data-icon="logout">logout</span>
</a>
</div>
</div>
</header>

<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg flex flex-col gap-stack-lg">
<!-- Header Section -->
<section class="flex flex-col gap-stack-sm">
<h1 class="font-display-lg text-display-lg text-primary">Admin Dashboard</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant">Welcome back, Administrator <strong><?php echo htmlspecialchars($username); ?></strong></p>
</section>

<!-- Metrics Grid -->
<section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-gutter">
<!-- KPI Card: Total Users -->
<div class="bg-surface-container-lowest rounded-lg p-stack-md shadow-diffused hover:shadow-diffused-hover transition-all duration-300 transform hover:-translate-y-1 border border-outline-variant/30 flex flex-col gap-stack-sm">
<div class="flex justify-between items-start text-on-surface-variant">
<span class="font-label-md text-label-md uppercase tracking-wider">Total Users</span>
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">group</span>
</div>
<div class="font-numeric-kpi text-numeric-kpi text-primary">
    <?php echo number_format($total_users); ?>
</div>
</div>
<!-- KPI Card: Farmers -->
<div class="bg-surface-container-lowest rounded-lg p-stack-md shadow-diffused hover:shadow-diffused-hover transition-all duration-300 transform hover:-translate-y-1 border border-outline-variant/30 flex flex-col gap-stack-sm">
<div class="flex justify-between items-start text-on-surface-variant">
<span class="font-label-md text-label-md uppercase tracking-wider">Farmers</span>
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">agriculture</span>
</div>
<div class="font-numeric-kpi text-numeric-kpi text-primary">
    <?php echo number_format($total_farmers); ?>
</div>
</div>
<!-- KPI Card: Investors -->
<div class="bg-surface-container-lowest rounded-lg p-stack-md shadow-diffused hover:shadow-diffused-hover transition-all duration-300 transform hover:-translate-y-1 border border-outline-variant/30 flex flex-col gap-stack-sm">
<div class="flex justify-between items-start text-on-surface-variant">
<span class="font-label-md text-label-md uppercase tracking-wider">Investors</span>
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">payments</span>
</div>
<div class="font-numeric-kpi text-numeric-kpi text-primary">
    <?php echo number_format($total_investors); ?>
</div>
</div>
<!-- KPI Card: Landowners -->
<div class="bg-surface-container-lowest rounded-lg p-stack-md shadow-diffused hover:shadow-diffused-hover transition-all duration-300 transform hover:-translate-y-1 border border-outline-variant/30 flex flex-col gap-stack-sm">
<div class="flex justify-between items-start text-on-surface-variant">
<span class="font-label-md text-label-md uppercase tracking-wider">Landowners</span>
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">landscape</span>
</div>
<div class="font-numeric-kpi text-numeric-kpi text-primary">
    <?php echo number_format($total_landowners); ?>
</div>
</div>
<!-- KPI Card: Projects -->
<div class="bg-surface-container-lowest rounded-lg p-stack-md shadow-diffused hover:shadow-diffused-hover transition-all duration-300 transform hover:-translate-y-1 border border-outline-variant/30 flex flex-col gap-stack-sm">
<div class="flex justify-between items-start text-on-surface-variant">
<span class="font-label-md text-label-md uppercase tracking-wider">Projects</span>
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">account_tree</span>
</div>
<div class="font-numeric-kpi text-numeric-kpi text-primary">
    <?php echo number_format($total_projects); ?>
</div>
</div>
</section>

<!-- Navigation Section (Administrative Action Buttons) -->
<section class="flex flex-col gap-stack-md mt-stack-lg">
<h2 class="font-headline-sm text-headline-sm text-primary border-b border-outline-variant pb-base">Quick Management Actions</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-gutter">
<!-- Action: Manage Users -->
<a href="manage-users.php" class="bg-primary-container text-on-primary rounded-lg p-stack-md flex flex-col items-center justify-center gap-stack-sm hover:opacity-90 transition-opacity focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 min-h-[120px] shadow-sm text-center">
<span class="material-symbols-outlined text-[32px]">manage_accounts</span>
<span class="font-label-md text-label-md font-semibold">Manage Users</span>
</a>
<!-- Action: Manage Projects -->
<a href="manage-project.php" class="bg-primary-container text-on-primary rounded-lg p-stack-md flex flex-col items-center justify-center gap-stack-sm hover:opacity-90 transition-opacity focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 min-h-[120px] shadow-sm text-center">
<span class="material-symbols-outlined text-[32px]">inventory_2</span>
<span class="font-label-md text-label-md font-semibold">Manage Projects</span>
</a>
<!-- Action: Verify Farmers -->
<a href="verify-farmer.php" class="bg-primary-container text-on-primary rounded-lg p-stack-md flex flex-col items-center justify-center gap-stack-sm hover:opacity-90 transition-opacity focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 min-h-[120px] shadow-sm text-center">
<span class="material-symbols-outlined text-[32px]">verified</span>
<span class="font-label-md text-label-md font-semibold">Verify Farmers</span>
</a>
<!-- Action: Reports -->
<a href="reports.php" class="bg-surface-container-high text-on-surface rounded-lg border border-outline-variant p-stack-md flex flex-col items-center justify-center gap-stack-sm hover:bg-surface-variant transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 min-h-[120px] text-center relative">
<span class="material-symbols-outlined text-[32px]">bar_chart</span>
<span class="font-label-md text-label-md font-semibold">Reports (<?php echo $pending_reports; ?>)</span>
</a>
<!-- Action: Finalize Shareout -->
<a href="finalize-shareout.php" class="bg-surface-container-high text-on-surface rounded-lg border border-outline-variant p-stack-md flex flex-col items-center justify-center gap-stack-sm hover:bg-surface-variant transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 min-h-[120px] text-center">
<span class="material-symbols-outlined text-[32px]">account_balance_wallet</span>
<span class="font-label-md text-label-md font-semibold">Finalize Shareout</span>
</a>
</div>
</section>
</main>

<!-- Footer -->
<footer class="bg-surface-container-lowest font-label-md text-label-md full-width border-t border-outline-variant mt-auto">
<div class="flex flex-col md:flex-row justify-between items-center px-margin-mobile md:px-margin-desktop py-stack-md max-w-container-max mx-auto gap-stack-md md:gap-0">
<span class="font-label-md text-label-md font-bold text-on-surface-variant">&copy; <?php echo date("Y"); ?> ChasiConnect. All rights reserved.</span>
<div class="flex gap-gutter">
<a class="text-on-surface-variant hover:text-primary transition-all" href="../home.php">Home</a>
<a class="text-on-surface-variant hover:text-primary transition-all" href="../logout.php">Logout</a>
</div>
</div>
</footer>
</body>
</html>

<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/LandownerController.php';

Auth::requireRole('landowner');

$landownerController = new LandownerController();
$landownerController->dashboard();
extract($GLOBALS['_landowner_dashboard_data']);

$user_id = Auth::userId();
$username = Auth::username();
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Landowner Dashboard - ChasiConnect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Hanken+Grotesk:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "inverse-on-surface": "#f3f0ef",
                      "primary-container": "#1b4332",
                      "tertiary-fixed-dim": "#95d4b3",
                      "outline-variant": "#c1c8c2",
                      "secondary-fixed": "#a1f4c8",
                      "on-primary-fixed-variant": "#274e3d",
                      "surface-container-lowest": "#ffffff",
                      "on-primary-fixed": "#002114",
                      "surface": "#fcf9f8",
                      "error-container": "#ffdad6",
                      "primary-fixed-dim": "#a5d0b9",
                      "surface-tint": "#3f6653",
                      "on-secondary-container": "#1b724f",
                      "surface-container-low": "#f6f3f2",
                      "surface-variant": "#e5e2e1",
                      "surface-dim": "#dcd9d9",
                      "on-error-container": "#93000a",
                      "on-tertiary-container": "#75b393",
                      "tertiary-container": "#00452e",
                      "on-background": "#1c1b1b",
                      "on-secondary": "#ffffff",
                      "surface-container-high": "#eae7e7",
                      "on-secondary-fixed": "#002113",
                      "primary-fixed": "#c1ecd4",
                      "on-error": "#ffffff",
                      "background": "#fcf9f8",
                      "primary": "#012d1d",
                      "on-tertiary": "#ffffff",
                      "error": "#ba1a1a",
                      "surface-container-highest": "#e5e2e1",
                      "secondary-container": "#a1f4c8",
                      "on-surface": "#1c1b1b",
                      "inverse-primary": "#a5d0b9",
                      "on-surface-variant": "#414844",
                      "on-tertiary-fixed-variant": "#0e5138",
                      "on-primary": "#ffffff",
                      "inverse-surface": "#313030",
                      "tertiary": "#002d1c",
                      "surface-container": "#f0eded",
                      "secondary": "#116c4a",
                      "secondary-fixed-dim": "#86d7ad",
                      "on-primary-container": "#86af99",
                      "tertiary-fixed": "#b1f0ce",
                      "on-secondary-fixed-variant": "#005236",
                      "surface-bright": "#fcf9f8",
                      "outline": "#717973",
                      "on-tertiary-fixed": "#002114"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "base": "8px",
                      "margin-desktop": "40px",
                      "margin-mobile": "16px",
                      "container-max": "1440px",
                      "stack-md": "16px",
                      "stack-lg": "32px",
                      "stack-sm": "8px",
                      "gutter": "24px"
              },
              "fontFamily": {
                      "headline-md": ["Manrope", "sans-serif"],
                      "body-md": ["Hanken Grotesk", "sans-serif"],
                      "headline-sm": ["Manrope", "sans-serif"],
                      "body-sm": ["Hanken Grotesk", "sans-serif"],
                      "numeric-kpi": ["Hanken Grotesk", "sans-serif"],
                      "label-md": ["Hanken Grotesk", "sans-serif"],
                      "display-lg": ["Manrope", "sans-serif"],
                      "body-lg": ["Hanken Grotesk", "sans-serif"],
                      "headline-lg": ["Manrope", "sans-serif"]
              },
              "fontSize": {
                      "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                      "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                      "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                      "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                      "numeric-kpi": ["28px", { "lineHeight": "32px", "fontWeight": "600" }],
                      "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                      "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                      "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                      "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }]
              }
            },
          },
        }
</script>
<style>
        body { font-family: 'Hanken Grotesk', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-headline-lg, .font-headline-md, .font-headline-sm, .font-display-lg { font-family: 'Manrope', sans-serif; }
        .shadow-kpi { box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06); }
        .shadow-kpi-hover:hover { box-shadow: 0px 8px 24px rgba(27, 67, 50, 0.10); transform: translateY(-2px); }
</style>
</head>
<body class="bg-surface text-on-surface font-body-md antialiased min-h-screen flex flex-col">
<!-- TopNavBar -->
<nav class="bg-surface border-b border-outline-variant sticky top-0 z-50 flex justify-between items-center px-margin-mobile md:px-margin-desktop w-full max-w-container-max mx-auto h-16">
<div class="flex items-center gap-stack-lg">
    <a href="landowner-dashboard.php" class="flex items-center gap-3">
        <div class="flex items-center justify-center w-9 h-9 bg-primary-container rounded-lg">
            <span class="material-symbols-outlined text-on-primary text-xl" style="font-variation-settings: 'FILL' 1;">landscape</span>
        </div>
        <span class="font-headline-md text-headline-md font-bold text-primary">ChasiConnect</span>
    </a>
    <div class="hidden md:flex gap-stack-md ml-4">
        <a class="text-primary font-bold border-b-2 border-primary pb-1" href="landowner-dashboard.php">Dashboard</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="manage-land.php">My Land</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="farmer-list.php">Find Farmer</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="hiring-requests.php">Requests</a>
    </div>
</div>
<div class="flex items-center gap-stack-md">
    <div class="hidden sm:flex items-center gap-3">
        <div class="text-right">
            <p class="font-body-md text-body-md text-primary font-semibold"><?php echo htmlspecialchars($username); ?></p>
            <p class="text-xs text-on-surface-variant">Landowner</p>
        </div>
        <div class="w-9 h-9 rounded-full bg-primary-container/20 text-primary flex items-center justify-center font-bold text-sm border border-outline-variant">
            <?php echo strtoupper(substr($username, 0, 2)); ?>
        </div>
    </div>
    <a href="../home.php" class="text-on-surface-variant hover:text-primary transition-colors text-sm hidden lg:inline">Home</a>
    <a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors flex items-center gap-1 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">logout</span>
        <span class="hidden sm:inline">Logout</span>
    </a>
</div>
</nav>

<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg flex flex-col gap-stack-lg">
<!-- Header Section -->
<header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-stack-md">
<div>
    <h1 class="font-headline-lg text-headline-lg text-primary">Landowner Dashboard</h1>
    <p class="font-body-md text-body-md text-on-surface-variant mt-1">Manage your agricultural land assets, partner with verified farmers, and monitor lease returns.</p>
</div>
<div class="flex flex-wrap gap-stack-sm w-full md:w-auto">
    <a href="add-land.php" class="bg-primary-container text-on-primary border-[1.5px] border-primary-container font-label-md text-label-md rounded-lg px-5 py-2.5 hover:bg-primary transition-colors flex-1 md:flex-none text-center shadow-sm flex items-center justify-center gap-1.5">
        <span class="material-symbols-outlined text-[18px]">add</span>
        Add New Land
    </a>
    <a href="farmer-list.php" class="bg-surface text-primary border-[1.5px] border-primary-container font-label-md text-label-md rounded-lg px-5 py-2.5 hover:bg-surface-container-low transition-colors flex-1 md:flex-none text-center flex items-center justify-center gap-1.5">
        <span class="material-symbols-outlined text-[18px]">search</span>
        Find a Farmer
    </a>
</div>
</header>

<!-- KPI Grid -->
<section class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
<div class="bg-surface-container-lowest rounded-xl p-6 shadow-kpi shadow-kpi-hover transition-all duration-300 border border-outline-variant/40 flex items-center justify-between">
    <div>
        <h3 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">My Lands Listed</h3>
        <span class="font-numeric-kpi text-numeric-kpi text-primary"><?php echo $lands_count; ?> <?php echo $lands_count === 1 ? 'Parcel' : 'Parcels'; ?></span>
    </div>
    <div class="w-12 h-12 rounded-full bg-secondary-fixed/20 flex items-center justify-center text-secondary">
        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">landscape</span>
    </div>
</div>

<div class="bg-surface-container-lowest rounded-xl p-6 shadow-kpi shadow-kpi-hover transition-all duration-300 border border-outline-variant/40 flex items-center justify-between">
    <div>
        <h3 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Hiring Proposals Sent</h3>
        <span class="font-numeric-kpi text-numeric-kpi text-primary"><?php echo $hiring_count; ?> <?php echo $hiring_count === 1 ? 'Request' : 'Requests'; ?></span>
    </div>
    <div class="w-12 h-12 rounded-full bg-primary-fixed/30 flex items-center justify-center text-primary">
        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">handshake</span>
    </div>
</div>
</section>

<!-- Data Sections (2 Columns) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
<!-- Left Column: Accepted Lease Offers -->
<section class="lg:col-span-2 flex flex-col gap-stack-md">
<div class="bg-surface-container-lowest rounded-xl shadow-kpi border border-outline-variant/40 p-6 flex flex-col h-full">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-headline-sm text-headline-sm text-primary">Accepted Lease Offers</h2>
        <a href="hiring-requests.php" class="text-secondary hover:text-primary font-label-md text-label-md font-semibold">View All &rarr;</a>
    </div>

    <?php if (count($lease_offers) > 0): ?>
        <div class="overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[550px]">
        <thead>
        <tr class="bg-surface-container-low border-b border-outline-variant font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
            <th class="py-3 px-4">Land Parcel</th>
            <th class="py-3 px-4">Farmer</th>
            <th class="py-3 px-4">Lease Amount</th>
            <th class="py-3 px-4">Payout Status</th>
        </tr>
        </thead>
        <tbody class="font-body-sm text-body-sm divide-y divide-outline-variant/30 text-on-surface">
        <?php foreach ($lease_offers as $offer): ?>
            <tr class="hover:bg-surface-bright transition-colors">
                <td class="py-4 px-4 font-semibold text-primary"><?php echo htmlspecialchars($offer['land_title']); ?></td>
                <td class="py-4 px-4"><?php echo htmlspecialchars($offer['farmer_name']); ?></td>
                <td class="py-4 px-4 font-numeric-kpi text-[17px] text-primary font-bold">৳<?php echo number_format((float)$offer['lease_amount'], 2); ?></td>
                <td class="py-4 px-4">
                    <?php if (!empty($offer['lease_paid_at'])): ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-secondary-container text-on-secondary-container">
                            Paid on <?php echo htmlspecialchars(date('d M Y', strtotime($offer['lease_paid_at']))); ?>
                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#FEF08A] text-[#854D0E]">
                            Pending Funding
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
        </div>
    <?php else: ?>
        <div class="p-8 text-center text-on-surface-variant my-auto">
            <span class="material-symbols-outlined text-4xl text-outline mb-2">contract</span>
            <p class="font-body-md text-body-md">No accepted lease offers yet.</p>
            <a href="farmer-list.php" class="inline-block mt-3 bg-primary-container text-on-primary px-5 py-2 rounded-lg font-label-md text-label-md uppercase">Find a Farmer</a>
        </div>
    <?php endif; ?>
</div>
</section>

<!-- Right Column: My Land Overview -->
<section class="flex flex-col gap-stack-md">
<div class="bg-surface-container-lowest rounded-xl shadow-kpi border border-outline-variant/40 p-6 flex flex-col h-full">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-headline-sm text-headline-sm text-primary">Land Overview</h2>
        <a href="manage-land.php" class="text-secondary hover:text-primary font-label-md text-label-md font-semibold">Manage &rarr;</a>
    </div>

    <?php if (count($lands_list) > 0): ?>
        <div class="flex flex-col gap-3 flex-grow">
        <?php foreach ($lands_list as $l): ?>
            <div class="flex justify-between items-center p-3.5 border border-outline-variant/40 rounded-lg hover:bg-surface-bright transition-colors bg-surface-container-low/20">
                <div>
                    <h4 class="font-body-md text-body-md font-semibold text-on-surface"><?php echo htmlspecialchars($l['title']); ?></h4>
                    <p class="font-body-sm text-body-sm text-on-surface-variant"><?php echo htmlspecialchars($l['area'] . ' ' . $l['area_unit']); ?></p>
                </div>
                <span class="font-label-md text-label-md px-2.5 py-0.5 rounded-full font-bold <?php echo $l['availability_status'] === 'available' ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface-variant text-on-surface-variant'; ?>">
                    <?php echo ucfirst(htmlspecialchars($l['availability_status'])); ?>
                </span>
            </div>
        <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="p-6 text-center text-on-surface-variant my-auto">
            <span class="material-symbols-outlined text-3xl text-outline mb-2">add_location_alt</span>
            <p class="text-sm">No land parcels registered.</p>
        </div>
    <?php endif; ?>

    <a href="manage-land.php" class="w-full mt-4 text-center text-primary hover:text-secondary font-label-md text-label-md cursor-pointer py-2 border-t border-outline-variant/30 block">
        View All Lands &rarr;
    </a>
</div>
</section>
</div>
</main>

<!-- Footer -->
<footer class="bg-surface-container-lowest border-t border-outline-variant w-full py-6 px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-on-surface-variant mt-auto">
    <span class="font-headline-sm font-bold text-primary">ChasiConnect</span>
    <span>&copy; <?php echo date("Y"); ?> ChasiConnect Agricultural Fintech. All rights reserved.</span>
    <div class="flex gap-4">
        <a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
        <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
        <a class="hover:text-primary transition-colors" href="#">Legal Notice</a>
    </div>
</footer>
</body>
</html>

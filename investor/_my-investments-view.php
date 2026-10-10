<?php
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChasiConnect - My Investments</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Hanken+Grotesk:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "on-primary-container": "#86af99",
                      "on-secondary-container": "#1b724f",
                      "on-primary": "#ffffff",
                      "outline-variant": "#c1c8c2",
                      "on-secondary-fixed-variant": "#005236",
                      "tertiary-container": "#00452e",
                      "primary-fixed": "#c1ecd4",
                      "on-tertiary": "#ffffff",
                      "surface-container-highest": "#e5e2e1",
                      "secondary-container": "#a1f4c8",
                      "error-container": "#ffdad6",
                      "on-surface-variant": "#414844",
                      "on-error-container": "#93000a",
                      "surface-dim": "#dcd9d9",
                      "error": "#ba1a1a",
                      "primary": "#012d1d",
                      "background": "#fcf9f8",
                      "on-secondary-fixed": "#002113",
                      "surface-tint": "#3f6653",
                      "surface-bright": "#fcf9f8",
                      "on-background": "#1c1b1b",
                      "outline": "#717973",
                      "inverse-on-surface": "#f3f0ef",
                      "on-tertiary-fixed": "#002114",
                      "surface-container": "#f0eded",
                      "surface": "#fcf9f8",
                      "on-tertiary-container": "#75b393",
                      "on-primary-fixed": "#002114",
                      "inverse-primary": "#a5d0b9",
                      "primary-container": "#1b4332",
                      "surface-container-low": "#f6f3f2",
                      "surface-variant": "#e5e2e1",
                      "secondary-fixed": "#a1f4c8",
                      "secondary": "#116c4a",
                      "on-surface": "#1c1b1b",
                      "tertiary": "#002d1c",
                      "tertiary-fixed-dim": "#95d4b3",
                      "on-primary-fixed-variant": "#274e3d",
                      "on-secondary": "#ffffff",
                      "surface-container-lowest": "#ffffff",
                      "secondary-fixed-dim": "#86d7ad",
                      "tertiary-fixed": "#b1f0ce",
                      "on-tertiary-fixed-variant": "#0e5138",
                      "on-error": "#ffffff",
                      "surface-container-high": "#eae7e7",
                      "primary-fixed-dim": "#a5d0b9",
                      "inverse-surface": "#313030"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "stack-md": "16px",
                      "stack-sm": "8px",
                      "gutter": "24px",
                      "container-max": "1440px",
                      "base": "8px",
                      "margin-mobile": "16px",
                      "margin-desktop": "40px",
                      "stack-lg": "32px"
              },
              "fontFamily": {
                      "headline-md": ["Manrope", "sans-serif"],
                      "label-md": ["Hanken Grotesk", "sans-serif"],
                      "body-md": ["Hanken Grotesk", "sans-serif"],
                      "numeric-kpi": ["Hanken Grotesk", "sans-serif"],
                      "headline-lg": ["Manrope", "sans-serif"],
                      "body-lg": ["Hanken Grotesk", "sans-serif"],
                      "display-lg": ["Manrope", "sans-serif"],
                      "headline-sm": ["Manrope", "sans-serif"],
                      "body-sm": ["Hanken Grotesk", "sans-serif"]
              },
              "fontSize": {
                      "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                      "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                      "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                      "numeric-kpi": ["28px", { "lineHeight": "32px", "fontWeight": "600" }],
                      "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                      "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                      "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                      "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                      "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }]
              }
            },
          },
        }
</script>
<style>
        body { font-family: 'Hanken Grotesk', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-headline-lg, .font-headline-md, .font-headline-sm, .font-display-lg { font-family: 'Manrope', sans-serif; }
        .ambient-shadow { box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06); }
        .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0px 8px 24px rgba(27, 67, 50, 0.10); }
</style>
</head>
<body class="bg-surface text-on-surface font-body-md h-screen flex overflow-hidden antialiased">
<!-- SideNavBar -->
<nav class="hidden md:flex flex-col h-full py-stack-lg bg-primary-container text-on-primary-fixed fixed left-0 top-0 w-[280px] shadow-lg z-20">
<div class="px-margin-desktop mb-stack-lg">
    <a href="dashboard.php" class="flex items-center gap-3">
        <img src="../logo.png" alt="ChasiConnect" class="h-8 w-auto object-contain brightness-0 invert">
        <div>
            <h1 class="font-headline-md text-headline-md font-bold text-on-primary">ChasiConnect</h1>
            <p class="font-label-md text-label-md text-on-primary-container opacity-90">Investor Portal</p>
        </div>
    </a>
</div>
<div class="flex-1 flex flex-col gap-1">
<a class="text-on-primary-container opacity-80 mx-4 my-1 px-4 py-3 flex items-center gap-3 hover:bg-primary-fixed-dim/20 transition-colors rounded-lg" href="dashboard.php">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<a class="text-on-primary-container opacity-80 mx-4 my-1 px-4 py-3 flex items-center gap-3 hover:bg-primary-fixed-dim/20 transition-colors rounded-lg" href="projects.php">
<span class="material-symbols-outlined">search</span>
<span class="font-label-md text-label-md">Browse Projects</span>
</a>
<a class="bg-secondary-container text-on-secondary-container rounded-lg mx-4 my-1 px-4 py-3 flex items-center gap-3 font-semibold shadow-sm" href="my-investments.php">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">payments</span>
<span class="font-label-md text-label-md">My Investments</span>
</a>
</div>
<div class="px-margin-desktop mt-auto flex flex-col gap-2 pt-4 border-t border-on-primary/10">
<a class="w-full bg-secondary text-on-primary font-label-md text-label-md py-3 rounded-lg text-center hover:bg-tertiary transition-colors flex items-center justify-center gap-2 shadow-sm" href="projects.php">
    <span class="material-symbols-outlined text-[18px]">add</span>
    New Investment
</a>
<a class="text-on-primary-container opacity-80 py-2 flex items-center gap-3 hover:text-white transition-colors" href="../home.php">
<span class="material-symbols-outlined text-sm">home</span>
<span class="font-label-md text-label-md">Back to Home</span>
</a>
<a class="text-on-primary-container opacity-80 py-2 flex items-center gap-3 hover:text-error transition-colors" href="../logout.php">
<span class="material-symbols-outlined text-sm">logout</span>
<span class="font-label-md text-label-md">Logout</span>
</a>
</div>
</nav>

<!-- Main Content Area -->
<main class="flex-1 md:ml-[280px] h-full overflow-y-auto bg-background flex flex-col">
<!-- Top Nav -->
<header class="bg-surface border-b border-outline-variant shadow-sm flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop h-20 sticky top-0 z-10">
<div class="flex items-center gap-4">
    <a href="dashboard.php" class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors group">
        <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
        <span class="font-label-md text-label-md uppercase hidden sm:block">Dashboard</span>
    </a>
    <div class="h-6 w-px bg-outline-variant mx-2 hidden sm:block"></div>
    <h2 class="font-headline-sm text-headline-sm text-primary font-bold">My Portfolio & Investments</h2>
</div>
<div class="flex items-center gap-4">
    <a href="projects.php" class="bg-primary-container text-on-primary font-label-md text-label-md px-4 py-2 rounded-lg hover:bg-primary transition-colors hidden sm:flex items-center gap-1.5 shadow-sm">
        <span class="material-symbols-outlined text-[18px]">search</span>
        Explore Projects
    </a>
    <a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors flex items-center gap-1 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">logout</span>
        <span class="hidden sm:inline">Logout</span>
    </a>
</div>
</header>

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg w-full flex-grow flex flex-col gap-stack-lg">
<!-- Header Section -->
<div class="flex flex-col gap-1">
    <h1 class="font-headline-lg text-headline-lg text-primary">My Investments</h1>
    <p class="font-body-lg text-body-lg text-on-surface-variant">Review all your committed capital allocations, funding progress, and distributed profits.</p>
</div>

<!-- Summary Section (KPI Cards) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
<div class="bg-surface-container-lowest rounded-xl ambient-shadow p-6 border border-outline-variant/40 flex items-center justify-between hover-lift">
    <div>
        <span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1 block">Total Investments</span>
        <span class="font-numeric-kpi text-numeric-kpi text-primary"><?php echo (int)($total_row['cnt'] ?? 0); ?> <?php echo ((int)($total_row['cnt'] ?? 0) === 1) ? 'Project' : 'Projects'; ?></span>
    </div>
    <div class="w-12 h-12 rounded-full bg-primary-fixed/30 flex items-center justify-center text-primary">
        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">forest</span>
    </div>
</div>

<div class="bg-surface-container-lowest rounded-xl ambient-shadow p-6 border border-outline-variant/40 flex items-center justify-between hover-lift">
    <div>
        <span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1 block">Total Capital Invested</span>
        <span class="font-numeric-kpi text-numeric-kpi text-primary">৳<?php echo number_format((float)($total_row['total'] ?? 0), 2); ?></span>
    </div>
    <div class="w-12 h-12 rounded-full bg-secondary-container/50 flex items-center justify-center text-secondary">
        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">payments</span>
    </div>
</div>
</div>

<!-- Main Table Section -->
<div class="bg-surface-container-lowest rounded-xl ambient-shadow border border-outline-variant/40 overflow-hidden flex flex-col">
<div class="p-5 border-b border-outline-variant/30 flex justify-between items-center bg-surface-container-low/40">
    <h3 class="font-headline-sm text-headline-sm text-primary">Investment Ledger</h3>
    <span class="bg-secondary-container text-on-secondary-container font-label-md text-label-md px-3 py-1 rounded-full">
        <?php echo mysqli_num_rows($investments_res); ?> Entries
    </span>
</div>

<div class="overflow-x-auto">
<table class="w-full text-left border-collapse min-w-[880px]">
<thead class="bg-surface-container-high border-b border-outline-variant font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
<tr>
<th class="px-6 py-4">Project</th>
<th class="px-6 py-4">Farmer</th>
<th class="px-6 py-4">My Investment</th>
<th class="px-6 py-4">Project Funding</th>
<th class="px-6 py-4">Profit Share</th>
<th class="px-6 py-4">Investment Status</th>
<th class="px-6 py-4">Project Status</th>
<th class="px-6 py-4 text-right">Date</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/30 font-body-md text-body-md text-on-surface">
<?php if (mysqli_num_rows($investments_res) > 0): ?>
    <?php while ($inv = mysqli_fetch_assoc($investments_res)): ?>
        <?php
            $required = (float)$inv['required_budget'];
            $pct = $required > 0 ? min(100, round(((float)$inv['current_funding'] / $required) * 100, 1)) : 0;
        ?>
        <tr class="hover:bg-surface-bright transition-colors">
        <td class="px-6 py-4 align-middle">
            <a class="font-headline-sm text-body-md font-semibold text-secondary hover:text-primary hover:underline block" href="project-details.php?id=<?php echo $inv['project_id']; ?>">
                <?php echo htmlspecialchars($inv['title']); ?>
            </a>
            <span class="font-body-sm text-body-sm text-on-surface-variant block mt-0.5">
                <?php echo htmlspecialchars($inv['crop']); ?> &middot; <?php echo (int)$inv['duration_months']; ?> mo &middot; <?php echo $pct; ?>% funded
            </span>
        </td>
        <td class="px-6 py-4 align-middle font-body-sm text-body-sm">
            <?php echo htmlspecialchars($inv['farmer_name']); ?>
        </td>
        <td class="px-6 py-4 align-middle font-numeric-kpi text-[18px] text-primary font-bold">
            ৳<?php echo number_format((float)$inv['amount'], 2); ?>
        </td>
        <td class="px-6 py-4 align-middle font-body-sm text-body-sm">
            ৳<?php echo number_format((float)$inv['current_funding'], 2); ?>
            <span class="text-xs text-on-surface-variant block">of ৳<?php echo number_format($required, 2); ?></span>
        </td>
        <td class="px-6 py-4 align-middle font-body-sm text-body-sm">
            <?php if ($inv['profit_share'] !== null): ?>
                <span class="font-numeric-kpi text-[18px] text-secondary font-bold">৳<?php echo number_format((float)$inv['profit_share'], 2); ?></span>
                <span class="text-xs text-on-surface-variant block">Distributed</span>
            <?php else: ?>
                <span class="text-on-surface-variant italic">Pending Harvest</span>
            <?php endif; ?>
        </td>
        <td class="px-6 py-4 align-middle">
            <?php if ($inv['status'] === 'confirmed'): ?>
                <span class="inline-flex items-center px-3 py-1 rounded-full font-label-md text-label-md bg-secondary-fixed text-on-secondary-fixed-variant font-bold">
                    Confirmed
                </span>
            <?php elseif ($inv['status'] === 'pending'): ?>
                <span class="inline-flex items-center px-3 py-1 rounded-full font-label-md text-label-md bg-[#FEF08A] text-[#854D0E] font-bold">
                    Pending
                </span>
            <?php else: ?>
                <span class="inline-flex items-center px-3 py-1 rounded-full font-label-md text-label-md bg-surface-variant text-on-surface-variant font-bold">
                    <?php echo ucfirst(htmlspecialchars($inv['status'])); ?>
                </span>
            <?php endif; ?>
        </td>
        <td class="px-6 py-4 align-middle font-body-sm text-body-sm">
            <?php if ($inv['project_status'] === 'active'): ?>
                <span class="font-semibold text-primary">Active</span>
            <?php elseif ($inv['project_status'] === 'completed'): ?>
                <span class="font-semibold text-secondary">Completed</span>
            <?php else: ?>
                <span class="font-semibold text-on-surface-variant"><?php echo ucfirst(htmlspecialchars($inv['project_status'])); ?></span>
            <?php endif; ?>
        </td>
        <td class="px-6 py-4 align-middle font-body-sm text-body-sm text-on-surface-variant text-right">
            <?php echo htmlspecialchars(date('d M Y', strtotime($inv['invested_at']))); ?>
        </td>
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr>
        <td colspan="8" class="px-6 py-12 text-center text-on-surface-variant">
            <span class="material-symbols-outlined text-4xl text-outline mb-2">savings</span>
            <p class="font-body-md text-body-md font-medium">You have not made any investments yet.</p>
            <a href="projects.php" class="inline-block mt-3 bg-primary-container text-on-primary px-6 py-2 rounded-lg font-label-md text-label-md uppercase">Browse Open Projects</a>
        </td>
    </tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
</div>

<!-- Footer -->
<footer class="bg-surface-container-lowest border-t border-outline-variant w-full py-6 px-margin-mobile md:px-margin-desktop mt-auto">
<div class="max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-on-surface-variant">
    <div class="font-headline-sm font-bold text-primary">ChasiConnect</div>
    <div>&copy; <?php echo date("Y"); ?> ChasiConnect Agricultural Fintech. All rights reserved.</div>
</div>
</footer>
</main>
</body>
</html>

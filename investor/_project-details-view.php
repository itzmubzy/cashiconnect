<?php
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title><?php echo $project ? htmlspecialchars($project['title']) . " - Project Details" : "Project Details"; ?> | ChasiConnect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600&amp;family=Manrope:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-dim": "#dcd9d9",
                        "on-secondary": "#ffffff",
                        "tertiary": "#002d1c",
                        "surface-tint": "#3f6653",
                        "primary-fixed-dim": "#a5d0b9",
                        "error": "#ba1a1a",
                        "outline": "#717973",
                        "primary": "#012d1d",
                        "background": "#fcf9f8",
                        "error-container": "#ffdad6",
                        "outline-variant": "#c1c8c2",
                        "secondary-fixed-dim": "#86d7ad",
                        "tertiary-container": "#00452e",
                        "inverse-on-surface": "#f3f0ef",
                        "on-secondary-container": "#1b724f",
                        "secondary-fixed": "#a1f4c8",
                        "on-tertiary-container": "#75b393",
                        "on-error": "#ffffff",
                        "on-tertiary-fixed": "#002114",
                        "secondary": "#116c4a",
                        "surface-container-low": "#f6f3f2",
                        "on-primary": "#ffffff",
                        "on-background": "#1c1b1b",
                        "on-primary-container": "#86af99",
                        "on-secondary-fixed-variant": "#005236",
                        "on-secondary-fixed": "#002113",
                        "on-primary-fixed-variant": "#274e3d",
                        "on-primary-fixed": "#002114",
                        "surface-container-lowest": "#ffffff",
                        "primary-container": "#1b4332",
                        "surface-bright": "#fcf9f8",
                        "surface-container-high": "#eae7e7",
                        "on-surface": "#1c1b1b",
                        "inverse-primary": "#a5d0b9",
                        "surface-container-highest": "#e5e2e1",
                        "tertiary-fixed-dim": "#95d4b3",
                        "surface-container": "#f0eded",
                        "surface": "#fcf9f8",
                        "secondary-container": "#a1f4c8",
                        "on-error-container": "#93000a",
                        "tertiary-fixed": "#b1f0ce",
                        "on-tertiary-fixed-variant": "#0e5138",
                        "primary-fixed": "#c1ecd4",
                        "surface-variant": "#e5e2e1",
                        "on-surface-variant": "#414844",
                        "inverse-surface": "#313030",
                        "on-tertiary": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "stack-md": "16px",
                        "base": "8px",
                        "container-max": "1440px",
                        "margin-desktop": "40px",
                        "margin-mobile": "16px",
                        "stack-sm": "8px",
                        "stack-lg": "32px"
                    },
                    "fontFamily": {
                        "display-lg": ["Manrope", "sans-serif"],
                        "body-lg": ["Hanken Grotesk", "sans-serif"],
                        "numeric-kpi": ["Hanken Grotesk", "sans-serif"],
                        "body-sm": ["Hanken Grotesk", "sans-serif"],
                        "headline-md": ["Manrope", "sans-serif"],
                        "body-md": ["Hanken Grotesk", "sans-serif"],
                        "label-md": ["Hanken Grotesk", "sans-serif"],
                        "headline-lg": ["Manrope", "sans-serif"],
                        "headline-sm": ["Manrope", "sans-serif"]
                    },
                    "fontSize": {
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "numeric-kpi": ["28px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
<style>
        body { font-family: 'Hanken Grotesk', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-headline-lg, .font-headline-md, .font-headline-sm, .font-display-lg { font-family: 'Manrope', sans-serif; }
        .shadow-soft { box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06); }
        .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0px 8px 24px rgba(27, 67, 50, 0.10); }
</style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col font-body-md antialiased">
<!-- Top Navigation Header -->
<header class="bg-surface text-primary w-full top-0 sticky border-b border-outline-variant z-50">
<div class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop py-4 max-w-container-max mx-auto">
<div class="flex items-center gap-4">
<a class="text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1 group font-label-md text-label-md" href="projects.php">
<span class="material-symbols-outlined mr-1 group-hover:-translate-x-1 transition-transform">arrow_back</span>
<span class="hidden md:inline">Back to Browse</span>
</a>
<div class="h-6 w-px bg-outline-variant mx-1 hidden md:block"></div>
<a href="dashboard.php" class="font-display-lg text-primary text-[22px] md:text-[28px] font-bold leading-none">ChasiConnect</a>
</div>
<div class="flex items-center gap-4">
<a href="dashboard.php" class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors hidden sm:block">Dashboard</a>
<a href="projects.php" class="font-label-md text-label-md text-primary font-bold hidden sm:block">Projects</a>
<a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors flex items-center gap-1 text-sm font-medium">
    <span class="material-symbols-outlined text-lg">logout</span>
    <span class="hidden sm:inline">Logout</span>
</a>
</div>
</div>
</header>

<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg flex flex-col gap-gutter">

<?php if (!$project): ?>
    <div class="bg-surface-container-lowest rounded-xl p-12 text-center border border-outline-variant shadow-soft">
        <span class="material-symbols-outlined text-5xl text-outline mb-2">search_off</span>
        <h1 class="font-headline-md text-headline-md text-primary mb-2">Project Not Found</h1>
        <p class="text-on-surface-variant mb-6">This project does not exist or is no longer open for active view.</p>
        <a href="projects.php" class="bg-primary-container text-on-primary font-label-md text-label-md px-6 py-2.5 rounded-lg uppercase">Back to Projects</a>
    </div>
<?php else: ?>
    <?php
        $required = (float)$project['required_budget'];
        $current = (float)$project['current_funding'];
        $percent = $required > 0 ? min(100, round(($current / $required) * 100, 1)) : 0;
        $remaining = max(0, $required - $current);
    ?>

    <!-- Project Header / Hero -->
    <div class="w-full flex flex-col md:flex-row gap-gutter">
    <!-- Project Hero Visual -->
    <div class="w-full md:w-2/3 h-64 md:h-96 rounded-xl overflow-hidden relative shadow-soft bg-primary-container/20">
        <img src="../banner.jpg" alt="<?php echo htmlspecialchars($project['title']); ?>" class="w-full h-full object-cover">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/30 to-transparent"></div>
        <div class="absolute bottom-0 left-0 p-stack-lg w-full flex flex-col md:flex-row justify-between items-end gap-4">
            <div class="text-on-primary">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md mb-2 shadow-sm backdrop-blur-sm">
                    <span class="material-symbols-outlined text-[16px] mr-1">eco</span> <?php echo htmlspecialchars($project['crop']); ?> Project
                </span>
                <h1 class="font-display-lg text-display-lg text-[30px] md:text-[42px] leading-tight text-on-primary font-bold">
                    <?php echo htmlspecialchars($project['title']); ?>
                </h1>
                <p class="font-body-lg text-body-lg flex items-center gap-2 mt-1 text-surface-variant">
                    <span class="material-symbols-outlined text-[20px]">location_on</span> <?php echo htmlspecialchars($project['location']); ?> &middot; <?php echo htmlspecialchars($project['land_title']); ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Funding Progress Card -->
    <div class="w-full md:w-1/3 bg-surface-container-lowest rounded-xl p-6 shadow-soft flex flex-col justify-between hover-lift border border-outline-variant/40">
        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-headline-sm text-headline-sm text-on-surface">Funding Status</h2>
                <?php if ($project['status'] === 'approved'): ?>
                    <span class="bg-secondary-container text-on-secondary-container text-xs px-2.5 py-0.5 rounded-full font-bold uppercase">Funding</span>
                <?php else: ?>
                    <span class="bg-primary-fixed text-on-primary-fixed-variant text-xs px-2.5 py-0.5 rounded-full font-bold uppercase"><?php echo ucfirst(htmlspecialchars($project['status'])); ?></span>
                <?php endif; ?>
            </div>

            <div class="flex justify-between items-baseline mb-2">
                <span class="font-numeric-kpi text-numeric-kpi text-primary">৳<?php echo number_format($current, 2); ?></span>
                <span class="font-body-sm text-body-sm text-on-surface-variant">of ৳<?php echo number_format($required, 2); ?></span>
            </div>

            <!-- Progress Bar -->
            <div class="w-full bg-surface-variant rounded-full h-3 mb-2 overflow-hidden">
                <div class="bg-primary h-3 rounded-full transition-all duration-500" style="width: <?php echo $percent; ?>%"></div>
            </div>

            <div class="flex justify-between items-center font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
                <span><?php echo $percent; ?>% Funded</span>
                <span>৳<?php echo number_format($remaining, 2); ?> Remaining</span>
            </div>

            <div class="mt-6 pt-6 border-t border-outline-variant/30 flex justify-between">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase">Duration</p>
                    <p class="font-numeric-kpi text-[22px] text-secondary font-bold"><?php echo (int)$project['duration_months']; ?> Months</p>
                </div>
                <div class="text-right">
                    <p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase">Land Area</p>
                    <p class="font-numeric-kpi text-[22px] text-on-surface font-bold"><?php echo htmlspecialchars($project['area'] . ' ' . $project['area_unit']); ?></p>
                </div>
            </div>
        </div>

        <?php if (in_array($project['status'], ['approved', 'active']) && $remaining > 0): ?>
            <a href="invest.php?id=<?php echo $project['id']; ?>" class="w-full mt-6 bg-primary-container text-on-primary font-headline-sm text-headline-sm py-3.5 px-4 rounded-lg hover:bg-primary transition-colors flex justify-center items-center gap-2 shadow-sm text-center">
                Invest Now <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        <?php else: ?>
            <div class="w-full mt-6 bg-surface-container-high text-on-surface-variant text-center py-3 rounded-lg font-label-md text-label-md uppercase font-semibold">
                Investment Complete
            </div>
        <?php endif; ?>
    </div>
    </div>

    <!-- Details Grid (Bento Style) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
    <!-- Left Column: Summary & Operator/Land -->
    <div class="md:col-span-2 flex flex-col gap-gutter">
        <!-- Description -->
        <div class="bg-surface-container-lowest rounded-xl p-8 shadow-soft border border-outline-variant/40">
            <h3 class="font-headline-md text-headline-md text-on-surface mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">description</span> Project Summary
            </h3>
            <p class="font-body-md text-body-md text-on-surface leading-relaxed">
                <?php echo nl2br(htmlspecialchars($project['description'] ?? 'No detailed description provided.')); ?>
            </p>

            <?php if (!empty($funding_breakdown['lease_amount'])): ?>
                <div class="mt-6 pt-6 border-t border-outline-variant/30 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-3 bg-surface-container-low rounded-lg border border-outline-variant/40">
                        <span class="text-xs text-on-surface-variant uppercase font-semibold block">Cultivation Costs</span>
                        <span class="font-numeric-kpi text-[18px] text-primary">৳<?php echo number_format((float)$funding_breakdown['farming_costs'], 2); ?></span>
                    </div>
                    <div class="p-3 bg-surface-container-low rounded-lg border border-outline-variant/40">
                        <span class="text-xs text-on-surface-variant uppercase font-semibold block">Land Lease Subtotal</span>
                        <span class="font-numeric-kpi text-[18px] text-primary">৳<?php echo number_format((float)$funding_breakdown['lease_amount'], 2); ?></span>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Asset Data (Land & Farmer) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-gutter">
            <!-- Farmer Card -->
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow-soft hover-lift border border-outline-variant/40 flex items-start gap-4">
                <div class="w-14 h-14 rounded-full bg-primary-container/20 text-primary flex items-center justify-center font-bold text-lg shrink-0">
                    <?php echo strtoupper(substr($project['farmer_name'], 0, 2)); ?>
                </div>
                <div>
                    <h4 class="font-label-md text-label-md text-on-surface-variant uppercase mb-1">Farmer Operator</h4>
                    <p class="font-headline-sm text-headline-sm text-on-surface font-bold"><?php echo htmlspecialchars($project['farmer_name']); ?></p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                        <?php echo htmlspecialchars($project['specialization'] ?? 'Agricultural Producer'); ?> &middot; <?php echo htmlspecialchars($project['experience_years']); ?> Yrs Exp
                    </p>
                    <div class="mt-3 inline-flex items-center px-2 py-1 bg-secondary-container text-on-secondary-container rounded text-xs font-semibold">
                        <span class="material-symbols-outlined text-[14px] mr-1">verified</span> Verified Partner
                    </div>
                </div>
            </div>

            <!-- Land Details -->
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow-soft hover-lift border border-outline-variant/40">
                <h4 class="font-label-md text-label-md text-on-surface-variant uppercase mb-3 flex items-center">
                    <span class="material-symbols-outlined text-[16px] mr-1">landscape</span> Land Specifications
                </h4>
                <div class="space-y-3">
                    <div class="flex justify-between items-center border-b border-outline-variant/30 pb-2">
                        <span class="font-body-sm text-body-sm text-on-surface-variant">Plot Title</span>
                        <span class="font-body-sm text-body-sm font-semibold text-on-surface"><?php echo htmlspecialchars($project['land_title']); ?></span>
                    </div>
                    <div class="flex justify-between items-center border-b border-outline-variant/30 pb-2">
                        <span class="font-body-sm text-body-sm text-on-surface-variant">Soil / Type</span>
                        <span class="font-body-sm text-body-sm font-semibold text-on-surface"><?php echo htmlspecialchars($project['soil_type'] ?? 'Standard'); ?> / <?php echo htmlspecialchars($project['land_type'] ?? 'Arable'); ?></span>
                    </div>
                    <div class="flex justify-between items-center pb-1">
                        <span class="font-body-sm text-body-sm text-on-surface-variant">Location</span>
                        <span class="font-body-sm text-body-sm font-semibold text-primary"><?php echo htmlspecialchars($project['location']); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($project['profit_distributed_at'])): ?>
            <!-- Profit Distribution Breakdown (If completed) -->
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow-soft border border-outline-variant/40">
                <h3 class="font-headline-sm text-headline-sm text-primary mb-3">Profit Distribution Summary</h3>
                <p class="text-sm text-on-surface-variant mb-4">
                    Distributed on <strong><?php echo htmlspecialchars(date('d M Y, h:i A', strtotime($project['profit_distributed_at']))); ?></strong>.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div class="p-4 bg-secondary-container/30 rounded-lg border border-secondary/30">
                        <span class="text-xs uppercase font-bold text-secondary block">Your Total Investment</span>
                        <span class="font-numeric-kpi text-[20px] text-primary">৳<?php echo number_format((float)($distribution['own_total_amount'] ?? 0), 2); ?></span>
                    </div>
                    <div class="p-4 bg-secondary-container/30 rounded-lg border border-secondary/30">
                        <span class="text-xs uppercase font-bold text-secondary block">Your Profit Share Payout</span>
                        <span class="font-numeric-kpi text-[20px] text-secondary">৳<?php echo number_format((float)($distribution['own_profit_share'] ?? 0), 2); ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Right Column: Timeline / Progress Updates -->
    <div class="bg-surface-container-lowest rounded-xl p-6 shadow-soft border border-outline-variant/40 flex flex-col h-full">
        <h3 class="font-headline-md text-headline-md text-on-surface mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">history</span> Field Progress Timeline
        </h3>

        <?php if (is_array($updates) && count($updates) > 0): ?>
            <div class="relative border-l-2 border-surface-variant ml-3 space-y-6 flex-grow">
                <?php foreach ($updates as $upd): ?>
                    <div class="relative pl-6">
                        <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-primary ring-4 ring-surface-container-lowest"></div>
                        <p class="font-label-md text-label-md text-on-surface-variant mb-1 uppercase"><?php echo htmlspecialchars(date('d M Y', strtotime($upd['update_date']))); ?></p>
                        <p class="font-headline-sm text-[16px] text-on-surface font-semibold"><?php echo htmlspecialchars($upd['milestone'] ?? 'Field Milestone'); ?> &middot; <?php echo htmlspecialchars($upd['progress_percentage']); ?>%</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1"><?php echo htmlspecialchars($upd['description'] ?? 'No notes recorded.'); ?></p>
                        <?php if ((float)$upd['expense'] > 0): ?>
                            <p class="text-xs text-primary font-bold mt-1">Expense Logged: ৳<?php echo number_format((float)$upd['expense'], 2); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12 text-on-surface-variant my-auto">
                <span class="material-symbols-outlined text-3xl text-outline mb-2">pending</span>
                <p class="text-sm">No operational field updates recorded yet.</p>
            </div>
        <?php endif; ?>
    </div>
    </div>
<?php endif; ?>

</main>

<!-- Footer -->
<footer class="bg-surface-container-highest border-t border-outline-variant w-full mt-auto py-6 px-margin-mobile md:px-margin-desktop">
<div class="max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-on-surface-variant">
    <div class="font-headline-sm font-bold text-primary">ChasiConnect</div>
    <div>&copy; <?php echo date("Y"); ?> ChasiConnect Agricultural Fintech. All rights reserved.</div>
</div>
</footer>
</body>
</html>

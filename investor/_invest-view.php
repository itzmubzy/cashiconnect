<?php
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Invest in <?php echo $project ? htmlspecialchars($project['title']) : "Project"; ?> | ChasiConnect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet"/>
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
</style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col font-body-md antialiased">
<!-- Top Navigation Header -->
<header class="bg-surface text-primary w-full top-0 sticky border-b border-outline-variant z-50">
<div class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop py-4 max-w-container-max mx-auto">
<div class="flex items-center gap-4">
<a class="text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1 group font-label-md text-label-md" href="project-details.php?id=<?php echo (int)$project_id; ?>">
<span class="material-symbols-outlined text-lg group-hover:-translate-x-1 transition-transform">arrow_back</span>
<span class="hidden sm:inline">Back to Project</span>
</a>
</div>
<div class="font-display-lg text-headline-lg md:text-display-lg font-bold text-primary tracking-tight">
    ChasiConnect
</div>
<div class="flex items-center gap-4">
    <a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors flex items-center gap-1 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">logout</span>
        <span class="hidden sm:inline">Logout</span>
    </a>
</div>
</div>
</header>

<!-- Main Content -->
<main class="flex-1 w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg grid grid-cols-1 md:grid-cols-12 gap-gutter">
<!-- Page Title -->
<div class="col-span-1 md:col-span-12 mb-2">
<h1 class="font-headline-lg text-headline-lg text-primary">Make an Investment</h1>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Participate directly in crop production and agricultural profit sharing.</p>
</div>

<?php if (!empty($message)): ?>
    <div class="col-span-1 md:col-span-12 p-4 rounded-lg <?php echo $message_class === "registration-message" ? "bg-secondary-container/40 text-secondary border border-secondary/30" : "bg-error-container text-error border border-error/20"; ?> text-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5"><?php echo $message_class === "registration-message" ? "check_circle" : "error"; ?></span>
        <div class="font-medium"><?php echo htmlspecialchars($message); ?></div>
    </div>
<?php endif; ?>

<?php if ($project && ($message_class !== "error-message" || $message !== "This project does not exist or is not open for investment.")): ?>
    <?php
        $required = (float)$project['required_budget'];
        $current = (float)$project['current_funding'];
        $percent = $required > 0 ? min(100, round(($current / $required) * 100, 1)) : 0;
    ?>
    <!-- Left Column: Form -->
    <div class="col-span-1 md:col-span-8 flex flex-col gap-stack-lg">
        <!-- Investment Form Card -->
        <div class="bg-surface-container-lowest rounded-xl shadow-soft border border-outline-variant p-6 md:p-8">
            <h2 class="font-headline-md text-headline-md text-primary mb-6">Investment Details</h2>
            <form method="POST" class="space-y-6">
                <div>
                    <label class="block font-label-md text-label-md text-on-surface mb-2" for="amount">Investment Amount (৳ BDT)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-on-surface-variant font-numeric-kpi text-body-lg">৳</span>
                        <input class="w-full pl-10 pr-4 py-3 rounded-lg border-[1.5px] border-outline-variant bg-surface focus:border-primary focus:ring-2 focus:ring-primary-fixed-dim/20 transition-all font-numeric-kpi text-numeric-kpi text-on-surface placeholder:text-outline-variant outline-none" id="amount" max="<?php echo $remaining_now; ?>" min="1" name="amount" placeholder="0.00" step="0.01" type="number" required/>
                    </div>
                    <div class="mt-2 flex justify-between items-center text-body-sm font-body-sm">
                        <span class="text-on-surface-variant">Minimum: ৳1.00</span>
                        <span class="text-secondary font-semibold">Maximum allowable: ৳<?php echo number_format($remaining_now, 2); ?></span>
                    </div>
                </div>

                <div class="pt-4 border-t border-outline-variant">
                    <h3 class="font-label-md text-label-md text-on-surface-variant uppercase mb-4 tracking-wider">Profit Pool Participation</h3>
                    <div class="space-y-3 font-body-md text-body-md bg-surface-container-low p-4 rounded-lg border border-outline-variant/40">
                        <div class="flex justify-between">
                            <span class="text-on-surface-variant">Investor Pool Share</span>
                            <span class="text-primary font-semibold">60% of Harvest Net Profit</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-on-surface-variant">Distribution Method</span>
                            <span class="text-secondary font-semibold">Proportional to Principal</span>
                        </div>
                        <div class="flex justify-between pt-2 border-t border-outline-variant/30 text-xs text-on-surface-variant">
                            <span>Capital Safety:</span>
                            <span>Principal costs reimbursed prior to profit split</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button class="w-full bg-primary-container text-on-primary hover:bg-primary transition-colors py-4 rounded-lg font-headline-sm text-headline-sm uppercase tracking-wider flex justify-center items-center gap-2 shadow-sm cursor-pointer" type="submit">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">lock</span>
                        Confirm Investment
                    </button>
                    <p class="text-center font-body-sm text-body-sm text-on-surface-variant mt-4 flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">shield</span>
                        Secure and recorded in platform ledger.
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Right Column: Project Context/Summary -->
    <div class="col-span-1 md:col-span-4 flex flex-col gap-stack-md">
        <!-- Project Summary Card -->
        <div class="bg-surface-container-lowest rounded-xl shadow-soft border border-outline-variant overflow-hidden group">
            <div class="h-44 w-full relative overflow-hidden bg-surface-variant">
                <img class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-700" src="../banner.jpg" alt="<?php echo htmlspecialchars($project['title']); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-primary/85 to-transparent"></div>
                <div class="absolute bottom-3 left-4 right-4">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-secondary-container text-on-secondary-container mb-1 shadow-sm">
                        <?php echo htmlspecialchars($project['crop']); ?> Project
                    </span>
                    <h3 class="font-headline-sm text-headline-sm text-on-primary font-bold leading-tight"><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p class="font-body-sm text-body-sm text-surface-bright flex items-center gap-1 mt-0.5">
                        <span class="material-symbols-outlined text-[14px]">person</span> <?php echo htmlspecialchars($project['farmer_name']); ?>
                    </p>
                </div>
            </div>
            <div class="p-5">
                <div class="mb-4">
                    <div class="flex justify-between font-label-md text-label-md mb-2 text-on-surface-variant">
                        <span>Funding Progress</span>
                        <span class="text-primary font-bold"><?php echo $percent; ?>%</span>
                    </div>
                    <div class="w-full bg-surface-container-high rounded-full h-2 overflow-hidden">
                        <div class="bg-secondary h-2 rounded-full" style="width: <?php echo $percent; ?>%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-on-surface-variant mt-1.5">
                        <span>Raised: ৳<?php echo number_format($current, 2); ?></span>
                        <span>Goal: ৳<?php echo number_format($required, 2); ?></span>
                    </div>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant border-t border-outline-variant pt-3 italic">
                    "<?php echo htmlspecialchars($project['description'] ?? 'Cultivation project managed through ChasiConnect.'); ?>"
                </p>
            </div>
        </div>

        <!-- Trust / Security Callout -->
        <div class="bg-surface-container-low rounded-xl border border-outline-variant p-5 shadow-sm">
            <div class="flex items-start gap-3">
                <div class="bg-secondary-container p-2 rounded-full text-secondary shrink-0">
                    <span class="material-symbols-outlined text-[20px]">verified_user</span>
                </div>
                <div>
                    <h4 class="font-headline-sm text-body-md text-on-surface font-bold mb-1">Guaranteed Transparency</h4>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">All harvest yields, sales revenue, and expenditure records are validated by verified platform audits.</p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
</main>

<!-- Footer -->
<footer class="bg-surface-container-highest w-full mt-auto border-t border-outline-variant py-6 px-margin-mobile md:px-margin-desktop">
<div class="max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-on-surface-variant">
    <div class="font-headline-sm font-bold text-primary">ChasiConnect</div>
    <div>&copy; <?php echo date("Y"); ?> ChasiConnect Agricultural Fintech. All rights reserved.</div>
</div>
</footer>
</body>
</html>

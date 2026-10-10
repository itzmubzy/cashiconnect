<?php

$total_harvest_value = 0;
$logged_harvests = [];
if (isset($harvests_res) && mysqli_num_rows($harvests_res) > 0) {
    while ($h = mysqli_fetch_assoc($harvests_res)) {
        $logged_harvests[] = $h;
        $total_harvest_value += floatval($h['estimated_value'] ?? 0);
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Record Harvest - ChasiConnect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&amp;family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "secondary": "#116c4a",
                      "surface": "#fcf9f8",
                      "inverse-on-surface": "#f3f0ef",
                      "outline-variant": "#c1c8c2",
                      "background": "#fcf9f8",
                      "surface-container-high": "#eae7e7",
                      "outline": "#717973",
                      "on-tertiary-fixed": "#002114",
                      "on-primary-container": "#86af99",
                      "surface-tint": "#3f6653",
                      "surface-bright": "#fcf9f8",
                      "error": "#ba1a1a",
                      "inverse-surface": "#313030",
                      "on-surface-variant": "#414844",
                      "on-primary-fixed-variant": "#274e3d",
                      "on-secondary-fixed-variant": "#005236",
                      "surface-variant": "#e5e2e1",
                      "secondary-container": "#a1f4c8",
                      "on-error-container": "#93000a",
                      "surface-container-lowest": "#ffffff",
                      "on-tertiary": "#ffffff",
                      "tertiary-container": "#00452e",
                      "primary-fixed-dim": "#a5d0b9",
                      "on-primary": "#ffffff",
                      "primary-fixed": "#c1ecd4",
                      "primary": "#012d1d",
                      "on-tertiary-container": "#75b393",
                      "on-surface": "#1c1b1b",
                      "on-secondary-container": "#1b724f",
                      "error-container": "#ffdad6",
                      "on-error": "#ffffff",
                      "on-secondary-fixed": "#002113",
                      "surface-dim": "#dcd9d9",
                      "on-secondary": "#ffffff",
                      "secondary-fixed-dim": "#86d7ad",
                      "tertiary-fixed": "#b1f0ce",
                      "secondary-fixed": "#a1f4c8",
                      "on-tertiary-fixed-variant": "#0e5138",
                      "primary-container": "#1b4332",
                      "surface-container": "#f0eded",
                      "inverse-primary": "#a5d0b9",
                      "tertiary": "#002d1c",
                      "on-primary-fixed": "#002114",
                      "surface-container-low": "#f6f3f2",
                      "tertiary-fixed-dim": "#95d4b3",
                      "surface-container-highest": "#e5e2e1",
                      "on-background": "#1c1b1b"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "margin-desktop": "40px",
                      "margin-mobile": "16px",
                      "stack-lg": "32px",
                      "stack-md": "16px",
                      "stack-sm": "8px",
                      "container-max": "1440px",
                      "gutter": "24px",
                      "base": "8px"
              },
              "fontFamily": {
                      "headline-md": ["Manrope", "sans-serif"],
                      "label-md": ["Hanken Grotesk", "sans-serif"],
                      "headline-sm": ["Manrope", "sans-serif"],
                      "headline-lg": ["Manrope", "sans-serif"],
                      "display-lg": ["Manrope", "sans-serif"],
                      "numeric-kpi": ["Hanken Grotesk", "sans-serif"],
                      "body-lg": ["Hanken Grotesk", "sans-serif"],
                      "body-sm": ["Hanken Grotesk", "sans-serif"],
                      "body-md": ["Hanken Grotesk", "sans-serif"]
              },
              "fontSize": {
                      "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                      "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                      "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                      "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                      "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                      "numeric-kpi": ["28px", { "lineHeight": "32px", "fontWeight": "600" }],
                      "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                      "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                      "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }]
              }
            },
          },
        }
</script>
<style>
        body { font-family: 'Hanken Grotesk', sans-serif; background-color: #fcf9f8; }
        h1, h2, h3, h4, h5, h6, .font-headline-lg, .font-headline-md, .font-headline-sm, .font-display-lg { font-family: 'Manrope', sans-serif; }
</style>
</head>
<body class="bg-background text-on-background font-body-md text-body-md antialiased min-h-screen flex flex-col">
<!-- TopNavBar -->
<header class="sticky top-0 w-full z-50 flex justify-between items-center px-margin-mobile md:px-margin-desktop py-4 bg-surface-container-lowest mx-auto max-w-container-max border-b border-outline-variant shadow-sm">
<div class="flex items-center gap-stack-lg">
    <a href="farmer-dashboard.php" class="flex items-center gap-3">
        <div class="flex items-center justify-center w-9 h-9 bg-primary-container rounded-lg">
            <span class="material-symbols-outlined text-on-primary text-xl" style="font-variation-settings: 'FILL' 1;">agriculture</span>
        </div>
        <span class="text-headline-md font-headline-md font-bold text-primary">ChasiConnect</span>
    </a>
    <nav class="hidden md:flex gap-stack-md ml-4">
        <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md py-1" href="farmer-dashboard.php">Dashboard</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md py-1" href="create-project.php">Create Project</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md py-1" href="hire-requests.php">Requests</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md py-1" href="project-update.php">Progress</a>
        <a class="text-secondary border-b-2 border-secondary pb-1 font-bold font-label-md text-label-md py-1" href="harvest.php">Harvest</a>
    </nav>
</div>
<div class="flex items-center gap-stack-md">
    <a href="farmer-dashboard.php" class="text-on-surface-variant hover:text-primary text-sm hidden sm:inline font-medium">Dashboard</a>
    <a href="../logout.php" class="font-label-md text-label-md text-on-surface-variant hover:text-error transition-colors duration-200 flex items-center gap-1">
        <span class="material-symbols-outlined text-lg">logout</span>
        <span class="hidden sm:inline">Logout</span>
    </a>
</div>
</header>

<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg">
<!-- Header Section -->
<header class="mb-stack-lg">
    <a class="flex items-center text-on-surface-variant hover:text-primary mb-stack-sm transition-colors text-label-md font-label-md" href="farmer-dashboard.php">
        <span class="material-symbols-outlined text-[16px] mr-1">arrow_back</span>
        Back to Dashboard
    </a>
    <h1 class="font-headline-lg text-headline-lg text-primary mb-stack-sm">Record Harvest</h1>
    <p class="font-body-md text-body-md text-on-surface-variant">Log production yield and final market value. Submitting a harvest triggers automatic profit reconciliation and distribution.</p>
</header>

<?php if (!empty($message)): ?>
    <div class="mb-6 p-4 rounded-lg <?php echo $message_class === "registration-message" ? "bg-secondary-container text-on-secondary-container border border-secondary/30" : "bg-error-container text-error border border-error/20"; ?> text-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5"><?php echo $message_class === "registration-message" ? "check_circle" : "error"; ?></span>
        <div class="font-medium"><?php echo htmlspecialchars($message); ?></div>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
<!-- Left Column: Form -->
<div class="lg:col-span-8 flex flex-col gap-stack-lg">
    <!-- Harvest Data Entry Form -->
    <section class="bg-surface-container-lowest rounded-xl p-6 md:p-8 border border-outline-variant/40" style="box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06);">
        <h3 class="font-headline-md text-headline-md text-primary mb-stack-md pb-4 border-b border-outline-variant/30">Log New Harvest</h3>

        <?php if (mysqli_num_rows($projects_res) > 0): ?>
            <form method="POST" class="flex flex-col gap-stack-md">
                <!-- Project Selection -->
                <div class="flex flex-col gap-base">
                    <label class="font-label-md text-label-md text-on-surface uppercase" for="project_id">Select Project (Active or Completed) *</label>
                    <select class="w-full bg-surface-container-lowest border-1.5 border-outline-variant rounded-lg px-4 py-3 font-body-md text-on-surface focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all outline-none" id="project_id" name="project_id" required>
                        <option value="">-- Choose active project --</option>
                        <?php while ($p = mysqli_fetch_assoc($projects_res)): ?>
                            <option value="<?php echo $p['id']; ?>" data-crop="<?php echo htmlspecialchars($p['crop']); ?>">
                                <?php echo htmlspecialchars($p['title'] . ' (' . ucfirst($p['status']) . ' - ' . $p['crop'] . ')'); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                    <!-- Crop Type -->
                    <div class="flex flex-col gap-base">
                        <label class="font-label-md text-label-md text-on-surface uppercase" for="crop">Crop / Commodity *</label>
                        <input class="w-full bg-surface-container-lowest border-1.5 border-outline-variant rounded-lg px-4 py-3 font-body-md text-on-surface focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all outline-none" id="crop" name="crop" placeholder="e.g. Rice, Maize, Wheat" maxlength="150" required type="text"/>
                    </div>
                    <!-- Harvest Date -->
                    <div class="flex flex-col gap-base">
                        <label class="font-label-md text-label-md text-on-surface uppercase" for="harvest_date">Harvest Date *</label>
                        <input class="w-full bg-surface-container-lowest border-1.5 border-outline-variant rounded-lg px-4 py-3 font-body-md text-on-surface focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all outline-none" id="harvest_date" name="harvest_date" required type="date"/>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                    <!-- Total Yield -->
                    <div class="flex flex-col gap-base">
                        <label class="font-label-md text-label-md text-on-surface uppercase" for="quantity">Quantity Harvested *</label>
                        <input class="w-full bg-surface-container-lowest border-1.5 border-outline-variant rounded-lg px-4 py-3 font-numeric-kpi text-numeric-kpi text-on-surface focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all outline-none" id="quantity" name="quantity" min="0.01" step="0.01" placeholder="e.g. 1500" required type="number"/>
                    </div>
                    <!-- Unit -->
                    <div class="flex flex-col gap-base">
                        <label class="font-label-md text-label-md text-on-surface uppercase" for="quantity_unit">Quantity Unit *</label>
                        <input class="w-full bg-surface-container-lowest border-1.5 border-outline-variant rounded-lg px-4 py-3 font-body-md text-on-surface focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all outline-none" id="quantity_unit" name="quantity_unit" placeholder="e.g. kg, maund, tons, bags" maxlength="50" required type="text"/>
                    </div>
                </div>

                <!-- Market Value / Total Estimated Value -->
                <div class="flex flex-col gap-base">
                    <label class="font-label-md text-label-md text-on-surface uppercase" for="estimated_value">Estimated / Realized Market Value (৳) *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 font-bold text-primary text-lg">৳</span>
                        <input class="w-full bg-surface-container-lowest border-1.5 border-outline-variant rounded-lg pl-10 pr-4 py-3 font-numeric-kpi text-numeric-kpi text-on-surface focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all outline-none" id="estimated_value" name="estimated_value" placeholder="e.g. 180000" min="0" step="0.01" required type="number"/>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant text-xs">Total sale or valuation of harvested produce for profit calculation.</p>
                </div>

                <!-- Description -->
                <div class="flex flex-col gap-base">
                    <label class="font-label-md text-label-md text-on-surface uppercase" for="description">Notes / Storage / Buyer Details (Optional)</label>
                    <textarea class="w-full bg-surface-container-lowest border-1.5 border-outline-variant rounded-lg px-4 py-3 font-body-md text-on-surface focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all outline-none resize-y" id="description" name="description" placeholder="Storage conditions, quality notes, direct buyer arrangements..."></textarea>
                </div>

                <div class="mt-stack-md flex justify-end gap-stack-sm pt-4 border-t border-outline-variant/30">
                    <a href="farmer-dashboard.php" class="px-6 py-3 rounded-lg border-1.5 border-outline-variant text-on-surface-variant font-label-md text-label-md uppercase hover:bg-surface-container-low transition-colors text-center">
                        Cancel
                    </a>
                    <button class="px-8 py-3 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md uppercase tracking-wider hover:bg-primary transition-colors shadow-sm flex items-center gap-2 cursor-pointer" type="submit">
                        Record Harvest &amp; Complete
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                    </button>
                </div>
            </form>
        <?php else: ?>
            <div class="p-8 text-center text-on-surface-variant">
                <span class="material-symbols-outlined text-4xl text-outline mb-2 block">inventory_2</span>
                <p class="font-body-md text-body-md">You have no projects eligible for harvest logging.</p>
                <p class="font-body-sm text-body-sm text-outline mt-1">Harvests can be logged for active or completed projects.</p>
            </div>
        <?php endif; ?>
    </section>
</div>

<!-- Right Column: History & Stats -->
<div class="lg:col-span-4 flex flex-col gap-stack-lg">
    <!-- Quick Stats Bento -->
    <div class="grid grid-cols-2 gap-stack-sm">
        <div class="bg-surface-container-lowest rounded-xl p-stack-md border border-outline-variant/40" style="box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06);">
            <span class="font-label-md text-label-md text-on-surface-variant uppercase block mb-1">Total Logs</span>
            <div class="font-numeric-kpi text-numeric-kpi text-primary"><?php echo count($logged_harvests); ?></div>
        </div>
        <div class="bg-surface-container-lowest rounded-xl p-stack-md border border-outline-variant/40" style="box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06);">
            <span class="font-label-md text-label-md text-on-surface-variant uppercase block mb-1">Total Value</span>
            <div class="font-numeric-kpi text-[20px] font-bold text-secondary truncate">৳<?php echo number_format($total_harvest_value, 0); ?></div>
        </div>
    </div>

    <!-- Harvest History List -->
    <section class="bg-surface-container-lowest rounded-xl border border-outline-variant/40 flex flex-col overflow-hidden" style="box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06);">
        <div class="p-stack-md border-b border-outline-variant/40 bg-surface-container-low flex justify-between items-center">
            <h3 class="font-headline-sm text-headline-sm text-primary">Harvest History</h3>
            <span class="font-label-md text-xs text-on-surface-variant uppercase"><?php echo count($logged_harvests); ?> logs</span>
        </div>
        <div class="flex flex-col divide-y divide-outline-variant/30 max-h-[480px] overflow-y-auto">
            <?php if (count($logged_harvests) > 0): ?>
                <?php foreach ($logged_harvests as $h): ?>
                    <div class="p-4 hover:bg-surface-bright transition-colors flex justify-between items-center">
                        <div>
                            <span class="font-body-md text-body-md font-bold text-primary block"><?php echo htmlspecialchars($h['title']); ?></span>
                            <span class="font-label-md text-xs text-on-surface-variant uppercase"><?php echo htmlspecialchars($h['crop']); ?> &bull; <?php echo htmlspecialchars(date('d M Y', strtotime($h['harvest_date']))); ?></span>
                            <span class="text-xs text-secondary font-semibold block mt-0.5"><?php echo htmlspecialchars(rtrim(rtrim(number_format((float)$h['quantity'], 2), '0'), '.')); ?> <?php echo htmlspecialchars($h['quantity_unit']); ?></span>
                        </div>
                        <div class="text-right">
                            <span class="font-numeric-kpi text-sm font-bold text-primary block">৳<?php echo number_format((float)$h['estimated_value'], 2); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="p-8 text-center text-on-surface-variant">
                    <span class="material-symbols-outlined text-3xl text-outline mb-1 block">history</span>
                    <p class="text-sm">No harvest logs recorded yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
</div>
</main>

<!-- Footer -->
<footer class="w-full py-stack-lg px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-base bg-surface-container border-t border-outline-variant mt-auto">
    <div class="font-headline-sm text-headline-sm text-primary font-bold">ChasiConnect</div>
    <div class="font-body-sm text-body-sm text-on-surface-variant text-center md:text-left">
        &copy; <?php echo date("Y"); ?> ChasiConnect Agricultural Management. All rights reserved.
    </div>
    <div class="flex gap-stack-md font-label-md text-xs text-on-surface-variant">
        <a class="hover:underline transition-opacity duration-200" href="#">Support</a>
        <a class="hover:underline transition-opacity duration-200" href="#">Privacy Policy</a>
        <a class="hover:underline transition-opacity duration-200" href="#">Terms of Service</a>
    </div>
</footer>

<script>
    // Autofill crop when project is selected and set default date
    document.addEventListener('DOMContentLoaded', () => {
        const projectSelect = document.getElementById('project_id');
        const cropInput = document.getElementById('crop');
        const dateInput = document.getElementById('harvest_date');

        if (dateInput && !dateInput.value) {
            dateInput.value = new Date().toISOString().split('T')[0];
        }

        if (projectSelect && cropInput) {
            projectSelect.addEventListener('change', () => {
                const selected = projectSelect.options[projectSelect.selectedIndex];
                if (selected && selected.dataset && selected.dataset.crop) {
                    cropInput.value = selected.dataset.crop;
                }
            });
        }
    });
</script>
</body>
</html>

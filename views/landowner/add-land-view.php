<?php
extract($GLOBALS['_landowner_add_land_data']);
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChasiConnect - Add New Land</title>
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
        .premium-shadow { box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06); }
        .premium-input:focus { border-color: #012d1d; box-shadow: 0 0 0 2px rgba(1, 45, 29, 0.2); }
</style>
</head>
<body class="bg-background text-on-surface font-body-md min-h-screen flex flex-col antialiased">
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
        <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="landowner-dashboard.php">Dashboard</a>
        <a class="text-primary font-bold border-b-2 border-primary pb-1" href="manage-land.php">My Land</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="farmer-list.php">Find Farmer</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="hiring-requests.php">Requests</a>
    </div>
</div>
<div class="flex items-center gap-stack-md">
    <a href="landowner-dashboard.php" class="text-on-surface-variant hover:text-primary text-sm hidden sm:inline font-medium">Dashboard</a>
    <a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors flex items-center gap-1 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">logout</span>
        <span class="hidden sm:inline">Logout</span>
    </a>
</div>
</nav>

<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg flex flex-col">
<!-- Back Navigation -->
<div class="mb-stack-md">
    <a class="inline-flex items-center text-on-surface-variant hover:text-primary transition-colors font-body-sm text-body-sm group" href="manage-land.php">
        <span class="material-symbols-outlined text-[18px] mr-2 group-hover:-translate-x-1 transition-transform">arrow_back</span>
        &larr; Back to My Land
    </a>
</div>

<!-- Form Container -->
<div class="max-w-3xl mx-auto w-full bg-surface-container-lowest rounded-xl premium-shadow overflow-hidden border border-outline-variant/40">
    <div class="p-stack-lg border-b border-outline-variant/30 bg-surface">
        <h1 class="font-headline-lg text-headline-lg text-primary mb-1">Add New Land</h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Provide detailed information about your property to attract potential agricultural partners or investors.</p>
    </div>

    <?php if (!empty($message)): ?>
        <div class="m-6 p-4 rounded-lg <?php echo $message_class === "registration-message" ? "bg-secondary-container/40 text-secondary border border-secondary/30" : "bg-error-container text-error border border-error/20"; ?> text-sm flex items-start gap-3">
            <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5"><?php echo $message_class === "registration-message" ? "check_circle" : "error"; ?></span>
            <div class="font-medium"><?php echo htmlspecialchars($message); ?></div>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="p-stack-lg grid grid-cols-1 md:grid-cols-2 gap-x-gutter gap-y-stack-md">
        <!-- Land Title -->
        <div class="col-span-1 md:col-span-2 space-y-stack-sm">
            <label class="block font-label-md text-label-md text-on-surface uppercase" for="title">Land Title / Name *</label>
            <input class="w-full rounded-lg bg-surface border border-outline-variant px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline premium-input transition-all outline-none" id="title" name="title" placeholder="e.g., Sunny Valley Acres in Gazipur" type="text" value="<?php echo htmlspecialchars($title ?? ''); ?>" required/>
        </div>

        <!-- Location -->
        <div class="col-span-1 space-y-stack-sm">
            <label class="block font-label-md text-label-md text-on-surface uppercase" for="location">Location (District, Sub-district) *</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-lg">location_on</span>
                <input class="w-full rounded-lg bg-surface border border-outline-variant pl-10 pr-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline premium-input transition-all outline-none" id="location" name="location" placeholder="e.g. Kaliganj, Gazipur" type="text" value="<?php echo htmlspecialchars($location ?? ''); ?>" required/>
            </div>
        </div>

        <!-- Total Acreage / Area -->
        <div class="col-span-1 space-y-stack-sm">
            <label class="block font-label-md text-label-md text-on-surface uppercase" for="area">Total Area *</label>
            <div class="flex gap-2">
                <input class="w-2/3 rounded-lg bg-surface border border-outline-variant px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline premium-input transition-all outline-none" id="area" name="area" placeholder="e.g. 2.5" type="number" step="0.01" min="0.01" value="<?php echo htmlspecialchars($area ?? ''); ?>" required/>
                <select class="w-1/3 rounded-lg bg-surface border border-outline-variant px-3 py-3 font-body-md text-body-md text-on-surface premium-input transition-all outline-none" name="area_unit" required>
                    <option value="acre">Acre</option>
                    <option value="bigha">Bigha</option>
                    <option value="katha">Katha</option>
                    <option value="decimal">Decimal</option>
                    <option value="hectare">Hectare</option>
                </select>
            </div>
        </div>

        <!-- Soil Type -->
        <div class="col-span-1 space-y-stack-sm">
            <label class="block font-label-md text-label-md text-on-surface uppercase" for="soil_type">Soil Type</label>
            <input class="w-full rounded-lg bg-surface border border-outline-variant px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline premium-input transition-all outline-none" id="soil_type" name="soil_type" placeholder="e.g. Loam, Sandy Loam, Clay" type="text" value="<?php echo htmlspecialchars($soil_type ?? ''); ?>"/>
        </div>

        <!-- Land Type -->
        <div class="col-span-1 space-y-stack-sm">
            <label class="block font-label-md text-label-md text-on-surface uppercase" for="land_type">Land Type / Terrain</label>
            <input class="w-full rounded-lg bg-surface border border-outline-variant px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline premium-input transition-all outline-none" id="land_type" name="land_type" placeholder="e.g. Agricultural, Highland, Irrigated" type="text" value="<?php echo htmlspecialchars($land_type ?? ''); ?>"/>
        </div>

        <!-- Availability Status -->
        <div class="col-span-1 md:col-span-2 space-y-stack-sm">
            <label class="block font-label-md text-label-md text-on-surface uppercase">Initial Availability Status</label>
            <div class="flex items-center h-[50px] gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input checked class="w-4 h-4 text-primary border-outline-variant focus:ring-primary" name="status" type="radio" value="available"/>
                    <span class="font-body-md text-body-md text-on-surface font-semibold">Available for Leasing</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input class="w-4 h-4 text-primary border-outline-variant focus:ring-primary" name="status" type="radio" value="leased"/>
                    <span class="font-body-md text-body-md text-on-surface">Currently Leased</span>
                </label>
            </div>
        </div>

        <!-- Land Description -->
        <div class="col-span-1 md:col-span-2 space-y-stack-sm">
            <label class="block font-label-md text-label-md text-on-surface uppercase" for="description">Land Description</label>
            <textarea class="w-full rounded-lg bg-surface border border-outline-variant px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline premium-input transition-all outline-none resize-y" id="description" name="description" placeholder="Describe the topography, water access, previous crops, irrigation infrastructure, and road accessibility..." rows="4"><?php echo htmlspecialchars($description ?? ''); ?></textarea>
        </div>

        <!-- Image Upload -->
        <div class="col-span-1 md:col-span-2 space-y-stack-sm">
            <label class="block font-label-md text-label-md text-on-surface uppercase" for="image">Property Image</label>
            <input class="w-full text-sm text-on-surface border border-outline-variant rounded-lg p-2.5 bg-surface file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-container cursor-pointer" type="file" id="image" name="image" accept="image/*">
        </div>

        <!-- Action Buttons -->
        <div class="col-span-1 md:col-span-2 flex flex-col-reverse sm:flex-row justify-end gap-stack-md mt-stack-md pt-stack-md border-t border-outline-variant/30">
            <a href="manage-land.php" class="px-6 py-3 rounded-lg border-[1.5px] border-outline-variant text-on-surface-variant font-label-md text-label-md uppercase hover:bg-surface-container-low transition-colors text-center">
                Cancel
            </a>
            <button class="px-8 py-3 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md uppercase hover:bg-primary transition-all shadow-md cursor-pointer" type="submit">
                Save &amp; List Land
            </button>
        </div>
    </form>
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

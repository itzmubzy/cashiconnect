<?php
extract($GLOBALS['_landowner_farmer_list_data']);
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Find a Farmer - ChasiConnect</title>
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
        .farmer-card { box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06); transition: all 0.3s ease; }
        .farmer-card:hover { box-shadow: 0px 6px 25px rgba(27, 67, 50, 0.10); transform: translateY(-2px); }
        .bg-pattern { background: linear-gradient(135deg, #1B4332 0%, #012D1D 100%); }
</style>
</head>
<body class="bg-background text-on-surface font-body-md antialiased min-h-screen flex flex-col">
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
        <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="manage-land.php">My Land</a>
        <a class="text-primary font-bold border-b-2 border-primary pb-1" href="farmer-list.php">Find Farmer</a>
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

<!-- Main Content -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg flex flex-col gap-stack-lg">
<!-- Header Section -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-stack-md">
<div>
    <h1 class="font-headline-lg text-headline-lg text-primary mb-1">Find a Farmer</h1>
    <p class="font-body-md text-body-md text-on-surface-variant">Connect with verified agricultural operators to cultivate and manage your land.</p>
</div>
<!-- Filters / Search -->
<form method="GET" class="flex gap-2 w-full md:w-auto">
    <div class="relative w-full sm:w-72">
        <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-outline text-lg">search</span>
        <input class="w-full pl-10 pr-4 py-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all text-on-surface" name="search" placeholder="Search by crop or name..." value="<?php echo htmlspecialchars($search_query); ?>" type="text"/>
    </div>
    <button type="submit" class="flex items-center justify-center gap-1.5 px-5 py-2.5 bg-primary text-on-primary rounded-lg font-label-md text-label-md uppercase tracking-wider hover:bg-primary-container transition-colors shadow-sm cursor-pointer">
        Search
    </button>
</form>
</div>

<!-- Farmer Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-gutter">
<?php if (count($farmers) > 0): ?>
    <?php foreach ($farmers as $farmer): ?>
        <div class="farmer-card bg-surface-container-lowest rounded-xl overflow-hidden border border-outline-variant/40 flex flex-col h-full relative group">
            <!-- Cover Header -->
            <div class="h-24 bg-pattern w-full relative">
                <div class="absolute -bottom-9 left-4 w-18 h-18 rounded-full border-4 border-surface-container-lowest overflow-hidden shadow-sm bg-primary-container text-white flex items-center justify-center font-bold text-xl">
                    <?php if (!empty($farmer["profile_image"]) && file_exists("../" . $farmer["profile_image"])): ?>
                        <img alt="<?php echo htmlspecialchars($farmer["name"]); ?>" class="w-full h-full object-cover" src="../<?php echo htmlspecialchars($farmer["profile_image"]); ?>"/>
                    <?php else: ?>
                        <span><?php echo strtoupper(substr($farmer["name"], 0, 2)); ?></span>
                    <?php endif; ?>
                </div>
                <!-- Verification Badge -->
                <div class="absolute top-3 right-3 bg-secondary-container text-on-secondary-container px-2.5 py-0.5 rounded-full font-label-md text-xs flex items-center gap-1 font-semibold">
                    <span class="material-symbols-outlined text-[14px]">verified</span>
                    Verified
                </div>
            </div>

            <div class="pt-12 px-5 pb-5 flex-grow flex flex-col justify-between gap-4">
                <div>
                    <h3 class="font-headline-sm text-headline-sm text-primary mb-0.5 font-bold"><?php echo htmlspecialchars($farmer["name"]); ?></h3>
                    <p class="font-body-sm text-body-sm text-secondary flex items-center gap-1 mb-3 font-semibold">
                        <span class="material-symbols-outlined text-[15px]">psychology</span>
                        <?php echo htmlspecialchars($farmer["specialization"] ? $farmer["specialization"] : 'General Crop Cultivation'); ?>
                    </p>

                    <div class="grid grid-cols-2 gap-2 mb-3">
                        <div class="bg-surface-container-low p-2.5 rounded-lg">
                            <span class="block font-label-md text-[11px] text-on-surface-variant uppercase mb-0.5">Experience</span>
                            <span class="font-body-sm text-body-sm font-bold text-primary"><?php echo (int)$farmer["experience_years"]; ?> Years</span>
                        </div>
                        <div class="bg-surface-container-low p-2.5 rounded-lg">
                            <span class="block font-label-md text-[11px] text-on-surface-variant uppercase mb-0.5">Rating</span>
                            <span class="font-body-sm text-body-sm font-bold text-secondary">★ <?php echo number_format((float)$farmer["rating"], 1); ?>/5</span>
                        </div>
                    </div>

                    <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 italic">
                        "<?php echo htmlspecialchars($farmer["bio"] ? $farmer["bio"] : 'Verified farmer ready to manage crop operations.'); ?>"
                    </p>
                </div>

                <div class="pt-2 border-t border-outline-variant/30">
                    <a href="hire-farmer.php?farmer_id=<?php echo $farmer["farmer_profile_id"]; ?>" class="w-full bg-primary-container text-on-primary font-label-md text-label-md uppercase tracking-wider py-2.5 rounded-lg hover:bg-primary transition-colors block text-center shadow-sm">
                        Request Proposal
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="col-span-full bg-surface-container-lowest rounded-xl p-12 text-center border border-outline-variant/40 text-on-surface-variant">
        <span class="material-symbols-outlined text-4xl text-outline mb-2">person_search</span>
        <p class="font-body-md text-body-md font-medium">No verified farmers found matching "<?php echo htmlspecialchars($search_query); ?>".</p>
        <a href="farmer-list.php" class="inline-block mt-3 bg-primary-container text-on-primary px-6 py-2 rounded-lg font-label-md text-label-md uppercase">Reset Filter</a>
    </div>
<?php endif; ?>
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

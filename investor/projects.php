<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/ProjectController.php';

Auth::requireRole('investor');

$username = Auth::username();

$projectController = new ProjectController();
$projectController->browse();
extract($GLOBALS['_project_browse_data']);
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChasiConnect - Browse Projects</title>
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
<a class="bg-secondary-container text-on-secondary-container rounded-lg mx-4 my-1 px-4 py-3 flex items-center gap-3 font-semibold shadow-sm" href="projects.php">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">agriculture</span>
<span class="font-label-md text-label-md">Browse Projects</span>
</a>
<a class="text-on-primary-container opacity-80 mx-4 my-1 px-4 py-3 flex items-center gap-3 hover:bg-primary-fixed-dim/20 transition-colors rounded-lg" href="my-investments.php">
<span class="material-symbols-outlined">payments</span>
<span class="font-label-md text-label-md">My Investments</span>
</a>
</div>
<div class="px-margin-desktop mt-auto flex flex-col gap-2 pt-4 border-t border-on-primary/10">
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
    <h2 class="font-headline-sm text-headline-sm text-primary font-bold">Marketplace & Projects</h2>
</div>

<div class="flex items-center gap-4">
    <!-- Search Bar in Header -->
    <form method="GET" class="relative hidden sm:flex items-center" onsubmit="return false;">
        <?php if ($filter !== "all"): ?><input type="hidden" name="filter" value="<?php echo htmlspecialchars($filter); ?>"><?php endif; ?>
        <input id="ajax-search-input" class="pl-10 pr-4 py-2 rounded-full border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all w-60 text-sm text-on-surface placeholder:text-on-surface-variant/70" name="search" placeholder="Search crops, places..." value="<?php echo htmlspecialchars($search); ?>" type="text"/>
        <span class="material-symbols-outlined absolute left-3 top-2.5 text-outline text-lg">search</span>
    </form>

    <div class="flex items-center gap-3">
        <div class="text-right hidden lg:block">
            <p class="font-body-sm text-body-sm text-primary font-semibold"><?php echo htmlspecialchars($username); ?></p>
            <p class="text-xs text-on-surface-variant">Investor</p>
        </div>
        <div class="w-10 h-10 rounded-full bg-primary-container/20 text-primary flex items-center justify-center font-bold text-sm border border-outline-variant">
            <?php echo strtoupper(substr($username, 0, 2)); ?>
        </div>
    </div>
</div>
</header>

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg w-full flex-grow">
<!-- Search on mobile -->
<form method="GET" class="mb-6 sm:hidden" onsubmit="return false;">
    <div class="relative flex items-center">
        <input id="ajax-search-input-mobile" class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary outline-none text-sm" name="search" placeholder="Search projects by crop, title..." value="<?php echo htmlspecialchars($search); ?>" type="text"/>
        <span class="material-symbols-outlined absolute left-3 top-3 text-outline text-lg">search</span>
    </div>
</form>

<!-- Filter Tabs -->
<div class="flex flex-wrap items-center gap-3 mb-stack-lg border-b border-outline-variant pb-4">
    <a href="projects.php<?php echo $search !== '' ? '?search='.urlencode($search) : ''; ?>" class="font-label-md text-label-md px-3 py-1.5 rounded-lg transition-all <?php echo $filter === 'all' ? 'bg-primary text-on-primary font-bold shadow-sm' : 'text-on-surface-variant hover:text-primary hover:bg-surface-container'; ?>">All Projects</a>
    <a href="projects.php?filter=crops<?php echo $search !== '' ? '&search='.urlencode($search) : ''; ?>" class="font-label-md text-label-md px-3 py-1.5 rounded-lg transition-all <?php echo $filter === 'crops' ? 'bg-primary text-on-primary font-bold shadow-sm' : 'text-on-surface-variant hover:text-primary hover:bg-surface-container'; ?>">Crop Farming</a>
</div>

<!-- Projects Grid -->
<div id="search-results" class="w-full">
<?php if (count($projects) > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
    <?php $idx = 0; ?>
    <?php foreach ($projects as $project): ?>
        <?php
            $required = (float)$project['required_budget'];
            $current = (float)$project['current_funding'];
            $percent = $required > 0 ? min(100, round(($current / $required) * 100, 1)) : 0;
            $remaining = max(0, $required - $current);
            $idx++;
            $is_featured = ($idx === 1 && $search === "");
        ?>
        <div class="bg-surface-container-lowest rounded-xl ambient-shadow hover-lift border border-outline-variant/50 overflow-hidden flex flex-col group <?php echo $is_featured ? 'md:col-span-2 lg:col-span-2' : ''; ?>">
            <div class="relative <?php echo $is_featured ? 'h-64' : 'h-48'; ?> w-full bg-primary-container/10 overflow-hidden flex items-center justify-center">
                <!-- Background Image or Decorative Pattern -->
                <div class="absolute inset-0 bg-gradient-to-t from-primary/70 via-primary/20 to-transparent z-10"></div>
                <img src="../banner.jpg" alt="<?php echo htmlspecialchars($project['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                <div class="absolute top-4 left-4 z-20 flex gap-2">
                    <span class="bg-surface-container-lowest/90 backdrop-blur-sm px-3 py-1 rounded-full font-label-md text-label-md text-primary flex items-center gap-1 border border-outline-variant/50">
                        <span class="material-symbols-outlined text-[16px]">eco</span> <?php echo htmlspecialchars($project['crop']); ?>
                    </span>
                </div>
                <div class="absolute top-4 right-4 z-20">
                    <?php if ($project['status'] === 'approved'): ?>
                        <span class="bg-secondary-container/90 text-on-secondary-container px-3 py-1 rounded-full font-label-md text-label-md font-semibold backdrop-blur-md shadow-sm">
                            Open for Funding
                        </span>
                    <?php else: ?>
                        <span class="bg-primary-fixed/90 text-on-primary-fixed-variant px-3 py-1 rounded-full font-label-md text-label-md font-semibold backdrop-blur-md shadow-sm">
                            Active Project
                        </span>
                    <?php endif; ?>
                </div>

                <div class="absolute bottom-3 left-4 right-4 z-20 text-white">
                    <h3 class="<?php echo $is_featured ? 'text-2xl' : 'text-lg'; ?> font-headline-md font-bold text-white drop-shadow-sm leading-tight">
                        <?php echo htmlspecialchars($project['title']); ?>
                    </h3>
                </div>
            </div>

            <div class="p-6 flex flex-col flex-1 justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 text-on-surface-variant font-body-sm text-body-sm mb-3 flex-wrap">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px] text-primary">person</span> <?php echo htmlspecialchars($project['farmer_name']); ?></span>
                        <span class="w-1 h-1 rounded-full bg-outline"></span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px] text-primary">location_on</span> <?php echo htmlspecialchars($project['location']); ?></span>
                        <span class="w-1 h-1 rounded-full bg-outline"></span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px] text-primary">straighten</span> <?php echo htmlspecialchars($project['area'] . ' ' . $project['area_unit']); ?></span>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 italic">
                        "<?php echo htmlspecialchars($project['description'] ?? 'Cultivation and harvest project.'); ?>"
                    </p>
                </div>

                <div class="pt-4 border-t border-outline-variant/40">
                    <div class="flex justify-between items-end mb-2">
                        <div>
                            <p class="font-label-md text-label-md text-on-surface-variant mb-0.5 uppercase">Funding Progress</p>
                            <p class="font-numeric-kpi text-[20px] text-primary font-bold">
                                ৳<?php echo number_format($current, 2); ?>
                                <span class="font-body-sm text-body-sm text-on-surface-variant font-normal">/ ৳<?php echo number_format($required, 2); ?></span>
                            </p>
                        </div>
                        <span class="font-label-md text-label-md text-secondary font-bold"><?php echo $percent; ?>%</span>
                    </div>

                    <div class="w-full bg-surface-container-high rounded-full h-2 mb-5 overflow-hidden">
                        <div class="bg-secondary h-2 rounded-full transition-all duration-500" style="width: <?php echo $percent; ?>%"></div>
                    </div>

                    <div class="flex gap-2">
                        <a href="project-details.php?id=<?php echo $project['id']; ?>" class="flex-1 text-center bg-primary-container text-on-primary rounded-lg py-2.5 font-label-md text-label-md uppercase tracking-wider hover:bg-primary transition-colors flex justify-center items-center gap-1.5 shadow-sm">
                            <?php echo ($project['status'] === 'approved' && $remaining > 0) ? 'Invest Now' : 'View Project'; ?>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="bg-surface-container-lowest rounded-xl p-12 text-center border border-outline-variant/30 text-on-surface-variant">
        <span class="material-symbols-outlined text-4xl text-outline mb-2">search_off</span>
        <p class="font-body-md text-body-md font-medium">No projects found<?php echo $search !== '' ? ' matching "' . htmlspecialchars($search) . '"' : ''; ?>.</p>
        <a href="projects.php" class="inline-block mt-3 bg-primary-container text-on-primary px-6 py-2 rounded-lg font-label-md text-label-md uppercase">Reset Filters</a>
    </div>
<?php endif; ?>
</div>

<!-- Footer -->
<footer class="bg-surface-container-lowest border-t border-outline-variant w-full py-6 px-margin-mobile md:px-margin-desktop mt-auto">
<div class="max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-on-surface-variant">
<div class="font-headline-sm font-bold text-primary">ChasiConnect</div>
<div>&copy; <?php echo date("Y"); ?> ChasiConnect Agri-Fintech. All rights reserved.</div>
</div>
</footer>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('ajax-search-input');
    const searchInputMobile = document.getElementById('ajax-search-input-mobile');
    const resultsContainer = document.getElementById('search-results');

    let debounceTimer;

    function performSearch(keyword) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetch('../ajax/search-projects.php?keyword=' + encodeURIComponent(keyword))
                .then(response => response.text())
                .then(html => {
                    resultsContainer.innerHTML = html;
                })
                .catch(error => console.error('Error fetching search results:', error));
        }, 400); // 400ms debounce
    }

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            performSearch(this.value);
            if (searchInputMobile) searchInputMobile.value = this.value;
        });
    }

    if (searchInputMobile) {
        searchInputMobile.addEventListener('input', function() {
            performSearch(this.value);
            if (searchInput) searchInput.value = this.value;
        });
    }
});
</script>
</body>
</html>

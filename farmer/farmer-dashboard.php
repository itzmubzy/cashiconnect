<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/FarmerController.php';

Auth::requireRole('farmer');

$farmerController = new FarmerController();
$farmerController->dashboard();
extract($GLOBALS['_farmer_dashboard_data']);

$user_id = Auth::userId();
$username = Auth::username();
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Farmer Dashboard | ChasiConnect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Hanken+Grotesk:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
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
        .premium-shadow { box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06); }
        .premium-shadow:hover { box-shadow: 0px 6px 24px rgba(27, 67, 50, 0.10); transform: translateY(-2px); transition: all 0.3s ease; }
</style>
</head>
<body class="text-on-surface antialiased min-h-screen flex flex-col font-body-md">
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
        <a class="text-secondary border-b-2 border-secondary pb-1 font-bold font-label-md text-label-md" href="farmer-dashboard.php">Dashboard</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md py-1" href="create-project.php">Create Project</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md py-1" href="hire-requests.php">Requests</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md py-1" href="project-update.php">Progress</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md py-1" href="harvest.php">Harvest</a>
    </nav>
</div>
<div class="flex items-center gap-stack-md">
    <div class="hidden sm:flex items-center gap-3">
        <div class="text-right">
            <p class="font-body-md text-primary font-semibold text-sm"><?php echo htmlspecialchars($username); ?></p>
            <p class="text-xs text-on-surface-variant">Farmer</p>
        </div>
        <div class="w-9 h-9 rounded-full bg-primary-container/20 text-primary flex items-center justify-center font-bold text-sm border border-outline-variant">
            <?php echo strtoupper(substr($username, 0, 2)); ?>
        </div>
    </div>
    <a href="../logout.php" class="font-label-md text-label-md text-on-surface-variant hover:text-error transition-colors duration-200 flex items-center gap-1">
        <span class="material-symbols-outlined text-lg">logout</span>
        <span class="hidden sm:inline">Logout</span>
    </a>
</div>
</header>

<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg flex flex-col gap-stack-lg">
<?php if (isset($_GET["created"]) && $_GET["created"] === "1"): ?>
    <div class="p-4 rounded-lg bg-secondary-container text-on-secondary-container border border-secondary/30 flex items-center gap-3">
        <span class="material-symbols-outlined text-secondary text-2xl">check_circle</span>
        <div>
            <h4 class="font-bold">Project Submitted Successfully!</h4>
            <p class="text-sm">Your project proposal has been submitted and is currently pending admin review.</p>
        </div>
    </div>
<?php endif; ?>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-primary">Farmer Dashboard</h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Overview of your agricultural ventures, pending lease proposals, and harvest shares.</p>
    </div>
</div>

<!-- Top Section: Profile & KPIs Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
    <!-- Profile Card (Span 4) -->
    <div class="lg:col-span-4 bg-surface-container-lowest rounded-xl premium-shadow p-stack-md flex flex-col gap-stack-md justify-between border border-outline-variant/30">
        <div class="flex items-center gap-stack-md">
            <div class="w-16 h-16 rounded-full bg-primary-container text-white flex items-center justify-center text-xl font-bold border-2 border-surface-container shrink-0">
                <?php echo strtoupper(substr($username, 0, 2)); ?>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="font-headline-sm text-headline-sm text-primary"><?php echo htmlspecialchars($username); ?></h2>
                    <?php if ($farmer && ($farmer['verification_status'] ?? '') === 'approved'): ?>
                        <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1; font-size: 20px;" title="Verified Farmer">verified</span>
                    <?php endif; ?>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Specialization: <?php echo htmlspecialchars($farmer["specialization"] ?? "General Crop"); ?></p>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Experience: <?php echo htmlspecialchars($farmer["experience_years"] ?? "0"); ?> Years</p>
            </div>
        </div>
        <div class="pt-2 border-t border-outline-variant/30 flex justify-between items-center text-xs">
            <span class="text-on-surface-variant uppercase font-semibold">Verification</span>
            <span class="px-2.5 py-0.5 rounded-full font-bold uppercase text-[11px] <?php echo ($farmer && ($farmer['verification_status'] ?? '') === 'approved') ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface-variant text-on-surface-variant'; ?>">
                <?php echo ucfirst(htmlspecialchars($farmer['verification_status'] ?? 'pending')); ?>
            </span>
        </div>
    </div>

    <!-- KPIs (Span 8) -->
    <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-gutter">
        <!-- KPI 1: My Projects -->
        <div class="bg-surface-container-lowest rounded-xl premium-shadow p-stack-md flex flex-col justify-between border border-outline-variant/30">
            <div class="flex items-center justify-between">
                <span class="font-label-md text-label-md text-on-surface-variant uppercase">My Projects</span>
                <span class="material-symbols-outlined text-outline">agriculture</span>
            </div>
            <div class="mt-stack-sm flex items-end justify-between">
                <span class="font-numeric-kpi text-numeric-kpi text-primary"><?php echo $project_count; ?></span>
                <a href="create-project.php" class="font-body-sm text-body-sm text-secondary hover:underline font-semibold flex items-center gap-1">
                    Manage <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>

        <!-- KPI 2: Pending Hire Requests -->
        <div class="bg-surface-container-lowest rounded-xl premium-shadow p-stack-md flex flex-col justify-between border border-outline-variant/30">
            <div class="flex items-center justify-between">
                <span class="font-label-md text-label-md text-on-surface-variant uppercase">Pending Hire Requests</span>
                <span class="material-symbols-outlined text-outline">work</span>
            </div>
            <div class="mt-stack-sm flex items-end justify-between">
                <div class="flex items-baseline gap-2">
                    <span class="font-numeric-kpi text-numeric-kpi text-primary"><?php echo $hiring_count; ?></span>
                    <?php if ($hiring_count > 0): ?>
                        <span class="font-body-sm text-body-sm text-amber-800 bg-amber-100 px-2 py-0.5 rounded-full text-xs font-semibold">Requires review</span>
                    <?php endif; ?>
                </div>
                <a href="hire-requests.php" class="font-body-sm text-body-sm text-secondary hover:underline font-semibold flex items-center gap-1">
                    View <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions Row -->
<div class="flex flex-wrap gap-stack-md py-stack-sm">
    <a href="create-project.php" class="bg-primary-container text-on-primary font-label-md text-label-md py-3 px-6 rounded-lg hover:bg-secondary transition-colors duration-200 flex items-center gap-2 shadow-sm">
        <span class="material-symbols-outlined" style="font-size: 18px;">add_circle</span>
        Create Project
    </a>
    <a href="project-update.php" class="border-[1.5px] border-primary-container text-primary-container font-label-md text-label-md py-3 px-6 rounded-lg hover:bg-surface-container transition-colors duration-200 flex items-center gap-2 bg-surface-container-lowest">
        <span class="material-symbols-outlined" style="font-size: 18px;">update</span>
        Update Progress
    </a>
    <a href="harvest.php" class="border-[1.5px] border-primary-container text-primary-container font-label-md text-label-md py-3 px-6 rounded-lg hover:bg-surface-container transition-colors duration-200 flex items-center gap-2 bg-surface-container-lowest">
        <span class="material-symbols-outlined" style="font-size: 18px;">inventory_2</span>
        Record Harvest
    </a>
    <a href="hire-requests.php" class="border-[1.5px] border-outline-variant text-on-surface-variant font-label-md text-label-md py-3 px-6 rounded-lg hover:bg-surface-container transition-colors duration-200 flex items-center gap-2 bg-surface-container-lowest">
        <span class="material-symbols-outlined" style="font-size: 18px;">mail</span>
        Hire Requests (<?php echo $hiring_count; ?>)
    </a>
</div>

<!-- My Projects -->
<section class="bg-surface-container-lowest rounded-xl premium-shadow overflow-hidden border border-outline-variant/30">
    <div class="p-stack-md border-b border-surface-container-highest flex justify-between items-center">
        <h3 class="font-headline-sm text-headline-sm text-primary">My Projects</h3>
        <span class="text-xs text-on-surface-variant font-medium">Click a project to view full details</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low border-b border-surface-container-highest">
                    <th class="py-4 px-stack-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Project</th>
                    <th class="py-4 px-stack-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Status</th>
                    <th class="py-4 px-stack-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Budget</th>
                    <th class="py-4 px-stack-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Funded</th>
                    <th class="py-4 px-stack-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Progress</th>
                    <th class="py-4 px-stack-md"></th>
                </tr>
            </thead>
            <tbody class="font-body-md text-body-md text-on-surface divide-y divide-surface-container-highest">
                <?php if (count($projects) > 0): ?>
                    <?php foreach ($projects as $p): ?>
                        <?php
                            $p_pct = ((float)$p['required_budget'] > 0)
                                ? min(100.0, round(((float)$p['current_funding'] / (float)$p['required_budget']) * 100, 1))
                                : 0.0;
                            $p_status_classes = [
                                'pending'   => 'bg-amber-100 text-amber-800',
                                'approved'  => 'bg-blue-100 text-blue-800',
                                'rejected'  => 'bg-red-100 text-red-800',
                                'active'    => 'bg-green-100 text-green-800',
                                'completed' => 'bg-emerald-100 text-emerald-800',
                            ];
                            $p_cls = $p_status_classes[$p['status']] ?? 'bg-surface-variant text-on-surface-variant';
                        ?>
                        <tr class="hover:bg-surface-bright transition-colors duration-150">
                            <td class="py-4 px-stack-md font-bold text-primary">
                                <?php echo htmlspecialchars($p['title']); ?>
                                <span class="font-normal text-xs text-on-surface-variant block mt-0.5"><?php echo htmlspecialchars($p['crop']); ?></span>
                            </td>
                            <td class="py-4 px-stack-md">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-md text-xs font-semibold <?php echo $p_cls; ?>">
                                    <?php echo ucfirst(htmlspecialchars($p['status'])); ?>
                                </span>
                            </td>
                            <td class="py-4 px-stack-md font-numeric-kpi text-sm">৳<?php echo number_format((float)$p['required_budget'], 2); ?></td>
                            <td class="py-4 px-stack-md font-numeric-kpi text-sm">
                                ৳<?php echo number_format((float)$p['current_funding'], 2); ?>
                                <span class="text-xs text-on-surface-variant">(<?php echo $p_pct; ?>%)</span>
                            </td>
                            <td class="py-4 px-stack-md font-numeric-kpi text-sm"><?php echo number_format((float)$p['progress_percentage'], 0); ?>%</td>
                            <td class="py-4 px-stack-md text-right">
                                <a href="project-details.php?id=<?php echo (int)$p['id']; ?>" class="font-body-sm text-body-sm text-secondary hover:underline font-semibold">View Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="py-8 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl text-outline mb-2 block">agriculture</span>
                            No projects yet. Create your first project to get started.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Profit Shareout History -->
<section class="bg-surface-container-lowest rounded-xl premium-shadow overflow-hidden border border-outline-variant/30">
    <div class="p-stack-md border-b border-surface-container-highest flex justify-between items-center">
        <h3 class="font-headline-sm text-headline-sm text-primary">Profit Shareout History</h3>
        <span class="text-xs text-on-surface-variant font-medium">Automatic distribution after completed harvest</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low border-b border-surface-container-highest">
                    <th class="py-4 px-stack-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Distributed Date</th>
                    <th class="py-4 px-stack-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Project / Crop</th>
                    <th class="py-4 px-stack-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Total Profit</th>
                    <th class="py-4 px-stack-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Your Farmer Share</th>
                    <th class="py-4 px-stack-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="font-body-md text-body-md text-on-surface divide-y divide-surface-container-highest">
                <?php if (count($shareouts) > 0): ?>
                    <?php foreach ($shareouts as $share): ?>
                        <tr class="hover:bg-surface-bright transition-colors duration-150">
                            <td class="py-4 px-stack-md font-medium text-sm"><?php echo htmlspecialchars(date('d M Y, h:i A', strtotime($share['profit_distributed_at']))); ?></td>
                            <td class="py-4 px-stack-md font-bold text-primary">
                                <?php echo htmlspecialchars($share['title']); ?>
                                <span class="font-normal text-xs text-on-surface-variant block mt-0.5"><?php echo htmlspecialchars($share['crop']); ?></span>
                            </td>
                            <td class="py-4 px-stack-md font-numeric-kpi text-sm">৳<?php echo number_format((float)$share['total_profit'], 2); ?></td>
                            <td class="py-4 px-stack-md font-numeric-kpi font-bold text-primary text-base">৳<?php echo number_format((float)$share['farmer_profit_share'], 2); ?></td>
                            <td class="py-4 px-stack-md">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-md text-xs bg-secondary-container text-on-secondary-container font-semibold">
                                    Disbursed
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="py-8 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl text-outline mb-2 block">receipt_long</span>
                            No completed profit shareouts yet.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
</main>

<!-- Footer -->
<footer class="w-full py-stack-lg px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-base border-t border-outline-variant bg-surface-container mt-auto">
    <div class="font-headline-sm text-headline-sm text-primary font-bold">ChasiConnect</div>
    <div class="font-body-sm text-body-sm text-on-surface">&copy; <?php echo date("Y"); ?> ChasiConnect Agricultural Management. All rights reserved.</div>
    <nav class="flex gap-stack-md text-xs text-on-surface-variant">
        <a class="hover:underline transition-opacity duration-200" href="#">Support</a>
        <a class="hover:underline transition-opacity duration-200" href="#">Privacy Policy</a>
        <a class="hover:underline transition-opacity duration-200" href="#">Terms of Service</a>
    </nav>
</footer>
</body>
</html>

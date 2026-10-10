<?php
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChasiConnect - Manage Projects</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container": "#f0eded",
                        "on-tertiary-container": "#75b393",
                        "tertiary-fixed-dim": "#95d4b3",
                        "on-primary-container": "#86af99",
                        "tertiary-fixed": "#b1f0ce",
                        "outline-variant": "#c1c8c2",
                        "secondary": "#116c4a",
                        "primary-fixed-dim": "#a5d0b9",
                        "on-background": "#1c1b1b",
                        "on-secondary-fixed-variant": "#005236",
                        "on-error": "#ffffff",
                        "surface-variant": "#e5e2e1",
                        "inverse-on-surface": "#f3f0ef",
                        "on-secondary-fixed": "#002113",
                        "inverse-surface": "#313030",
                        "primary-container": "#1b4332",
                        "tertiary": "#002d1c",
                        "on-secondary-container": "#1b724f",
                        "secondary-fixed-dim": "#86d7ad",
                        "on-surface": "#1c1b1b",
                        "surface-dim": "#dcd9d9",
                        "background": "#fcf9f8",
                        "secondary-container": "#a1f4c8",
                        "on-primary": "#ffffff",
                        "secondary-fixed": "#a1f4c8",
                        "outline": "#717973",
                        "surface-bright": "#fcf9f8",
                        "surface-tint": "#3f6653",
                        "inverse-primary": "#a5d0b9",
                        "on-primary-fixed": "#002114",
                        "on-tertiary-fixed": "#002114",
                        "surface-container-low": "#f6f3f2",
                        "primary-fixed": "#c1ecd4",
                        "error-container": "#ffdad6",
                        "on-surface-variant": "#414844",
                        "primary": "#012d1d",
                        "on-primary-fixed-variant": "#274e3d",
                        "surface": "#fcf9f8",
                        "on-secondary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary-fixed-variant": "#0e5138",
                        "on-tertiary": "#ffffff",
                        "on-error-container": "#93000a",
                        "surface-container-high": "#eae7e7",
                        "error": "#ba1a1a",
                        "tertiary-container": "#00452e",
                        "surface-container-highest": "#e5e2e1"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "16px",
                        "stack-sm": "8px",
                        "stack-lg": "32px",
                        "base": "8px",
                        "container-max": "1440px",
                        "margin-desktop": "40px",
                        "stack-md": "16px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "body-md": ["Hanken Grotesk", "sans-serif"],
                        "body-lg": ["Hanken Grotesk", "sans-serif"],
                        "numeric-kpi": ["Hanken Grotesk", "sans-serif"],
                        "headline-md": ["Manrope", "sans-serif"],
                        "display-lg": ["Manrope", "sans-serif"],
                        "body-sm": ["Hanken Grotesk", "sans-serif"],
                        "headline-sm": ["Manrope", "sans-serif"],
                        "headline-lg": ["Manrope", "sans-serif"],
                        "label-md": ["Hanken Grotesk", "sans-serif"]
                    },
                    "fontSize": {
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "numeric-kpi": ["28px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }]
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
<body class="bg-background text-on-background antialiased flex flex-col md:flex-row min-h-screen">
<!-- SideNavBar (Desktop) -->
<nav class="hidden lg:flex flex-col h-full p-6 fixed left-0 top-0 w-[280px] bg-primary text-on-primary shadow-sm z-50">
<div class="mb-stack-lg flex items-center gap-3">
    <a href="admin-dashboard.php" class="flex items-center gap-3">
        <img src="../logo.png" alt="ChasiConnect Logo" class="w-8 h-8 object-contain brightness-0 invert">
        <div>
            <h2 class="font-headline-sm text-headline-sm font-bold text-on-primary">ChasiConnect</h2>
            <p class="font-label-md text-label-md text-primary-fixed-dim">Admin Portal</p>
        </div>
    </a>
</div>
<ul class="flex flex-col gap-2 flex-grow">
<li>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="admin-dashboard.php">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="manage-users.php">
<span class="material-symbols-outlined">group</span>
<span class="font-label-md text-label-md">Manage Users</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary-container text-on-primary font-semibold shadow-sm" href="manage-project.php">
<span class="material-symbols-outlined">inventory_2</span>
<span class="font-label-md text-label-md">Manage Projects</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="verify-farmer.php">
<span class="material-symbols-outlined">verified</span>
<span class="font-label-md text-label-md">Verify Farmers</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="reports.php">
<span class="material-symbols-outlined">assessment</span>
<span class="font-label-md text-label-md">Reports</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="finalize-shareout.php">
<span class="material-symbols-outlined">payments</span>
<span class="font-label-md text-label-md">Finalize Shareout</span>
</a>
</li>
</ul>
<div class="mt-auto flex flex-col gap-2 pt-4 border-t border-on-primary/10">
<a class="flex items-center gap-3 px-4 py-2 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/30 transition-colors" href="../home.php">
<span class="material-symbols-outlined text-sm">home</span>
<span class="font-label-md text-label-md">Back to Site</span>
</a>
<a class="flex items-center gap-3 px-4 py-2 rounded-lg text-on-primary-fixed-variant hover:text-error hover:bg-error-container/20 transition-colors" href="../logout.php">
<span class="material-symbols-outlined text-sm">logout</span>
<span class="font-label-md text-label-md">Logout</span>
</a>
</div>
</nav>

<!-- Main Content Canvas -->
<main class="flex-grow lg:ml-[280px] w-full min-h-screen bg-background flex flex-col">
<!-- TopNavBar -->
<header class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop h-16 bg-surface border-b border-outline-variant z-40 sticky top-0">
<div class="flex items-center gap-3">
    <a href="admin-dashboard.php" class="lg:hidden flex items-center gap-2">
        <img src="../logo.png" alt="ChasiConnect" class="h-7 w-auto">
        <span class="font-headline-sm text-headline-sm font-bold text-primary">ChasiConnect</span>
    </a>
    <span class="hidden lg:block font-headline-sm text-headline-sm font-bold text-primary">Project Moderation</span>
</div>
<div class="flex items-center gap-4">
    <a href="../home.php" class="text-on-surface-variant hover:text-primary transition-colors text-sm">Public Home</a>
    <a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors flex items-center gap-1 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">logout</span>
        <span>Logout</span>
    </a>
</div>
</header>

<div class="p-margin-mobile lg:p-margin-desktop max-w-container-max mx-auto w-full flex-grow">
<!-- Header Section -->
<div class="mb-stack-lg">
<h1 class="font-display-lg text-display-lg text-on-background mb-stack-sm">Manage Projects</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant">Review pending submissions, approve budgets, and monitor active agricultural ventures.</p>
</div>

<?php if (!empty($message)): ?>
    <div class="mb-6 p-4 rounded-lg <?php echo $message_class === "registration-message" ? "bg-secondary-container/40 text-secondary border border-secondary/30" : "bg-error-container text-error border border-error/20"; ?> text-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5"><?php echo $message_class === "registration-message" ? "check_circle" : "error"; ?></span>
        <div class="font-medium"><?php echo htmlspecialchars($message); ?></div>
    </div>
<?php endif; ?>

<!-- Section 1: Pending Project Approvals (Grid) -->
<section class="mb-stack-lg">
<div class="flex items-center justify-between mb-stack-md">
<h2 class="font-headline-md text-headline-md text-on-background">Pending Project Approvals</h2>
<!-- Badge shows how many projects are waiting for admin decision. -->
<?php $pending_count = mysqli_num_rows($pending_res); ?>
<span class="bg-secondary-container text-on-secondary-container font-label-md text-label-md px-3 py-1 rounded-full"><?php echo $pending_count; ?> Pending</span>
</div>

<?php if ($pending_count > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-gutter">
    <?php while ($p = mysqli_fetch_assoc($pending_res)): ?>
        <div class="bg-surface-container-lowest rounded-xl p-6 shadow-[0px_4px_20px_rgba(27,67,50,0.06)] hover:shadow-[0px_8px_30px_rgba(27,67,50,0.10)] hover:-translate-y-[2px] transition-all duration-300 border border-outline-variant/30 flex flex-col h-full">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <span class="font-label-md text-label-md text-secondary mb-1 block uppercase tracking-wider"><?php echo htmlspecialchars($p['crop']); ?> Project</span>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface"><?php echo htmlspecialchars($p['title']); ?></h3>
                </div>
                <span class="material-symbols-outlined text-outline" data-icon="pending_actions">pending_actions</span>
            </div>
            <div class="space-y-2.5 mb-6 flex-grow">
                <div class="flex items-center justify-between border-b border-outline-variant/30 pb-2">
                    <span class="font-body-sm text-body-sm text-on-surface-variant">Farmer</span>
                    <span class="font-body-md text-body-md text-on-surface font-semibold"><?php echo htmlspecialchars($p['farmer_name']); ?></span>
                </div>
                <div class="flex items-center justify-between border-b border-outline-variant/30 pb-2">
                    <span class="font-body-sm text-body-sm text-on-surface-variant">Land</span>
                    <span class="font-body-sm text-body-sm text-on-surface"><?php echo htmlspecialchars($p['land_title'] . ' (' . $p['area'] . ' ' . $p['area_unit'] . ')'); ?></span>
                </div>
                <div class="flex items-center justify-between border-b border-outline-variant/30 pb-2">
                    <span class="font-body-sm text-body-sm text-on-surface-variant">Duration</span>
                    <span class="font-body-sm text-body-sm text-on-surface font-medium"><?php echo (int)$p['duration_months']; ?> Months</span>
                </div>
                <div class="flex items-center justify-between pb-1">
                    <span class="font-body-sm text-body-sm text-on-surface-variant">Requested Budget</span>
                    <span class="font-numeric-kpi text-numeric-kpi text-primary">৳<?php echo number_format((float)$p['required_budget'], 2); ?></span>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 mt-2 pt-2 border-t border-outline-variant/20 italic">
                    "<?php echo htmlspecialchars($p['description'] ?? 'No description provided.'); ?>"
                </p>
            </div>
            <form method="POST" class="flex gap-3 mt-auto m-0">
                <!-- project_id is posted so the backend can identify which project to update. -->
                <input type="hidden" name="project_id" value="<?php echo $p['id']; ?>">
                <button type="submit" name="action" value="approve" class="flex-1 bg-primary-container text-on-primary font-label-md text-label-md py-2.5 rounded-lg hover:bg-primary transition-colors flex items-center justify-center gap-2 cursor-pointer shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                    Approve
                </button>
                <button type="submit" name="action" value="reject" class="flex-1 border-2 border-error text-error font-label-md text-label-md py-2.5 rounded-lg hover:bg-error/10 transition-colors flex items-center justify-center gap-2 cursor-pointer" onclick="return confirm('Reject this project proposal?');">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                    Reject
                </button>
            </form>
        </div>
    <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="bg-surface-container-lowest rounded-xl p-8 text-center border border-outline-variant/30 text-on-surface-variant">
        <span class="material-symbols-outlined text-4xl text-secondary mb-2">task_alt</span>
        <p class="font-body-md text-body-md font-medium">All caught up! No projects awaiting review.</p>
    </div>
<?php endif; ?>
</section>

<!-- Section 2: Project Oversight (Table) -->
<section>
<div class="flex items-center justify-between mb-stack-md">
<h2 class="font-headline-md text-headline-md text-on-background">Project Catalog</h2>
</div>
<div class="bg-surface-container-lowest rounded-xl shadow-[0px_4px_20px_rgba(27,67,50,0.06)] border border-outline-variant/30 overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low border-b border-outline-variant/50">
<th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">ID</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Project Name</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Farmer</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Crop</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Required Budget</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Raised</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Status</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/30">
<!-- Read-only table showing every project's funding progress and current state. -->
<?php while ($pa = mysqli_fetch_assoc($all_res)): ?>
    <tr class="hover:bg-surface-container-low/50 transition-colors group">
    <td class="py-4 px-6 font-body-sm text-body-sm text-on-surface-variant font-mono">#<?php echo str_pad($pa['id'], 3, '0', STR_PAD_LEFT); ?></td>
    <td class="py-4 px-6 font-body-md text-body-md text-on-surface font-semibold"><?php echo htmlspecialchars($pa['title']); ?></td>
    <td class="py-4 px-6 font-body-sm text-body-sm text-on-surface"><?php echo htmlspecialchars($pa['farmer_name']); ?></td>
    <td class="py-4 px-6 font-body-sm text-body-sm text-on-surface"><?php echo htmlspecialchars($pa['crop']); ?></td>
    <td class="py-4 px-6 font-body-md text-body-md text-primary font-semibold">৳<?php echo number_format((float)$pa['required_budget'], 2); ?></td>
    <td class="py-4 px-6 font-body-md text-body-md text-secondary font-semibold">৳<?php echo number_format((float)$pa['current_funding'], 2); ?></td>
    <td class="py-4 px-6">
        <?php if ($pa['status'] === 'approved'): ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-secondary-container text-on-secondary-container">
                Approved
            </span>
        <?php elseif ($pa['status'] === 'active'): ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-fixed text-on-primary-fixed-variant">
                Active
            </span>
        <?php elseif ($pa['status'] === 'completed'): ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-surface-container-high text-on-surface-variant border border-outline-variant/50">
                Completed
            </span>
        <?php elseif ($pa['status'] === 'rejected'): ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-error-container text-error">
                Rejected
            </span>
        <?php else: ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#FEF08A] text-[#854D0E]">
                Pending
            </span>
        <?php endif; ?>
    </td>
    </tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</section>
</div>
</main>
</body>
</html>

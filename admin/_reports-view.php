<?php
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChasiConnect - Platform Reports</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet"/>
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
        .custom-shadow { box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06); }
        .table-header-style { background-color: #F3F4F6; color: #414844; }
</style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col md:flex-row antialiased">
<!-- SideNavBar -->
<aside class="hidden lg:flex flex-col h-full p-6 bg-primary text-on-primary fixed left-0 top-0 w-[280px] shadow-sm z-50">
<div class="mb-stack-lg flex items-center gap-3">
    <a href="admin-dashboard.php" class="flex items-center gap-3 text-on-primary">
        <img src="../logo.png" alt="ChasiConnect Logo" class="h-8 w-auto object-contain brightness-0 invert">
        <div>
            <h1 class="font-headline-sm text-headline-sm font-bold text-on-primary">ChasiConnect</h1>
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
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="manage-project.php">
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
<a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary-container text-on-primary font-semibold shadow-sm" href="reports.php">
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
<div class="mt-auto border-t border-on-primary/10 pt-4 flex flex-col gap-2">
<a class="flex items-center gap-3 px-4 py-2 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/30 transition-colors" href="../home.php">
<span class="material-symbols-outlined text-sm">home</span>
<span class="font-label-md text-label-md">Back to Site</span>
</a>
<a class="flex items-center gap-3 px-4 py-2 rounded-lg text-on-primary-fixed-variant hover:text-error hover:bg-error-container/20 transition-colors" href="../logout.php">
<span class="material-symbols-outlined text-sm">logout</span>
<span class="font-label-md text-label-md">Logout</span>
</a>
</div>
</aside>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col w-full lg:ml-[280px] min-h-screen bg-background">
<!-- TopNavBar -->
<header class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop h-16 bg-surface border-b border-outline-variant z-30 sticky top-0">
<div class="flex items-center gap-3">
    <a href="admin-dashboard.php" class="lg:hidden flex items-center gap-2">
        <img src="../logo.png" alt="ChasiConnect" class="h-7 w-auto">
        <span class="font-headline-sm text-headline-sm font-bold text-primary">ChasiConnect</span>
    </a>
    <span class="hidden lg:block font-headline-sm text-headline-sm font-bold text-primary">Dispute & Reports</span>
</div>
<div class="flex items-center gap-4">
    <a href="../home.php" class="text-on-surface-variant hover:text-primary transition-colors text-sm">Public Home</a>
    <a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors flex items-center gap-1 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">logout</span>
        <span>Logout</span>
    </a>
</div>
</header>

<!-- Main Canvas -->
<div class="p-margin-mobile md:p-margin-desktop max-w-container-max mx-auto w-full flex flex-col gap-stack-lg flex-grow">
<!-- Page Header -->
<section class="flex flex-col gap-2">
<h1 class="font-display-lg text-display-lg text-primary">Disputes & Incident Reports</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Review submitted complaints, monitor system activity, and take resolution actions.</p>
</section>

<?php if (!empty($message)): ?>
    <div class="p-4 rounded-lg <?php echo $message_class === "registration-message" ? "bg-secondary-container/40 text-secondary border border-secondary/30" : "bg-error-container text-error border border-error/20"; ?> text-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5"><?php echo $message_class === "registration-message" ? "check_circle" : "error"; ?></span>
        <div class="font-medium"><?php echo htmlspecialchars($message); ?></div>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-gutter">
<!-- Section 1: Open Reports (Actionable Cards) -->
<section class="xl:col-span-2 flex flex-col gap-stack-md">
<div class="bg-surface-container-lowest rounded-xl custom-shadow p-6 border border-outline-variant/30">
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-headline-sm text-headline-sm text-primary">Open Reports Awaiting Decision</h2>
        <span class="bg-secondary-container text-on-secondary-container font-label-md text-label-md px-3 py-1 rounded-full">
            <?php echo mysqli_num_rows($open_res); ?> Open
        </span>
    </div>

    <!-- Each card represents an unresolved report that an admin can resolve
         or dismiss. The form POSTs back to reports.php with the selected action. -->
    <?php if (mysqli_num_rows($open_res) > 0): ?>
        <div class="space-y-4">
        <?php while ($r = mysqli_fetch_assoc($open_res)): ?>
            <div class="border border-outline-variant/50 rounded-xl p-5 bg-surface-container-low/30 hover:border-primary/40 transition-colors">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold"><?php echo htmlspecialchars($r['subject']); ?></h3>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold <?php echo $r['status'] === 'pending' ? 'bg-[#FEF08A] text-[#854D0E]' : 'bg-primary-fixed text-on-primary-fixed-variant'; ?>">
                        <?php echo ucfirst(htmlspecialchars($r['status'])); ?>
                    </span>
                </div>
                <div class="text-xs text-on-surface-variant mb-3 flex gap-4 flex-wrap">
                    <span><strong>Reported by:</strong> <?php echo htmlspecialchars($r['reporter_name']); ?></span>
                    <span><strong>Type:</strong> <?php echo ucfirst(htmlspecialchars($r['report_type'])); ?></span>
                    <span><strong>Date:</strong> <?php echo htmlspecialchars(date('d M Y', strtotime($r['created_at']))); ?></span>
                </div>
                <?php if ($r['report_type'] === 'user' && $r['reported_user_name'] !== null): ?>
                    <p class="text-sm text-primary mb-2 font-medium">Target User: <?php echo htmlspecialchars($r['reported_user_name']); ?> (<?php echo htmlspecialchars($r['reported_user_email']); ?>)</p>
                <?php elseif ($r['report_type'] === 'project' && $r['project_title'] !== null): ?>
                    <p class="text-sm text-primary mb-2 font-medium">Target Project: <?php echo htmlspecialchars($r['project_title']); ?> (<?php echo htmlspecialchars($r['project_crop']); ?>)</p>
                <?php endif; ?>
                <p class="text-sm text-on-surface bg-surface-container-lowest p-3 rounded-lg border border-outline-variant/30 italic mb-4">
                    "<?php echo nl2br(htmlspecialchars($r['description'])); ?>"
                </p>
                <form method="POST" class="space-y-3 m-0">
                    <!-- report_id is posted so the backend knows which record to update. -->
                    <input type="hidden" name="report_id" value="<?php echo $r['id']; ?>">
                    <textarea name="admin_note" rows="2" placeholder="Admin decision notes or resolution findings..." class="w-full px-3 py-2 text-sm rounded-lg border border-outline-variant/60 bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all resize-none"></textarea>
                    <div class="flex gap-2 justify-end">
                        <!-- Resolve marks the report as handled; dismiss clears it without action. -->
                        <button type="submit" name="action" value="resolve" class="bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md px-4 py-2 rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer shadow-sm">
                            <span class="material-symbols-outlined text-[16px]">check_circle</span>
                            Resolve Report
                        </button>
                        <button type="submit" name="action" value="dismiss" class="border border-error text-error hover:bg-error-container/20 font-label-md text-label-md px-4 py-2 rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer" onclick="return confirm('Dismiss this report?');">
                            <span class="material-symbols-outlined text-[16px]">cancel</span>
                            Dismiss
                        </button>
                    </div>
                </form>
            </div>
        <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="p-8 text-center text-on-surface-variant">
            <span class="material-symbols-outlined text-4xl text-secondary mb-2">task_alt</span>
            <p class="font-body-md text-body-md font-medium">All caught up! No open reports awaiting decision.</p>
        </div>
    <?php endif; ?>
</div>
</section>

<!-- Section 2: All Reports History Table -->
<section class="xl:col-span-1 flex flex-col gap-stack-md">
<div class="bg-surface-container-lowest rounded-xl custom-shadow p-6 border border-outline-variant/30 flex flex-col h-full">
<h2 class="font-headline-sm text-headline-sm text-primary mb-4">Historical Audit Log</h2>
<div class="overflow-y-auto max-h-[600px] space-y-3">
<!-- Read-only historical view of every report, including admin notes
     and resolution timestamps for auditability. -->
<?php while ($ra = mysqli_fetch_assoc($all_res)): ?>
    <div class="p-3.5 rounded-lg border border-outline-variant/40 bg-surface-container-low/20 flex flex-col gap-1 text-xs">
        <div class="flex justify-between items-start">
            <span class="font-semibold text-on-surface text-sm">#<?php echo $ra['id']; ?> &middot; <?php echo htmlspecialchars($ra['subject']); ?></span>
            <span class="px-2 py-0.5 rounded-full font-bold text-[10px] <?php echo $ra['status'] === 'resolved' ? 'bg-secondary-container text-on-secondary-container' : ($ra['status'] === 'dismissed' ? 'bg-surface-variant text-on-surface-variant' : 'bg-[#FEF08A] text-[#854D0E]'); ?>">
                <?php echo ucfirst(htmlspecialchars($ra['status'])); ?>
            </span>
        </div>
        <div class="text-on-surface-variant">By: <?php echo htmlspecialchars($ra['reporter_name']); ?> &middot; <?php echo ucfirst(htmlspecialchars($ra['report_type'])); ?></div>
        <?php if (!empty($ra['admin_note'])): ?>
            <div class="text-on-surface bg-surface-container-lowest p-2 rounded border border-outline-variant/20 mt-1 font-mono">
                Note: <?php echo htmlspecialchars($ra['admin_note']); ?>
            </div>
        <?php endif; ?>
        <?php if ($ra['resolved_at'] !== null): ?>
            <div class="text-[10px] text-on-surface-variant/70 text-right mt-0.5">
                Resolved: <?php echo htmlspecialchars(date('d M Y, h:i A', strtotime($ra['resolved_at']))); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endwhile; ?>
</div>
</div>
</section>
</div>
</div>
</main>
</body>
</html>

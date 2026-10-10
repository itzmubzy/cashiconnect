<?php
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChasiConnect - Manage Users</title>
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
                      "body-md": ["hankenGrotesk", "sans-serif"],
                      "body-lg": ["hankenGrotesk", "sans-serif"],
                      "numeric-kpi": ["hankenGrotesk", "sans-serif"],
                      "headline-md": ["manrope", "sans-serif"],
                      "display-lg": ["manrope", "sans-serif"],
                      "body-sm": ["hankenGrotesk", "sans-serif"],
                      "headline-sm": ["manrope", "sans-serif"],
                      "headline-lg": ["manrope", "sans-serif"],
                      "label-md": ["hankenGrotesk", "sans-serif"]
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
        .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0px 6px 24px rgba(27, 67, 50, 0.10); }
</style>
</head>
<body class="bg-background text-on-surface font-body-md min-h-screen flex flex-col md:flex-row antialiased">
<!-- SideNavBar -->
<nav class="hidden lg:flex flex-col h-full p-6 fixed left-0 top-0 w-[280px] bg-primary text-on-primary shadow-sm z-50">
<div class="mb-stack-lg flex items-center gap-3">
    <a href="admin-dashboard.php" class="flex items-center gap-3">
        <img src="../logo.png" alt="ChasiConnect Logo" class="w-8 h-8 object-contain brightness-0 invert">
        <div>
            <h1 class="font-headline-sm text-headline-sm font-bold text-on-primary">ChasiConnect</h1>
            <p class="font-label-md text-label-md text-primary-fixed-dim">Admin Portal</p>
        </div>
    </a>
</div>
<ul class="flex flex-col gap-base flex-1">
<li>
<a class="flex items-center gap-4 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="admin-dashboard.php">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
</li>
<li>
<a class="flex items-center gap-4 px-4 py-3 rounded-lg bg-primary-container text-on-primary font-semibold shadow-sm" href="manage-users.php">
<span class="material-symbols-outlined">group</span>
<span class="font-label-md text-label-md">Manage Users</span>
</a>
</li>
<li>
<a class="flex items-center gap-4 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="manage-project.php">
<span class="material-symbols-outlined">inventory_2</span>
<span class="font-label-md text-label-md">Manage Projects</span>
</a>
</li>
<li>
<a class="flex items-center gap-4 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="verify-farmer.php">
<span class="material-symbols-outlined">verified</span>
<span class="font-label-md text-label-md">Verify Farmers</span>
</a>
</li>
<li>
<a class="flex items-center gap-4 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="reports.php">
<span class="material-symbols-outlined">assessment</span>
<span class="font-label-md text-label-md">Reports</span>
</a>
</li>
<li>
<a class="flex items-center gap-4 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="finalize-shareout.php">
<span class="material-symbols-outlined">payments</span>
<span class="font-label-md text-label-md">Finalize Shareout</span>
</a>
</li>
</ul>
<div class="mt-auto border-t border-on-primary/10 pt-stack-md flex flex-col gap-2">
<a class="flex items-center gap-3 px-4 py-2 text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/30 rounded-lg transition-colors" href="../home.php">
<span class="material-symbols-outlined text-sm">home</span>
<span class="font-label-md text-label-md">Back to Site</span>
</a>
<a class="flex items-center gap-3 px-4 py-2 text-on-primary-fixed-variant hover:text-error hover:bg-error-container/20 rounded-lg transition-colors" href="../logout.php">
<span class="material-symbols-outlined text-sm">logout</span>
<span class="font-label-md text-label-md">Logout</span>
</a>
</div>
</nav>

<!-- Main Content Area -->
<main class="flex-1 lg:ml-[280px] w-full min-h-screen bg-background flex flex-col">
<!-- TopNavBar -->
<header class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop h-16 bg-surface border-b border-outline-variant z-40 sticky top-0">
<div class="flex items-center gap-3">
    <a href="admin-dashboard.php" class="lg:hidden flex items-center gap-2">
        <img src="../logo.png" alt="ChasiConnect" class="h-7 w-auto">
        <span class="font-headline-sm text-headline-sm font-bold text-primary">ChasiConnect</span>
    </a>
    <span class="hidden lg:block font-headline-sm text-headline-sm font-bold text-primary">User Management</span>
</div>
<div class="flex items-center gap-4">
    <a href="../home.php" class="text-on-surface-variant hover:text-primary transition-colors text-sm">Public Home</a>
    <a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors flex items-center gap-1 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">logout</span>
        <span>Logout</span>
    </a>
</div>
</header>

<!-- Page Content -->
<div class="max-w-[1440px] mx-auto p-margin-mobile md:p-margin-desktop w-full flex-grow">
<!-- Page Header -->
<div class="mb-stack-lg flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<h1 class="font-headline-lg text-headline-lg text-primary mb-stack-sm">Manage Users</h1>
<p class="font-body-md text-body-md text-on-surface-variant">View, moderate, activate, or suspend platform user accounts across all roles.</p>
</div>
<!-- Filters -->
<!-- Role filter pills are generated from $valid_roles; the active filter
     is highlighted to indicate the current subset of users being displayed. -->
<div class="flex gap-1.5 bg-surface-container-low p-1.5 rounded-lg border border-outline-variant/60 flex-wrap">
<a href="manage-users.php" class="px-4 py-1.5 rounded-md font-label-md text-label-md transition-all <?php echo $role_filter === "" ? "bg-primary-container text-on-primary shadow-sm" : "text-on-surface-variant hover:bg-surface-container hover:text-primary"; ?>">All</a>
<?php foreach ($valid_roles as $r): ?>
    <a href="manage-users.php?role=<?php echo $r; ?>" class="px-4 py-1.5 rounded-md font-label-md text-label-md transition-all <?php echo $role_filter === $r ? "bg-primary-container text-on-primary shadow-sm" : "text-on-surface-variant hover:bg-surface-container hover:text-primary"; ?>"><?php echo ucfirst($r); ?>s</a>
<?php endforeach; ?>
</div>
</div>

<?php if (!empty($message)): ?>
    <div class="mb-6 p-4 rounded-lg <?php echo $message_class === "registration-message" ? "bg-secondary-container/40 text-secondary border border-secondary/30" : "bg-error-container text-error border border-error/20"; ?> text-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5"><?php echo $message_class === "registration-message" ? "check_circle" : "error"; ?></span>
        <div class="font-medium"><?php echo htmlspecialchars($message); ?></div>
    </div>
<?php endif; ?>

<!-- Data Table Card -->
<div class="bg-surface-container-lowest rounded-xl custom-shadow border border-outline-variant/50 overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low border-b border-outline-variant/50">
<th class="py-4 px-6 font-label-md text-label-md text-on-surface uppercase tracking-wider">ID</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface uppercase tracking-wider">User Name</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface uppercase tracking-wider">Email</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface uppercase tracking-wider">Phone</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface uppercase tracking-wider">Role</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface uppercase tracking-wider">Status</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface uppercase tracking-wider">Reg Date</th>
<th class="py-4 px-6 font-label-md text-label-md text-on-surface uppercase tracking-wider text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/30">
<?php while ($u = mysqli_fetch_assoc($users_res)): ?>
    <!-- Highlight the current admin's own row so they cannot accidentally
         suspend or modify their own account from this interface. -->
    <?php $is_self = ((int)$u['id'] === (int)$admin_user_id); ?>
    <tr class="hover:bg-surface-container-low/40 transition-colors group <?php echo $is_self ? "bg-surface-container-lowest/80" : ""; ?>">
    <td class="py-4 px-6 font-body-sm text-body-sm text-on-surface-variant font-mono">#<?php echo str_pad($u['id'], 3, '0', STR_PAD_LEFT); ?></td>
    <td class="py-4 px-6">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-primary-container/20 text-primary flex items-center justify-center font-bold text-xs shrink-0">
                <?php echo strtoupper(substr($u['name'], 0, 2)); ?>
            </div>
            <span class="font-body-md text-body-md font-semibold text-primary">
                <?php echo htmlspecialchars($u['name']); ?>
                <?php if ($is_self): ?><span class="text-xs font-normal text-on-surface-variant ml-1">(you)</span><?php endif; ?>
            </span>
        </div>
    </td>
    <td class="py-4 px-6 font-body-sm text-body-sm text-on-surface-variant"><?php echo htmlspecialchars($u['email']); ?></td>
    <td class="py-4 px-6 font-body-sm text-body-sm text-on-surface-variant"><?php echo htmlspecialchars($u['phone'] ?? '-'); ?></td>
    <td class="py-4 px-6">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-surface-container-high text-on-surface">
            <?php echo ucfirst(htmlspecialchars($u['role'])); ?>
        </span>
    </td>
    <td class="py-4 px-6">
        <?php if ($u['status'] === 'active'): ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-secondary-container text-on-secondary-container">
                Active
            </span>
        <?php elseif ($u['status'] === 'suspended'): ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-error-container text-error">
                Suspended
            </span>
        <?php else: ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-surface-variant text-on-surface-variant">
                <?php echo ucfirst(htmlspecialchars($u['status'])); ?>
            </span>
        <?php endif; ?>
    </td>
    <td class="py-4 px-6 font-body-sm text-body-sm text-on-surface-variant"><?php echo htmlspecialchars(date('d M Y', strtotime($u['created_at']))); ?></td>
    <td class="py-4 px-6 text-right space-x-2">
        <?php if ($is_self): ?>
            <!-- The admin's own account is protected; no action buttons are rendered. -->
            <span class="text-xs text-on-surface-variant/60 font-medium">N/A</span>
        <?php elseif ($u['status'] === 'active'): ?>
            <!-- Confirm dialog adds a client-side safety check before sending
                 the POST request to suspend the selected user account. -->
            <form method="POST" class="inline-block m-0" onsubmit="return confirm('Are you sure you want to suspend this user account?');">
                <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                <button type="submit" name="action" value="suspend" class="text-error hover:text-error/80 font-label-md text-label-md transition-colors cursor-pointer">
                    Suspend
                </button>
            </form>
        <?php else: ?>
            <form method="POST" class="inline-block m-0">
                <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                <button type="submit" name="action" value="activate" class="text-secondary hover:text-secondary-container font-label-md text-label-md transition-colors cursor-pointer">
                    Activate
                </button>
            </form>
        <?php endif; ?>
    </td>
    </tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>
</main>
</body>
</html>

<?php
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChasiConnect - Verify Farmers</title>
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
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0px 6px 24px rgba(27, 67, 50, 0.10); transition: all 0.2s ease-in-out; }
</style>
</head>
<body class="bg-background text-on-surface font-body-md antialiased flex flex-col md:flex-row min-h-screen">
<!-- SideNavBar -->
<aside class="fixed left-0 top-0 h-full w-[280px] bg-primary text-on-primary flex-col shadow-sm hidden lg:flex z-50 p-6">
<div class="flex items-center gap-3 mb-8">
    <a href="admin-dashboard.php" class="flex items-center gap-3 text-on-primary">
        <img src="../logo.png" alt="ChasiConnect Logo" class="h-8 w-auto object-contain brightness-0 invert">
        <div>
            <h1 class="font-headline-sm text-headline-sm font-bold text-on-primary">ChasiConnect</h1>
            <p class="font-label-md text-label-md text-primary-fixed-dim">Admin Portal</p>
        </div>
    </a>
</div>
<nav class="flex flex-col gap-2 flex-grow">
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="admin-dashboard.php">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="manage-users.php">
<span class="material-symbols-outlined">group</span>
<span class="font-label-md text-label-md">Manage Users</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="manage-project.php">
<span class="material-symbols-outlined">inventory_2</span>
<span class="font-label-md text-label-md">Manage Projects</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary-container text-on-primary font-semibold shadow-sm" href="verify-farmer.php">
<span class="material-symbols-outlined">verified</span>
<span class="font-label-md text-label-md">Verify Farmers</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="reports.php">
<span class="material-symbols-outlined">assessment</span>
<span class="font-label-md text-label-md">Reports</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary-fixed-variant hover:text-on-primary hover:bg-primary-container/50 transition-colors" href="finalize-shareout.php">
<span class="material-symbols-outlined">payments</span>
<span class="font-label-md text-label-md">Finalize Shareout</span>
</a>
</nav>
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
</aside>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col lg:ml-[280px] min-h-screen bg-background w-full">
<!-- TopNavBar -->
<header class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop h-16 bg-surface border-b border-outline-variant z-40 sticky top-0">
<div class="flex items-center gap-3">
    <a href="admin-dashboard.php" class="lg:hidden flex items-center gap-2">
        <img src="../logo.png" alt="ChasiConnect" class="h-7 w-auto">
        <span class="font-headline-sm text-headline-sm font-bold text-primary">ChasiConnect</span>
    </a>
    <span class="hidden lg:block font-headline-sm text-headline-sm font-bold text-primary">Farmer Verification</span>
</div>
<div class="flex items-center gap-4">
    <a href="../home.php" class="text-on-surface-variant hover:text-primary transition-colors text-sm">Public Home</a>
    <a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors flex items-center gap-1 text-sm font-medium">
        <span class="material-symbols-outlined text-lg">logout</span>
        <span>Logout</span>
    </a>
</div>
</header>

<div class="w-full max-w-container-max mx-auto px-margin-mobile lg:px-margin-desktop py-stack-lg flex flex-col gap-stack-lg flex-grow">
<!-- Page Header -->
<header class="flex flex-col gap-stack-sm">
<h1 class="font-headline-lg text-headline-lg text-on-surface">Verify Farmers</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Review farmer credential applications, verify cultivation experience, and approve profile statuses.</p>
</header>

<?php if (!empty($message)): ?>
    <div class="p-4 rounded-lg <?php echo $message_class === "registration-message" ? "bg-secondary-container/40 text-secondary border border-secondary/30" : "bg-error-container text-error border border-error/20"; ?> text-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5"><?php echo $message_class === "registration-message" ? "check_circle" : "error"; ?></span>
        <div class="font-medium"><?php echo htmlspecialchars($message); ?></div>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 xl:grid-cols-12 gap-gutter">
<!-- Section 1: Pending Verification -->
<section class="xl:col-span-6 flex flex-col gap-stack-md">
<div class="flex items-center justify-between">
    <h2 class="font-headline-md text-headline-md text-on-surface">Pending Applications</h2>
    <!-- Badge reflects real-time count of farmers awaiting verification. -->
    <span class="bg-secondary-container text-on-secondary-container font-label-md text-label-md px-3 py-1 rounded-full">
        <?php echo mysqli_num_rows($pending_res); ?> Pending
    </span>
</div>

<?php if (mysqli_num_rows($pending_res) > 0): ?>
    <div class="space-y-4">
    <?php while ($f = mysqli_fetch_assoc($pending_res)): ?>
        <div class="bg-surface-container-lowest rounded-xl p-6 custom-shadow hover-lift flex flex-col gap-4 border border-outline-variant/30">
            <!-- Farmer Header Profile -->
            <div class="flex gap-4 items-start">
                <div class="w-14 h-14 rounded-full bg-primary-container/20 text-primary flex items-center justify-center font-bold text-lg shrink-0">
                    <?php echo strtoupper(substr($f['name'], 0, 2)); ?>
                </div>
                <div class="flex flex-col flex-grow">
                    <h3 class="font-headline-sm text-headline-sm text-on-surface m-0 leading-tight"><?php echo htmlspecialchars($f['name']); ?></h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant"><?php echo htmlspecialchars($f['email']); ?><?php if ($f['phone']): ?> &middot; <?php echo htmlspecialchars($f['phone']); ?><?php endif; ?></p>
                    <div class="mt-2 flex items-center gap-2 flex-wrap">
                        <span class="inline-flex items-center gap-1 bg-surface-container px-2.5 py-0.5 rounded-full text-xs text-on-surface-variant font-medium">
                            <span class="material-symbols-outlined text-[14px]">psychology</span>
                            <?php echo htmlspecialchars($f['specialization'] ?? 'General Farmer'); ?>
                        </span>
                        <span class="inline-flex items-center gap-1 bg-surface-container px-2.5 py-0.5 rounded-full text-xs text-on-surface-variant font-medium">
                            <span class="material-symbols-outlined text-[14px]">history</span>
                            <?php echo htmlspecialchars($f['experience_years']); ?> Yrs Exp
                        </span>
                    </div>
                </div>
            </div>
            <hr class="border-outline-variant/40"/>
            <!-- Bio / Detail -->
            <div>
                <h4 class="font-label-md text-label-md text-on-surface-variant uppercase mb-1">Farmer Bio & Background</h4>
                <p class="font-body-sm text-body-sm text-on-surface leading-relaxed italic">
                    "<?php echo nl2br(htmlspecialchars($f['bio'] ?? 'No bio or background details submitted.')); ?>"
                </p>
            </div>
            <!-- Actions -->
            <!-- Each form submits farmer_id and the chosen action (approve/reject)
                 to verify-farmer.php, which performs the actual status update. -->
            <form method="POST" class="flex gap-3 mt-2 m-0">
                <input type="hidden" name="farmer_id" value="<?php echo $f['id']; ?>">
                <button type="submit" name="action" value="approve" class="flex-1 bg-primary-container text-on-primary py-2.5 px-4 rounded-lg font-label-md text-label-md hover:bg-primary transition-colors flex items-center justify-center gap-2 cursor-pointer shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">verified</span>
                    Verify Farmer
                </button>
                <button type="submit" name="action" value="reject" class="flex-1 border border-error text-error bg-transparent py-2.5 px-4 rounded-lg font-label-md text-label-md hover:bg-error/10 transition-colors flex items-center justify-center gap-2 cursor-pointer" onclick="return confirm('Reject this farmer verification application?');">
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
        <p class="font-body-md text-body-md font-medium">No farmer verification applications are pending review.</p>
    </div>
<?php endif; ?>
</section>

<!-- Section 2: Verification History / All Farmers -->
<section class="xl:col-span-6 flex flex-col gap-stack-md">
<h2 class="font-headline-md text-headline-md text-on-surface">Farmer Directory & Status</h2>
<div class="bg-surface-container-lowest rounded-xl custom-shadow overflow-hidden border border-outline-variant/30 flex flex-col">
<div class="overflow-x-auto w-full">
<table class="w-full text-left border-collapse">
<thead class="bg-surface-container-low border-b border-outline-variant">
<tr>
<th class="py-4 px-5 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Farmer</th>
<th class="py-4 px-5 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Specialization</th>
<th class="py-4 px-5 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Experience</th>
<th class="py-4 px-5 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider text-right">Status</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/30">
<!-- Read-only directory of all farmers with their current verification status. -->
<?php while ($fa = mysqli_fetch_assoc($all_res)): ?>
    <tr class="hover:bg-surface-container-low/40 transition-colors">
    <td class="py-4 px-5">
        <div class="font-semibold text-on-surface text-sm"><?php echo htmlspecialchars($fa['name']); ?></div>
        <div class="text-xs text-on-surface-variant"><?php echo htmlspecialchars($fa['email']); ?></div>
    </td>
    <td class="py-4 px-5 font-body-sm text-body-sm text-on-surface"><?php echo htmlspecialchars($fa['specialization'] ?? 'N/A'); ?></td>
    <td class="py-4 px-5 font-body-sm text-body-sm text-on-surface"><?php echo htmlspecialchars($fa['experience_years']); ?> Yrs</td>
    <td class="py-4 px-5 text-right">
        <?php if ($fa['verification_status'] === 'approved'): ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-secondary-container text-on-secondary-container">
                Approved
            </span>
        <?php elseif ($fa['verification_status'] === 'rejected'): ?>
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
</div>
</main>
</body>
</html>

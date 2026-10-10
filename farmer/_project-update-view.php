<?php
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChasiConnect - Update Project Progress</title>
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600&amp;family=Manrope:wght@600;700&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Tailwind Config -->
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
                    },
                    boxShadow: {
                        'premium': '0px 4px 20px rgba(27, 67, 50, 0.06)',
                    }
                }
            }
        }
</script>
<style>
        body { font-family: 'Hanken Grotesk', sans-serif; background-color: #fcf9f8; }
        h1, h2, h3, h4, h5, h6, .font-headline-lg, .font-headline-md, .font-headline-sm, .font-display-lg { font-family: 'Manrope', sans-serif; }
</style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col font-body-md">
<!-- TopNavBar -->
<header class="sticky top-0 w-full z-50 flex justify-between items-center px-margin-mobile md:px-margin-desktop py-4 bg-surface-container-lowest mx-auto max-w-container-max border-b border-outline-variant shadow-sm">
<div class="flex items-center gap-stack-lg">
    <a href="farmer-dashboard.php" class="flex items-center gap-3">
        <div class="flex items-center justify-center w-9 h-9 bg-primary-container rounded-lg">
            <span class="material-symbols-outlined text-on-primary text-xl" style="font-variation-settings: 'FILL' 1;">agriculture</span>
        </div>
        <span class="font-headline-md text-headline-md font-bold text-primary">ChasiConnect</span>
    </a>
    <nav class="hidden md:flex gap-stack-md ml-4">
        <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200 py-1" href="farmer-dashboard.php">Dashboard</a>
        <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200 py-1" href="create-project.php">Create Project</a>
        <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200 py-1" href="hire-requests.php">Requests</a>
        <a class="font-label-md text-label-md text-secondary border-b-2 border-secondary pb-1 font-bold py-1" href="project-update.php">Progress</a>
        <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200 py-1" href="harvest.php">Harvest</a>
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
<main class="flex-1 w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg">
<!-- Header Section -->
<div class="mb-stack-lg">
    <a class="flex items-center text-on-surface-variant hover:text-primary mb-stack-sm transition-colors text-label-md font-label-md" href="farmer-dashboard.php">
        <span class="material-symbols-outlined text-[16px] mr-1">arrow_back</span>
        Back to Dashboard
    </a>
    <h1 class="font-headline-lg text-headline-lg text-primary mb-stack-sm">Update Project Progress</h1>
    <p class="font-body-md text-body-md text-on-surface-variant">Record recent activities, progress milestones, and field updates for your active projects.</p>
</div>

<?php if (!empty($message)): ?>
    <div class="mb-6 p-4 rounded-lg <?php echo $message_class === "registration-message" ? "bg-secondary-container text-on-secondary-container border border-secondary/30" : "bg-error-container text-error border border-error/20"; ?> text-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5"><?php echo $message_class === "registration-message" ? "check_circle" : "error"; ?></span>
        <div class="font-medium"><?php echo htmlspecialchars($message); ?></div>
    </div>
<?php endif; ?>

<!-- Layout Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
<!-- Left Column: Form -->
<div class="lg:col-span-7 flex flex-col gap-stack-lg">
    <!-- Update Form Card -->
    <div class="bg-surface-container-lowest rounded-xl p-stack-lg shadow-premium border border-outline-variant/50 relative overflow-hidden">
        <h3 class="font-headline-sm text-headline-sm text-primary border-b border-outline-variant/30 pb-stack-sm mb-stack-md">New Progress Entry</h3>

        <?php if (mysqli_num_rows($projects_res) > 0): ?>
            <form method="POST" class="flex flex-col gap-stack-md">
                <!-- Select Project -->
                <div class="flex flex-col gap-1">
                    <label class="font-label-md text-label-md text-on-surface-variant uppercase" for="project_id">Select Project *</label>
                    <select class="bg-surface border-1.5 border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md p-3 transition-all outline-none" id="project_id" name="project_id" required>
                        <option value="">-- Choose project --</option>
                        <?php while ($p = mysqli_fetch_assoc($projects_res)): ?>
                            <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['title'] . ' - ' . $p['crop'] . ' (' . ucfirst($p['status']) . ')'); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant uppercase" for="progress_percentage">Progress Percentage (%) *</label>
                        <input class="bg-surface border-1.5 border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md p-3 transition-all outline-none" id="progress_percentage" name="progress_percentage" placeholder="e.g. 65" min="0" max="100" step="0.01" type="number" required/>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant uppercase" for="update_date">Date of Update *</label>
                        <input class="bg-surface border-1.5 border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md p-3 transition-all outline-none" id="update_date" name="update_date" type="date" required/>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant uppercase" for="milestone">Milestone / Title *</label>
                        <input class="bg-surface border-1.5 border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md p-3 transition-all outline-none" id="milestone" name="milestone" placeholder="e.g. Fertilizer Application" maxlength="200" type="text" required/>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant uppercase" for="expense">Expense Incurred (৳, optional)</label>
                        <input class="bg-surface border-1.5 border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md p-3 transition-all outline-none" id="expense" name="expense" placeholder="e.g. 15000" min="0" step="0.01" type="number"/>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="font-label-md text-label-md text-on-surface-variant uppercase" for="description">Milestone Description *</label>
                    <textarea class="bg-surface border-1.5 border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md p-3 resize-y transition-all outline-none" id="description" name="description" placeholder="Describe recent activities, field conditions, inputs applied, or milestones reached..." rows="4" required></textarea>
                </div>

                <div class="mt-stack-sm flex justify-end">
                    <button class="bg-primary-container text-on-primary rounded-lg px-8 py-3.5 font-label-md text-label-md uppercase tracking-wider hover:bg-secondary transition-colors duration-200 shadow-sm flex items-center gap-2 cursor-pointer" type="submit">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 18px;">send</span>
                        Post Update
                    </button>
                </div>
            </form>
        <?php else: ?>
            <div class="p-8 text-center text-on-surface-variant">
                <span class="material-symbols-outlined text-4xl text-outline mb-2 block">pending_actions</span>
                <p class="font-body-md text-body-md">You have no projects currently open for updates.</p>
                <p class="font-body-sm text-body-sm text-outline mt-1">Progress updates can be posted once an admin approves your project or sets it to active status.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Right Column: Timeline -->
<div class="lg:col-span-5">
    <div class="bg-surface-container-lowest rounded-xl p-stack-lg shadow-premium border border-outline-variant/50 h-full flex flex-col">
        <h3 class="font-headline-sm text-headline-sm text-primary border-b border-outline-variant/30 pb-stack-sm mb-stack-lg">Update History</h3>

        <?php if (isset($updates_res) && mysqli_num_rows($updates_res) > 0): ?>
            <div class="relative border-l-2 border-outline-variant/40 ml-3 flex flex-col gap-stack-lg flex-grow">
                <?php while ($upd = mysqli_fetch_assoc($updates_res)): ?>
                    <div class="relative pl-6">
                        <div class="absolute w-3.5 h-3.5 bg-primary rounded-full -left-[8px] top-1.5 shadow-sm border-2 border-surface-container-lowest"></div>
                        <div class="flex items-center justify-between gap-2 mb-1">
                            <span class="font-label-md text-label-md text-on-surface-variant"><?php echo htmlspecialchars(date('d M Y', strtotime($upd['update_date']))); ?></span>
                            <span class="bg-secondary-container text-on-secondary-container font-label-md text-xs px-2 py-0.5 rounded-full font-bold">
                                <?php echo htmlspecialchars($upd['progress_percentage']); ?>%
                            </span>
                        </div>
                        <div class="bg-surface rounded-lg p-3.5 border border-outline-variant/30 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="font-body-md text-body-md font-semibold text-primary"><?php echo htmlspecialchars($upd['milestone']); ?></h4>
                                <?php if (!empty($upd['expense']) && (float)$upd['expense'] > 0): ?>
                                    <span class="text-xs font-semibold text-on-surface-variant">৳<?php echo number_format((float)$upd['expense'], 2); ?></span>
                                <?php endif; ?>
                            </div>
                            <span class="text-[11px] font-semibold text-secondary uppercase block mb-1"><?php echo htmlspecialchars($upd['project_title']); ?></span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant"><?php echo htmlspecialchars($upd['description']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="my-auto py-12 text-center text-on-surface-variant">
                <span class="material-symbols-outlined text-4xl text-outline mb-2 block">history</span>
                <p class="font-body-md text-body-md">No updates posted yet.</p>
                <p class="font-body-sm text-body-sm text-outline mt-1">Logged milestones will appear here in chronological order.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>
</main>

<!-- Footer -->
<footer class="w-full py-stack-lg px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-base bg-surface-container border-t border-outline-variant mt-auto">
    <span class="font-headline-sm text-headline-sm text-primary font-bold">ChasiConnect</span>
    <div class="flex gap-stack-md font-label-md text-label-md text-on-surface-variant text-xs">
        <a class="hover:underline transition-opacity duration-200" href="#">Support</a>
        <a class="hover:underline transition-opacity duration-200" href="#">Privacy Policy</a>
        <a class="hover:underline transition-opacity duration-200" href="#">Terms of Service</a>
    </div>
    <span class="font-body-sm text-body-sm text-on-surface text-xs">&copy; <?php echo date("Y"); ?> ChasiConnect Agricultural Management. All rights reserved.</span>
</footer>

<script>
    // Set default date to today if empty
    document.addEventListener('DOMContentLoaded', () => {
        const dateInput = document.getElementById('update_date');
        if (dateInput && !dateInput.value) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.value = today;
        }
    });
</script>
</body>
</html>

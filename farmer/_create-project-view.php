<?php
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChasiConnect - Create Project</title>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&amp;family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Tailwind Configuration (From Design System) -->
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
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                    "headline-sm": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "numeric-kpi": ["28px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
            }
          },
        }
      }
    </script>
<style>
        body { font-family: 'Hanken Grotesk', sans-serif; background-color: #fcf9f8; }
        h1, h2, h3, h4, h5, h6, .font-headline-lg, .font-headline-md, .font-headline-sm, .font-display-lg { font-family: 'Manrope', sans-serif; }
        .ambient-shadow {
            box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06);
        }
        .form-input-premium {
            border-width: 1.5px;
            border-color: #c1c8c2;
            transition: all 0.2s ease;
        }
        .form-input-premium:focus {
            border-color: #012d1d;
            box-shadow: 0 0 0 2px rgba(1, 45, 29, 0.2);
            outline: none;
        }
</style>
</head>
<body class="bg-background text-on-surface font-body-md min-h-screen flex flex-col">
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
        <a class="text-secondary border-b-2 border-secondary pb-1 font-bold font-label-md text-label-md" href="create-project.php">Create Project</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md py-1" href="hire-requests.php">Requests</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md py-1" href="project-update.php">Progress</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md py-1" href="harvest.php">Harvest</a>
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

<!-- Main Content Area -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg">
<!-- Header Section -->
<header class="mb-stack-lg flex justify-between items-end">
<div>
    <a class="flex items-center text-on-surface-variant hover:text-primary mb-stack-sm transition-colors text-label-md font-label-md" href="farmer-dashboard.php">
        <span class="material-symbols-outlined text-[16px] mr-1">arrow_back</span>
        Back to Dashboard
    </a>
    <h1 class="font-display-lg text-display-lg text-primary tracking-tight">Create New Project</h1>
    <p class="font-body-lg text-body-lg text-on-surface-variant mt-2 max-w-2xl">Define your cultivation plan, allocate resources, and establish the financial framework for your upcoming season.</p>
</div>
</header>

<?php if (!empty($message)): ?>
    <div class="mb-6 p-4 rounded-lg <?php echo $message_class === "registration-message" ? "bg-secondary-container text-on-secondary-container border border-secondary/30" : "bg-error-container text-error border border-error/20"; ?> text-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5"><?php echo $message_class === "registration-message" ? "check_circle" : "error"; ?></span>
        <div class="font-medium"><?php echo htmlspecialchars($message); ?></div>
    </div>
<?php endif; ?>

<!-- Asymmetric Grid Layout for Form & Summary -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
<!-- Left Column: Main Form Card -->
<div class="lg:col-span-8 bg-surface-container-lowest rounded-xl ambient-shadow p-6 md:p-8 border border-outline-variant/30">
<?php if (mysqli_num_rows($lands_res) > 0): ?>
    <form method="POST" class="space-y-stack-md" id="project-form">
        <h2 class="font-headline-sm text-headline-sm text-primary mb-stack-md pb-4 border-b border-outline-variant/50">Project Details</h2>

        <!-- Row 1: Title (Full Width) -->
        <div>
            <label class="block font-label-md text-label-md text-on-surface-variant mb-base uppercase" for="title">Project Title *</label>
            <input class="w-full bg-surface-bright form-input-premium rounded-lg p-3 font-body-md text-body-md text-on-surface placeholder:text-outline" id="title" name="title" placeholder="e.g. Winter Rice Cultivation Project" type="text" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>" required/>
        </div>

        <!-- Row 2: Land & Crop (Half Widths) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
            <div>
                <label class="block font-label-md text-label-md text-on-surface-variant mb-base uppercase" for="land_id">Land Parcel (from accepted hires) *</label>
                <div class="relative">
                    <select class="w-full bg-surface-bright form-input-premium rounded-lg p-3 font-body-md text-body-md text-on-surface appearance-none pr-10" id="land_id" name="land_id" required>
                        <option disabled selected value="">Select accepted land...</option>
                        <?php while ($land = mysqli_fetch_assoc($lands_res)): ?>
                            <option value="<?php echo (int)$land['id']; ?>" data-lease="<?php echo htmlspecialchars(number_format((float)($land['lease_amount'] ?? 0), 2, '.', '')); ?>" <?php if (isset($_POST['land_id']) && (int)$_POST['land_id'] === (int)$land['id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($land['title'] . ' - ' . $land['location'] . ' (' . $land['area'] . ' ' . $land['area_unit'] . ')'); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                </div>
            </div>
            <div>
                <label class="block font-label-md text-label-md text-on-surface-variant mb-base uppercase" for="crop">Target Crop *</label>
                <input class="w-full bg-surface-bright form-input-premium rounded-lg p-3 font-body-md text-body-md text-on-surface placeholder:text-outline" id="crop" name="crop" placeholder="e.g. Rice, Maize, Wheat" type="text" value="<?php echo isset($_POST['crop']) ? htmlspecialchars($_POST['crop']) : ''; ?>" required/>
            </div>
        </div>

        <!-- Row 3: Duration -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
            <div>
                <label class="block font-label-md text-label-md text-on-surface-variant mb-base uppercase" for="duration_months">Expected Duration (Months) *</label>
                <div class="relative">
                    <input class="w-full bg-surface-bright form-input-premium rounded-lg p-3 pl-10 font-body-md text-body-md text-on-surface" id="duration_months" name="duration_months" max="36" min="1" placeholder="e.g. 6" type="number" value="<?php echo isset($_POST['duration_months']) ? htmlspecialchars($_POST['duration_months']) : ''; ?>" required/>
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none text-[20px]">calendar_month</span>
                </div>
            </div>
        </div>

        <!-- Row 4: Description -->
        <div>
            <label class="block font-label-md text-label-md text-on-surface-variant mb-base uppercase" for="description">Cultivation Plan & Description *</label>
            <textarea class="w-full bg-surface-bright form-input-premium rounded-lg p-3 font-body-md text-body-md text-on-surface placeholder:text-outline resize-y" id="description" name="description" rows="4" placeholder="Describe the cultivation plan, irrigation methods, harvest timeline, and input allocation..." required><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
        </div>

        <h2 class="font-headline-sm text-headline-sm text-primary mb-stack-md pt-stack-md pb-4 border-b border-outline-variant/50 mt-stack-lg">Financial Allocation</h2>

        <!-- Row 5: Costs -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
            <div>
                <label class="block font-label-md text-label-md text-on-surface-variant mb-base uppercase" for="farming_costs">Estimated Farming Costs (৳) *</label>
                <div class="relative">
                    <input class="w-full bg-surface-bright form-input-premium rounded-lg p-3 pl-10 font-body-md text-body-md text-on-surface" id="farming_costs" name="farming_costs" placeholder="0.00" type="number" min="0.01" step="0.01" value="<?php echo isset($_POST['farming_costs']) ? htmlspecialchars($_POST['farming_costs']) : ''; ?>" required/>
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-outline pointer-events-none font-bold text-sm">৳</span>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1 text-xs">Includes seeds, fertilizer, labor, and fuel.</p>
            </div>
            <div>
                <label class="block font-label-md text-label-md text-on-surface-variant mb-base uppercase">Land Lease Cost (৳, Fixed)</label>
                <div class="relative">
                    <input class="w-full bg-surface-container-low form-input-premium rounded-lg p-3 pl-10 font-body-md text-body-md text-on-surface cursor-not-allowed" id="lease-costs-input" readonly placeholder="0.00" type="text" value="0.00"/>
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-outline pointer-events-none font-bold text-sm">৳</span>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1 text-xs">Automatically derived from your accepted land offer.</p>
            </div>
        </div>

        <div class="pt-6 flex justify-end">
            <button class="w-full sm:w-auto bg-primary-container text-on-primary rounded-lg font-label-md text-label-md uppercase tracking-wide py-4 px-8 hover:bg-secondary transition-colors shadow-sm flex justify-center items-center gap-2 cursor-pointer" type="submit">
                <span class="material-symbols-outlined text-[18px]">add_circle</span>
                Submit Project for Approval
            </button>
        </div>
    </form>
<?php else: ?>
    <div class="p-8 text-center text-on-surface-variant">
        <span class="material-symbols-outlined text-5xl text-outline mb-3 block">landscape</span>
        <h3 class="font-headline-sm text-headline-sm text-primary mb-2">No Available Land Leases Found</h3>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-md mx-auto mb-6">You need an accepted land lease from a landowner before you can create and submit a farming project for investment.</p>
        <a href="hire-requests.php" class="inline-flex items-center gap-2 bg-primary-container text-on-primary px-6 py-3 rounded-lg font-label-md text-label-md uppercase hover:bg-primary transition-colors shadow-sm">
            <span class="material-symbols-outlined text-[18px]">mail</span>
            Review Pending Hire Requests
        </a>
    </div>
<?php endif; ?>
</div>

<!-- Right Column: Budget Summary & Actions (Sticky) -->
<div class="lg:col-span-4 sticky top-[100px] flex flex-col gap-stack-md">
    <!-- Financial Summary Card -->
    <div class="bg-primary text-on-primary rounded-xl p-6 relative overflow-hidden shadow-lg border border-primary-container">
        <!-- Decorative background element for premium feel -->
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-secondary opacity-30 rounded-full blur-2xl pointer-events-none"></div>
        <h3 class="font-label-md text-label-md uppercase tracking-wider text-primary-fixed-dim mb-4">Total Required Budget</h3>
        <div class="flex items-baseline gap-1 mb-6">
            <span class="font-numeric-kpi text-[32px] font-bold leading-none">৳</span>
            <span class="font-numeric-kpi text-[42px] font-bold leading-none tracking-tight" id="total-budget-display">0.00</span>
        </div>
        <div class="space-y-3 font-body-sm text-body-sm text-primary-fixed-dim border-t border-secondary pt-4">
            <div class="flex justify-between items-center">
                <span>Farming Allocation</span>
                <span class="font-numeric-kpi font-medium text-on-primary" id="summary-farming-cost">৳0.00</span>
            </div>
            <div class="flex justify-between items-center">
                <span>Land Lease Cost</span>
                <span class="font-numeric-kpi font-medium text-on-primary" id="summary-lease-cost">৳0.00</span>
            </div>
        </div>
    </div>

    <!-- Guidance Note -->
    <div class="p-4 bg-surface-container-low rounded-lg border border-outline-variant/30 flex gap-3 items-start">
        <span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">info</span>
        <p class="font-body-sm text-body-sm text-on-surface-variant">Submitted projects enter a <strong>Pending</strong> state and are reviewed by system administrators before being published to investors.</p>
    </div>
</div>
</div>
</main>

<!-- Footer -->
<footer class="w-full py-stack-lg px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-base bg-surface-container border-t border-outline-variant mt-auto">
    <div class="font-headline-sm text-headline-sm text-primary font-bold">ChasiConnect</div>
    <div class="font-body-sm text-body-sm text-on-surface-variant text-center md:text-left">
        &copy; <?php echo date("Y"); ?> ChasiConnect Agricultural Management. All rights reserved.
    </div>
    <div class="flex gap-4 text-xs text-on-surface-variant">
        <a class="hover:underline transition-opacity duration-200" href="#">Support</a>
        <a class="hover:underline transition-opacity duration-200" href="#">Privacy Policy</a>
        <a class="hover:underline transition-opacity duration-200" href="#">Terms of Service</a>
    </div>
</footer>

<!-- Micro-interaction Script for Live Calculation -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const landSelect = document.getElementById('land_id');
        const farmingCostInput = document.getElementById('farming_costs');
        const leaseCostInput = document.getElementById('lease-costs-input');
        const totalBudgetDisplay = document.getElementById('total-budget-display');
        const summaryFarming = document.getElementById('summary-farming-cost');
        const summaryLease = document.getElementById('summary-lease-cost');

        function formatMoney(amount) {
            return new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(amount);
        }

        function updateBudget() {
            if (!landSelect || !farmingCostInput) return;
            const selected = landSelect.options[landSelect.selectedIndex];
            const leaseVal = (selected && selected.dataset) ? parseFloat(selected.dataset.lease || 0) : 0;
            const farmingVal = parseFloat(farmingCostInput.value) || 0;
            const total = farmingVal + leaseVal;

            if (leaseCostInput) leaseCostInput.value = formatMoney(leaseVal);
            totalBudgetDisplay.textContent = formatMoney(total);
            summaryFarming.textContent = '৳' + formatMoney(farmingVal);
            summaryLease.textContent = '৳' + formatMoney(leaseVal);
        }

        if (landSelect) landSelect.addEventListener('change', updateBudget);
        if (farmingCostInput) farmingCostInput.addEventListener('input', updateBudget);
        updateBudget();
    });
</script>
</body>
</html>

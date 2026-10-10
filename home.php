<?php

session_start();
$is_logged_in = isset($_SESSION["id"], $_SESSION["role"]);
$dashboard_url = "home.php";
if ($is_logged_in) {
    if ($_SESSION["role"] === "farmer") $dashboard_url = "farmer/farmer-dashboard.php";
    else if ($_SESSION["role"] === "investor") $dashboard_url = "investor/dashboard.php";
    else if ($_SESSION["role"] === "landowner") $dashboard_url = "landowner/landowner-dashboard.php";
    else if ($_SESSION["role"] === "admin") $dashboard_url = "admin/admin-dashboard.php";
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChasiConnect - Empowering the Future of Agriculture</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary-container": "#75b393",
                        "on-secondary-fixed": "#002113",
                        "on-tertiary": "#ffffff",
                        "surface": "#fcf9f8",
                        "primary": "#012d1d",
                        "surface-dim": "#dcd9d9",
                        "inverse-on-surface": "#f3f0ef",
                        "surface-container-highest": "#e5e2e1",
                        "on-secondary": "#ffffff",
                        "inverse-primary": "#a5d0b9",
                        "secondary-fixed": "#a1f4c8",
                        "error": "#ba1a1a",
                        "on-primary-container": "#86af99",
                        "tertiary-fixed": "#b1f0ce",
                        "outline": "#717973",
                        "on-secondary-fixed-variant": "#005236",
                        "error-container": "#ffdad6",
                        "on-primary-fixed-variant": "#274e3d",
                        "surface-container-lowest": "#ffffff",
                        "tertiary": "#002d1c",
                        "on-surface-variant": "#414844",
                        "primary-fixed-dim": "#a5d0b9",
                        "surface-container": "#f0eded",
                        "tertiary-fixed-dim": "#95d4b3",
                        "secondary": "#116c4a",
                        "inverse-surface": "#313030",
                        "on-background": "#1c1b1b",
                        "background": "#fcf9f8",
                        "on-tertiary-fixed-variant": "#0e5138",
                        "primary-container": "#1b4332",
                        "surface-tint": "#3f6653",
                        "on-error-container": "#93000a",
                        "on-primary": "#ffffff",
                        "secondary-container": "#a1f4c8",
                        "on-tertiary-fixed": "#002114",
                        "outline-variant": "#c1c8c2",
                        "surface-variant": "#e5e2e1",
                        "on-primary-fixed": "#002114",
                        "tertiary-container": "#00452e",
                        "surface-container-low": "#f6f3f2",
                        "on-secondary-container": "#1b724f",
                        "on-error": "#ffffff",
                        "surface-bright": "#fcf9f8",
                        "primary-fixed": "#c1ecd4",
                        "on-surface": "#1c1b1b",
                        "surface-container-high": "#eae7e7",
                        "secondary-fixed-dim": "#86d7ad"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-max": "1440px",
                        "margin-mobile": "16px",
                        "margin-desktop": "40px",
                        "base": "8px",
                        "stack-md": "16px",
                        "stack-lg": "32px",
                        "stack-sm": "8px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "body-sm": ["hankenGrotesk", "sans-serif"],
                        "body-lg": ["hankenGrotesk", "sans-serif"],
                        "label-md": ["hankenGrotesk", "sans-serif"],
                        "display-lg": ["manrope", "sans-serif"],
                        "body-md": ["hankenGrotesk", "sans-serif"],
                        "headline-md": ["manrope", "sans-serif"],
                        "numeric-kpi": ["hankenGrotesk", "sans-serif"],
                        "headline-lg": ["manrope", "sans-serif"],
                        "headline-sm": ["manrope", "sans-serif"]
                    },
                    "fontSize": {
                        "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "numeric-kpi": ["28px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&amp;family=Hanken+Grotesk:wght@400;600&amp;display=swap" rel="stylesheet"/>
<style>
        body { font-family: 'Hanken Grotesk', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-manrope { font-family: 'Manrope', sans-serif; }
        .hero-pattern { background-image: radial-gradient(#e5e2e1 1px, transparent 1px); background-size: 24px 24px; }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen flex flex-col antialiased">
<!-- Header Navigation -->
<header class="bg-surface border-b border-outline-variant sticky top-0 z-50">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop h-16 flex justify-between items-center w-full">
<div class="flex items-center gap-3">
<a href="home.php" class="flex items-center gap-3">
    <img src="logo.png" alt="ChasiConnect Logo" class="h-8 w-auto object-contain">
    <span class="font-headline-md text-headline-md font-bold text-primary tracking-tight">ChasiConnect</span>
</a>
</div>
<nav class="hidden md:flex gap-8">
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="#how-it-works">How it Works</a>
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="#roles">Solutions</a>
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="#trust">Trust &amp; Security</a>
</nav>
<div class="flex items-center gap-4">
<?php if ($is_logged_in): ?>
    <a href="<?php echo htmlspecialchars($dashboard_url); ?>" class="bg-primary text-on-primary font-label-md text-label-md px-6 py-2 rounded-lg hover:bg-primary-container transition-colors shadow-sm">My Dashboard</a>
<?php else: ?>
    <a href="login.php" class="font-label-md text-label-md text-primary hover:text-primary-container transition-colors">Login</a>
    <a href="registration.php" class="bg-primary text-on-primary font-label-md text-label-md px-6 py-2 rounded-lg hover:bg-primary-container transition-colors shadow-sm">Register</a>
<?php endif; ?>
</div>
</div>
</header>
<!-- Main Content -->
<main class="flex-grow">
<!-- Hero Section -->
<section class="relative pt-24 pb-32 overflow-hidden hero-pattern">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop relative z-10 flex flex-col items-center text-center">
<h1 class="font-display-lg text-display-lg text-primary max-w-4xl mb-6 leading-tight">Empowering the Future of Agriculture</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mb-10">Connecting farmers, investors, and landowners to create sustainable growth. A premium agricultural platform designed for modern financial ecosystems.</p>
<div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
<a href="registration.php" class="bg-primary text-on-primary font-label-md text-label-md px-8 py-4 rounded-lg hover:bg-primary-container transition-all shadow-[0px_4px_20px_rgba(27,67,50,0.15)] flex items-center justify-center gap-2">
                        Get Started
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</a>
<a href="#roles" class="border-[1.5px] border-primary text-primary font-label-md text-label-md px-8 py-4 rounded-lg hover:bg-surface-container-highest transition-colors flex items-center justify-center gap-2 bg-surface">
                        Explore Platform
</a>
</div>
</div>
<!-- Hero Imagery (Decorative) -->
<div class="mt-20 w-full max-w-6xl mx-auto px-margin-mobile md:px-margin-desktop relative">
<div class="aspect-[21/9] rounded-2xl overflow-hidden shadow-[0px_8px_40px_rgba(27,67,50,0.08)] bg-surface-container relative">
<img class="w-full h-full object-cover" data-alt="A sweeping aerial view of a meticulously organized modern farm at sunrise. The fields are geometric and vibrant green, contrasting with the warm golden hour light. The aesthetic is clean, premium, and structured, reflecting modern agricultural technology and investment potential. Shot in high resolution, wide angle." src="banner.jpg" onerror="this.onerror=null;this.src='https://lh3.googleusercontent.com/aida-public/AB6AXuBYwOPQo9ung3QJxPI7FzPe7JUJiBETVAlez8-kZTIFPTz0dG_ZcVJkpJGaV6I9ONx7m6JObazy3YYiJOgYbrySUd7oSpzDwXE0kRDD6ikN9FkizPCTK7_juiCTxk3sZHWLKtLXyAmqJmY-ogR0PteqMpecTzjCtqmWW_RVVIGABlOcoLHi_G_1JZUTcoMiGrjDth0VPlLmrU2NtVXUu_IplQdCxgJQ6k6uaEA57K9F7c0IJFx8ORk';"/>
<!-- Overlay gradient for depth -->
<div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent"></div>
</div>
</div>
</section>
<!-- Value Proposition / Roles Cards -->
<section class="py-24 bg-surface-container-lowest" id="roles">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
<div class="text-center mb-16">
<h2 class="font-headline-lg text-headline-lg text-primary mb-4">A Unified Agricultural Ecosystem</h2>
<p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mx-auto">Tailored solutions designed to maximize potential for every participant in the agricultural value chain.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Farmer Card -->
<div class="bg-surface rounded-xl p-8 border border-outline-variant shadow-[0px_4px_20px_rgba(27,67,50,0.06)] hover:shadow-[0px_8px_30px_rgba(27,67,50,0.10)] hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group relative overflow-hidden">
<div class="absolute top-0 right-0 w-32 h-32 bg-secondary-container rounded-bl-full opacity-20 -z-10 group-hover:scale-110 transition-transform"></div>
<div class="w-12 h-12 rounded-lg bg-surface-container-high flex items-center justify-center mb-6 text-primary">
<span class="material-symbols-outlined text-[24px]">agriculture</span>
</div>
<h3 class="font-headline-md text-headline-md text-primary mb-2">Farmer</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-grow">Access capital, advanced tools, and premium markets to sustainably grow your agricultural business and scale operations.</p>
<ul class="space-y-3 mb-8">
<li class="flex items-start gap-2 font-body-sm text-body-sm text-on-surface-variant">
<span class="material-symbols-outlined text-secondary text-[16px] mt-0.5">check_circle</span>
                                Direct access to funding
                            </li>
<li class="flex items-start gap-2 font-body-sm text-body-sm text-on-surface-variant">
<span class="material-symbols-outlined text-secondary text-[16px] mt-0.5">check_circle</span>
                                Yield prediction analytics
                            </li>
</ul>
<a href="registration.php" class="w-full text-center font-label-md text-label-md text-primary py-3 border-[1.5px] border-outline-variant rounded-lg hover:border-primary hover:bg-surface-container transition-colors">Grow your business</a>
</div>
<!-- Investor Card -->
<div class="bg-surface rounded-xl p-8 border border-outline-variant shadow-[0px_4px_20px_rgba(27,67,50,0.06)] hover:shadow-[0px_8px_30px_rgba(27,67,50,0.10)] hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group relative overflow-hidden">
<div class="absolute top-0 right-0 w-32 h-32 bg-primary-container rounded-bl-full opacity-10 -z-10 group-hover:scale-110 transition-transform"></div>
<div class="w-12 h-12 rounded-lg bg-surface-container-high flex items-center justify-center mb-6 text-primary">
<span class="material-symbols-outlined text-[24px]">account_balance</span>
</div>
<h3 class="font-headline-md text-headline-md text-primary mb-2">Investor</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-grow">Diversify your portfolio with secure, real-asset agricultural investments offering stable, long-term returns.</p>
<ul class="space-y-3 mb-8">
<li class="flex items-start gap-2 font-body-sm text-body-sm text-on-surface-variant">
<span class="material-symbols-outlined text-secondary text-[16px] mt-0.5">check_circle</span>
                                Vetted agricultural assets
                            </li>
<li class="flex items-start gap-2 font-body-sm text-body-sm text-on-surface-variant">
<span class="material-symbols-outlined text-secondary text-[16px] mt-0.5">check_circle</span>
                                Transparent reporting
                            </li>
</ul>
<a href="registration.php" class="w-full text-center bg-primary text-on-primary font-label-md text-label-md py-3 rounded-lg hover:bg-primary-container transition-colors">Invest in real assets</a>
</div>
<!-- Landowner Card -->
<div class="bg-surface rounded-xl p-8 border border-outline-variant shadow-[0px_4px_20px_rgba(27,67,50,0.06)] hover:shadow-[0px_8px_30px_rgba(27,67,50,0.10)] hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group relative overflow-hidden">
<div class="absolute top-0 right-0 w-32 h-32 bg-tertiary-container rounded-bl-full opacity-10 -z-10 group-hover:scale-110 transition-transform"></div>
<div class="w-12 h-12 rounded-lg bg-surface-container-high flex items-center justify-center mb-6 text-primary">
<span class="material-symbols-outlined text-[24px]">map</span>
</div>
<h3 class="font-headline-md text-headline-md text-primary mb-2">Landowner</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-grow">Unlock the value of your idle land by connecting with verified farmers and investors for sustainable leasing.</p>
<ul class="space-y-3 mb-8">
<li class="flex items-start gap-2 font-body-sm text-body-sm text-on-surface-variant">
<span class="material-symbols-outlined text-secondary text-[16px] mt-0.5">check_circle</span>
                                Secure lease agreements
                            </li>
<li class="flex items-start gap-2 font-body-sm text-body-sm text-on-surface-variant">
<span class="material-symbols-outlined text-secondary text-[16px] mt-0.5">check_circle</span>
                                Sustainable land management
                            </li>
</ul>
<a href="registration.php" class="w-full text-center font-label-md text-label-md text-primary py-3 border-[1.5px] border-outline-variant rounded-lg hover:border-primary hover:bg-surface-container transition-colors">Monetize your land</a>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-surface border-t border-outline-variant py-12">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-6">
<div class="flex items-center gap-2">
<span class="font-headline-sm text-headline-sm font-bold text-primary">ChasiConnect</span>
</div>
<div class="font-body-sm text-body-sm text-on-surface-variant">
                &copy; <?php echo date("Y"); ?> ChasiConnect. All rights reserved.
            </div>
</div>
</footer>
</body>
</html>

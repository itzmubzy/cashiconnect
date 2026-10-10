<?php
require_once __DIR__ . "/controllers/AuthController.php";
$authController = new AuthController();
$authController->handleLogin();
extract($GLOBALS['_auth_login_data']);
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChasiConnect - Login</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Hanken+Grotesk:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .form-input {
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .form-input:focus {
            border-color: #012d1d;
            box-shadow: 0 0 0 2px rgba(1, 45, 29, 0.2);
            outline: none;
        }
        .bg-pattern {
            background-image: radial-gradient(#e5e2e1 1px, transparent 1px);
            background-size: 24px 24px;
        }
</style>
</head>
<body class="bg-surface text-on-surface font-body-md antialiased min-h-screen flex flex-col">
<!-- Auth Layout Container -->
<div class="flex-grow flex flex-col md:flex-row w-full max-w-[container-max] mx-auto min-h-screen relative overflow-hidden">
<!-- Left Side: Branding / Atmospheric (Hidden on Mobile) -->
<div class="hidden md:flex md:w-1/2 bg-primary text-on-primary flex-col justify-between p-12 relative overflow-hidden">
<!-- Decorative background map/pattern overlay -->
<div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: url('banner.jpg'); background-size: cover; background-position: center;"></div>
<div class="relative z-10 flex items-center gap-3">
<a href="home.php" class="flex items-center gap-3 text-on-primary">
    <img src="logo.png" alt="ChasiConnect Logo" class="h-8 w-auto object-contain brightness-0 invert">
    <span class="font-headline-lg text-headline-lg text-on-primary">ChasiConnect</span>
</a>
</div>
<div class="relative z-10 max-w-md mt-24 mb-auto">
<h1 class="font-display-lg text-display-lg text-on-primary mb-6">Premium Agri-Fintech Solutions.</h1>
<p class="font-body-lg text-body-lg text-on-primary/80 mb-stack-lg">Bridging the gap between raw physical farming and the sophisticated data-driven world of modern investments. Secure, structured, and trustworthy.</p>
<!-- Trust Indicators -->
<div class="flex gap-6 mt-12 pt-8 border-t border-on-primary/20">
<div>
<div class="font-numeric-kpi text-numeric-kpi text-secondary-fixed mb-1">৳25M+</div>
<div class="font-label-md text-label-md text-on-primary/70 uppercase">Funding Deployed</div>
</div>
<div>
<div class="font-numeric-kpi text-numeric-kpi text-secondary-fixed mb-1">100%</div>
<div class="font-label-md text-label-md text-on-primary/70 uppercase">Verified Projects</div>
</div>
</div>
</div>
<div class="relative z-10 font-body-sm text-body-sm text-on-primary/60 flex items-center justify-between">
    <span>&copy; <?php echo date("Y"); ?> ChasiConnect. All rights reserved.</span>
    <a href="home.php" class="text-on-primary hover:underline">Back to Home</a>
</div>
</div>

<!-- Right Side: Auth Form -->
<div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-12 lg:p-24 bg-surface bg-pattern relative z-20 overflow-y-auto">
<!-- Mobile Brand Header -->
<div class="absolute top-0 left-0 w-full p-6 flex justify-between items-center md:hidden mb-8">
    <a href="home.php" class="flex items-center gap-2 text-primary">
        <img src="logo.png" alt="ChasiConnect Logo" class="h-7 w-auto object-contain">
        <span class="font-headline-md text-headline-md font-bold">ChasiConnect</span>
    </a>
    <a href="home.php" class="text-xs font-semibold text-primary">Home</a>
</div>

<div class="w-full max-w-md mt-16 md:mt-0 relative">
<!-- Navigation Toggle -->
<div class="bg-surface-container-high rounded-full p-1 flex justify-between items-center mb-8 shadow-sm border border-outline-variant/30">
    <a href="login.php" class="flex-1 text-center py-2 px-6 rounded-full font-label-md text-label-md uppercase tracking-wider bg-surface text-primary shadow-sm">
        Log In
    </a>
    <a href="registration.php" class="flex-1 text-center py-2 px-6 rounded-full font-label-md text-label-md uppercase tracking-wider text-on-surface-variant hover:text-primary transition-all duration-200">
        Register
    </a>
</div>

<!-- LOGIN PANEL -->
<div class="w-full bg-surface-container-lowest p-8 md:p-10 rounded-xl shadow-[0px_4px_20px_rgba(27,67,50,0.06)] border border-outline-variant/20">
    <div class="mb-8">
        <h2 class="font-headline-lg text-headline-lg text-primary mb-2">Welcome Back</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">Securely access your portfolio and farm insights.</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="mb-6 p-4 rounded-lg bg-error-container text-error text-sm flex items-start gap-3 border border-error/20">
            <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5">error</span>
            <div class="font-medium"><?php echo htmlspecialchars($error); ?></div>
        </div>
    <?php endif; ?>

    <form method="POST" class="space-y-6">
        <div>
            <label class="block font-label-md text-label-md text-on-surface mb-2 uppercase" for="username">Username or Email</label>
            <input class="form-input w-full px-4 py-3 bg-surface-container-lowest border-1.5 border-outline-variant rounded-lg font-body-md text-on-surface placeholder-on-surface-variant/50 focus:border-primary focus:ring-0" id="username" name="username" placeholder="Enter your username or email" value="<?php echo htmlspecialchars($username); ?>" required type="text"/>
        </div>
        <div>
            <div class="flex justify-between items-center mb-2">
                <label class="block font-label-md text-label-md text-on-surface uppercase" for="password">Password</label>
            </div>
            <input class="form-input w-full px-4 py-3 bg-surface-container-lowest border-1.5 border-outline-variant rounded-lg font-body-md text-on-surface placeholder-on-surface-variant/50 focus:border-primary focus:ring-0" id="password" name="password" placeholder="••••••••" required type="password"/>
        </div>
        <button class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#1B4332] hover:bg-[#116c4a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B4332] transition-colors font-label-md text-label-md uppercase tracking-wider cursor-pointer" type="submit">
            Log In to Dashboard
        </button>
    </form>

    <div class="mt-8 pt-6 border-t border-outline-variant/60 text-center">
        <p class="font-body-sm text-body-sm text-on-surface-variant">
            Don't have an account?
            <a href="registration.php" class="font-semibold text-secondary hover:text-primary transition-colors">Create one now</a>
        </p>
    </div>
</div>

</div>
</div>
</div>
</body>
</html>
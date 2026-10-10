<?php
session_start();
include("../db.php");

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "farmer") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION["id"];
$username = $_SESSION["username"];
$message = "";
$message_class = "";

$fp_stmt = mysqli_prepare($conn, "SELECT id FROM farmer_profiles WHERE user_id=?");
mysqli_stmt_bind_param($fp_stmt, "i", $user_id);
mysqli_stmt_execute($fp_stmt);
$fp_res = mysqli_stmt_get_result($fp_stmt);
$farmer = mysqli_fetch_assoc($fp_res);
if (!$farmer) {
    die("Farmer profile not found.");
}
$farmer_profile_id = $farmer['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["request_id"], $_POST["action"])) {
    $request_id = intval($_POST["request_id"]);
    $action = $_POST["action"];
    $ver_stmt = mysqli_prepare($conn, "SELECT farmer_id, land_id FROM hiring_requests WHERE id=? AND farmer_id=?");
    mysqli_stmt_bind_param($ver_stmt, "ii", $request_id, $farmer_profile_id);
    mysqli_stmt_execute($ver_stmt);
    $ver_res = mysqli_stmt_get_result($ver_stmt);
    $req = mysqli_fetch_assoc($ver_res);
    if (!$req) {
        $message = "Invalid request or unauthorized action.";
        $message_class = "error-message";
    } else {
        if ($action === "accept") {
            $upd_stmt = mysqli_prepare($conn, "UPDATE hiring_requests SET status='accepted', responded_at=NOW() WHERE id=?");
            mysqli_stmt_bind_param($upd_stmt, "i", $request_id);
            if (mysqli_stmt_execute($upd_stmt)) {
                $land_stmt = mysqli_prepare($conn, "UPDATE lands SET availability_status='unavailable' WHERE id=?");
                mysqli_stmt_bind_param($land_stmt, "i", $req['land_id']);
                mysqli_stmt_execute($land_stmt);
                $_SESSION["action_message"] = "Lease request accepted! You can now create a farming project with this land.";
                $_SESSION["action_message_class"] = "registration-message";
                header("Location: hire-requests.php");
                exit();
            } else {
                $message = "Database error while accepting request.";
                $message_class = "error-message";
            }
        } elseif ($action === "reject") {
            $upd_stmt = mysqli_prepare($conn, "UPDATE hiring_requests SET status='rejected', responded_at=NOW() WHERE id=?");
            mysqli_stmt_bind_param($upd_stmt, "i", $request_id);
            if (mysqli_stmt_execute($upd_stmt)) {
                $_SESSION["action_message"] = "Lease proposal declined.";
                $_SESSION["action_message_class"] = "registration-message";
                header("Location: hire-requests.php");
                exit();
            } else {
                $message = "Database error while rejecting request.";
                $message_class = "error-message";
            }
        }
    }
}

if (isset($_SESSION["action_message"])) {
    $message = $_SESSION["action_message"];
    $message_class = $_SESSION["action_message_class"];
    unset($_SESSION["action_message"], $_SESSION["action_message_class"]);
}

$req_stmt = mysqli_prepare($conn, "SELECT hr.id, hr.message, hr.status, hr.requested_at, hr.lease_amount,
                                          l.title AS land_title, l.area AS land_area, l.area_unit AS land_area_unit, l.location AS land_location,
                                          lo.name AS landowner_name, lo.email AS landowner_email, lo.phone AS landowner_phone
                                   FROM hiring_requests hr
                                   JOIN lands l ON hr.land_id = l.id
                                   JOIN landowner_profiles lop ON hr.landowner_id = lop.id
                                   JOIN users lo ON lop.user_id = lo.id
                                   WHERE hr.farmer_id = ? AND hr.status='pending'
                                   ORDER BY hr.requested_at DESC");
mysqli_stmt_bind_param($req_stmt, "i", $farmer_profile_id);
mysqli_stmt_execute($req_stmt);
$requests_res = mysqli_stmt_get_result($req_stmt);
$requests = [];
while ($row = mysqli_fetch_assoc($requests_res)) {
    $requests[] = $row;
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChasiConnect - Hiring Requests</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600&amp;family=Manrope:wght@600;700&amp;display=swap" rel="stylesheet"/>
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
                }
            }
        }
    </script>
<style>
        body { font-family: 'Hanken Grotesk', sans-serif; background-color: #fcf9f8; }
        h1, h2, h3, h4, h5, h6, .font-headline-lg, .font-headline-md, .font-headline-sm, .font-display-lg { font-family: 'Manrope', sans-serif; }
        .premium-shadow {
            box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06);
        }
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0px 8px 24px rgba(27, 67, 50, 0.10);
        }
</style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col font-body-md text-body-md">
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
        <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md py-1" href="create-project.php">Create Project</a>
        <a class="text-secondary border-b-2 border-secondary pb-1 font-bold font-label-md text-label-md" href="hire-requests.php">Requests</a>
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

<!-- Main Content -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg">
<header class="mb-stack-lg flex flex-col md:flex-row md:items-end justify-between gap-stack-md">
<div>
    <a class="flex items-center text-on-surface-variant hover:text-primary mb-stack-sm transition-colors text-label-md font-label-md" href="farmer-dashboard.php">
        <span class="material-symbols-outlined text-[16px] mr-1">arrow_back</span>
        Back to Dashboard
    </a>
    <h1 class="font-headline-lg text-headline-lg text-primary mb-stack-sm">Incoming Hiring Requests</h1>
    <p class="font-body-md text-body-md text-on-surface-variant">Review and manage pending land lease and farm operation proposals from landowners.</p>
</div>
<div>
    <span class="inline-flex items-center px-4 py-2 bg-surface-container rounded-lg font-label-md text-label-md text-on-surface border border-outline-variant">
        <?php echo count($requests); ?> Pending <?php echo count($requests) === 1 ? 'Request' : 'Requests'; ?>
    </span>
</div>
</header>

<?php if (!empty($message)): ?>
    <div class="mb-6 p-4 rounded-lg <?php echo $message_class === "registration-message" ? "bg-secondary-container text-on-secondary-container border border-secondary/30" : "bg-error-container text-error border border-error/20"; ?> text-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5"><?php echo $message_class === "registration-message" ? "check_circle" : "error"; ?></span>
        <div class="font-medium"><?php echo htmlspecialchars($message); ?></div>
    </div>
<?php endif; ?>

<!-- Requests Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
<?php if (count($requests) > 0): ?>
    <?php foreach ($requests as $req): ?>
        <article class="bg-surface-container-lowest rounded-xl premium-shadow hover-lift p-stack-md flex flex-col gap-stack-md border border-outline-variant/30">
            <div class="flex justify-between items-start border-b border-outline-variant/50 pb-stack-sm">
                <div class="flex items-center gap-stack-md">
                    <div class="w-12 h-12 rounded-full overflow-hidden bg-primary-container text-white flex items-center justify-center font-bold text-lg">
                        <?php echo strtoupper(substr($req['landowner_name'], 0, 2)); ?>
                    </div>
                    <div>
                        <h3 class="font-headline-sm text-headline-sm text-primary"><?php echo htmlspecialchars($req['landowner_name']); ?></h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Landowner &bull; <?php echo htmlspecialchars(date('d M Y', strtotime($req['requested_at']))); ?></p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full bg-secondary-container/50 text-on-secondary-container font-label-md text-label-md border border-secondary-container font-semibold">
                    Pending
                </span>
            </div>

            <div class="grid grid-cols-2 gap-stack-md">
                <div>
                    <span class="block font-label-md text-label-md text-on-surface-variant uppercase mb-1">Land Parcel</span>
                    <p class="font-body-md text-body-md font-semibold text-on-surface"><?php echo htmlspecialchars($req['land_title']); ?></p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1 mt-1">
                        <span class="material-symbols-outlined text-[16px]">landscape</span>
                        <?php echo htmlspecialchars($req['land_area'] . ' ' . $req['land_area_unit']); ?> &bull; <?php echo htmlspecialchars($req['land_location']); ?>
                    </p>
                </div>
                <div>
                    <span class="block font-label-md text-label-md text-on-surface-variant uppercase mb-1">Offered Lease Payment</span>
                    <p class="font-body-md text-body-md font-semibold text-primary">
                        <?php if ($req['lease_amount'] !== null): ?>
                            ৳<?php echo number_format((float)$req['lease_amount'], 2); ?>
                        <?php else: ?>
                            <span class="text-on-surface-variant">Negotiable</span>
                        <?php endif; ?>
                    </p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1 mt-1">
                        <span class="material-symbols-outlined text-[16px]">schedule</span>
                        Sent <?php echo htmlspecialchars(date('h:i A', strtotime($req['requested_at']))); ?>
                    </p>
                </div>
            </div>

            <div class="bg-surface p-stack-sm rounded-lg border border-outline-variant/30">
                <span class="block font-label-md text-label-md text-on-surface-variant uppercase mb-1">Proposal Message</span>
                <p class="font-body-sm text-body-sm text-on-surface leading-relaxed italic">
                    "<?php echo htmlspecialchars($req['message'] ? $req['message'] : 'Landowner has proposed a lease partnership for this land parcel.'); ?>"
                </p>
            </div>

            <div class="mt-auto pt-stack-sm flex gap-stack-sm border-t border-outline-variant/50">
                <form method="POST" class="flex-1" onsubmit="return confirm('Accept this hiring request? This will mark the land as leased to you.');">
                    <input type="hidden" name="request_id" value="<?php echo $req['id']; ?>" />
                    <button type="submit" name="action" value="accept" class="w-full bg-primary-container text-white font-label-md text-label-md py-3 rounded-lg hover:bg-primary transition-colors cursor-pointer flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">check</span> Accept Request
                    </button>
                </form>
                <form method="POST" class="flex-1" onsubmit="return confirm('Decline this proposal?');">
                    <input type="hidden" name="request_id" value="<?php echo $req['id']; ?>" />
                    <button type="submit" name="action" value="reject" class="w-full border-1.5 border-error text-error font-label-md text-label-md py-3 rounded-lg hover:bg-error-container hover:text-on-error-container transition-colors bg-surface-container-lowest cursor-pointer flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">close</span> Decline
                    </button>
                </form>
            </div>
        </article>
    <?php endforeach; ?>
<?php else: ?>
    <div class="col-span-full bg-surface-container-lowest rounded-xl p-12 text-center border border-outline-variant/30 premium-shadow">
        <span class="material-symbols-outlined text-5xl text-outline mb-3 block">inbox</span>
        <h3 class="font-headline-sm text-headline-sm text-primary mb-2">No Pending Hire Requests</h3>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-md mx-auto mb-6">When landowners search for verified farmers and send you lease proposals, they will appear here for your review and approval.</p>
        <a href="farmer-dashboard.php" class="inline-flex items-center gap-2 bg-primary-container text-on-primary px-6 py-2.5 rounded-lg font-label-md text-label-md uppercase hover:bg-primary transition-colors">
            Return to Dashboard
        </a>
    </div>
<?php endif; ?>
</div>
</main>

<!-- Footer -->
<footer class="w-full py-stack-lg px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-base bg-surface-container border-t border-outline-variant mt-auto">
    <div class="flex items-center gap-stack-sm">
        <span class="font-headline-sm text-headline-sm text-primary font-bold">ChasiConnect</span>
        <span class="font-body-sm text-body-sm text-on-surface-variant ml-2">&copy; <?php echo date("Y"); ?> ChasiConnect Agricultural Management. All rights reserved.</span>
    </div>
    <div class="flex gap-gutter text-xs text-on-surface-variant">
        <a class="hover:underline transition-opacity duration-200" href="#">Support</a>
        <a class="hover:underline transition-opacity duration-200" href="#">Privacy Policy</a>
        <a class="hover:underline transition-opacity duration-200" href="#">Terms of Service</a>
    </div>
</footer>
</body>
</html>

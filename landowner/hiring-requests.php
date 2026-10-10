<?php

session_start();
include("../db.php");

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "landowner")
{
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION["id"];
$username = $_SESSION["username"];

$stmt = mysqli_prepare($conn, "SELECT id FROM landowner_profiles WHERE user_id=?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$landowner = mysqli_fetch_assoc($res);

if (!$landowner) {
    die("Landowner profile not found.");
}

$landowner_id = $landowner['id'];

$query_str = "
    SELECT hr.id, hr.message, hr.status, hr.requested_at, hr.lease_amount, l.title as land_title, u.name as farmer_name
    FROM hiring_requests hr
    JOIN lands l ON hr.land_id = l.id
    JOIN farmer_profiles fp ON hr.farmer_id = fp.id
    JOIN users u ON fp.user_id = u.id
    WHERE hr.landowner_id = ?
    ORDER BY hr.requested_at DESC
";
$req_stmt = mysqli_prepare($conn, $query_str);
mysqli_stmt_bind_param($req_stmt, "i", $landowner_id);
mysqli_stmt_execute($req_stmt);
$requests_res = mysqli_stmt_get_result($req_stmt);

$all_requests = [];
while ($row = mysqli_fetch_assoc($requests_res)) {
    $all_requests[] = $row;
}

$total = count($all_requests);
$pending = count(array_filter($all_requests, fn($r) => $r['status'] === 'pending'));
$accepted = count(array_filter($all_requests, fn($r) => $r['status'] === 'accepted'));
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Hiring Requests - ChasiConnect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Hanken+Grotesk:wght@400;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      "colors": {
        "inverse-on-surface": "#f3f0ef",
        "primary-container": "#1b4332",
        "tertiary-fixed-dim": "#95d4b3",
        "outline-variant": "#c1c8c2",
        "secondary-fixed": "#a1f4c8",
        "surface-container-lowest": "#ffffff",
        "surface": "#fcf9f8",
        "error-container": "#ffdad6",
        "primary-fixed-dim": "#a5d0b9",
        "on-secondary-container": "#1b724f",
        "surface-container-low": "#f6f3f2",
        "surface-variant": "#e5e2e1",
        "surface-dim": "#dcd9d9",
        "on-error-container": "#93000a",
        "on-background": "#1c1b1b",
        "on-secondary": "#ffffff",
        "surface-container-high": "#eae7e7",
        "primary-fixed": "#c1ecd4",
        "on-error": "#ffffff",
        "background": "#fcf9f8",
        "primary": "#012d1d",
        "on-tertiary": "#ffffff",
        "error": "#ba1a1a",
        "surface-container-highest": "#e5e2e1",
        "secondary-container": "#a1f4c8",
        "on-surface": "#1c1b1b",
        "inverse-primary": "#a5d0b9",
        "on-surface-variant": "#414844",
        "on-primary": "#ffffff",
        "inverse-surface": "#313030",
        "tertiary": "#002d1c",
        "surface-container": "#f0eded",
        "secondary": "#116c4a",
        "secondary-fixed-dim": "#86d7ad",
        "on-primary-container": "#86af99",
        "surface-bright": "#fcf9f8",
        "outline": "#717973",
      },
      "spacing": {
        "margin-desktop": "40px",
        "margin-mobile": "16px",
        "container-max": "1440px",
        "stack-md": "16px",
        "stack-lg": "32px",
        "stack-sm": "8px",
        "gutter": "24px"
      },
      "fontFamily": {
        "headline-md": ["Manrope", "sans-serif"],
        "body-md": ["Hanken Grotesk", "sans-serif"],
        "headline-sm": ["Manrope", "sans-serif"],
        "body-sm": ["Hanken Grotesk", "sans-serif"],
        "numeric-kpi": ["Hanken Grotesk", "sans-serif"],
        "label-md": ["Hanken Grotesk", "sans-serif"],
        "headline-lg": ["Manrope", "sans-serif"]
      },
      "fontSize": {
        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
        "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
        "numeric-kpi": ["28px", { "lineHeight": "32px", "fontWeight": "600" }],
        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }]
      }
    },
  },
}
</script>
<style>
body { font-family: 'Hanken Grotesk', sans-serif; }
h1,h2,h3,h4,h5,h6 { font-family: 'Manrope', sans-serif; }
.card-shadow { box-shadow: 0px 4px 20px rgba(27, 67, 50, 0.06); }
.card-shadow:hover { box-shadow: 0px 6px 24px rgba(27, 67, 50, 0.10); }
</style>
</head>
<body class="bg-background text-on-surface font-body-md antialiased min-h-screen flex flex-col">

<!-- TopNavBar -->
<nav class="bg-surface border-b border-outline-variant sticky top-0 z-50 flex justify-between items-center px-margin-mobile md:px-margin-desktop w-full max-w-container-max mx-auto h-16">
  <div class="flex items-center gap-6">
    <a href="landowner-dashboard.php" class="flex items-center gap-3">
      <div class="flex items-center justify-center w-9 h-9 bg-primary-container rounded-lg">
        <span class="material-symbols-outlined text-on-primary text-xl" style="font-variation-settings:'FILL' 1;">landscape</span>
      </div>
      <span class="text-headline-md font-bold text-primary" style="font-family:Manrope,sans-serif;">ChasiConnect</span>
    </a>
    <div class="hidden md:flex gap-4 ml-4">
      <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="landowner-dashboard.php">Dashboard</a>
      <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="manage-land.php">My Land</a>
      <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="farmer-list.php">Find Farmer</a>
      <a class="text-primary font-bold border-b-2 border-primary pb-1" href="hiring-requests.php">Requests</a>
    </div>
  </div>
  <div class="flex items-center gap-4">
    <a href="farmer-list.php" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium bg-primary-container text-on-primary px-4 py-2 rounded-lg hover:bg-primary transition-colors">
      <span class="material-symbols-outlined text-[16px]">add</span>New Proposal
    </a>
    <a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors flex items-center gap-1 text-sm font-medium">
      <span class="material-symbols-outlined text-lg">logout</span>
      <span class="hidden sm:inline">Logout</span>
    </a>
  </div>
</nav>

<!-- Main -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg flex flex-col gap-stack-lg">

  <!-- Page Header -->
  <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
      <h1 class="text-headline-lg text-primary mb-1" style="font-family:Manrope,sans-serif;">Outgoing Hiring Proposals</h1>
      <p class="text-body-md text-on-surface-variant">Track the status of every lease offer you've sent to verified farmers.</p>
    </div>
  </header>

  <!-- Summary KPI Row -->
  <div class="grid grid-cols-3 gap-gutter">
    <div class="bg-surface-container-lowest rounded-xl p-5 card-shadow border border-outline-variant/40 text-center">
      <p class="text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Total Sent</p>
      <p class="text-numeric-kpi text-primary font-bold"><?php echo $total; ?></p>
    </div>
    <div class="bg-surface-container-lowest rounded-xl p-5 card-shadow border border-outline-variant/40 text-center">
      <p class="text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Pending</p>
      <p class="text-numeric-kpi text-[#B45309] font-bold"><?php echo $pending; ?></p>
    </div>
    <div class="bg-surface-container-lowest rounded-xl p-5 card-shadow border border-outline-variant/40 text-center">
      <p class="text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Accepted</p>
      <p class="text-numeric-kpi text-secondary font-bold"><?php echo $accepted; ?></p>
    </div>
  </div>

  <!-- Request Cards -->
  <?php if (count($all_requests) > 0): ?>
    <div class="flex flex-col gap-4">
    <?php foreach ($all_requests as $req): ?>
      <?php
        $status = $req['status'];
        $status_classes = [
          'pending'   => 'bg-yellow-100 text-yellow-700 border-yellow-200',
          'accepted'  => 'bg-secondary-container text-on-secondary-container border-secondary-fixed',
          'rejected'  => 'bg-error-container text-on-error-container border-red-200',
          'completed' => 'bg-sky-100 text-sky-700 border-sky-200',
        ];
        $chip = $status_classes[$status] ?? 'bg-surface-variant text-on-surface-variant border-outline-variant';
        $icon_map = [
          'pending'   => 'schedule',
          'accepted'  => 'check_circle',
          'rejected'  => 'cancel',
          'completed' => 'task_alt',
        ];
        $icon = $icon_map[$status] ?? 'info';
      ?>
      <div class="bg-surface-container-lowest rounded-xl card-shadow border border-outline-variant/40 transition-all duration-200 overflow-hidden">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 p-5">
          <!-- Left: Proposal Info -->
          <div class="flex-grow">
            <div class="flex items-center gap-3 mb-2 flex-wrap">
              <h3 class="text-headline-sm text-primary font-bold" style="font-family:Manrope,sans-serif;"><?php echo htmlspecialchars($req['land_title']); ?></h3>
              <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full border font-bold text-xs <?php echo $chip; ?>">
                <span class="material-symbols-outlined text-[14px]"><?php echo $icon; ?></span>
                <?php echo ucfirst($status); ?>
              </span>
            </div>

            <div class="flex flex-wrap gap-4 text-body-sm text-on-surface-variant mb-3">
              <span class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">person</span>
                <strong class="text-on-surface"><?php echo htmlspecialchars($req['farmer_name']); ?></strong>
              </span>
              <span class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">payments</span>
                Lease: <strong class="text-primary ml-1">৳<?php echo number_format((float)$req['lease_amount'], 2); ?></strong>
              </span>
              <span class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                <?php echo htmlspecialchars(date("d M Y, h:i A", strtotime($req['requested_at']))); ?>
              </span>
            </div>

            <?php if (!empty($req['message'])): ?>
              <div class="bg-surface-container-low border border-outline-variant/40 rounded-lg px-4 py-3 italic text-on-surface-variant text-body-sm">
                "<?php echo htmlspecialchars($req['message']); ?>"
              </div>
            <?php endif; ?>
          </div>

          <!-- Right: Action hint (read-only for landowner) -->
          <div class="shrink-0 text-right text-xs text-on-surface-variant">
            <p class="font-label-md text-label-md uppercase text-on-surface-variant">Farmer decides</p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>

  <?php else: ?>
    <div class="bg-surface-container-lowest rounded-xl p-12 text-center border border-outline-variant/40 text-on-surface-variant card-shadow">
      <span class="material-symbols-outlined text-5xl text-outline mb-3 block">inbox</span>
      <p class="text-body-md font-medium mb-4">No hiring proposals sent yet.</p>
      <a href="farmer-list.php" class="inline-flex items-center gap-2 bg-primary-container text-on-primary px-6 py-2.5 rounded-lg font-label-md text-label-md uppercase hover:bg-primary transition-colors shadow-sm">
        <span class="material-symbols-outlined text-[18px]">search</span>
        Browse Farmers
      </a>
    </div>
  <?php endif; ?>

</main>

<!-- Footer -->
<footer class="bg-surface-container-lowest border-t border-outline-variant w-full py-6 px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-on-surface-variant mt-auto">
  <span class="font-bold text-primary" style="font-family:Manrope,sans-serif;">ChasiConnect</span>
  <span>&copy; <?php echo date("Y"); ?> ChasiConnect Agricultural Fintech. All rights reserved.</span>
  <div class="flex gap-4">
    <a class="hover:text-primary transition-colors" href="#">Terms</a>
    <a class="hover:text-primary transition-colors" href="#">Privacy</a>
  </div>
</footer>
</body>
</html>

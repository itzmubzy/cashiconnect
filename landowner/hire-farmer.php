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
$message = "";
$message_type = "";

$stmt = mysqli_prepare($conn, "SELECT id FROM landowner_profiles WHERE user_id=?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$landowner = mysqli_fetch_assoc($res);

if (!$landowner) {
    die("Landowner profile not found.");
}

$landowner_id = $landowner['id'];

$farmer_profile_id = isset($_GET["farmer_id"]) ? intval($_GET["farmer_id"]) : 0;
$farmer_stmt = mysqli_prepare($conn, "
    SELECT u.name, fp.specialization, fp.experience_years, fp.rating, fp.bio, fp.profile_image
    FROM users u
    JOIN farmer_profiles fp ON u.id = fp.user_id
    WHERE fp.id=? AND fp.verification_status='approved'
");
mysqli_stmt_bind_param($farmer_stmt, "i", $farmer_profile_id);
mysqli_stmt_execute($farmer_stmt);
$farmer_res = mysqli_stmt_get_result($farmer_stmt);
$farmer = mysqli_fetch_assoc($farmer_res);

if (!$farmer) {
    die("Invalid or unverified farmer selected.");
}

$lands_stmt = mysqli_prepare($conn, "SELECT id, title, area, area_unit, location FROM lands WHERE landowner_id=? AND availability_status='available'");
mysqli_stmt_bind_param($lands_stmt, "i", $landowner_id);
mysqli_stmt_execute($lands_stmt);
$lands_res = mysqli_stmt_get_result($lands_stmt);
$available_lands = [];
while ($l = mysqli_fetch_assoc($lands_res)) {
    $available_lands[] = $l;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $land_id = isset($_POST["land_id"]) ? intval($_POST["land_id"]) : 0;
    $hire_message = trim($_POST["message"]);
    $lease_raw = trim($_POST["lease_amount"] ?? "");

    if ($land_id <= 0) {
        $message = "Please select a land to offer.";
        $message_type = "error";
    } elseif ($lease_raw === "" || !is_numeric($lease_raw)) {
        $message = "Please enter a valid lease amount.";
        $message_type = "error";
    } else {
        $lease_amount = round((float)$lease_raw, 2);
        if ($lease_amount <= 0) {
            $message = "Lease amount must be greater than zero.";
            $message_type = "error";
        } else {
            $validate_stmt = mysqli_prepare($conn, "SELECT id FROM lands WHERE id=? AND landowner_id=? AND availability_status='available'");
            mysqli_stmt_bind_param($validate_stmt, "ii", $land_id, $landowner_id);
            mysqli_stmt_execute($validate_stmt);
            $validate_res = mysqli_stmt_get_result($validate_stmt);

            if (mysqli_num_rows($validate_res) > 0) {
                $ins_stmt = mysqli_prepare($conn, "INSERT INTO hiring_requests (landowner_id, farmer_id, land_id, message, lease_amount, status) VALUES (?, ?, ?, ?, ?, 'pending')");
                mysqli_stmt_bind_param($ins_stmt, "iiisd", $landowner_id, $farmer_profile_id, $land_id, $hire_message, $lease_amount);

                if (mysqli_stmt_execute($ins_stmt)) {
                    $message = "Proposal sent successfully! The farmer will review and respond shortly.";
                    $message_type = "success";
                } else {
                    $message = "Database error: Failed to send hiring request.";
                    $message_type = "error";
                }
            } else {
                $message = "Invalid land selection or the land is no longer available.";
                $message_type = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Send Hire Proposal - ChasiConnect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Hanken+Grotesk:wght@400;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      "colors": {
        "primary-container": "#1b4332",
        "outline-variant": "#c1c8c2",
        "secondary-fixed": "#a1f4c8",
        "surface-container-lowest": "#ffffff",
        "surface": "#fcf9f8",
        "error-container": "#ffdad6",
        "on-secondary-container": "#1b724f",
        "surface-container-low": "#f6f3f2",
        "surface-variant": "#e5e2e1",
        "on-background": "#1c1b1b",
        "on-secondary": "#ffffff",
        "surface-container-high": "#eae7e7",
        "on-error": "#ffffff",
        "background": "#fcf9f8",
        "primary": "#012d1d",
        "error": "#ba1a1a",
        "secondary-container": "#a1f4c8",
        "on-surface": "#1c1b1b",
        "on-surface-variant": "#414844",
        "on-primary": "#ffffff",
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
        "label-md": ["Hanken Grotesk", "sans-serif"],
        "headline-lg": ["Manrope", "sans-serif"]
      },
      "fontSize": {
        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
        "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
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
.card-shadow { box-shadow: 0px 4px 24px rgba(27, 67, 50, 0.07); }
.premium-input:focus { border-color: #012d1d; box-shadow: 0 0 0 2px rgba(1, 45, 29, 0.15); outline: none; }
.bg-pattern { background: linear-gradient(135deg, #1B4332 0%, #012D1D 100%); }
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
      <a class="text-primary font-bold border-b-2 border-primary pb-1" href="farmer-list.php">Find Farmer</a>
      <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="hiring-requests.php">Requests</a>
    </div>
  </div>
  <div class="flex items-center gap-4">
    <a href="../logout.php" class="text-on-surface-variant hover:text-error transition-colors flex items-center gap-1 text-sm font-medium">
      <span class="material-symbols-outlined text-lg">logout</span>
      <span class="hidden sm:inline">Logout</span>
    </a>
  </div>
</nav>

<!-- Main Content -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg flex flex-col gap-stack-lg">
  <!-- Back Link -->
  <a class="inline-flex items-center text-on-surface-variant hover:text-primary transition-colors text-body-sm group" href="farmer-list.php">
    <span class="material-symbols-outlined text-[18px] mr-2 group-hover:-translate-x-1 transition-transform">arrow_back</span>
    Back to Farmer Directory
  </a>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter items-start">
    <!-- Farmer Profile Panel -->
    <div class="lg:col-span-1 bg-surface-container-lowest rounded-xl card-shadow border border-outline-variant/40 overflow-hidden">
      <!-- Header Gradient -->
      <div class="h-28 bg-pattern relative flex items-end justify-center">
        <div class="absolute -bottom-10 w-20 h-20 rounded-full border-4 border-surface-container-lowest bg-primary-container text-white flex items-center justify-center font-bold text-2xl overflow-hidden shadow-md">
          <?php if (!empty($farmer['profile_image']) && file_exists("../" . $farmer['profile_image'])): ?>
            <img alt="<?php echo htmlspecialchars($farmer['name']); ?>" class="w-full h-full object-cover" src="../<?php echo htmlspecialchars($farmer['profile_image']); ?>"/>
          <?php else: ?>
            <?php echo strtoupper(substr($farmer['name'], 0, 2)); ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="pt-14 pb-6 px-6 text-center">
        <h2 class="text-headline-sm text-primary font-bold mb-0.5" style="font-family:Manrope,sans-serif;"><?php echo htmlspecialchars($farmer['name']); ?></h2>
        <span class="inline-flex items-center gap-1 px-3 py-0.5 rounded-full bg-secondary-container text-on-secondary-container text-xs font-bold mb-4">
          <span class="material-symbols-outlined text-[13px]">verified</span>Verified Farmer
        </span>

        <div class="grid grid-cols-2 gap-2 text-center mt-3">
          <div class="bg-surface-container-low p-3 rounded-lg">
            <p class="text-label-md text-on-surface-variant uppercase text-[10px] mb-0.5">Specialization</p>
            <p class="text-body-sm font-bold text-on-surface text-xs"><?php echo htmlspecialchars($farmer['specialization'] ? $farmer['specialization'] : 'General'); ?></p>
          </div>
          <div class="bg-surface-container-low p-3 rounded-lg">
            <p class="text-label-md text-on-surface-variant uppercase text-[10px] mb-0.5">Experience</p>
            <p class="text-body-sm font-bold text-on-surface text-xs"><?php echo (int)$farmer['experience_years']; ?> Years</p>
          </div>
          <div class="col-span-2 bg-surface-container-low p-3 rounded-lg">
            <p class="text-label-md text-on-surface-variant uppercase text-[10px] mb-0.5">Rating</p>
            <p class="text-body-sm font-bold text-secondary text-sm">★ <?php echo number_format((float)$farmer['rating'], 1); ?> / 5.0</p>
          </div>
        </div>

        <?php if (!empty($farmer['bio'])): ?>
          <p class="text-body-sm text-on-surface-variant italic mt-4 text-xs leading-relaxed">
            "<?php echo htmlspecialchars($farmer['bio']); ?>"
          </p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Proposal Form Panel -->
    <div class="lg:col-span-2 bg-surface-container-lowest rounded-xl card-shadow border border-outline-variant/40 overflow-hidden">
      <div class="p-6 border-b border-outline-variant/30 bg-surface">
        <h1 class="text-headline-lg text-primary mb-1" style="font-family:Manrope,sans-serif;">Send Hire Proposal</h1>
        <p class="text-body-md text-on-surface-variant">Proposing to: <strong class="text-primary"><?php echo htmlspecialchars($farmer['name']); ?></strong></p>
      </div>

      <!-- Flash Message -->
      <?php if (!empty($message)): ?>
        <div class="mx-6 mt-5 p-4 rounded-lg border flex items-start gap-3 text-sm <?php echo $message_type === 'success' ? 'bg-secondary-container/40 text-secondary border-secondary/30' : 'bg-error-container text-on-error-container border-red-300'; ?>">
          <span class="material-symbols-outlined text-[20px] shrink-0"><?php echo $message_type === 'success' ? 'check_circle' : 'error'; ?></span>
          <div class="font-medium"><?php echo htmlspecialchars($message); ?></div>
        </div>
      <?php endif; ?>

      <form method="POST" class="p-6 flex flex-col gap-stack-md">
        <!-- Select Land -->
        <div class="space-y-2">
          <label class="block text-label-md text-on-surface uppercase" for="land_id">Select Land to Offer *</label>
          <?php if (count($available_lands) > 0): ?>
            <select id="land_id" name="land_id" required class="w-full rounded-lg bg-surface border border-outline-variant px-4 py-3 text-body-md text-on-surface premium-input transition-all">
              <option value="">— Choose available land —</option>
              <?php foreach ($available_lands as $land): ?>
                <option value="<?php echo $land['id']; ?>">
                  <?php echo htmlspecialchars($land['title']); ?> — <?php echo htmlspecialchars($land['area'] . ' ' . $land['area_unit']); ?> (<?php echo htmlspecialchars($land['location']); ?>)
                </option>
              <?php endforeach; ?>
            </select>
          <?php else: ?>
            <div class="w-full rounded-lg bg-surface-container-low border border-outline-variant px-4 py-3 text-body-sm text-on-surface-variant italic">
              No available lands found. <a href="add-land.php" class="text-secondary underline font-semibold">Add a land parcel</a> first.
            </div>
          <?php endif; ?>
        </div>

        <!-- Lease Amount -->
        <div class="space-y-2">
          <label class="block text-label-md text-on-surface uppercase" for="lease_amount">Lease Amount (৳) *</label>
          <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-primary text-lg">৳</span>
            <input id="lease_amount" name="lease_amount" type="number" min="0.01" step="0.01" placeholder="e.g. 20000" required
                   class="w-full rounded-lg bg-surface border border-outline-variant pl-9 pr-4 py-3 text-body-md text-on-surface placeholder:text-outline premium-input transition-all"/>
          </div>
          <p class="text-body-sm text-on-surface-variant text-xs mt-1">This is the land lease payment offered. It will be processed when the project gets fully funded.</p>
        </div>

        <!-- Proposal Message -->
        <div class="space-y-2">
          <label class="block text-label-md text-on-surface uppercase" for="message">Proposal Message</label>
          <textarea id="message" name="message" rows="4" placeholder="Describe the crops you'd like to grow, preferred lease terms, irrigation access, and any other requirements..."
                    class="w-full rounded-lg bg-surface border border-outline-variant px-4 py-3 text-body-md text-on-surface placeholder:text-outline premium-input transition-all resize-y"></textarea>
        </div>

        <!-- Actions -->
        <div class="flex flex-col-reverse sm:flex-row justify-end gap-4 pt-4 border-t border-outline-variant/30">
          <a href="farmer-list.php" class="px-6 py-3 rounded-lg border-[1.5px] border-outline-variant text-on-surface-variant text-label-md uppercase hover:bg-surface-container-low transition-colors text-center">
            Cancel
          </a>
          <?php if (count($available_lands) > 0): ?>
            <button type="submit" class="px-8 py-3 rounded-lg bg-primary-container text-on-primary text-label-md uppercase hover:bg-primary transition-all shadow-md cursor-pointer flex items-center justify-center gap-2">
              <span class="material-symbols-outlined text-[18px]">send</span>
              Send Proposal
            </button>
          <?php else: ?>
            <a href="add-land.php" class="px-8 py-3 rounded-lg bg-primary-container text-on-primary text-label-md uppercase hover:bg-primary transition-all shadow-md flex items-center justify-center gap-2">
              <span class="material-symbols-outlined text-[18px]">add</span>
              Add a Land First
            </a>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>
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

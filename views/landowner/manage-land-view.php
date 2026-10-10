<?php
extract($GLOBALS['_landowner_manage_land_data']);
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Manage My Land - ChasiConnect</title>
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
        "outline-variant": "#c1c8c2",
        "secondary-fixed": "#a1f4c8",
        "surface-container-lowest": "#ffffff",
        "surface": "#fcf9f8",
        "error-container": "#ffdad6",
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
.premium-input:focus { border-color: #012d1d; box-shadow: 0 0 0 2px rgba(1, 45, 29, 0.15); outline: none; }
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
      <a class="text-primary font-bold border-b-2 border-primary pb-1" href="manage-land.php">My Land</a>
      <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="farmer-list.php">Find Farmer</a>
      <a class="text-on-surface-variant hover:text-primary transition-colors py-1" href="hiring-requests.php">Requests</a>
    </div>
  </div>
  <div class="flex items-center gap-4">
    <a href="add-land.php" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium bg-primary-container text-on-primary px-4 py-2 rounded-lg hover:bg-primary transition-colors">
      <span class="material-symbols-outlined text-[16px]">add</span>Add Land
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
      <h1 class="text-headline-lg text-primary mb-1" style="font-family:Manrope,sans-serif;">Manage My Land</h1>
      <p class="text-body-md text-on-surface-variant">View, edit, or remove your registered land parcels.</p>
    </div>
    <a href="add-land.php" class="inline-flex items-center gap-2 bg-primary-container text-on-primary px-5 py-2.5 rounded-lg font-label-md text-label-md uppercase tracking-wider hover:bg-primary transition-colors shadow-sm">
      <span class="material-symbols-outlined text-[18px]">add</span>
      Add New Land
    </a>
  </header>

  <!-- Flash Message -->
  <?php if (!empty($message)): ?>
    <div class="p-4 rounded-lg border flex items-start gap-3 text-sm <?php echo $message_type === 'success' ? 'bg-secondary-container/40 text-secondary border-secondary/30' : 'bg-error-container text-on-error-container border-red-300'; ?>">
      <span class="material-symbols-outlined text-[20px] shrink-0"><?php echo $message_type === 'success' ? 'check_circle' : 'error'; ?></span>
      <span class="font-medium"><?php echo htmlspecialchars($message); ?></span>
    </div>
  <?php endif; ?>

  <!-- KPI Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-gutter">
    <div class="bg-surface-container-lowest rounded-xl card-shadow border border-outline-variant/40 p-5 flex items-center gap-4">
      <div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center text-primary">
        <span class="material-symbols-outlined text-2xl" style="font-variation-settings:'FILL' 1;">landscape</span>
      </div>
      <div>
        <p class="text-label-md text-on-surface-variant uppercase tracking-wider">Total Parcels</p>
        <p class="text-numeric-kpi text-primary font-bold"><?php echo $total_parcels; ?></p>
      </div>
    </div>
    <div class="bg-surface-container-lowest rounded-xl card-shadow border border-outline-variant/40 p-5 flex items-center gap-4">
      <div class="w-12 h-12 rounded-full bg-secondary-container/40 flex items-center justify-center text-secondary">
        <span class="material-symbols-outlined text-2xl" style="font-variation-settings:'FILL' 1;">straighten</span>
      </div>
      <div>
        <p class="text-label-md text-on-surface-variant uppercase tracking-wider">Total Area</p>
        <p class="text-numeric-kpi text-secondary font-bold"><?php echo number_format($total_area, 1); ?> <span class="text-base font-normal text-on-surface-variant">units</span></p>
      </div>
    </div>
    <div class="bg-surface-container-lowest rounded-xl card-shadow border border-outline-variant/40 p-5 flex items-center gap-4">
      <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-700">
        <span class="material-symbols-outlined text-2xl" style="font-variation-settings:'FILL' 1;">handshake</span>
      </div>
      <div>
        <p class="text-label-md text-on-surface-variant uppercase tracking-wider">Active Leases</p>
        <p class="text-numeric-kpi text-yellow-700 font-bold"><?php echo $active_leases; ?></p>
      </div>
    </div>
  </div>

  <!-- Lands Table -->
  <div class="bg-surface-container-lowest rounded-xl card-shadow border border-outline-variant/40 overflow-hidden">
    <div class="p-5 border-b border-outline-variant/30 flex justify-between items-center">
      <h2 class="text-headline-sm text-primary" style="font-family:Manrope,sans-serif;">Your Land Parcels</h2>
      <span class="text-label-md text-on-surface-variant"><?php echo $total_parcels; ?> parcel<?php echo $total_parcels !== 1 ? 's' : ''; ?></span>
    </div>

    <?php if (count($all_lands) > 0): ?>
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse min-w-[700px]">
        <thead>
          <tr class="bg-surface-container-low border-b border-outline-variant text-label-md text-on-surface-variant uppercase tracking-wider">
            <th class="px-5 py-3.5">Title</th>
            <th class="px-5 py-3.5">Location</th>
            <th class="px-5 py-3.5">Area</th>
            <th class="px-5 py-3.5">Soil Type</th>
            <th class="px-5 py-3.5">Status</th>
            <th class="px-5 py-3.5 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-outline-variant/30 text-body-sm text-on-surface">
          <?php foreach ($all_lands as $land): ?>
            <?php
              $avail = $land['availability_status'];
              $status_chip = match($avail) {
                'available'   => 'bg-secondary-container text-on-secondary-container',
                'leased'      => 'bg-yellow-100 text-yellow-700',
                'unavailable' => 'bg-surface-variant text-on-surface-variant',
                default       => 'bg-surface-container-high text-on-surface-variant'
              };
            ?>
            <tr class="hover:bg-surface-bright transition-colors group">
              <td class="px-5 py-4 font-semibold text-primary"><?php echo htmlspecialchars($land['title']); ?></td>
              <td class="px-5 py-4 text-on-surface-variant flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[14px]">location_on</span>
                <?php echo htmlspecialchars($land['location']); ?>
              </td>
              <td class="px-5 py-4"><?php echo htmlspecialchars($land['area'] . ' ' . $land['area_unit']); ?></td>
              <td class="px-5 py-4 text-on-surface-variant"><?php echo htmlspecialchars($land['soil_type'] ? $land['soil_type'] : '—'); ?></td>
              <td class="px-5 py-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold <?php echo $status_chip; ?>">
                  <?php echo ucfirst(htmlspecialchars($avail)); ?>
                </span>
              </td>
              <td class="px-5 py-4 text-right">
                <div class="flex justify-end items-center gap-2">
                  <a href="manage-land.php?action=edit&id=<?php echo $land['id']; ?>" class="inline-flex items-center gap-1 px-3 py-1.5 border border-outline-variant rounded-lg text-on-surface hover:bg-surface-container-low transition-colors text-xs font-semibold">
                    <span class="material-symbols-outlined text-[14px]">edit</span>Edit
                  </a>
                  <form method="POST" onsubmit="return confirm('Are you sure you want to delete this land listing? This cannot be undone.');" class="inline">
                    <input type="hidden" name="delete_land_id" value="<?php echo $land['id']; ?>">
                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 border border-error/30 rounded-lg text-error hover:bg-error-container transition-colors text-xs font-semibold cursor-pointer">
                      <span class="material-symbols-outlined text-[14px]">delete</span>Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
    <div class="p-12 text-center text-on-surface-variant">
      <span class="material-symbols-outlined text-5xl text-outline mb-3 block">add_location_alt</span>
      <p class="text-body-md font-medium mb-4">No land parcels registered yet.</p>
      <a href="add-land.php" class="inline-flex items-center gap-2 bg-primary-container text-on-primary px-6 py-2.5 rounded-lg font-label-md text-label-md uppercase hover:bg-primary transition-colors shadow-sm">
        <span class="material-symbols-outlined text-[18px]">add</span>List Your First Land
      </a>
    </div>
    <?php endif; ?>
  </div>

  <!-- Edit Form Section -->
  <?php if ($edit_land): ?>
  <div class="bg-surface-container-lowest rounded-xl card-shadow border border-outline-variant/40 overflow-hidden">
    <div class="p-5 bg-surface border-b border-outline-variant/30">
      <h2 class="text-headline-sm text-primary" style="font-family:Manrope,sans-serif;">
        Editing: <?php echo htmlspecialchars($edit_land['title']); ?>
      </h2>
      <p class="text-body-sm text-on-surface-variant mt-0.5">Update the details for this land parcel.</p>
    </div>
    <form method="POST" enctype="multipart/form-data" class="p-stack-lg grid grid-cols-1 md:grid-cols-2 gap-x-gutter gap-y-stack-md">
      <input type="hidden" name="land_id" value="<?php echo $edit_land['id']; ?>">

      <!-- Land Title + Status -->
      <div class="col-span-1 md:col-span-2 flex flex-col md:flex-row gap-gutter">
        <div class="flex-[3] space-y-2">
          <label class="block text-label-md text-on-surface uppercase" for="edit_title">Land Title *</label>
          <input class="w-full rounded-lg bg-surface border border-outline-variant px-4 py-3 text-body-md text-on-surface placeholder:text-outline premium-input transition-all" id="edit_title" name="title" type="text" value="<?php echo htmlspecialchars($edit_land['title']); ?>" required/>
        </div>
        <div class="flex-1 space-y-2">
          <label class="block text-label-md text-on-surface uppercase" for="edit_status">Status *</label>
          <select class="w-full rounded-lg bg-surface border border-outline-variant px-4 py-3 text-body-md text-on-surface premium-input transition-all" id="edit_status" name="availability_status" required>
            <option value="available" <?php if ($edit_land['availability_status'] === 'available') echo 'selected'; ?>>Available</option>
            <option value="leased" <?php if ($edit_land['availability_status'] === 'leased') echo 'selected'; ?>>Leased</option>
            <option value="unavailable" <?php if ($edit_land['availability_status'] === 'unavailable') echo 'selected'; ?>>Unavailable</option>
          </select>
        </div>
      </div>

      <!-- Location -->
      <div class="col-span-1 md:col-span-2 space-y-2">
        <label class="block text-label-md text-on-surface uppercase" for="edit_location">Location *</label>
        <input class="w-full rounded-lg bg-surface border border-outline-variant px-4 py-3 text-body-md text-on-surface placeholder:text-outline premium-input transition-all" id="edit_location" name="location" type="text" value="<?php echo htmlspecialchars($edit_land['location']); ?>" required/>
      </div>

      <!-- Area + Unit -->
      <div class="space-y-2">
        <label class="block text-label-md text-on-surface uppercase" for="edit_area">Land Area *</label>
        <div class="flex gap-2">
          <input class="w-2/3 rounded-lg bg-surface border border-outline-variant px-4 py-3 text-body-md text-on-surface premium-input transition-all" id="edit_area" name="area" type="number" step="0.01" min="0.01" value="<?php echo htmlspecialchars($edit_land['area']); ?>" required/>
          <select class="w-1/3 rounded-lg bg-surface border border-outline-variant px-3 py-3 text-body-md text-on-surface premium-input transition-all" name="area_unit" required>
            <option value="acre" <?php if ($edit_land['area_unit'] === 'acre') echo 'selected'; ?>>Acre</option>
            <option value="bigha" <?php if ($edit_land['area_unit'] === 'bigha') echo 'selected'; ?>>Bigha</option>
            <option value="katha" <?php if ($edit_land['area_unit'] === 'katha') echo 'selected'; ?>>Katha</option>
            <option value="decimal" <?php if ($edit_land['area_unit'] === 'decimal') echo 'selected'; ?>>Decimal</option>
            <option value="hectare" <?php if ($edit_land['area_unit'] === 'hectare') echo 'selected'; ?>>Hectare</option>
          </select>
        </div>
      </div>

      <!-- Soil Type -->
      <div class="space-y-2">
        <label class="block text-label-md text-on-surface uppercase" for="edit_soil">Soil Type</label>
        <input class="w-full rounded-lg bg-surface border border-outline-variant px-4 py-3 text-body-md text-on-surface placeholder:text-outline premium-input transition-all" id="edit_soil" name="soil_type" type="text" value="<?php echo htmlspecialchars($edit_land['soil_type']); ?>"/>
      </div>

      <!-- Land Type -->
      <div class="space-y-2">
        <label class="block text-label-md text-on-surface uppercase" for="edit_land_type">Land Type / Terrain</label>
        <input class="w-full rounded-lg bg-surface border border-outline-variant px-4 py-3 text-body-md text-on-surface placeholder:text-outline premium-input transition-all" id="edit_land_type" name="land_type" type="text" value="<?php echo htmlspecialchars($edit_land['land_type']); ?>"/>
      </div>

      <!-- Description -->
      <div class="col-span-1 md:col-span-2 space-y-2">
        <label class="block text-label-md text-on-surface uppercase" for="edit_desc">Description</label>
        <textarea class="w-full rounded-lg bg-surface border border-outline-variant px-4 py-3 text-body-md text-on-surface premium-input transition-all resize-y" id="edit_desc" name="description" rows="3"><?php echo htmlspecialchars($edit_land['description']); ?></textarea>
      </div>

      <!-- Image Upload -->
      <div class="col-span-1 md:col-span-2 space-y-2">
        <label class="block text-label-md text-on-surface uppercase" for="edit_image">Change Land Image (optional)</label>
        <input class="w-full text-sm text-on-surface border border-outline-variant rounded-lg p-2.5 bg-surface file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-container cursor-pointer" type="file" id="edit_image" name="image" accept="image/*">
        <?php if (!empty($edit_land['image'])): ?>
          <p class="text-xs text-on-surface-variant mt-1">Current: <a href="../<?php echo htmlspecialchars($edit_land['image']); ?>" target="_blank" class="text-secondary underline hover:text-primary">View current image</a></p>
        <?php endif; ?>
      </div>

      <!-- Form Actions -->
      <div class="col-span-1 md:col-span-2 flex flex-col-reverse sm:flex-row justify-end gap-4 mt-4 pt-4 border-t border-outline-variant/30">
        <a href="manage-land.php" class="px-6 py-3 rounded-lg border-[1.5px] border-outline-variant text-on-surface-variant font-label-md text-label-md uppercase hover:bg-surface-container-low transition-colors text-center">
          Cancel
        </a>
        <button class="px-8 py-3 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md uppercase hover:bg-primary transition-all shadow-md cursor-pointer" type="submit" name="update_land">
          Save Changes
        </button>
      </div>
    </form>
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

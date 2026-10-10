<?php
if (!isset($project) || !$project):
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<title>Project Not Found | ChasiConnect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-[#fcf9f8] p-6">
  <div class="bg-white rounded-xl shadow p-8 max-w-md text-center">
    <h1 class="text-xl font-bold text-[#012d1d] mb-2">Project not found</h1>
    <p class="text-sm text-gray-600 mb-5">This project does not exist or does not belong to you.</p>
    <a href="farmer-dashboard.php" class="inline-block bg-[#1b4332] text-white text-sm font-semibold py-2 px-5 rounded-lg">Back to Dashboard</a>
  </div>
</body>
</html>
<?php
return;
endif;

$required_budget = (float)$project['required_budget'];
$confirmed       = (float)($stats['confirmed_amount'] ?? 0);
$funding_pct     = (float)($stats['funding_pct'] ?? 0);
$remaining       = (float)($stats['remaining'] ?? 0);
$settled         = !empty($project['profit_distributed_at']);

$status_badges = [
    'pending'   => 'bg-amber-100 text-amber-800',
    'approved'  => 'bg-blue-100 text-blue-800',
    'rejected'  => 'bg-red-100 text-red-800',
    'active'    => 'bg-green-100 text-green-800',
    'completed' => $settled ? 'bg-emerald-100 text-emerald-800' : 'bg-indigo-100 text-indigo-800',
];
$badge = $status_badges[$project['status']] ?? 'bg-gray-100 text-gray-800';

$status_labels = [
    'pending'   => 'Pending',
    'approved'  => 'Approved (awaiting funding)',
    'rejected'  => 'Rejected',
    'active'    => 'Active (fully funded)',
    'completed' => $settled ? 'Completed & Settled' : 'Completed (settlement pending)',
];
$status_label = $status_labels[$project['status']] ?? ucfirst($project['status']);
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title><?php echo htmlspecialchars($project['title']); ?> | Farmer Project Details | ChasiConnect</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
</head>
<body class="text-gray-900 antialiased min-h-screen flex flex-col bg-[#fcf9f8]">

<!-- TopNavBar -->
<header class="sticky top-0 w-full z-50 flex justify-between items-center px-4 md:px-10 py-4 bg-white border-b border-gray-200 shadow-sm">
  <div class="flex items-center gap-6">
    <a href="farmer-dashboard.php" class="flex items-center gap-3">
      <div class="flex items-center justify-center w-9 h-9 bg-[#1b4332] rounded-lg">
        <span class="material-symbols-outlined text-white text-xl" style="font-variation-settings:'FILL' 1;">agriculture</span>
      </div>
      <span class="text-lg font-bold text-[#012d1d]">ChasiConnect</span>
    </a>
    <nav class="hidden md:flex gap-4 ml-4 text-sm">
      <a class="text-gray-600 hover:text-[#012d1d]" href="farmer-dashboard.php">Dashboard</a>
      <a class="text-gray-600 hover:text-[#012d1d]" href="create-project.php">Create Project</a>
      <a class="text-gray-600 hover:text-[#012d1d]" href="hire-requests.php">Requests</a>
      <a class="text-gray-600 hover:text-[#012d1d]" href="project-update.php">Progress</a>
      <a class="text-gray-600 hover:text-[#012d1d]" href="harvest.php">Harvest</a>
    </nav>
  </div>
  <div class="flex items-center gap-4">
    <span class="hidden sm:inline text-sm font-semibold text-[#012d1d]"><?php echo htmlspecialchars($username); ?></span>
    <a href="../logout.php" class="text-sm text-gray-500 hover:text-red-600 flex items-center gap-1">
      <span class="material-symbols-outlined text-lg">logout</span><span class="hidden sm:inline">Logout</span>
    </a>
  </div>
</header>

<main class="flex-grow w-full max-w-5xl mx-auto px-4 md:px-10 py-8 flex flex-col gap-6">

  <?php if ($message !== ""): ?>
    <div class="<?php echo $message_class === 'error-message' ? 'bg-red-50 text-red-800 border-red-200' : 'bg-green-50 text-green-800 border-green-200'; ?> p-4 rounded-lg border flex items-start gap-3">
      <div class="text-sm">
        <p class="font-semibold"><?php echo htmlspecialchars($message); ?></p>
        <?php if ($distribution_result): ?>
          <p class="mt-1">Profit ৳<?php echo number_format((float)$distribution_result['profit'], 2); ?> →
            Investors ৳<?php echo number_format((float)$distribution_result['investor_pool'], 2); ?> (60%) ·
            You ৳<?php echo number_format((float)$distribution_result['farmer_share'], 2); ?> (39.5%) ·
            Platform ৳<?php echo number_format((float)$distribution_result['platform_share'], 2); ?> (0.5%)</p>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>

  <!-- Header -->
  <div class="flex flex-col md:flex-row justify-between md:items-center gap-3">
    <div>
      <div class="flex items-center gap-3 flex-wrap">
        <h1 class="text-2xl font-bold text-[#012d1d]"><?php echo htmlspecialchars($project['title']); ?></h1>
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold <?php echo $badge; ?>">
          <?php echo $status_label; ?>
        </span>
      </div>
      <p class="text-sm text-gray-500 mt-1">Crop: <?php echo htmlspecialchars($project['crop']); ?> · Duration: <?php echo (int)$project['duration_months']; ?> month(s)</p>
    </div>
    <a href="farmer-dashboard.php" class="text-sm text-[#116c4a] hover:underline font-semibold">← Back to Dashboard</a>
  </div>

  <?php if ($project['status'] === 'rejected' && !empty($project['rejection_reason'])): ?>
    <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-lg text-sm">
      <strong>Rejection reason:</strong> <?php echo htmlspecialchars($project['rejection_reason']); ?>
    </div>
  <?php endif; ?>

  <!-- Funding / Financial KPIs -->
  <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-white rounded-xl border border-gray-200 p-5">
      <p class="text-xs uppercase text-gray-500 font-semibold">Required Budget</p>
      <p class="text-xl font-bold text-[#012d1d] mt-2">৳<?php echo number_format($required_budget, 2); ?></p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5">
      <p class="text-xs uppercase text-gray-500 font-semibold">Invested (Confirmed)</p>
      <p class="text-xl font-bold text-[#116c4a] mt-2">৳<?php echo number_format($confirmed, 2); ?></p>
      <p class="text-xs text-gray-400 mt-1"><?php echo (int)$stats['confirmed_count']; ?> investor(s)<?php echo (float)$stats['pending_amount'] > 0 ? ' · ৳' . number_format((float)$stats['pending_amount'], 2) . ' pending (not counted)' : ''; ?></p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5">
      <p class="text-xs uppercase text-gray-500 font-semibold">Remaining</p>
      <p class="text-xl font-bold mt-2 <?php echo $remaining > 0 ? 'text-amber-700' : 'text-gray-400'; ?>">৳<?php echo number_format($remaining, 2); ?></p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5">
      <p class="text-xs uppercase text-gray-500 font-semibold">Funding Progress</p>
      <p class="text-xl font-bold text-[#012d1d] mt-2"><?php echo number_format($funding_pct, 2); ?>%</p>
      <div class="w-full h-2 bg-gray-200 rounded-full mt-2">
        <div class="h-2 bg-[#116c4a] rounded-full" style="width: <?php echo min(100, max(0, $funding_pct)); ?>%;"></div>
      </div>
    </div>
  </section>

  <!-- Completion Action -->
  <?php if ($project['status'] === 'active'): ?>
  <section class="bg-white rounded-xl border border-gray-200 p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
      <h3 class="font-bold text-[#012d1d]">Mark Project 100% Complete</h3>
      <p class="text-sm text-gray-500 mt-1">Confirms the project is finished and triggers the final profit settlement
        (Investors 60% · Farmer 39.5% · Platform 0.5%). The land lease is <strong>not</strong> part of profit sharing.
        This action can only be performed once.</p>
      <?php if ((int)$stats['harvest_count'] < 1): ?>
        <p class="text-xs text-amber-700 mt-1">⚠ No harvest records yet — profit distribution will automatically run when you log a harvest on the Harvest page.</p>
      <?php endif; ?>
    </div>
    <form method="post" action="project-details.php?id=<?php echo (int)$project['id']; ?>"
          onsubmit="if(this.dataset.busy){return false;} this.dataset.busy='1'; var b=this.querySelector('button'); b.disabled=true; b.textContent='Processing…'; return true;">
      <input type="hidden" name="action" value="complete_project"/>
      <input type="hidden" name="project_id" value="<?php echo (int)$project['id']; ?>"/>
      <button type="submit" class="bg-[#1b4332] text-white text-sm font-semibold py-2.5 px-5 rounded-lg hover:bg-[#116c4a] disabled:opacity-50 disabled:cursor-not-allowed whitespace-nowrap">
        Mark 100% Complete
      </button>
    </form>
  </section>
  <?php endif; ?>

  <!-- Financial / Settlement -->
  <section class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
      <h3 class="font-bold text-[#012d1d]">Project Financials &amp; Settlement</h3>
      <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full <?php echo $settled ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-600'; ?>">
        <?php echo $settled ? 'Settled' : ($project['status'] === 'completed' ? 'Settlement pending' : 'Not settled'); ?>
      </span>
    </div>
    <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 text-sm">
      <div class="flex justify-between border-b border-gray-100 pb-2"><span class="text-gray-500">Harvest records</span><span class="font-semibold"><?php echo (int)$stats['harvest_count']; ?></span></div>
      <div class="flex justify-between border-b border-gray-100 pb-2"><span class="text-gray-500">Total harvest revenue</span><span class="font-semibold">৳<?php echo number_format((float)$stats['harvest_revenue'], 2); ?></span></div>
      <div class="flex justify-between border-b border-gray-100 pb-2"><span class="text-gray-500">Required budget (project cost)</span><span class="font-semibold">৳<?php echo number_format($required_budget, 2); ?></span></div>
      <div class="flex justify-between border-b border-gray-100 pb-2"><span class="text-gray-500">Net profit (revenue − budget)</span><span class="font-semibold"><?php echo $project['total_profit'] !== null ? '৳' . number_format((float)$project['total_profit'], 2) : '—'; ?></span></div>
      <div class="flex justify-between border-b border-gray-100 pb-2"><span class="text-gray-500">Your farmer share (39.5%)</span><span class="font-semibold text-[#116c4a]"><?php echo $project['farmer_profit_share'] !== null ? '৳' . number_format((float)$project['farmer_profit_share'], 2) : '—'; ?></span></div>
      <div class="flex justify-between border-b border-gray-100 pb-2"><span class="text-gray-500">Platform fee (0.5%)</span><span class="font-semibold"><?php echo $project['platform_profit_share'] !== null ? '৳' . number_format((float)$project['platform_profit_share'], 2) : '—'; ?></span></div>
      <div class="flex justify-between border-b border-gray-100 pb-2"><span class="text-gray-500">Investor profit pool (60%)</span><span class="font-semibold"><?php echo $project['total_profit'] !== null ? '৳' . number_format(round((float)$project['total_profit'] * 0.60, 2), 2) : '—'; ?></span></div>
      <div class="flex justify-between border-b border-gray-100 pb-2"><span class="text-gray-500">Landowner profit share</span><span class="font-semibold">0% (fixed lease only)</span></div>
      <?php if ($settled): ?>
      <div class="flex justify-between md:col-span-2"><span class="text-gray-500">Settled on</span><span class="font-semibold"><?php echo htmlspecialchars(date('d M Y, h:i A', strtotime($project['profit_distributed_at']))); ?></span></div>
      <?php endif; ?>
    </div>
  </section>

  <!-- Investors -->
  <section class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
      <h3 class="font-bold text-[#012d1d]">Investors (<?php echo (int)$stats['confirmed_count']; ?> confirmed)</h3>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm border-collapse">
        <thead>
          <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500">
            <th class="py-3 px-5">Investor</th>
            <th class="py-3 px-5">Amount</th>
            <th class="py-3 px-5">Status</th>
            <th class="py-3 px-5">Profit Share</th>
            <th class="py-3 px-5">Invested At</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <?php if (count($investors) > 0): ?>
            <?php foreach ($investors as $inv): ?>
              <tr class="hover:bg-gray-50">
                <td class="py-3 px-5 font-medium"><?php echo htmlspecialchars($inv['investor_name']); ?></td>
                <td class="py-3 px-5">৳<?php echo number_format((float)$inv['amount'], 2); ?></td>
                <td class="py-3 px-5">
                  <?php $s = $inv['status']; $cls = $s === 'confirmed' ? 'bg-green-100 text-green-800' : ($s === 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-600'); ?>
                  <span class="px-2 py-0.5 rounded-full text-xs font-semibold <?php echo $cls; ?>"><?php echo ucfirst(htmlspecialchars($s)); ?></span>
                </td>
                <td class="py-3 px-5"><?php echo $inv['profit_share'] !== null ? '৳' . number_format((float)$inv['profit_share'], 2) : '—'; ?></td>
                <td class="py-3 px-5 text-gray-500"><?php echo htmlspecialchars(date('d M Y', strtotime($inv['invested_at']))); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="5" class="py-8 text-center text-gray-400">No investors yet.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Land & Landowner -->
  <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bg-white rounded-xl border border-gray-200 p-5">
      <h3 class="font-bold text-[#012d1d] mb-3">Land Information</h3>
      <div class="text-sm space-y-2">
        <div class="flex justify-between"><span class="text-gray-500">Title</span><span class="font-semibold"><?php echo htmlspecialchars($project['land_title']); ?></span></div>
        <div class="flex justify-between"><span class="text-gray-500">Location</span><span class="font-semibold"><?php echo htmlspecialchars($project['location']); ?></span></div>
        <div class="flex justify-between"><span class="text-gray-500">Area</span><span class="font-semibold"><?php echo htmlspecialchars($project['area'] . ' ' . $project['area_unit']); ?></span></div>
        <div class="flex justify-between"><span class="text-gray-500">Soil / Type</span><span class="font-semibold"><?php echo htmlspecialchars(trim(($project['soil_type'] ?: '—') . ' / ' . ($project['land_type'] ?: '—'))); ?></span></div>
        <div class="flex justify-between"><span class="text-gray-500">Availability</span><span class="font-semibold"><?php echo ucfirst(htmlspecialchars($project['availability_status'])); ?></span></div>
      </div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5">
      <h3 class="font-bold text-[#012d1d] mb-3">Landowner &amp; Lease</h3>
      <div class="text-sm space-y-2">
        <div class="flex justify-between"><span class="text-gray-500">Landowner</span><span class="font-semibold"><?php echo htmlspecialchars($project['landowner_name']); ?></span></div>
        <div class="flex justify-between"><span class="text-gray-500">Contact</span><span class="font-semibold"><?php echo htmlspecialchars($project['landowner_phone'] ?: $project['landowner_email'] ?: '—'); ?></span></div>
        <?php if ($lease): ?>
        <div class="flex justify-between"><span class="text-gray-500">Fixed lease amount</span><span class="font-semibold">৳<?php echo number_format((float)$lease['lease_amount'], 2); ?></span></div>
        <div class="flex justify-between"><span class="text-gray-500">Lease payment status</span><span class="font-semibold"><?php echo !empty($lease['lease_paid_at']) ? 'Paid (' . htmlspecialchars(date('d M Y', strtotime($lease['lease_paid_at']))) . ')' : 'Not paid'; ?></span></div>
        <?php else: ?>
        <div class="flex justify-between"><span class="text-gray-500">Lease agreement</span><span class="font-semibold">No accepted hiring request found</span></div>
        <?php endif; ?>
        <p class="text-xs text-gray-400 pt-1">The landowner receives the fixed lease payment only and receives no share of project profit.</p>
      </div>
    </div>
  </section>

</main>

<footer class="w-full py-6 px-4 md:px-10 flex flex-col md:flex-row justify-between items-center gap-2 border-t border-gray-200 bg-white">
  <div class="font-bold text-[#012d1d]">ChasiConnect</div>
  <div class="text-xs text-gray-500">&copy; <?php echo date("Y"); ?> ChasiConnect Agricultural Management. All rights reserved.</div>
</footer>
</body>
</html>

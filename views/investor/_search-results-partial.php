<?php
?>
<?php if (count($projects) > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
    <?php $idx = 0; ?>
    <?php foreach ($projects as $project): ?>
        <?php
            $required  = (float)$project['required_budget'];
            $current   = (float)$project['current_funding'];
            $percent   = $required > 0 ? min(100, round(($current / $required) * 100, 1)) : 0;
            $remaining = max(0, $required - $current);
            $idx++;
        ?>
        <div class="bg-surface-container-lowest rounded-xl ambient-shadow hover-lift border border-outline-variant/50 overflow-hidden flex flex-col group">
            <div class="relative h-48 w-full bg-primary-container/10 overflow-hidden flex items-center justify-center">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/70 via-primary/20 to-transparent z-10"></div>
                <img src="../banner.jpg" alt="<?= htmlspecialchars($project['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                <div class="absolute top-4 left-4 z-20 flex gap-2">
                    <span class="bg-surface-container-lowest/90 backdrop-blur-sm px-3 py-1 rounded-full font-label-md text-label-md text-primary flex items-center gap-1 border border-outline-variant/50">
                        <span class="material-symbols-outlined text-[16px]">eco</span> <?= htmlspecialchars($project['crop']) ?>
                    </span>
                </div>
                <div class="absolute top-4 right-4 z-20">
                    <?php if ($project['status'] === 'approved'): ?>
                        <span class="bg-secondary-container/90 text-on-secondary-container px-3 py-1 rounded-full font-label-md text-label-md font-semibold backdrop-blur-md shadow-sm">Open for Funding</span>
                    <?php else: ?>
                        <span class="bg-primary-fixed/90 text-on-primary-fixed-variant px-3 py-1 rounded-full font-label-md text-label-md font-semibold backdrop-blur-md shadow-sm">Active Project</span>
                    <?php endif; ?>
                </div>
                <div class="absolute bottom-3 left-4 right-4 z-20 text-white">
                    <h3 class="text-lg font-headline-md font-bold text-white drop-shadow-sm leading-tight">
                        <?= htmlspecialchars($project['title']) ?>
                    </h3>
                </div>
            </div>

            <div class="p-6 flex flex-col flex-1 justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 text-on-surface-variant font-body-sm text-body-sm mb-3 flex-wrap">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px] text-primary">person</span> <?= htmlspecialchars($project['farmer_name']) ?></span>
                        <span class="w-1 h-1 rounded-full bg-outline"></span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px] text-primary">location_on</span> <?= htmlspecialchars($project['location']) ?></span>
                        <span class="w-1 h-1 rounded-full bg-outline"></span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px] text-primary">straighten</span> <?= htmlspecialchars($project['area'] . ' ' . $project['area_unit']) ?></span>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 italic">
                        "<?= htmlspecialchars($project['description'] ?? 'Cultivation and harvest project.') ?>"
                    </p>
                </div>

                <div class="pt-4 border-t border-outline-variant/40">
                    <div class="flex justify-between items-end mb-2">
                        <div>
                            <p class="font-label-md text-label-md text-on-surface-variant mb-0.5 uppercase">Funding Progress</p>
                            <p class="font-numeric-kpi text-[20px] text-primary font-bold">
                                ৳<?= number_format($current, 2) ?>
                                <span class="font-body-sm text-body-sm text-on-surface-variant font-normal">/ ৳<?= number_format($required, 2) ?></span>
                            </p>
                        </div>
                        <span class="font-label-md text-label-md text-secondary font-bold"><?= $percent ?>%</span>
                    </div>

                    <div class="w-full bg-surface-container-high rounded-full h-2 mb-5 overflow-hidden">
                        <div class="bg-secondary h-2 rounded-full transition-all duration-500" style="width: <?= $percent ?>%"></div>
                    </div>

                    <div class="flex gap-2">
                        <a href="project-details.php?id=<?= $project['id'] ?>" class="flex-1 text-center bg-primary-container text-on-primary rounded-lg py-2.5 font-label-md text-label-md uppercase tracking-wider hover:bg-primary transition-colors flex justify-center items-center gap-1.5 shadow-sm">
                            <?= ($project['status'] === 'approved' && $remaining > 0) ? 'Invest Now' : 'View Project' ?>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

<?php else: ?>
    <div class="bg-surface-container-lowest rounded-xl p-12 text-center border border-outline-variant/30 text-on-surface-variant">
        <span class="material-symbols-outlined text-4xl text-outline mb-2 block">search_off</span>
        <p class="font-body-md text-body-md font-medium">
            <?php if (!empty($_GET['keyword'])): ?>
                No projects found matching "<strong><?= htmlspecialchars($_GET['keyword']) ?></strong>".
            <?php else: ?>
                No projects available at the moment.
            <?php endif; ?>
        </p>
        <button onclick="document.getElementById('ajax-search-input').value=''; document.getElementById('ajax-search-input').dispatchEvent(new Event('input'));"
                class="inline-block mt-3 bg-primary-container text-on-primary px-6 py-2 rounded-lg font-label-md text-label-md uppercase cursor-pointer">
            Clear Search
        </button>
    </div>
<?php endif; ?>

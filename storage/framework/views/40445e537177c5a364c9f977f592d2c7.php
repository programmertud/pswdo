<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>
<?php $__env->startSection('page-sub', 'Overview of Children Data — Surigao del Norte 2025'); ?>

<?php $__env->startSection('content'); ?>


<div class="stat-grid">
    <div class="stat-card navy">
        <span class="stat-label">Total Children Population</span>
        <span class="stat-value"><?php echo e(number_format($totalChildren)); ?></span>
        <span class="stat-sub">Male: <?php echo e(number_format($totalMale)); ?> · Female: <?php echo e(number_format($totalFemale)); ?></span>
    </div>
    <div class="stat-card gold">
        <span class="stat-label">Avg. Immunization Rate</span>
        <span class="stat-value"><?php echo e(number_format($avgImmunization, 1)); ?>%</span>
        <span class="stat-sub">Children aged 12 months, fully immunized</span>
    </div>
    <div class="stat-card teal">
        <span class="stat-label">Children with Disability</span>
        <span class="stat-value"><?php echo e(number_format($totalDisability)); ?></span>
        <span class="stat-sub">Across 21 LGUs</span>
    </div>
    <div class="stat-card red">
        <span class="stat-label">CNSP Cases</span>
        <span class="stat-value"><?php echo e(number_format($totalCNSP)); ?></span>
        <span class="stat-sub">Children in Need of Special Protection</span>
    </div>
    <div class="stat-card purple">
        <span class="stat-label">IP Children</span>
        <span class="stat-value"><?php echo e(number_format($totalIP)); ?></span>
        <span class="stat-sub">Indigenous Peoples</span>
    </div>
    <div class="stat-card navy">
        <span class="stat-label">Pregnant Adolescents</span>
        <span class="stat-value"><?php echo e(number_format($totalPregnant)); ?></span>
        <span class="stat-sub">Aged 10–19 years old</span>
    </div>
</div>


<div class="chart-grid">
    
    <div class="chart-card">
        <h3>Top LGUs by Children Population</h3>
        <?php $maxPop = $topLGUs->max('total'); ?>
        <div class="bar-chart">
            <?php $__currentLoopData = $topLGUs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lgu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $pct = $maxPop > 0 ? ($lgu->total / $maxPop) * 100 : 0; ?>
            <div class="bar-row">
                <span class="bar-label"><?php echo e($lgu->lgu_name); ?></span>
                <div class="bar-track">
                    <div class="bar-fill navy" style="width: <?php echo e($pct); ?>%">
                        <span class="bar-val"><?php echo e(number_format($lgu->total)); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="chart-card" style="overflow-y:auto; max-height: 380px;">
        <h3>Immunization Rates by LGU</h3>
        <?php $__currentLoopData = $immunizationData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $rate = $item->immunization_rate ?? 0;
            $cls  = $rate >= 85 ? 'rate-high' : ($rate >= 70 ? 'rate-mid' : 'rate-low');
        ?>
        <div class="gauge-row">
            <span class="gauge-name" style="font-size:11px;"><?php echo e($item->lgu_name); ?></span>
            <div class="gauge-track">
                <div class="gauge-fill <?php echo e($cls); ?>" style="width:<?php echo e($rate); ?>%"></div>
            </div>
            <span class="gauge-pct"><?php echo e(number_format($rate, 1)); ?>%</span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div style="display:flex; gap:14px; margin-top:12px; font-size:11px; color:var(--muted);">
            <span><span style="display:inline-block;width:10px;height:10px;background:#22c55e;border-radius:2px;margin-right:4px;"></span>≥85%</span>
            <span><span style="display:inline-block;width:10px;height:10px;background:var(--gold);border-radius:2px;margin-right:4px;"></span>70–84%</span>
            <span><span style="display:inline-block;width:10px;height:10px;background:var(--red);border-radius:2px;margin-right:4px;"></span>&lt;70%</span>
        </div>
    </div>
</div>


<div style="margin-bottom: 28px;">
    <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size:15px; font-weight:700; margin-bottom:14px;">Quick Access</h3>
    <div style="display:flex; flex-wrap:wrap; gap:10px;">
        <a href="<?php echo e(route('records.population')); ?>"  class="btn btn-outline btn-sm">Total Population</a>
        <a href="<?php echo e(route('records.survival')); ?>"    class="btn btn-outline btn-sm">Survival</a>
        <a href="<?php echo e(route('records.development')); ?>" class="btn btn-outline btn-sm">Development</a>
        <a href="<?php echo e(route('records.protection')); ?>"  class="btn btn-outline btn-sm">Protection</a>
        <a href="<?php echo e(route('records.disability')); ?>"  class="btn btn-outline btn-sm">Disability</a>
        <a href="<?php echo e(route('records.ip')); ?>"          class="btn btn-outline btn-sm">IP Children</a>
        <a href="<?php echo e(route('add.index')); ?>"           class="btn btn-gold btn-sm">+ Add Record</a>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\cswdo\resources\views/dashboard/index.blade.php ENDPATH**/ ?>
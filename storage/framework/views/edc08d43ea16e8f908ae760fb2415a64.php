<?php $__env->startSection('title', 'IP Children'); ?>
<?php $__env->startSection('page-title', 'Indigenous Peoples Children'); ?>
<?php $__env->startSection('page-sub', 'By Local Government Unit — Surigao del Norte 2025'); ?>

<?php $__env->startSection('content'); ?>
<div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; align-items:center;">
    <div class="stat-card purple" style="flex:1; min-width:160px;">
        <span class="stat-label">Total IP Children</span>
        <span class="stat-value"><?php echo e(number_format($totals['total'])); ?></span>
    </div>
    <div class="stat-card navy" style="flex:1; min-width:160px;">
        <span class="stat-label">Male</span>
        <span class="stat-value"><?php echo e(number_format($totals['male'])); ?></span>
    </div>
    <div class="stat-card navy" style="flex:1; min-width:160px;">
        <span class="stat-label">Female</span>
        <span class="stat-value"><?php echo e(number_format($totals['female'])); ?></span>
    </div>
    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
        <a href="<?php echo e(route('exports.download', ['dataset' => 'ip', 'format' => 'pdf'])); ?>" class="btn btn-outline btn-sm">PDF</a>
        <a href="<?php echo e(route('exports.download', ['dataset' => 'ip', 'format' => 'excel'])); ?>" class="btn btn-outline btn-sm">Excel</a>
        <a href="<?php echo e(route('add.index')); ?>" class="btn btn-gold btn-sm">+ Add / Update</a>
    </div>
</div>

<div class="table-card">
    <div class="table-header">
        <h3>IP Children by LGU</h3>
        <div class="table-search"><input type="text" placeholder="Search LGU…"></div>
    </div>
    <div style="overflow-x:auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>LGU</th>
                    <th class="num">Male</th>
                    <th class="num">Female</th>
                    <th class="num">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i + 1); ?></td>
                    <td class="lgu-name"><?php echo e($r->lgu_name); ?></td>
                    <td class="num"><?php echo $r->male !== null ? number_format($r->male) : '<span class="pill pill-amber">N/A</span>'; ?></td>
                    <td class="num"><?php echo $r->female !== null ? number_format($r->female) : '<span class="pill pill-amber">N/A</span>'; ?></td>
                    <td class="num"><?php echo $r->total !== null ? '<strong>'.number_format($r->total).'</strong>' : '<span class="pill pill-amber">N/A</span>'; ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="2"><strong>Total</strong></td>
                    <td class="num"><?php echo e(number_format($totals['male'])); ?></td>
                    <td class="num"><?php echo e(number_format($totals['female'])); ?></td>
                    <td class="num"><?php echo e(number_format($totals['total'])); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\cswdo\resources\views\records\ip.blade.php ENDPATH**/ ?>
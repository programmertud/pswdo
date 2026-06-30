<?php $__env->startSection('title', 'Protection'); ?>
<?php $__env->startSection('page-title', 'Protection Records'); ?>
<?php $__env->startSection('page-sub', 'CNSP, CAR & CICL Cases by LGU — 2025'); ?>

<?php $__env->startSection('content'); ?>
<div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; align-items:center;">
    <div class="stat-card red" style="flex:1; min-width:160px;">
        <span class="stat-label">Total CNSP Cases</span>
        <span class="stat-value"><?php echo e(number_format($totals['cnsp_cases'])); ?></span>
        <span class="stat-sub">Children in Need of Special Protection</span>
    </div>
    <div class="stat-card purple" style="flex:1; min-width:160px;">
        <span class="stat-label">CAR & CICL Cases</span>
        <span class="stat-value"><?php echo e(number_format($totals['car_cicl_cases'])); ?></span>
    </div>
    <div class="stat-card navy" style="flex:1; min-width:160px;">
        <span class="stat-label">Total CAR/CICL</span>
        <span class="stat-value"><?php echo e(number_format($totals['total'])); ?></span>
        <span class="stat-sub">M: <?php echo e(number_format($totals['male'])); ?> · F: <?php echo e(number_format($totals['female'])); ?></span>
    </div>
    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
        <a href="<?php echo e(route('exports.download', ['dataset' => 'protection', 'format' => 'pdf'])); ?>" class="btn btn-outline btn-sm">PDF</a>
        <a href="<?php echo e(route('exports.download', ['dataset' => 'protection', 'format' => 'excel'])); ?>" class="btn btn-outline btn-sm">Excel</a>
        <a href="<?php echo e(route('add.index')); ?>" class="btn btn-gold btn-sm">+ Add / Update</a>
    </div>
</div>

<div class="table-card">
    <div class="table-header">
        <h3>Protection Data by LGU</h3>
        <div class="table-search"><input type="text" placeholder="Search LGU…"></div>
    </div>
    <div style="overflow-x:auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>LGU</th>
                    <th class="num">CNSP Cases</th>
                    <th class="num">CAR & CICL</th>
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
                    <td class="num"><?php echo $r->cnsp_cases !== null ? '<span class="pill pill-red">'.number_format($r->cnsp_cases).'</span>' : '<span class="null-dash">—</span>'; ?></td>
                    <td class="num"><?php echo $r->car_cicl_cases !== null ? number_format($r->car_cicl_cases) : '<span class="null-dash">—</span>'; ?></td>
                    <td class="num"><?php echo $r->car_cicl_male !== null ? number_format($r->car_cicl_male) : '<span class="null-dash">—</span>'; ?></td>
                    <td class="num"><?php echo $r->car_cicl_female !== null ? number_format($r->car_cicl_female) : '<span class="null-dash">—</span>'; ?></td>
                    <td class="num"><?php echo $r->car_cicl_total !== null ? '<strong>'.number_format($r->car_cicl_total).'</strong>' : '<span class="null-dash">—</span>'; ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="2"><strong>Total</strong></td>
                    <td class="num"><?php echo e(number_format($totals['cnsp_cases'])); ?></td>
                    <td class="num"><?php echo e(number_format($totals['car_cicl_cases'])); ?></td>
                    <td class="num"><?php echo e(number_format($totals['male'])); ?></td>
                    <td class="num"><?php echo e(number_format($totals['female'])); ?></td>
                    <td class="num"><?php echo e(number_format($totals['total'])); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\cswdo\resources\views\records\protection.blade.php ENDPATH**/ ?>
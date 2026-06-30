<?php $__env->startSection('title', 'Development'); ?>
<?php $__env->startSection('page-title', 'Development Records'); ?>
<?php $__env->startSection('page-sub', 'Children in School & School Dropouts Reintegrated — 2025'); ?>

<?php $__env->startSection('content'); ?>
<div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; align-items:center;">
    <div class="stat-card navy" style="flex:1; min-width:160px;">
        <span class="stat-label">Male in School</span>
        <span class="stat-value"><?php echo e(number_format($totals['male'])); ?></span>
    </div>
    <div class="stat-card navy" style="flex:1; min-width:160px;">
        <span class="stat-label">Female in School</span>
        <span class="stat-value"><?php echo e(number_format($totals['female'])); ?></span>
    </div>
    <div class="stat-card teal" style="flex:1; min-width:160px;">
        <span class="stat-label">Total in School</span>
        <span class="stat-value"><?php echo e(number_format($totals['total'])); ?></span>
    </div>
    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
        <a href="<?php echo e(route('exports.download', ['dataset' => 'development', 'format' => 'pdf'])); ?>" class="btn btn-outline btn-sm">PDF</a>
        <a href="<?php echo e(route('exports.download', ['dataset' => 'development', 'format' => 'excel'])); ?>" class="btn btn-outline btn-sm">Excel</a>
        <a href="<?php echo e(route('add.index')); ?>" class="btn btn-gold btn-sm">+ Add / Update</a>
    </div>
</div>

<div class="table-card">
    <div class="table-header">
        <h3>Development Data by LGU</h3>
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
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i + 1); ?></td>
                    <td class="lgu-name"><?php echo e($r->lgu_name); ?></td>
                    <td class="num"><?php echo $r->children_in_school_male !== null ? number_format($r->children_in_school_male) : '<span class="null-dash">—</span>'; ?></td>
                    <td class="num"><?php echo $r->children_in_school_female !== null ? number_format($r->children_in_school_female) : '<span class="null-dash">—</span>'; ?></td>
                    <td class="num"><?php echo $r->children_in_school_total !== null ? number_format($r->children_in_school_total) : '<span class="null-dash">—</span>'; ?></td>
                    <td>
                        <?php if($r->remarks): ?>
                            <span class="pill pill-amber"><?php echo e($r->remarks); ?></span>
                        <?php else: ?>
                            <span class="null-dash">—</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="2"><strong>Total</strong></td>
                    <td class="num"><?php echo e(number_format($totals['male'])); ?></td>
                    <td class="num"><?php echo e(number_format($totals['female'])); ?></td>
                    <td class="num"><?php echo e(number_format($totals['total'])); ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\cswdo\resources\views\records\development.blade.php ENDPATH**/ ?>
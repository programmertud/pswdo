<?php $__env->startSection('title', 'Survival'); ?>
<?php $__env->startSection('page-title', 'Survival Records'); ?>
<?php $__env->startSection('page-sub', 'Immunization, 0-59 Months, Pregnant Adolescents — 2025'); ?>

<?php $__env->startSection('content'); ?>
<div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; align-items:center;">
    <div class="stat-card gold" style="flex:1; min-width:160px;">
        <span class="stat-label">Avg. Immunization Rate</span>
        <span class="stat-value"><?php echo e(number_format($totals['avg_immunization'], 1)); ?>%</span>
    </div>
    <div class="stat-card navy" style="flex:1; min-width:160px;">
        <span class="stat-label">Total Pop. 12 Months</span>
        <span class="stat-value"><?php echo e(number_format($totals['total_pop_12_months'])); ?></span>
    </div>
    <div class="stat-card teal" style="flex:1; min-width:160px;">
        <span class="stat-label">0-59 Months Weighed</span>
        <span class="stat-value"><?php echo e(number_format($totals['actual_0_59_months_weighed'])); ?></span>
    </div>
    <div class="stat-card red" style="flex:1; min-width:160px;">
        <span class="stat-label">Pregnant Adolescents (10-19)</span>
        <span class="stat-value"><?php echo e(number_format($totals['pregnant_adolescents_10_19'])); ?></span>
    </div>
    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
        <a href="<?php echo e(route('exports.download', ['dataset' => 'survival', 'format' => 'pdf'])); ?>" class="btn btn-outline btn-sm">PDF</a>
        <a href="<?php echo e(route('exports.download', ['dataset' => 'survival', 'format' => 'excel'])); ?>" class="btn btn-outline btn-sm">Excel</a>
        <a href="<?php echo e(route('add.index')); ?>" class="btn btn-gold btn-sm">+ Add / Update</a>
    </div>
</div>

<div class="table-card">
    <div class="table-header">
        <h3>Survival Data by LGU</h3>
        <div class="table-search"><input type="text" placeholder="Search LGU…"></div>
    </div>
    <div style="overflow-x:auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>LGU</th>
                    <th class="num">Immunization %<br><small style="font-weight:400;text-transform:none;">(12 mos.)</small></th>
                    <th class="num">Pop. 12 Mos.</th>
                    <th class="num">0-59 Mos. Weighed</th>
                    <th class="num">Total Pop. 0-59 Mos.</th>
                    <th class="num">Pregnant Adolescents<br><small style="font-weight:400;text-transform:none;">(10-19 yrs)</small></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $rate = $r->immunization_rate ?? 0;
                    $cls  = $rate >= 85 ? 'pill-green' : ($rate >= 70 ? 'pill-amber' : 'pill-red');
                ?>
                <tr>
                    <td><?php echo e($i + 1); ?></td>
                    <td class="lgu-name"><?php echo e($r->lgu_name); ?></td>
                    <td class="num">
                        <?php if($r->immunization_rate !== null): ?>
                            <span class="pill <?php echo e($cls); ?>"><?php echo e(number_format($r->immunization_rate, 2)); ?>%</span>
                        <?php else: ?>
                            <span class="null-dash">—</span>
                        <?php endif; ?>
                    </td>
                    <td class="num"><?php echo $r->total_pop_12_months !== null ? number_format($r->total_pop_12_months) : '<span class="null-dash">—</span>'; ?></td>
                    <td class="num"><?php echo $r->actual_0_59_months_weighed !== null ? number_format($r->actual_0_59_months_weighed) : '<span class="null-dash">—</span>'; ?></td>
                    <td class="num"><?php echo $r->total_pop_0_59_months !== null ? number_format($r->total_pop_0_59_months) : '<span class="null-dash">—</span>'; ?></td>
                    <td class="num"><?php echo $r->pregnant_adolescents_10_19 !== null ? number_format($r->pregnant_adolescents_10_19) : '<span class="null-dash">—</span>'; ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="2"><strong>Total</strong></td>
                    <td class="num"><?php echo e(number_format($totals['avg_immunization'], 2)); ?>% avg</td>
                    <td class="num"><?php echo e(number_format($totals['total_pop_12_months'])); ?></td>
                    <td class="num"><?php echo e(number_format($totals['actual_0_59_months_weighed'])); ?></td>
                    <td class="num"><?php echo e(number_format($totals['total_pop_0_59_months'])); ?></td>
                    <td class="num"><?php echo e(number_format($totals['pregnant_adolescents_10_19'])); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\cswdo\resources\views\records\survival.blade.php ENDPATH**/ ?>
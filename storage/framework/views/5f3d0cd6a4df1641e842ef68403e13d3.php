<?php $__env->startSection('title', 'History'); ?>
<?php $__env->startSection('page-title', 'History'); ?>
<?php $__env->startSection('page-sub', 'Archived children records by year'); ?>

<?php $__env->startSection('content'); ?>
<?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year => $sets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:16px;">
        <div>
            <h3 style="font-family:'Plus Jakarta Sans', sans-serif; font-size:18px; color:var(--text);">Records for <?php echo e($year); ?></h3>
            <p style="font-size:12px; color:var(--muted); margin-top:3px;">Existing records moved here so the current-year pages can start fresh.</p>
        </div>
        <span class="year-badge"><?php echo e($year); ?></span>
    </div>

    <div class="table-card" style="margin-bottom:22px;">
        <div class="table-header">
            <h3>Total Population</h3>
            <div class="table-search"><input type="text" placeholder="Search LGU..."></div>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name of LGU</th>
                        <th class="num">Male</th>
                        <th class="num">Female</th>
                        <th class="num">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $sets['population']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($i + 1); ?></td>
                        <td class="lgu-name"><?php echo e($r->lgu_name); ?></td>
                        <td class="num"><?php echo $r->male !== null ? number_format($r->male) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->female !== null ? number_format($r->female) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->total !== null ? '<strong>'.number_format($r->total).'</strong>' : '<span class="null-dash">—</span>'; ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" style="text-align:center; color:var(--muted);">No archived population records.</td></tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="num"><?php echo e(number_format($sets['population']->sum('male'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['population']->sum('female'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['population']->sum('total'))); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="table-card" style="margin-bottom:22px;">
        <div class="table-header">
            <h3>Survival</h3>
            <div class="table-search"><input type="text" placeholder="Search LGU..."></div>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>LGU</th>
                        <th class="num">Immunization %</th>
                        <th class="num">Pop. 12 Mos.</th>
                        <th class="num">0-59 Mos. Weighed</th>
                        <th class="num">Total Pop. 0-59 Mos.</th>
                        <th class="num">Pregnant Adolescents</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $sets['survival']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($i + 1); ?></td>
                        <td class="lgu-name"><?php echo e($r->lgu_name); ?></td>
                        <td class="num"><?php echo $r->immunization_rate !== null ? number_format($r->immunization_rate, 2).'%' : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->total_pop_12_months !== null ? number_format($r->total_pop_12_months) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->actual_0_59_months_weighed !== null ? number_format($r->actual_0_59_months_weighed) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->total_pop_0_59_months !== null ? number_format($r->total_pop_0_59_months) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->pregnant_adolescents_10_19 !== null ? number_format($r->pregnant_adolescents_10_19) : '<span class="null-dash">—</span>'; ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" style="text-align:center; color:var(--muted);">No archived survival records.</td></tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="num"><?php echo e(number_format($sets['survival']->whereNotNull('immunization_rate')->avg('immunization_rate') ?? 0, 2)); ?>% avg</td>
                        <td class="num"><?php echo e(number_format($sets['survival']->sum('total_pop_12_months'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['survival']->sum('actual_0_59_months_weighed'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['survival']->sum('total_pop_0_59_months'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['survival']->sum('pregnant_adolescents_10_19'))); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="table-card" style="margin-bottom:22px;">
        <div class="table-header">
            <h3>Development</h3>
            <div class="table-search"><input type="text" placeholder="Search LGU..."></div>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>LGU</th>
                        <th class="num">In School Male</th>
                        <th class="num">In School Female</th>
                        <th class="num">In School Total</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $sets['development']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($i + 1); ?></td>
                        <td class="lgu-name"><?php echo e($r->lgu_name); ?></td>
                        <td class="num"><?php echo $r->children_in_school_male !== null ? number_format($r->children_in_school_male) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->children_in_school_female !== null ? number_format($r->children_in_school_female) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->children_in_school_total !== null ? '<strong>'.number_format($r->children_in_school_total).'</strong>' : '<span class="null-dash">—</span>'; ?></td>
                        <td><?php echo e($r->remarks ?: '—'); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" style="text-align:center; color:var(--muted);">No archived development records.</td></tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="num"><?php echo e(number_format($sets['development']->sum('children_in_school_male'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['development']->sum('children_in_school_female'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['development']->sum('children_in_school_total'))); ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="table-card" style="margin-bottom:22px;">
        <div class="table-header">
            <h3>Protection</h3>
            <div class="table-search"><input type="text" placeholder="Search LGU..."></div>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>LGU</th>
                        <th class="num">CNSP Cases</th>
                        <th class="num">CAR/CICL Cases</th>
                        <th class="num">Male</th>
                        <th class="num">Female</th>
                        <th class="num">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $sets['protection']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($i + 1); ?></td>
                        <td class="lgu-name"><?php echo e($r->lgu_name); ?></td>
                        <td class="num"><?php echo $r->cnsp_cases !== null ? number_format($r->cnsp_cases) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->car_cicl_cases !== null ? number_format($r->car_cicl_cases) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->car_cicl_male !== null ? number_format($r->car_cicl_male) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->car_cicl_female !== null ? number_format($r->car_cicl_female) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->car_cicl_total !== null ? '<strong>'.number_format($r->car_cicl_total).'</strong>' : '<span class="null-dash">—</span>'; ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" style="text-align:center; color:var(--muted);">No archived protection records.</td></tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="num"><?php echo e(number_format($sets['protection']->sum('cnsp_cases'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['protection']->sum('car_cicl_cases'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['protection']->sum('car_cicl_male'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['protection']->sum('car_cicl_female'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['protection']->sum('car_cicl_total'))); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="table-card" style="margin-bottom:22px;">
        <div class="table-header">
            <h3>Children with Disability</h3>
            <div class="table-search"><input type="text" placeholder="Search LGU..."></div>
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
                    <?php $__empty_1 = true; $__currentLoopData = $sets['disability']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($i + 1); ?></td>
                        <td class="lgu-name"><?php echo e($r->lgu_name); ?></td>
                        <td class="num"><?php echo $r->male !== null ? number_format($r->male) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->female !== null ? number_format($r->female) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->total !== null ? '<strong>'.number_format($r->total).'</strong>' : '<span class="null-dash">—</span>'; ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" style="text-align:center; color:var(--muted);">No archived disability records.</td></tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="num"><?php echo e(number_format($sets['disability']->sum('male'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['disability']->sum('female'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['disability']->sum('total'))); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="table-card" style="margin-bottom:32px;">
        <div class="table-header">
            <h3>IP Children</h3>
            <div class="table-search"><input type="text" placeholder="Search LGU..."></div>
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
                    <?php $__empty_1 = true; $__currentLoopData = $sets['ip']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($i + 1); ?></td>
                        <td class="lgu-name"><?php echo e($r->lgu_name); ?></td>
                        <td class="num"><?php echo $r->male !== null ? number_format($r->male) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->female !== null ? number_format($r->female) : '<span class="null-dash">—</span>'; ?></td>
                        <td class="num"><?php echo $r->total !== null ? '<strong>'.number_format($r->total).'</strong>' : '<span class="null-dash">—</span>'; ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" style="text-align:center; color:var(--muted);">No archived IP children records.</td></tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="num"><?php echo e(number_format($sets['ip']->sum('male'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['ip']->sum('female'))); ?></td>
                        <td class="num"><?php echo e(number_format($sets['ip']->sum('total'))); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\cswdo\resources\views\records\History.blade.php ENDPATH**/ ?>
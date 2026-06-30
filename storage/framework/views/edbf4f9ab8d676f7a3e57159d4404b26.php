<?php $__env->startSection('title', 'Development'); ?>
<?php $__env->startSection('page-title', 'Development Records'); ?>
<?php $__env->startSection('page-sub', 'Children in School & School Dropouts Reintegrated — <?php echo e(date("Y")); ?>'); ?>

<?php
$lgus = ['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna',
         'Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso',
         'San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City'];
?>

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
                    <th style="text-align:center;">Actions</th>
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
                    <td class="action-cell" style="text-align:center;">
                        <button class="btn-edit" onclick="openEditModal(<?php echo e($r->id); ?>, '<?php echo e(addslashes($r->lgu_name)); ?>', <?php echo e($r->children_in_school_male ?? 'null'); ?>, <?php echo e($r->children_in_school_female ?? 'null'); ?>, <?php echo e($r->children_in_school_total ?? 'null'); ?>, '<?php echo e(addslashes($r->remarks ?? '')); ?>')">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Edit
                        </button>
                        <form method="POST" action="<?php echo e(route('add.development.destroy', $r->id)); ?>" style="display:inline;" onsubmit="return confirm('Delete development record for <?php echo e(addslashes($r->lgu_name)); ?>?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-delete">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                Delete
                            </button>
                        </form>
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
                    <td></td><td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


<div class="modal-backdrop" id="addModal">
    <div class="modal">
        <div class="modal-header">
            <h3>Add Development Record</h3>
            <button class="modal-close" onclick="closeModal('addModal')">✕</button>
        </div>
        <form method="POST" action="<?php echo e(route('add.development')); ?>">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group" style="grid-column:1/-1;">
                        <label>Name of LGU *</label>
                        <select name="lgu_name" class="form-control" required>
                            <option value="">— Select LGU —</option>
                            <?php $__currentLoopData = $lgus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lgu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($lgu); ?>"><?php echo e($lgu); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Children in School — Male</label>
                        <input type="number" name="children_in_school_male" class="form-control" min="0" placeholder="e.g. 128">
                    </div>
                    <div class="form-group">
                        <label>Children in School — Female</label>
                        <input type="number" name="children_in_school_female" class="form-control" min="0" placeholder="e.g. 116">
                    </div>
                    <div class="form-group">
                        <label>Total Children in School</label>
                        <input type="number" name="children_in_school_total" class="form-control" min="0" placeholder="e.g. 244">
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" name="remarks" class="form-control" placeholder="e.g. Only ECCD enrollees">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-sm" onclick="closeModal('addModal')">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm">Save Record</button>
            </div>
        </form>
    </div>
</div>


<div class="modal-backdrop" id="editModal">
    <div class="modal">
        <div class="modal-header">
            <h3>Edit Development Record</h3>
            <button class="modal-close" onclick="closeModal('editModal')">✕</button>
        </div>
        <form method="POST" id="editForm" action="">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group" style="grid-column:1/-1;">
                        <label>Name of LGU *</label>
                        <select name="lgu_name" id="edit_lgu" class="form-control" required>
                            <option value="">— Select LGU —</option>
                            <?php $__currentLoopData = $lgus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lgu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($lgu); ?>"><?php echo e($lgu); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Children in School — Male</label>
                        <input type="number" name="children_in_school_male" id="edit_male" class="form-control" min="0">
                    </div>
                    <div class="form-group">
                        <label>Children in School — Female</label>
                        <input type="number" name="children_in_school_female" id="edit_female" class="form-control" min="0">
                    </div>
                    <div class="form-group">
                        <label>Total Children in School</label>
                        <input type="number" name="children_in_school_total" id="edit_total" class="form-control" min="0">
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" name="remarks" id="edit_remarks" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-sm" onclick="closeModal('editModal')">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm">Update Record</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function openAddModal() { document.getElementById('addModal').classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
function openEditModal(id, lgu, male, female, total, remarks) {
    document.getElementById('editForm').action = '/add/development/' + id;
    document.getElementById('edit_lgu').value     = lgu;
    document.getElementById('edit_male').value    = male ?? '';
    document.getElementById('edit_female').value  = female ?? '';
    document.getElementById('edit_total').value   = total ?? '';
    document.getElementById('edit_remarks').value = remarks ?? '';
    document.getElementById('editModal').classList.add('open');
}
document.querySelectorAll('.modal-backdrop').forEach(b => {
    b.addEventListener('click', function(e) { if(e.target === this) this.classList.remove('open'); });
});
(function(){
    const m = document.getElementById('edit_male');
    const f = document.getElementById('edit_female');
    const t = document.getElementById('edit_total');
    const calc = () => { t.value = (parseInt(m.value)||0) + (parseInt(f.value)||0); };
    m.addEventListener('input', calc);
    f.addEventListener('input', calc);
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\cswdo\resources\views/records/development.blade.php ENDPATH**/ ?>
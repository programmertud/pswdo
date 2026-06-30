<?php $__env->startSection('title', 'Child Record'); ?>
<?php $__env->startSection('page-title', 'Child Record'); ?>
<?php $__env->startSection('page-sub', 'Manage individual child information'); ?>

<?php $__env->startSection('content'); ?>

<div class="table-card">
    <div class="table-header">
        <h3>Children Information</h3>
        
        <div style="display: flex; gap: 12px; align-items: center;">
            <div class="table-search">
                <form action="<?php echo e(route('children.index')); ?>" method="GET" style="margin: 0; display: flex; gap: 8px;">
                    <input type="text" name="search" placeholder="Search by name or LGU..." value="<?php echo e(request('search')); ?>">
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                </form>
            </div>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>LGU</th>
                    <th>Category</th>
                    <th>Date Recorded</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="font-weight: 500;"><?php echo e($child->name); ?></td>
                    <td><?php echo e($child->age); ?></td>
                    <td><?php echo e($child->lgu_name); ?></td>
                    <td>
                        <?php if($child->category): ?>
                            <span class="badge" style="background: var(--gold-light); color: var(--gold-dark); padding: 4px 8px; border-radius: 4px; font-size: 11px;"><?php echo e($child->category); ?></span>
                        <?php else: ?>
                            <span style="color: var(--muted); font-size: 12px;">General</span>
                        <?php endif; ?>
                    </td>
                    <td style="color: var(--muted); font-size: 13px;"><?php echo e($child->created_at->format('M d, Y')); ?></td>
                    <td class="action-cell">
                        <button class="btn-edit" onclick='openEditModal(<?php echo json_encode($child, 15, 512) ?>)'>Edit</button>
                        <form action="<?php echo e(route('children.destroy', $child->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: var(--muted);">No children records found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div style="padding: 16px; border-top: 1px solid var(--border);">
        <?php echo e($children->links('pagination::bootstrap-4')); ?>

    </div>
</div>

<!-- Modal: Add Record -->
<div class="modal-backdrop" id="modal-add">
    <div class="modal">
        <div class="modal-header">
            <h3>Add Child Record</h3>
            <button class="modal-close" onclick="closeModal('modal-add')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form action="<?php echo e(route('children.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-body form-grid" style="grid-template-columns: 1fr;">
                <div class="form-group">
                    <label>LGU Name</label>
                    <select name="lgu_name" class="form-control" required>
                        <option value="">-- Select LGU --</option>
                        <?php $__currentLoopData = $lgus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lgu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($lgu); ?>"><?php echo e($lgu); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="Juan Dela Cruz">
                </div>

                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control" required min="0" max="25" placeholder="e.g. 5">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeModal('modal-add')">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Record</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Record -->
<div class="modal-backdrop" id="modal-edit">
    <div class="modal">
        <div class="modal-header">
            <h3>Edit Child Record</h3>
            <button class="modal-close" onclick="closeModal('modal-edit')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form id="edit-form" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-body form-grid" style="grid-template-columns: 1fr;">
                <div class="form-group">
                    <label>LGU Name</label>
                    <select name="lgu_name" id="edit-lgu" class="form-control" required>
                        <option value="">-- Select LGU --</option>
                        <?php $__currentLoopData = $lgus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lgu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($lgu); ?>"><?php echo e($lgu); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" id="edit-name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" id="edit-age" class="form-control" required min="0" max="25">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeModal('modal-edit')">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Record</button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function openModal(id) {
        document.getElementById(id).classList.add('open');
    }
    
    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }

    function openEditModal(record) {
        let form = document.getElementById('edit-form');
        form.action = `/children/${record.id}`;
        document.getElementById('edit-lgu').value = record.lgu_name;
        document.getElementById('edit-name').value = record.name;
        document.getElementById('edit-age').value = record.age;
        openModal('modal-edit');
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\cswdo\resources\views/children/index.blade.php ENDPATH**/ ?>
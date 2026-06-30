<?php $__env->startSection('title', 'Add / Update Record'); ?>
<?php $__env->startSection('page-title', 'Add / Update Record'); ?>
<?php $__env->startSection('page-sub', 'Enter or update data for any LGU across all categories'); ?>

<?php $__env->startSection('content'); ?>

<div class="form-card">
    <div class="form-tabs">
        <button class="form-tab active" data-tab="population">Population</button>
        <button class="form-tab" data-tab="survival">Survival</button>
        <button class="form-tab" data-tab="development">Development</button>
        <button class="form-tab" data-tab="protection">Protection</button>
        <button class="form-tab" data-tab="disability">Disability</button>
        <button class="form-tab" data-tab="ip">IP Children</button>
    </div>

    
    <div class="form-panel active" id="panel-population">
        <p style="font-size:13px; color:var(--muted); margin-bottom:20px;">
            Add or update the total child population for an LGU. If the LGU already exists, values will be overwritten.
        </p>
        <form method="POST" action="<?php echo e(route('add.population')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label for="p_lgu">Name of LGU *</label>
                    <select name="lgu_name" id="p_lgu" class="form-control" required>
                        <option value="">— Select LGU —</option>
                        <?php $__currentLoopData = ['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lgu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lgu); ?>"><?php echo e($lgu); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Male</label>
                    <input type="number" name="male" class="form-control" min="0" placeholder="e.g. 3629">
                </div>
                <div class="form-group">
                    <label>Female</label>
                    <input type="number" name="female" class="form-control" min="0" placeholder="e.g. 3320">
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="number" name="total" class="form-control" min="0" placeholder="e.g. 6949">
                    <span class="hint">Leave blank to auto-sum Male + Female</span>
                </div>
            </div>
            <div class="form-footer" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary">Save Population Record</button>
                <a href="<?php echo e(route('records.population')); ?>" class="btn btn-outline">View Records</a>
            </div>
        </form>
    </div>

    
    <div class="form-panel" id="panel-survival">
        <p style="font-size:13px; color:var(--muted); margin-bottom:20px;">
            Add or update survival indicators including immunization rates and 0-59 month data.
        </p>
        <form method="POST" action="<?php echo e(route('add.survival')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Name of LGU *</label>
                    <select name="lgu_name" class="form-control" required>
                        <option value="">— Select LGU —</option>
                        <?php $__currentLoopData = ['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lgu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lgu); ?>"><?php echo e($lgu); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Immunization Rate (%)</label>
                    <input type="number" step="0.01" name="immunization_rate" class="form-control" min="0" max="100" placeholder="e.g. 97.85">
                    <span class="hint">Fully immunized children aged 12 months</span>
                </div>
                <div class="form-group">
                    <label>Total Population 12 Months Old</label>
                    <input type="number" name="total_pop_12_months" class="form-control" min="0" placeholder="e.g. 300">
                </div>
                <div class="form-group">
                    <label>Actual 0-59 Months Old Weighed</label>
                    <input type="number" name="actual_0_59_months_weighed" class="form-control" min="0" placeholder="e.g. 1482">
                </div>
                <div class="form-group">
                    <label>Total Population 0-59 Months Old</label>
                    <input type="number" name="total_pop_0_59_months" class="form-control" min="0" placeholder="e.g. 1628">
                </div>
                <div class="form-group">
                    <label>Pregnant Adolescents (10-19 yrs)</label>
                    <input type="number" name="pregnant_adolescents_10_19" class="form-control" min="0" placeholder="e.g. 24">
                </div>
            </div>
            <div class="form-footer" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary">Save Survival Record</button>
                <a href="<?php echo e(route('records.survival')); ?>" class="btn btn-outline">View Records</a>
            </div>
        </form>
    </div>

    
    <div class="form-panel" id="panel-development">
        <p style="font-size:13px; color:var(--muted); margin-bottom:20px;">
            Add or update school enrollment and reintegration data per LGU.
        </p>
        <form method="POST" action="<?php echo e(route('add.development')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Name of LGU *</label>
                    <select name="lgu_name" class="form-control" required>
                        <option value="">— Select LGU —</option>
                        <?php $__currentLoopData = ['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lgu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lgu); ?>"><?php echo e($lgu); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <div class="form-footer" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary">Save Development Record</button>
                <a href="<?php echo e(route('records.development')); ?>" class="btn btn-outline">View Records</a>
            </div>
        </form>
    </div>

    
    <div class="form-panel" id="panel-protection">
        <p style="font-size:13px; color:var(--muted); margin-bottom:20px;">
            Record CNSP and CAR/CICL case data per LGU.
        </p>
        <form method="POST" action="<?php echo e(route('add.protection')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Name of LGU *</label>
                    <select name="lgu_name" class="form-control" required>
                        <option value="">— Select LGU —</option>
                        <?php $__currentLoopData = ['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lgu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lgu); ?>"><?php echo e($lgu); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>CNSP Cases</label>
                    <input type="number" name="cnsp_cases" class="form-control" min="0" placeholder="e.g. 2">
                    <span class="hint">Children in Need of Special Protection</span>
                </div>
                <div class="form-group">
                    <label>Total CAR and CICL Cases</label>
                    <input type="number" name="car_cicl_cases" class="form-control" min="0" placeholder="e.g. 13">
                </div>
                <div class="form-group">
                    <label>CAR/CICL — Male</label>
                    <input type="number" name="car_cicl_male" class="form-control" min="0" placeholder="e.g. 12">
                </div>
                <div class="form-group">
                    <label>CAR/CICL — Female</label>
                    <input type="number" name="car_cicl_female" class="form-control" min="0" placeholder="e.g. 3">
                </div>
                <div class="form-group">
                    <label>CAR/CICL — Total</label>
                    <input type="number" name="car_cicl_total" class="form-control" min="0" placeholder="e.g. 15">
                </div>
            </div>
            <div class="form-footer" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary">Save Protection Record</button>
                <a href="<?php echo e(route('records.protection')); ?>" class="btn btn-outline">View Records</a>
            </div>
        </form>
    </div>

    
    <div class="form-panel" id="panel-disability">
        <p style="font-size:13px; color:var(--muted); margin-bottom:20px;">
            Add or update children with disability records per LGU.
        </p>
        <form method="POST" action="<?php echo e(route('add.disability')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Name of LGU *</label>
                    <select name="lgu_name" class="form-control" required>
                        <option value="">— Select LGU —</option>
                        <?php $__currentLoopData = ['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lgu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lgu); ?>"><?php echo e($lgu); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Male</label>
                    <input type="number" name="male" class="form-control" min="0" placeholder="e.g. 40">
                </div>
                <div class="form-group">
                    <label>Female</label>
                    <input type="number" name="female" class="form-control" min="0" placeholder="e.g. 43">
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="number" name="total" class="form-control" min="0" placeholder="e.g. 83">
                </div>
            </div>
            <div class="form-footer" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary">Save Disability Record</button>
                <a href="<?php echo e(route('records.disability')); ?>" class="btn btn-outline">View Records</a>
            </div>
        </form>
    </div>

    
    <div class="form-panel" id="panel-ip">
        <p style="font-size:13px; color:var(--muted); margin-bottom:20px;">
            Add or update Indigenous Peoples children data per LGU. Enter N/A by leaving the field blank.
        </p>
        <form method="POST" action="<?php echo e(route('add.ip')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Name of LGU *</label>
                    <select name="lgu_name" class="form-control" required>
                        <option value="">— Select LGU —</option>
                        <?php $__currentLoopData = ['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lgu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lgu); ?>"><?php echo e($lgu); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Male</label>
                    <input type="number" name="male" class="form-control" min="0" placeholder="Leave blank for N/A">
                </div>
                <div class="form-group">
                    <label>Female</label>
                    <input type="number" name="female" class="form-control" min="0" placeholder="Leave blank for N/A">
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="number" name="total" class="form-control" min="0" placeholder="Leave blank for N/A">
                </div>
            </div>
            <div class="form-footer" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary">Save IP Children Record</button>
                <a href="<?php echo e(route('records.ip')); ?>" class="btn btn-outline">View Records</a>
            </div>
        </form>
    </div>

</div>


<div style="margin-top:20px; padding:16px 20px; background:var(--white); border-radius:12px; border-left:4px solid var(--gold); box-shadow:var(--shadow); font-size:13px; color:var(--muted); line-height:1.6;">
    <strong style="color:var(--text);">Note:</strong> Submitting a record for an LGU that already exists will <strong>update</strong> the existing entry rather than create a duplicate. All fields except LGU name are optional — leave blank if data is unavailable.
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\cswdo\resources\views\records\add.blade.php ENDPATH**/ ?>
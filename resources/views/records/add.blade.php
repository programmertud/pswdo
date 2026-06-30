@extends('layouts.app')
@section('title', 'Add / Update Record')
@section('page-title', 'Add / Update Record')
@section('page-sub', 'Enter or update data for any LGU across all categories')

@section('content')

<style>
    .form-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        padding: 40px;
        margin-top: 20px;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .form-tabs {
        display: flex;
        gap: 12px;
        margin-bottom: 32px;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 12px;
        overflow-x: auto;
    }
    .form-tab {
        background: transparent;
        border: none;
        padding: 12px 24px;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
        white-space: nowrap;
    }
    .form-tab:hover {
        background: #f1f5f9;
        color: #334155;
    }
    .form-tab.active {
        color: var(--primary);
        background: #f0fdf4;
    }
    .form-tab.active::after {
        content: '';
        position: absolute;
        bottom: -14px;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--primary);
        border-radius: 3px;
    }
    .form-group label {
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
        display: block;
        font-size: 0.9rem;
    }
    .form-control {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 14px 16px;
        width: 100%;
        transition: all 0.2s ease;
        font-size: 0.95rem;
        background-color: #f8fafc;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        background-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.15);
    }
    .btn {
        padding: 12px 28px;
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.2s ease;
    }
    .btn-primary {
        background: var(--primary);
        color: #000000 !important;
        border: none;
        font-weight: 700;
        box-shadow: 0 4px 6px -1px rgba(34, 197, 94, 0.2), 0 2px 4px -1px rgba(34, 197, 94, 0.1);
    }
    .btn-primary:hover {
        background: #16a34a;
        color: #000000 !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 12px -1px rgba(34, 197, 94, 0.3), 0 4px 6px -1px rgba(34, 197, 94, 0.2);
    }
    .btn-outline {
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;
    }
    .btn-outline:hover {
        background: #f8fafc;
        border-color: #94a3b8;
    }
    .child-info-section {
        background: #fefce8;
        border-radius: 12px;
        padding: 24px;
        border: 1px dashed #ca8a04;
        margin-top: 16px;
    }
    .child-info-section label {
        color: #ca8a04 !important;
        font-size: 1.05rem;
    }
</style>

<div class="form-card">
    <div class="form-tabs">
        <button class="form-tab active" data-tab="population">Population</button>
        <button class="form-tab" data-tab="survival">Survival</button>
        <button class="form-tab" data-tab="development">Development</button>
        <button class="form-tab" data-tab="protection">Protection</button>
        <button class="form-tab" data-tab="disability">Disability</button>
        <button class="form-tab" data-tab="ip">IP Children</button>
    </div>

    {{-- ── POPULATION ─────────────────────────────────────────────── --}}
    <div class="form-panel active" id="panel-population">
        <p style="font-size:13px; color:var(--muted); margin-bottom:20px;">
            Add or update the total child population for an LGU. If the LGU already exists, values will be overwritten.
        </p>
        <form method="POST" action="{{ route('add.population') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label for="p_lgu">Name of LGU *</label>
                    <select name="lgu_name" id="p_lgu" class="form-control" required>
                        <option value="">— Select LGU —</option>
                        @foreach(['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City'] as $lgu)
                        <option value="{{ $lgu }}">{{ $lgu }}</option>
                        @endforeach
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
                <a href="{{ route('records.population') }}" class="btn btn-outline">View Records</a>
            </div>
        </form>
    </div>

    {{-- ── SURVIVAL ───────────────────────────────────────────────── --}}
    <div class="form-panel" id="panel-survival">
        <p style="font-size:13px; color:var(--muted); margin-bottom:20px;">
            Add or update survival indicators including immunization rates and 0-59 month data.
        </p>
        <form method="POST" action="{{ route('add.survival') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Name of LGU *</label>
                    <select name="lgu_name" class="form-control" required>
                        <option value="">— Select LGU —</option>
                        @foreach(['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City'] as $lgu)
                        <option value="{{ $lgu }}">{{ $lgu }}</option>
                        @endforeach
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
                <div class="form-group child-info-section" style="grid-column:1/-1;">
                    <label style="font-weight: bold;">Individual Child Info (Required)</label>
                    <p style="font-size:12px; color:#854d0e; margin-bottom: 12px;">This child will be saved to the Child Records database. Name and age are required.</p>
                    <div style="display: flex; gap: 16px;">
                        <input type="text" name="child_name" class="form-control" placeholder="Child's Name" required>
                        <input type="number" name="child_age" class="form-control" placeholder="Age" min="0" required style="max-width: 120px;">
                    </div>
                </div>
            </div>
            <div class="form-footer" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary">Save Survival Record</button>
                <a href="{{ route('records.survival') }}" class="btn btn-outline">View Records</a>
            </div>
        </form>
    </div>

    {{-- ── DEVELOPMENT ────────────────────────────────────────────── --}}
    <div class="form-panel" id="panel-development">
        <p style="font-size:13px; color:var(--muted); margin-bottom:20px;">
            Add or update school enrollment and reintegration data per LGU.
        </p>
        <form method="POST" action="{{ route('add.development') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Name of LGU *</label>
                    <select name="lgu_name" class="form-control" required>
                        <option value="">— Select LGU —</option>
                        @foreach(['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City'] as $lgu)
                        <option value="{{ $lgu }}">{{ $lgu }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Gender *</label>
                    <select name="gender" class="form-control" required>
                        <option value="">— Select Gender —</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <input type="text" name="remarks" class="form-control" placeholder="e.g. Only ECCD enrollees">
                </div>
                <div class="form-group child-info-section" style="grid-column:1/-1;">
                    <label style="font-weight: bold;">Individual Child Info (Required)</label>
                    <p style="font-size:12px; color:#854d0e; margin-bottom: 12px;">This child will be saved to the Child Records database. Name and age are required.</p>
                    <div style="display: flex; gap: 16px;">
                        <input type="text" name="child_name" class="form-control" placeholder="Child's Name" required>
                        <input type="number" name="child_age" class="form-control" placeholder="Age" min="0" required style="max-width: 120px;">
                    </div>
                </div>
            </div>
            <div class="form-footer" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary">Save Development Record</button>
                <a href="{{ route('records.development') }}" class="btn btn-outline">View Records</a>
            </div>
        </form>
    </div>

    {{-- ── PROTECTION ─────────────────────────────────────────────── --}}
    <div class="form-panel" id="panel-protection">
        <p style="font-size:13px; color:var(--muted); margin-bottom:20px;">
            Record CNSP and CAR/CICL case data per LGU.
        </p>
        <form method="POST" action="{{ route('add.protection') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Name of LGU *</label>
                    <select name="lgu_name" class="form-control" required>
                        <option value="">— Select LGU —</option>
                        @foreach(['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City'] as $lgu)
                        <option value="{{ $lgu }}">{{ $lgu }}</option>
                        @endforeach
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
                    <label>Gender *</label>
                    <select name="gender" class="form-control" required>
                        <option value="">— Select Gender —</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group child-info-section" style="grid-column:1/-1;">
                    <label style="font-weight: bold;">Individual Child Info (Required)</label>
                    <p style="font-size:12px; color:#854d0e; margin-bottom: 12px;">This child will be saved to the Child Records database. Name and age are required.</p>
                    <div style="display: flex; gap: 16px;">
                        <input type="text" name="child_name" class="form-control" placeholder="Child's Name" required>
                        <input type="number" name="child_age" class="form-control" placeholder="Age" min="0" required style="max-width: 120px;">
                    </div>
                </div>
            </div>
            <div class="form-footer" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary">Save Protection Record</button>
                <a href="{{ route('records.protection') }}" class="btn btn-outline">View Records</a>
            </div>
        </form>
    </div>

    {{-- ── DISABILITY ──────────────────────────────────────────────── --}}
    <div class="form-panel" id="panel-disability">
        <p style="font-size:13px; color:var(--muted); margin-bottom:20px;">
            Add or update children with disability records per LGU.
        </p>
        <form method="POST" action="{{ route('add.disability') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Name of LGU *</label>
                    <select name="lgu_name" class="form-control" required>
                        <option value="">— Select LGU —</option>
                        @foreach(['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City'] as $lgu)
                        <option value="{{ $lgu }}">{{ $lgu }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Gender *</label>
                    <select name="gender" class="form-control" required>
                        <option value="">— Select Gender —</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group child-info-section" style="grid-column:1/-1;">
                    <label style="font-weight: bold;">Individual Child Info (Required)</label>
                    <p style="font-size:12px; color:#854d0e; margin-bottom: 12px;">This child will be saved to the Child Records database. Name and age are required.</p>
                    <div style="display: flex; gap: 16px;">
                        <input type="text" name="child_name" class="form-control" placeholder="Child's Name" required>
                        <input type="number" name="child_age" class="form-control" placeholder="Age" min="0" required style="max-width: 120px;">
                    </div>
                </div>
            </div>
            <div class="form-footer" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary">Save Disability Record</button>
                <a href="{{ route('records.disability') }}" class="btn btn-outline">View Records</a>
            </div>
        </form>
    </div>

    {{-- ── IP CHILDREN ─────────────────────────────────────────────── --}}
    <div class="form-panel" id="panel-ip">
        <p style="font-size:13px; color:var(--muted); margin-bottom:20px;">
            Add or update Indigenous Peoples children data per LGU. Enter N/A by leaving the field blank.
        </p>
        <form method="POST" action="{{ route('add.ip') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Name of LGU *</label>
                    <select name="lgu_name" class="form-control" required>
                        <option value="">— Select LGU —</option>
                        @foreach(['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City'] as $lgu)
                        <option value="{{ $lgu }}">{{ $lgu }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Gender *</label>
                    <select name="gender" class="form-control" required>
                        <option value="">— Select Gender —</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group child-info-section" style="grid-column:1/-1;">
                    <label style="font-weight: bold;">Individual Child Info (Required)</label>
                    <p style="font-size:12px; color:#854d0e; margin-bottom: 12px;">This child will be saved to the Child Records database. Name and age are required.</p>
                    <div style="display: flex; gap: 16px;">
                        <input type="text" name="child_name" class="form-control" placeholder="Child's Name" required>
                        <input type="number" name="child_age" class="form-control" placeholder="Age" min="0" required style="max-width: 120px;">
                    </div>
                </div>
            </div>
            <div class="form-footer" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary">Save IP Children Record</button>
                <a href="{{ route('records.ip') }}" class="btn btn-outline">View Records</a>
            </div>
        </form>
    </div>

</div>

{{-- Info card --}}
<div style="margin-top:20px; padding:16px 20px; background:var(--white); border-radius:12px; border-left:4px solid var(--gold); box-shadow:var(--shadow); font-size:13px; color:var(--muted); line-height:1.6;">
    <strong style="color:var(--text);">Note:</strong> Submitting a record for an LGU that already exists will <strong>update</strong> the existing entry rather than create a duplicate. All fields except LGU name are optional — leave blank if data is unavailable.
</div>
</div>
@endsection

@push('scripts')
<script>
    function setupAutoSum(maleSelector, femaleSelector, totalSelector) {
        const maleInputs = document.querySelectorAll(maleSelector);
        const femaleInputs = document.querySelectorAll(femaleSelector);
        const totalInputs = document.querySelectorAll(totalSelector);

        if(maleInputs.length === 0) return;

        for (let i = 0; i < maleInputs.length; i++) {
            const m = maleInputs[i];
            const f = femaleInputs[i];
            const t = totalInputs[i];
            
            const calc = () => {
                const mv = parseInt(m.value) || 0;
                const fv = parseInt(f.value) || 0;
                if (m.value !== '' || f.value !== '') {
                    t.value = mv + fv;
                } else {
                    t.value = '';
                }
            };
            
            m.addEventListener('input', calc);
            f.addEventListener('input', calc);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        setupAutoSum('#panel-population input[name="male"]', '#panel-population input[name="female"]', '#panel-population input[name="total"]');
        setupAutoSum('#panel-development input[name="children_in_school_male"]', '#panel-development input[name="children_in_school_female"]', '#panel-development input[name="children_in_school_total"]');
        setupAutoSum('#panel-protection input[name="car_cicl_male"]', '#panel-protection input[name="car_cicl_female"]', '#panel-protection input[name="car_cicl_total"]');
        setupAutoSum('#panel-disability input[name="male"]', '#panel-disability input[name="female"]', '#panel-disability input[name="total"]');
        setupAutoSum('#panel-ip input[name="male"]', '#panel-ip input[name="female"]', '#panel-ip input[name="total"]');
    });
</script>
@endpush

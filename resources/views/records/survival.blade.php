@extends('layouts.app')
@section('title', 'Survival')
@section('page-title', 'Survival Records')
@section('page-sub', 'Immunization, 0-59 Months, Pregnant Adolescents — {{ date("Y") }}')

@php
$lgus = ['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna',
         'Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso',
         'San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City'];
@endphp

@section('content')
<div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; align-items:center;">
    <div class="stat-card gold" style="flex:1; min-width:160px;">
        <span class="stat-label">Avg. Immunization Rate</span>
        <span class="stat-value">{{ number_format($totals['avg_immunization'], 1) }}%</span>
    </div>
    <div class="stat-card navy" style="flex:1; min-width:160px;">
        <span class="stat-label">Total Pop. 12 Months</span>
        <span class="stat-value">{{ number_format($totals['total_pop_12_months']) }}</span>
    </div>
    <div class="stat-card teal" style="flex:1; min-width:160px;">
        <span class="stat-label">0-59 Months Weighed</span>
        <span class="stat-value">{{ number_format($totals['actual_0_59_months_weighed']) }}</span>
    </div>
    <div class="stat-card red" style="flex:1; min-width:160px;">
        <span class="stat-label">Pregnant Adolescents (10-19)</span>
        <span class="stat-value">{{ number_format($totals['pregnant_adolescents_10_19']) }}</span>
    </div>
    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
        <a href="{{ route('exports.download', ['dataset' => 'survival', 'format' => 'pdf']) }}" target="_blank" class="btn btn-outline btn-sm">Print</a>
        <a href="{{ route('exports.download', ['dataset' => 'survival', 'format' => 'excel']) }}" class="btn btn-outline btn-sm">Excel</a>
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
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $i => $r)
                @php
                    $rate = $r->immunization_rate ?? 0;
                    $cls  = $rate >= 85 ? 'pill-green' : ($rate >= 70 ? 'pill-amber' : 'pill-red');
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="lgu-name">{{ $r->lgu_name }}</td>
                    <td class="num">
                        @if($r->immunization_rate !== null)
                            <span class="pill {{ $cls }}">{{ number_format($r->immunization_rate, 2) }}%</span>
                        @else
                            <span class="null-dash">—</span>
                        @endif
                    </td>
                    <td class="num">{!! $r->total_pop_12_months !== null ? number_format($r->total_pop_12_months) : '<span class="null-dash">—</span>' !!}</td>
                    <td class="num">{!! $r->actual_0_59_months_weighed !== null ? number_format($r->actual_0_59_months_weighed) : '<span class="null-dash">—</span>' !!}</td>
                    <td class="num">{!! $r->total_pop_0_59_months !== null ? number_format($r->total_pop_0_59_months) : '<span class="null-dash">—</span>' !!}</td>
                    <td class="num">{!! $r->pregnant_adolescents_10_19 !== null ? number_format($r->pregnant_adolescents_10_19) : '<span class="null-dash">—</span>' !!}</td>
                    <td class="action-cell" style="text-align:center;">
                        <button class="btn-edit" onclick="openEditModal({{ $r->id }}, '{{ addslashes($r->lgu_name) }}', {{ $r->immunization_rate ?? 'null' }}, {{ $r->total_pop_12_months ?? 'null' }}, {{ $r->actual_0_59_months_weighed ?? 'null' }}, {{ $r->total_pop_0_59_months ?? 'null' }}, {{ $r->pregnant_adolescents_10_19 ?? 'null' }})">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Edit
                        </button>
                        <form method="POST" action="{{ route('add.survival.destroy', $r->id) }}" style="display:inline;" onsubmit="return confirm('Delete survival record for {{ addslashes($r->lgu_name) }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="2"><strong>Total</strong></td>
                    <td class="num">{{ number_format($totals['avg_immunization'], 2) }}% avg</td>
                    <td class="num">{{ number_format($totals['total_pop_12_months']) }}</td>
                    <td class="num">{{ number_format($totals['actual_0_59_months_weighed']) }}</td>
                    <td class="num">{{ number_format($totals['total_pop_0_59_months']) }}</td>
                    <td class="num">{{ number_format($totals['pregnant_adolescents_10_19']) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

{{-- ── ADD MODAL ──────────────────────────────────────────────────── --}}
<div class="modal-backdrop" id="addModal">
    <div class="modal">
        <div class="modal-header">
            <h3>Add Survival Record</h3>
            <button class="modal-close" onclick="closeModal('addModal')">✕</button>
        </div>
        <form method="POST" action="{{ route('add.survival') }}">
            @csrf
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group" style="grid-column:1/-1;">
                        <label>Name of LGU *</label>
                        <select name="lgu_name" class="form-control" required>
                            <option value="">— Select LGU —</option>
                            @foreach($lgus as $lgu)<option value="{{ $lgu }}">{{ $lgu }}</option>@endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Immunization Rate (%)</label>
                        <input type="number" step="0.01" name="immunization_rate" class="form-control" min="0" max="100" placeholder="e.g. 97.85">
                    </div>
                    <div class="form-group">
                        <label>Total Pop. 12 Months</label>
                        <input type="number" name="total_pop_12_months" class="form-control" min="0" placeholder="e.g. 300">
                    </div>
                    <div class="form-group">
                        <label>0-59 Months Weighed</label>
                        <input type="number" name="actual_0_59_months_weighed" class="form-control" min="0" placeholder="e.g. 1482">
                    </div>
                    <div class="form-group">
                        <label>Total Pop. 0-59 Months</label>
                        <input type="number" name="total_pop_0_59_months" class="form-control" min="0" placeholder="e.g. 1628">
                    </div>
                    <div class="form-group">
                        <label>Pregnant Adolescents (10-19)</label>
                        <input type="number" name="pregnant_adolescents_10_19" class="form-control" min="0" placeholder="e.g. 24">
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

{{-- ── EDIT MODAL ──────────────────────────────────────────────────── --}}
<div class="modal-backdrop" id="editModal">
    <div class="modal">
        <div class="modal-header">
            <h3>Edit Survival Record</h3>
            <button class="modal-close" onclick="closeModal('editModal')">✕</button>
        </div>
        <form method="POST" id="editForm" action="">
            @csrf
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group" style="grid-column:1/-1;">
                        <label>Name of LGU *</label>
                        <select name="lgu_name" id="edit_lgu" class="form-control" required>
                            <option value="">— Select LGU —</option>
                            @foreach($lgus as $lgu)<option value="{{ $lgu }}">{{ $lgu }}</option>@endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Immunization Rate (%)</label>
                        <input type="number" step="0.01" name="immunization_rate" id="edit_imm" class="form-control" min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label>Total Pop. 12 Months</label>
                        <input type="number" name="total_pop_12_months" id="edit_pop12" class="form-control" min="0">
                    </div>
                    <div class="form-group">
                        <label>0-59 Months Weighed</label>
                        <input type="number" name="actual_0_59_months_weighed" id="edit_weighed" class="form-control" min="0">
                    </div>
                    <div class="form-group">
                        <label>Total Pop. 0-59 Months</label>
                        <input type="number" name="total_pop_0_59_months" id="edit_pop59" class="form-control" min="0">
                    </div>
                    <div class="form-group">
                        <label>Pregnant Adolescents (10-19)</label>
                        <input type="number" name="pregnant_adolescents_10_19" id="edit_preg" class="form-control" min="0">
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
@endsection

@push('scripts')
<script>
function openAddModal() { document.getElementById('addModal').classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
function openEditModal(id, lgu, imm, pop12, weighed, pop59, preg) {
    document.getElementById('editForm').action = '/add/survival/' + id;
    document.getElementById('edit_lgu').value    = lgu;
    document.getElementById('edit_imm').value    = imm ?? '';
    document.getElementById('edit_pop12').value  = pop12 ?? '';
    document.getElementById('edit_weighed').value= weighed ?? '';
    document.getElementById('edit_pop59').value  = pop59 ?? '';
    document.getElementById('edit_preg').value   = preg ?? '';
    document.getElementById('editModal').classList.add('open');
}
document.querySelectorAll('.modal-backdrop').forEach(b => {
    b.addEventListener('click', function(e) { if(e.target === this) this.classList.remove('open'); });
});
</script>
@endpush

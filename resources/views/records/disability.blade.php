@extends('layouts.app')
@section('title', 'Children with Disability')
@section('page-title', 'Children with Disability')
@section('page-sub', 'By Local Government Unit — Surigao del Norte {{ date("Y") }}')

@php
$lgus = ['Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna',
         'Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso',
         'San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City'];
@endphp

@section('content')
<div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; align-items:center;">
    <div class="stat-card teal" style="flex:1; min-width:160px;">
        <span class="stat-label">Total</span>
        <span class="stat-value">{{ number_format($totals['total']) }}</span>
    </div>
    <div class="stat-card navy" style="flex:1; min-width:160px;">
        <span class="stat-label">Male</span>
        <span class="stat-value">{{ number_format($totals['male']) }}</span>
    </div>
    <div class="stat-card navy" style="flex:1; min-width:160px;">
        <span class="stat-label">Female</span>
        <span class="stat-value">{{ number_format($totals['female']) }}</span>
    </div>
    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
        <a href="{{ route('exports.download', ['dataset' => 'disability', 'format' => 'pdf']) }}" target="_blank" class="btn btn-outline btn-sm">Print</a>
        <a href="{{ route('exports.download', ['dataset' => 'disability', 'format' => 'excel']) }}" class="btn btn-outline btn-sm">Excel</a>
    </div>
</div>

<div class="table-card">
    <div class="table-header">
        <h3>Disability Records by LGU</h3>
        <div class="table-search"><input type="text" placeholder="Search LGU…"></div>
    </div>
    <div style="overflow-x:auto;">
        <table class="data-table theme-disability">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>LGU</th>
                    <th class="num">Male</th>
                    <th class="num">Female</th>
                    <th class="num">Total</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $i => $r)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="lgu-name">{{ $r->lgu_name }}</td>
                    <td class="num">{!! $r->male !== null ? number_format($r->male) : '<span class="null-dash">—</span>' !!}</td>
                    <td class="num">{!! $r->female !== null ? number_format($r->female) : '<span class="null-dash">—</span>' !!}</td>
                    <td class="num">
                        @if($r->total !== null)
                            @php $t = $r->total; $cls = $t >= 70 ? 'pill-red' : ($t >= 30 ? 'pill-amber' : 'pill-green'); @endphp
                            <span class="pill {{ $cls }}"><strong>{{ number_format($t) }}</strong></span>
                        @else
                            <span class="null-dash">—</span>
                        @endif
                    </td>
                    <td class="action-cell" style="text-align:center;">
                        <button class="btn-edit" onclick="openEditModal({{ $r->id }}, '{{ addslashes($r->lgu_name) }}', {{ $r->male ?? 'null' }}, {{ $r->female ?? 'null' }}, {{ $r->total ?? 'null' }})">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Edit
                        </button>
                        <form method="POST" action="{{ route('add.disability.destroy', $r->id) }}" style="display:inline;" onsubmit="return confirm('Delete disability record for {{ addslashes($r->lgu_name) }}?')">
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
                    <td class="num">{{ number_format($totals['male']) }}</td>
                    <td class="num">{{ number_format($totals['female']) }}</td>
                    <td class="num">{{ number_format($totals['total']) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

{{-- ADD MODAL --}}
<div class="modal-backdrop" id="addModal">
    <div class="modal">
        <div class="modal-header">
            <h3>Add Disability Record</h3>
            <button class="modal-close" onclick="closeModal('addModal')">✕</button>
        </div>
        <form method="POST" action="{{ route('add.disability') }}">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-sm" onclick="closeModal('addModal')">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm">Save Record</button>
            </div>
        </form>
    </div>
</div>

{{-- EDIT MODAL --}}
<div class="modal-backdrop" id="editModal">
    <div class="modal">
        <div class="modal-header">
            <h3>Edit Disability Record</h3>
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
                        <label>Male</label>
                        <input type="number" name="male" id="edit_male" class="form-control" min="0">
                    </div>
                    <div class="form-group">
                        <label>Female</label>
                        <input type="number" name="female" id="edit_female" class="form-control" min="0">
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <input type="number" name="total" id="edit_total" class="form-control" min="0">
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
function openEditModal(id, lgu, male, female, total) {
    document.getElementById('editForm').action = '/add/disability/' + id;
    document.getElementById('edit_lgu').value    = lgu;
    document.getElementById('edit_male').value   = male ?? '';
    document.getElementById('edit_female').value = female ?? '';
    document.getElementById('edit_total').value  = total ?? '';
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
@endpush

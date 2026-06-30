@extends('layouts.app')

@section('title', 'Child Record')
@section('page-title', 'Child Record')
@section('page-sub', 'Manage individual child information')

@section('content')

<div class="table-card">
    <div class="table-header">
        <h3>Children Information</h3>
        
        <div style="display: flex; gap: 12px; align-items: center;">
            <div class="table-search">
                <form action="{{ route('children.index') }}" method="GET" style="margin: 0; display: flex; gap: 8px;">
                    <input type="text" name="search" placeholder="Search by name or LGU..." value="{{ request('search') }}">
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
                @forelse($children as $child)
                <tr>
                    <td style="font-weight: 500;">{{ $child->name }}</td>
                    <td>{{ $child->age }}</td>
                    <td>{{ $child->lgu_name }}</td>
                    <td>
                        @if($child->category)
                            <span class="badge" style="background: var(--gold-light); color: var(--gold-dark); padding: 4px 8px; border-radius: 4px; font-size: 11px;">{{ $child->category }}</span>
                        @else
                            <span style="color: var(--muted); font-size: 12px;">General</span>
                        @endif
                    </td>
                    <td style="color: var(--muted); font-size: 13px;">{{ $child->created_at->format('M d, Y') }}</td>
                    <td class="action-cell">
                        <button class="btn-edit" onclick='openEditModal(@json($child))'>Edit</button>
                        <form action="{{ route('children.destroy', $child->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: var(--muted);">No children records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 16px; border-top: 1px solid var(--border);">
        {{ $children->links('pagination::bootstrap-4') }}
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
        <form action="{{ route('children.store') }}" method="POST">
            @csrf
            <div class="modal-body form-grid" style="grid-template-columns: 1fr;">
                <div class="form-group">
                    <label>LGU Name</label>
                    <select name="lgu_name" class="form-control" required>
                        <option value="">-- Select LGU --</option>
                        @foreach($lgus as $lgu)
                            <option value="{{ $lgu }}">{{ $lgu }}</option>
                        @endforeach
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
            @csrf
            @method('PUT')
            <div class="modal-body form-grid" style="grid-template-columns: 1fr;">
                <div class="form-group">
                    <label>LGU Name</label>
                    <select name="lgu_name" id="edit-lgu" class="form-control" required>
                        <option value="">-- Select LGU --</option>
                        @foreach($lgus as $lgu)
                            <option value="{{ $lgu }}">{{ $lgu }}</option>
                        @endforeach
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

@endsection

@push('scripts')
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
@endpush

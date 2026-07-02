@extends('layouts.app')
@section('title', 'User Management')
@section('page-title', 'User Management')
@section('page-sub', 'Manage administrator accounts for this system')

@section('content')
<div style="padding: 0 28px 28px;">

    @if(session('success'))
        <div class="alert alert-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if($errors->has('delete'))
        <div class="alert alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ $errors->first('delete') }}
        </div>
    @endif

    <div style="display:grid; grid-template-columns: 1fr 380px; gap:24px; align-items:start;">

        {{-- User List --}}
        <div class="table-card">
            <div class="table-card-header">
                <h3 class="table-card-title">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                    All Users ({{ count($users) }})
                </h3>
            </div>
            <table class="data-table" style="margin: 0;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="text-align:left;">Name</th>
                        <th>Username</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $i => $u)
                        <tr>
                            <td class="num">{{ $i + 1 }}</td>
                            <td style="text-align:left; font-weight:600;">
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <div style="width:34px; height:34px; border-radius:50%; background:var(--navy); color:#fff; display:flex; align-items:center; justify-content:center; font-size:13px; font-weight:700; flex-shrink:0;">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $u->name }}</span>
                                </div>
                            </td>
                            <td>
                                <code style="background:#f1f5f9; padding:3px 7px; border-radius:4px; font-size:12px;">{{ $u->username }}</code>
                            </td>
                            <td style="font-size:12px; color:var(--muted);">{{ \Carbon\Carbon::parse($u->created_at)->format('M d, Y') }}</td>
                            <td>
                                @if($u->id != session('user_id'))
                                    <form method="POST" action="{{ route('users.destroy', $u->id) }}" onsubmit="return confirm('Delete user {{ $u->username }}? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background:#fee2e2; color:#dc2626; border:none; padding:5px 12px; border-radius:6px; font-size:11px; font-weight:600; cursor:pointer;">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <span style="font-size:11px; color:var(--muted);">Current</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="text-align:center; color:var(--muted); padding:24px;">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Add User Form --}}
        <div class="table-card">
            <div class="table-card-header">
                <h3 class="table-card-title">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                    Add New User
                </h3>
            </div>
            <form method="POST" action="{{ route('users.store') }}" style="padding: 20px; display:grid; gap:14px;">
                @csrf
                <div>
                    <label style="display:block; font-size:12px; font-weight:600; color:var(--muted); margin-bottom:5px; text-transform:uppercase; letter-spacing:.4px;">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Juan Dela Cruz"
                        style="width:100%; border:1px solid var(--border); border-radius:8px; padding:10px 14px; font-size:14px; outline:none;"
                        required>
                    @error('name') <span style="font-size:12px;color:var(--red);">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:600; color:var(--muted); margin-bottom:5px; text-transform:uppercase; letter-spacing:.4px;">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="e.g. juan.delacruz"
                        style="width:100%; border:1px solid var(--border); border-radius:8px; padding:10px 14px; font-size:14px; outline:none;"
                        required>
                    @error('username') <span style="font-size:12px;color:var(--red);">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:600; color:var(--muted); margin-bottom:5px; text-transform:uppercase; letter-spacing:.4px;">Password</label>
                    <input type="password" name="password" placeholder="Minimum 6 characters"
                        style="width:100%; border:1px solid var(--border); border-radius:8px; padding:10px 14px; font-size:14px; outline:none;"
                        required>
                    @error('password') <span style="font-size:12px;color:var(--red);">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:600; color:var(--muted); margin-bottom:5px; text-transform:uppercase; letter-spacing:.4px;">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Repeat password"
                        style="width:100%; border:1px solid var(--border); border-radius:8px; padding:10px 14px; font-size:14px; outline:none;"
                        required>
                </div>
                <button type="submit" class="btn btn-primary btn-sm" style="width:100%; justify-content:center; padding:12px;">
                    Create User
                </button>
            </form>
        </div>

    </div>
</div>
@endsection

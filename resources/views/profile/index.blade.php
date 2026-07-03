@extends('layouts.app')
@section('title', 'My Profile')
@section('page-title', 'My Profile')
@section('page-sub', 'Update your personal information and password')

@section('content')
<div style="max-width: 720px; margin: 0 auto; padding: 0 28px 28px;">

    {{-- Profile Info Card --}}
    <div class="table-card" style="margin-bottom: 24px;">
        <div class="table-card-header" style="display:flex; align-items:center; gap:14px;">
            <div style="width:52px; height:52px; border-radius:50%; background:var(--navy); color:#fff; display:flex; align-items:center; justify-content:center; font-size:22px; font-weight:700; flex-shrink:0;">
                {{ strtoupper(substr(session('name', 'A'), 0, 1)) }}
            </div>
            <div>
                <h3 style="font-size:17px; font-weight:700; color:var(--navy); margin:0;">{{ session('name') }}</h3>
                <span style="font-size:12px; color:var(--muted);">{{ session('username') }} &bull; Administrator</span>
            </div>
        </div>
    </div>

    {{-- Update Profile Form --}}
    <div class="table-card" style="margin-bottom: 24px;">
        <div class="table-card-header">
            <h3 class="table-card-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Edit Profile
            </h3>
        </div>

        @if(session('success') && !str_contains(session('success'), 'Password'))
            <div class="alert alert-success" style="margin: 0 20px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" style="padding: 20px; display:grid; gap:16px;">
            @csrf
            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:var(--muted); margin-bottom:5px; text-transform:uppercase; letter-spacing:.4px;">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                    style="width:100%; border:1px solid var(--border); border-radius:8px; padding:10px 14px; font-size:14px; outline:none; transition:border-color .15s;"
                    required>
                @error('name') <span style="font-size:12px;color:var(--red);">{{ $message }}</span> @enderror
            </div>
            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:var(--muted); margin-bottom:5px; text-transform:uppercase; letter-spacing:.4px;">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username ?? '') }}"
                    style="width:100%; border:1px solid var(--border); border-radius:8px; padding:10px 14px; font-size:14px; outline:none; transition:border-color .15s;"
                    required>
                @error('username') <span style="font-size:12px;color:var(--red);">{{ $message }}</span> @enderror
            </div>
            <div style="display:flex; justify-content:flex-end;">
                <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
            </div>
        </form>
    </div>

    {{-- Change Password Form --}}
    <div class="table-card">
        <div class="table-card-header">
            <h3 class="table-card-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                Change Password
            </h3>
        </div>

        @if(session('success') && str_contains(session('success'), 'Password'))
            <div class="alert alert-success" style="margin: 0 20px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.password') }}" style="padding: 20px; display:grid; gap:16px;">
            @csrf
            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:var(--muted); margin-bottom:5px; text-transform:uppercase; letter-spacing:.4px;">Current Password</label>
                <input type="password" name="current_password"
                    style="width:100%; border:1px solid var(--border); border-radius:8px; padding:10px 14px; font-size:14px; outline:none;"
                    required>
                @error('current_password') <span style="font-size:12px;color:var(--red);">{{ $message }}</span> @enderror
            </div>
            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:var(--muted); margin-bottom:5px; text-transform:uppercase; letter-spacing:.4px;">New Password</label>
                <input type="password" name="new_password"
                    style="width:100%; border:1px solid var(--border); border-radius:8px; padding:10px 14px; font-size:14px; outline:none;"
                    required>
                @error('new_password') <span style="font-size:12px;color:var(--red);">{{ $message }}</span> @enderror
            </div>
            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:var(--muted); margin-bottom:5px; text-transform:uppercase; letter-spacing:.4px;">Confirm New Password</label>
                <input type="password" name="new_password_confirmation"
                    style="width:100%; border:1px solid var(--border); border-radius:8px; padding:10px 14px; font-size:14px; outline:none;"
                    required>
            </div>
            <div style="display:flex; justify-content:flex-end;">
                <button type="submit" class="btn btn-primary btn-sm">Update Password</button>
            </div>
        </form>
    </div>
</div>
@endsection

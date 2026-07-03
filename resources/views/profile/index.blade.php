@extends('layouts.app')
@section('title', 'My Profile')
@section('page-title', 'My Profile')
@section('page-sub', 'Manage your account information and security')

@push('styles')
<style>
    .profile-wrapper {
        max-width: 860px;
        margin: 0 auto;
    }

    /* ── Hero Banner ── */
    .profile-hero {
        background: linear-gradient(135deg, #0f2d5e 0%, #1a3a6e 50%, #0d9488 100%);
        border-radius: 20px;
        padding: 40px 36px 80px;
        position: relative;
        overflow: hidden;
        margin-bottom: 0;
    }
    .profile-hero::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
    }
    .profile-hero::after {
        content: '';
        position: absolute;
        bottom: -60px; left: 30%;
        width: 300px; height: 300px;
        border-radius: 50%;
        background: rgba(255,255,255,.04);
    }
    .hero-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 22px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 4px;
    }
    .hero-sub {
        font-size: 13px;
        color: rgba(255,255,255,.6);
    }

    /* ── Avatar Section ── */
    .avatar-section {
        display: flex;
        align-items: flex-end;
        gap: 24px;
        padding: 0 36px;
        margin-top: -52px;
        margin-bottom: 28px;
        position: relative;
        z-index: 10;
    }
    .avatar-wrapper {
        position: relative;
        flex-shrink: 0;
    }
    .avatar-img {
        width: 104px;
        height: 104px;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 4px 20px rgba(0,0,0,.18);
        object-fit: cover;
        background: var(--navy);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 38px;
        font-weight: 800;
        color: #fff;
    }
    .avatar-initials {
        width: 104px;
        height: 104px;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 4px 20px rgba(0,0,0,.18);
        background: linear-gradient(135deg, #0f2d5e, #0d9488);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 36px;
        font-weight: 800;
        color: #fff;
    }
    .avatar-edit-btn {
        position: absolute;
        bottom: 4px;
        right: 4px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--gold);
        border: 2px solid #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform .15s, background .15s;
        box-shadow: 0 2px 8px rgba(0,0,0,.2);
    }
    .avatar-edit-btn:hover { transform: scale(1.1); background: var(--gold-lt); }
    .avatar-info {
        padding-bottom: 8px;
    }
    .avatar-info h2 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 20px;
        font-weight: 800;
        color: var(--text);
        margin: 0 0 3px;
    }
    .avatar-info p {
        font-size: 13px;
        color: var(--muted);
    }
    .role-badge {
        display: inline-block;
        background: linear-gradient(135deg, #0f2d5e, #1a3a6e);
        color: #fff;
        font-size: 10.5px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
        letter-spacing: .4px;
        margin-top: 4px;
    }

    /* ── Cards ── */
    .profile-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,.08), 0 4px 16px rgba(0,0,0,.04);
        overflow: hidden;
        margin-bottom: 20px;
        border: 1px solid #f0f4f9;
    }
    .profile-card-header {
        padding: 20px 28px 16px;
        border-bottom: 1px solid #f0f4f9;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .profile-card-header-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .icon-blue  { background: #dbeafe; color: #1d4ed8; }
    .icon-amber { background: #fef3c7; color: #b45309; }
    .icon-red   { background: #fee2e2; color: #dc2626; }
    .icon-green { background: #dcfce7; color: #15803d; }

    .profile-card-header h3 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: var(--text);
    }
    .profile-card-header p {
        font-size: 12px;
        color: var(--muted);
        margin-top: 1px;
    }
    .profile-card-body { padding: 24px 28px; }

    /* ── Form Fields ── */
    .field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    .field-grid .full { grid-column: 1 / -1; }

    .field-group { display: flex; flex-direction: column; gap: 6px; }
    .field-label {
        font-size: 11.5px;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: .5px;
    }
    .field-input {
        width: 100%;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        padding: 11px 14px;
        font-size: 13.5px;
        font-family: 'Inter', sans-serif;
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        background: #fafbfc;
        color: var(--text);
    }
    .field-input:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(15,45,94,.08);
        background: #fff;
    }
    .field-input::placeholder { color: #b0bec5; }
    .field-error { font-size: 11.5px; color: var(--red); margin-top: 2px; }

    /* ── Password strength ── */
    .strength-bar { height: 4px; border-radius: 4px; background: #f1f5f9; margin-top: 6px; overflow: hidden; }
    .strength-fill { height: 100%; border-radius: 4px; transition: width .3s, background .3s; width: 0; }

    /* ── Buttons ── */
    .btn-save {
        background: linear-gradient(135deg, #0f2d5e, #1a3a6e);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 11px 24px;
        font-size: 13.5px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all .15s;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }
    .btn-save:hover { opacity: .9; transform: translateY(-1px); }

    .btn-pwd {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 11px 24px;
        font-size: 13.5px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all .15s;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }
    .btn-pwd:hover { opacity: .9; transform: translateY(-1px); }

    .card-footer {
        padding: 16px 28px;
        background: #fafbfc;
        border-top: 1px solid #f0f4f9;
        display: flex;
        justify-content: flex-end;
    }

    /* ── Alert ── */
    .profile-alert {
        margin: 16px 28px 0;
        padding: 11px 16px;
        border-radius: 10px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 9px;
    }
    .profile-alert.success { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .profile-alert.error   { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

    /* ── Photo preview overlay ── */
    #avatar-preview-wrapper { position: relative; display: inline-block; }
    #avatar-file-input { display: none; }

    /* ── Stats strip ── */
    .stats-strip {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }
    .stat-chip {
        background: #fff;
        border-radius: 12px;
        padding: 14px 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,.07);
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
        border: 1px solid #f0f4f9;
    }
    .stat-chip-icon {
        width: 38px; height: 38px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .stat-chip-label { font-size: 11px; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: .4px; }
    .stat-chip-value { font-size: 14px; font-weight: 700; color: var(--text); }

    @media (max-width: 640px) {
        .field-grid { grid-template-columns: 1fr; }
        .avatar-section { flex-direction: column; align-items: flex-start; }
        .stats-strip { flex-direction: column; }
    }
</style>
@endpush

@section('content')
<div class="profile-wrapper">

    {{-- Hero Banner --}}
    <div class="profile-hero">
        <div class="hero-title">Account Settings</div>
        <div class="hero-sub">Manage your personal info, photo and security settings</div>
    </div>

    {{-- Avatar + Name Section --}}
    <div class="avatar-section">
        <div class="avatar-wrapper" id="avatar-preview-wrapper">
            @if($user->avatar)
                @php
                    $profileAvatarSrc = str_starts_with($user->avatar, 'data:')
                        ? $user->avatar
                        : (file_exists(public_path($user->avatar)) ? asset($user->avatar) . '?v=' . time() : null);
                @endphp
                @if($profileAvatarSrc)
                    <img src="{{ $profileAvatarSrc }}" class="avatar-img" id="avatar-preview-img" alt="Profile Photo">
                @else
                    <div class="avatar-initials" id="avatar-initials-div">
                        {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                    </div>
                    <img src="" class="avatar-img" id="avatar-preview-img" alt="Profile Photo" style="display:none;">
                @endif
            @else
                <div class="avatar-initials" id="avatar-initials-div">
                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                </div>
                <img src="" class="avatar-img" id="avatar-preview-img" alt="Profile Photo" style="display:none;">
            @endif
            {{-- Camera button now triggers the file input INSIDE the main Edit Profile form --}}
            <label class="avatar-edit-btn" for="avatar-file-input-2" title="Change Photo">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/>
                    <circle cx="12" cy="13" r="4"/>
                </svg>
            </label>
        </div>
        <div class="avatar-info">
            <h2>{{ $user->name ?? 'User' }}</h2>
            <p>{{ $user->job_title ?? 'PSWDO Staff' }} &bull; {{ $user->username ?? '' }}</p>
            <span class="role-badge">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display:inline;vertical-align:middle;margin-right:3px;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Administrator
            </span>
        </div>
    </div>

    {{-- Success alerts --}}
    @if(session('success') && !str_contains(session('success'), 'Password'))
        <div class="profile-alert success" style="margin-bottom: 16px; margin-top: 0;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Edit Profile Card --}}
    <div class="profile-card">
        <div class="profile-card-header">
            <div class="profile-card-header-icon icon-blue">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </div>
            <div>
                <h3>Edit Profile</h3>
                <p>Update your name, username and job title</p>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="profile-card-body">
                <div class="field-grid">
                    <div class="field-group">
                        <label class="field-label">Full Name</label>
                        <input type="text" name="name" class="field-input" value="{{ old('name', $user->name ?? '') }}" required placeholder="Enter your full name">
                        @error('name') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">Username</label>
                        <input type="text" name="username" class="field-input" value="{{ old('username', $user->username ?? '') }}" required placeholder="Enter your username">
                        @error('username') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="field-group full">
                        <label class="field-label">Job Title / Position</label>
                        <input type="text" name="job_title" class="field-input" value="{{ old('job_title', $user->job_title ?? '') }}" placeholder="e.g. Social Welfare Officer, RSW">
                    </div>
                    <div class="field-group full">
                        <label class="field-label">Profile Photo</label>
                        <div style="display:flex; align-items:center; gap:12px;">
                            <label for="avatar-file-input-2" style="display:inline-flex; align-items:center; gap:8px; background:#f1f5f9; border:1.5px dashed var(--border); border-radius:10px; padding:10px 18px; cursor:pointer; font-size:13px; color:var(--muted); font-weight:500; transition:border-color .15s;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/></svg>
                                Choose Photo
                            </label>
                            <span id="file-name-display" style="font-size:12.5px; color:var(--muted);">No file selected</span>
                            <input type="file" name="avatar" id="avatar-file-input-2" accept="image/*" style="display:none;">
                        </div>
                        <span style="font-size:11px; color:var(--muted); margin-top:4px;">JPG, PNG or GIF. Max 2MB.</span>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn-save">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    {{-- Change Password Card --}}
    <div class="profile-card">
        <div class="profile-card-header">
            <div class="profile-card-header-icon icon-red">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            </div>
            <div>
                <h3>Change Password</h3>
                <p>Keep your account secure with a strong password</p>
            </div>
        </div>

        @if(session('success') && str_contains(session('success'), 'Password'))
            <div class="profile-alert success" style="margin-top: 16px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.password') }}">
            @csrf
            <div class="profile-card-body">
                <div class="field-grid">
                    <div class="field-group full">
                        <label class="field-label">Current Password</label>
                        <div style="position:relative;">
                            <input type="password" name="current_password" id="cur-pwd" class="field-input" required placeholder="Enter your current password" style="padding-right:42px;">
                            <button type="button" onclick="togglePwd('cur-pwd', this)" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--muted);">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        @error('current_password') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">New Password</label>
                        <div style="position:relative;">
                            <input type="password" name="new_password" id="new-pwd" class="field-input" required placeholder="Min. 6 characters" style="padding-right:42px;" oninput="checkStrength(this.value)">
                            <button type="button" onclick="togglePwd('new-pwd', this)" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--muted);">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        <div class="strength-bar"><div class="strength-fill" id="strength-fill"></div></div>
                        <span id="strength-label" style="font-size:11px; color:var(--muted);"></span>
                        @error('new_password') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">Confirm New Password</label>
                        <div style="position:relative;">
                            <input type="password" name="new_password_confirmation" id="confirm-pwd" class="field-input" required placeholder="Repeat new password" style="padding-right:42px;">
                            <button type="button" onclick="togglePwd('confirm-pwd', this)" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--muted);">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn-pwd">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    Update Password
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
// Toggle password visibility
function togglePwd(id, btn) {
    const input = document.getElementById(id);
    if (input.type === 'password') {
        input.type = 'text';
        btn.style.color = 'var(--navy)';
    } else {
        input.type = 'password';
        btn.style.color = 'var(--muted)';
    }
}

// Password strength checker
function checkStrength(val) {
    const fill = document.getElementById('strength-fill');
    const label = document.getElementById('strength-label');
    let score = 0;
    if (val.length >= 6)  score++;
    if (val.length >= 10) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const levels = [
        { pct: '0%',   color: '#f1f5f9', text: '' },
        { pct: '25%',  color: '#ef4444', text: 'Weak' },
        { pct: '50%',  color: '#f59e0b', text: 'Fair' },
        { pct: '75%',  color: '#3b82f6', text: 'Good' },
        { pct: '90%',  color: '#10b981', text: 'Strong' },
        { pct: '100%', color: '#059669', text: 'Very Strong' },
    ];
    const lvl = levels[score] || levels[0];
    fill.style.width = lvl.pct;
    fill.style.background = lvl.color;
    label.textContent = lvl.text;
    label.style.color = lvl.color;
}

// Avatar preview — both the camera button AND the Choose Photo button both trigger avatar-file-input-2
const avatarInput2 = document.getElementById('avatar-file-input-2');
const previewImg = document.getElementById('avatar-preview-img');
const initialsDiv = document.getElementById('avatar-initials-div');
const fileNameDisplay = document.getElementById('file-name-display');

function handleAvatarChange(file) {
    if (!file) return;
    // Show filename
    if (fileNameDisplay) fileNameDisplay.textContent = file.name;
    // Preview in the avatar circle
    const reader = new FileReader();
    reader.onload = function(e) {
        previewImg.src = e.target.result;
        previewImg.style.display = 'block';
        if (initialsDiv) initialsDiv.style.display = 'none';
    };
    reader.readAsDataURL(file);
}

if (avatarInput2) {
    avatarInput2.addEventListener('change', function() {
        if (this.files[0]) handleAvatarChange(this.files[0]);
    });
}
</script>
@endpush

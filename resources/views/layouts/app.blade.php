<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CSWDO – @yield('title', 'Surigao del Norte')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ── Reset & Base ────────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sidebar-w: 270px;
            --navy:      #0f2d5e;
            --navy-dark: #091e42;
            --navy-mid:  #1a3a6e;
            --gold:      #f5a623;
            --gold-lt:   #fdb940;
            --teal:      #0d9488;
            --teal-lt:   #14b8a6;
            --red:       #dc2626;
            --purple:    #7c3aed;
            --bg:        #f0f4f9;
            --white:     #ffffff;
            --text:      #1e293b;
            --muted:     #64748b;
            --border:    #e2e8f0;
            --shadow:    0 1px 3px rgba(0,0,0,.10), 0 1px 2px rgba(0,0,0,.06);
            --shadow-md: 0 4px 6px rgba(0,0,0,.07), 0 2px 4px rgba(0,0,0,.06);
        }

        html, body { height: 100%; font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); }

        /* ── Layout shell ────────────────────────────────────────── */
        .shell { display: flex; min-height: 100vh; }

        /* ── Sidebar ─────────────────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--navy-dark);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            overflow-y: auto;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 20px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sidebar-brand .logo-img {
            width: 52px;
            height: 52px;
            object-fit: contain;
            border-radius: 10px;
            background: rgba(255,255,255,.1);
            padding: 4px;
            flex-shrink: 0;
        }
        .sidebar-brand .brand-text h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 12px;
            font-weight: 800;
            color: #fff;
            line-height: 1.3;
            letter-spacing: .3px;
        }
        .sidebar-brand .brand-text p {
            font-size: 9.5px;
            color: rgba(255,255,255,.45);
            margin-top: 3px;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .sidebar-nav { padding: 16px 12px; flex: 1; }

        .nav-section-label {
            font-size: 9.5px;
            font-weight: 600;
            color: rgba(255,255,255,.35);
            letter-spacing: 1.2px;
            text-transform: uppercase;
            padding: 16px 8px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            color: rgba(255,255,255,.65);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: all .15s ease;
            margin-bottom: 2px;
            position: relative;
        }
        .nav-item:hover {
            background: rgba(255,255,255,.07);
            color: #fff;
        }
        .nav-item.active {
            background: var(--gold);
            color: var(--navy-dark);
            font-weight: 600;
        }
        .nav-item.active .nav-icon { opacity: 1; }
        .nav-icon { width: 18px; height: 18px; opacity: .7; flex-shrink: 0; }

        .nav-sub { padding-left: 16px; }
        .nav-sub .nav-item {
            font-size: 12.5px;
            padding: 8px 12px;
            color: rgba(255,255,255,.55);
        }
        .nav-sub .nav-item.active { color: var(--navy-dark); }
        .nav-sub .nav-item:hover { color: #fff; }

        .sidebar-footer {
            padding: 12px 16px;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-footer .user-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }
        .sidebar-footer .user-avatar {
            width: 30px; height: 30px;
            background: var(--gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: var(--navy-dark);
            flex-shrink: 0;
        }
        .sidebar-footer .user-info p { font-size: 11px; color: rgba(255,255,255,.7); font-weight: 600; }
        .sidebar-footer .user-info span { font-size: 10px; color: rgba(255,255,255,.35); }
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 7px;
            width: 100%;
            padding: 8px 12px;
            background: rgba(220,38,38,.15);
            border: 1px solid rgba(220,38,38,.25);
            border-radius: 8px;
            color: #fca5a5;
            font-size: 12.5px;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background .15s;
            text-align: left;
        }
        .btn-logout:hover { background: rgba(220,38,38,.28); color: #fff; }
        .sidebar-footer .footer-note { font-size: 9.5px; color: rgba(255,255,255,.25); margin-top: 8px; line-height: 1.4; }

        /* ── Main content ────────────────────────────────────────── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* ── Top bar ─────────────────────────────────────────────── */
        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar-title h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: var(--text);
        }
        .topbar-title p { font-size: 12px; color: var(--muted); margin-top: 2px; }
        .topbar-meta {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .year-badge {
            background: var(--navy);
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }
        .province-badge {
            font-size: 12px;
            color: var(--muted);
            font-weight: 500;
        }

        /* ── Page body ───────────────────────────────────────────── */
        .page-body { padding: 28px; flex: 1; }

        /* ── Alert ───────────────────────────────────────────────── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
        .alert-error   { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

        /* ── Stat cards ──────────────────────────────────────────── */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 28px; }
        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
        }
        .stat-card.navy::before  { background: var(--navy); }
        .stat-card.gold::before  { background: var(--gold); }
        .stat-card.teal::before  { background: var(--teal); }
        .stat-card.red::before   { background: var(--red); }
        .stat-card.purple::before{ background: var(--purple); }

        .stat-label { font-size: 11.5px; font-weight: 500; color: var(--muted); text-transform: uppercase; letter-spacing: .5px; }
        .stat-value { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 30px; font-weight: 700; color: var(--text); line-height: 1; }
        .stat-sub   { font-size: 11.5px; color: var(--muted); }

        /* ── Data table ──────────────────────────────────────────── */
        .table-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        .table-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .table-header h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
        }
        .table-search input {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 7px 12px;
            font-size: 13px;
            outline: none;
            transition: border-color .15s;
        }
        .table-search input:focus { border-color: var(--navy); }

        .data-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .data-table th {
            background: #f8fafc;
            padding: 10px 14px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            border-bottom: 1px solid var(--border);
        }
        .data-table td {
            padding: 11px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: var(--text);
        }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #f8fafc; }
        .data-table .total-row td {
            background: var(--navy);
            color: #fff;
            font-weight: 600;
            border-bottom: none;
        }
        .data-table td.num { text-align: right; font-variant-numeric: tabular-nums; }
        .data-table th.num { text-align: right; }

        .null-dash { color: #cbd5e1; }
        .lgu-name { font-weight: 500; }

        /* ── Badge pills ─────────────────────────────────────────── */
        .pill {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }
        .pill-blue   { background: #dbeafe; color: #1d4ed8; }
        .pill-green  { background: #dcfce7; color: #15803d; }
        .pill-amber  { background: #fef3c7; color: #b45309; }
        .pill-red    { background: #fee2e2; color: #dc2626; }

        /* ── Forms ───────────────────────────────────────────────── */
        .form-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        .form-tabs {
            display: flex;
            border-bottom: 1px solid var(--border);
            overflow-x: auto;
            scrollbar-width: none;
        }
        .form-tabs::-webkit-scrollbar { display: none; }
        .form-tab {
            padding: 14px 20px;
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            cursor: pointer;
            border-bottom: 2px solid transparent;
            white-space: nowrap;
            transition: all .15s;
            background: none;
            border-top: none;
            border-left: none;
            border-right: none;
        }
        .form-tab.active { color: var(--navy); border-bottom-color: var(--navy); font-weight: 600; }
        .form-tab:hover  { color: var(--text); }

        .form-panel { display: none; padding: 28px; }
        .form-panel.active { display: block; }

        .form-grid  { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text);
        }
        .form-group .hint { font-size: 11px; color: var(--muted); }
        .form-control {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 9px 12px;
            font-size: 13.5px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            width: 100%;
            background: #fff;
        }
        .form-control:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(15,45,94,.08);
        }
        .form-control.error { border-color: var(--red); }
        .error-msg { font-size: 11.5px; color: var(--red); }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            border: none;
            transition: all .15s;
            text-decoration: none;
        }
        .btn-primary { background: var(--navy); color: #fff; }
        .btn-primary:hover { background: var(--navy-mid); }
        .btn-gold    { background: var(--gold); color: var(--navy-dark); }
        .btn-gold:hover { background: var(--gold-lt); }
        .btn-outline {
            background: transparent;
            color: var(--navy);
            border: 1px solid var(--navy);
        }
        .btn-outline:hover { background: var(--navy); color: #fff; }
        .btn-sm { padding: 6px 14px; font-size: 12px; }

        .form-footer {
            padding: 18px 28px;
            background: #f8fafc;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* ── Chart wrapper ───────────────────────────────────────── */
        .chart-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 16px; margin-bottom: 28px; }
        .chart-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 20px;
        }
        .chart-card h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text);
        }

        /* ── Bar chart (CSS) ─────────────────────────────────────── */
        .bar-chart { display: flex; flex-direction: column; gap: 8px; }
        .bar-row { display: flex; align-items: center; gap: 10px; }
        .bar-label { font-size: 11.5px; color: var(--muted); width: 110px; flex-shrink: 0; text-align: right; }
        .bar-track { flex: 1; background: #f1f5f9; border-radius: 4px; height: 20px; overflow: hidden; }
        .bar-fill { height: 100%; border-radius: 4px; display: flex; align-items: center; justify-content: flex-end; padding-right: 6px; transition: width .4s ease; }
        .bar-val { font-size: 10.5px; font-weight: 600; color: #fff; }
        .bar-fill.navy   { background: var(--navy); }
        .bar-fill.teal   { background: var(--teal); }
        .bar-fill.gold   { background: var(--gold); }
        .bar-fill.red    { background: var(--red); }
        .bar-fill.purple { background: var(--purple); }

        /* ── Gauge ───────────────────────────────────────────────── */
        .gauge-row { display: flex; align-items: center; gap: 10px; margin-bottom: 6px; }
        .gauge-name { font-size: 11.5px; width: 120px; flex-shrink: 0; }
        .gauge-track { flex: 1; background: #f1f5f9; border-radius: 20px; height: 8px; overflow: hidden; }
        .gauge-fill  { height: 100%; border-radius: 20px; }
        .gauge-pct   { font-size: 11px; font-weight: 600; width: 42px; text-align: right; color: var(--muted); }

        /* Rate colors */
        .rate-high   { background: #22c55e; }
        .rate-mid    { background: var(--gold); }
        .rate-low    { background: var(--red); }

        /* ── Responsive ──────────────────────────────────────────── */
        @media (max-width: 768px) {
            :root { --sidebar-w: 0px; }
            .sidebar { transform: translateX(-270px); }
            .main { margin-left: 0; }
        }

        /* ── Modal ───────────────────────────────────────────────── */
        .modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(9,30,66,.55);
            z-index: 500;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }
        .modal-backdrop.open { display: flex; }
        .modal {
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,.25);
            width: 100%;
            max-width: 560px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalIn .2s ease;
        }
        @keyframes modalIn {
            from { opacity:0; transform:translateY(-16px) scale(.97); }
            to   { opacity:1; transform:translateY(0) scale(1); }
        }
        .modal-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .modal-header h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
        }
        .modal-close {
            width: 30px; height: 30px;
            border-radius: 8px;
            border: none;
            background: #f1f5f9;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--muted);
            transition: background .15s;
        }
        .modal-close:hover { background: #e2e8f0; color: var(--text); }
        .modal-body { padding: 24px; }
        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        /* ── Action buttons ──────────────────────────────────────── */
        .btn-edit, .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            border: none;
            cursor: pointer;
            transition: all .15s;
            text-decoration: none;
        }
        .btn-edit   { background: #dbeafe; color: #1d4ed8; }
        .btn-edit:hover   { background: #1d4ed8; color: #fff; }
        .btn-delete { background: #fee2e2; color: #dc2626; }
        .btn-delete:hover { background: #dc2626; color: #fff; }
        .action-cell { white-space: nowrap; }
    </style>
    @stack('styles')
</head>
<body>
<div class="shell">

    <!-- ── Sidebar ─────────────────────────────────────────────── -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('logo-hri.png') }}" alt="CSWDO Logo" class="logo-img">
            <div class="brand-text">
                <h1>Provincial Social Welfare<br>&amp; Development Office</h1>
                <p>Surigao del Norte · PSWDO</p>
            </div>
        </div>

        <nav class="sidebar-nav">
            <!-- Main -->
            <div class="nav-section-label">Main</div>
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                Dashboard
            </a>

            <!-- Records -->
            <div class="nav-section-label">Records</div>

            <a href="{{ route('records.history') }}" class="nav-item {{ request()->routeIs('records.history') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v5h5"/><path d="M3.05 13A9 9 0 102.5 8.5"/><path d="M12 7v5l3 2"/></svg>
                History
            </a>

            <a href="{{ route('records.population') }}" class="nav-item {{ request()->routeIs('records.population') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="7" r="3"/><path d="M3 21v-2a5 5 0 015-5h4a5 5 0 015 5v2"/><circle cx="18" cy="7" r="2"/><path d="M20 14a4 4 0 012 3.5V21"/></svg>
                Total Population
            </a>

            <a href="{{ route('records.survival') }}" class="nav-item {{ request()->routeIs('records.survival') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                Survival
            </a>

            <a href="{{ route('records.development') }}" class="nav-item {{ request()->routeIs('records.development') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
                Development
            </a>

            <a href="{{ route('records.protection') }}" class="nav-item {{ request()->routeIs('records.protection') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Protection
            </a>

            <a href="{{ route('records.disability') }}" class="nav-item {{ request()->routeIs('records.disability') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="5" r="2"/><path d="M12 10v5l3 3"/><circle cx="12" cy="19" r="2"/><path d="M8 21c0-2.5 2-4 4-4s4 1.5 4 4"/></svg>
                Children w/ Disability
            </a>

            <a href="{{ route('records.ip') }}" class="nav-item {{ request()->routeIs('records.ip') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                IP Children
            </a>

            <!-- Data Management -->
            <div class="nav-section-label">Data Management</div>

            <a href="{{ route('add.index') }}" class="nav-item {{ request()->routeIs('add.index') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M12 8v8"/><path d="M8 12h8"/></svg>
                Add Records
            </a>

            <a href="{{ route('children.index') }}" class="nav-item {{ request()->routeIs('children.*') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Child Record
            </a>

        </nav>

        <div class="sidebar-footer">
            <div class="user-row">
                <div class="user-avatar">{{ strtoupper(substr(session('username', 'A'), 0, 1)) }}</div>
                <div class="user-info">
                    <p>{{ ucfirst(session('username', 'Admin')) }}</p>
                    <span>Administrator</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Sign Out
                </button>
            </form>
            <p class="footer-note">Database on Children {{ date('Y') }}<br>Province of Surigao del Norte</p>
        </div>
    </aside>

    <!-- ── Main ─────────────────────────────────────────────────── -->
    <div class="main">
        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-title">
                <h2>@yield('page-title', 'Dashboard')</h2>
                <p>@yield('page-sub', 'Provincial Social Welfare & Development Office')</p>
            </div>
            <div class="topbar-meta">
                <span class="province-badge">Surigao del Norte</span>
                <span class="year-badge">{{ date('Y') }}</span>
            </div>
        </header>

        <!-- Flash messages -->
        <div style="padding: 0 28px; margin-top: 16px;">
            @if(session('success'))
                <div class="alert alert-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-error">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ $errors->first() }}
                </div>
            @endif
        </div>

        <!-- Page content -->
        <div class="page-body">
            @yield('content')
        </div>
    </div>

</div>

<script>
// Table search filter
document.querySelectorAll('.table-search input').forEach(input => {
    input.addEventListener('input', function() {
        const q = this.value.toLowerCase();
        const table = this.closest('.table-card').querySelector('.data-table tbody');
        if (!table) return;
        table.querySelectorAll('tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });
});

// Tab switching
document.querySelectorAll('.form-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        const target = this.dataset.tab;
        document.querySelectorAll('.form-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.form-panel').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('panel-' + target)?.classList.add('active');
    });
});
</script>
@stack('scripts')
</body>
</html>

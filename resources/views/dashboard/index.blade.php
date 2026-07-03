@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-sub', 'Overview of Children Data — Surigao del Norte ' . date('Y'))

@section('content')
<style>
    /* SaaS Dashboard Base */
    .saas-dashboard {
        font-family: 'Inter', 'Poppins', sans-serif;
        color: #1e293b;
        padding-bottom: 40px;
    }

    /* Grid Layouts */
    .saas-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-bottom: 24px;
    }

    @media (max-width: 1024px) {
        .saas-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .saas-grid { grid-template-columns: 1fr; }
    }

    .saas-grid-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 24px;
    }
    @media (max-width: 1024px) {
        .saas-grid-2 { grid-template-columns: 1fr; }
    }

    .saas-footer-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }
    @media (max-width: 1024px) {
        .saas-footer-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .saas-footer-grid { grid-template-columns: 1fr; }
    }

    /* Common Card Style */
    .saas-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
        border: 1px solid #e2e8f0;
        padding: 24px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .saas-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.06), 0 4px 6px -4px rgba(0, 0, 0, 0.03);
    }

    /* Metric Cards Header */
    .saas-card-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
    }
    .saas-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .saas-icon-box svg {
        width: 24px;
        height: 24px;
    }
    .saas-card-title {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
    }

    /* Metric Values */
    .saas-value {
        font-size: 32px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
        margin-bottom: 8px;
        margin-left: 64px;
    }
    
    .saas-sub-info {
        font-size: 13px;
        color: #64748b;
        margin-left: 64px;
        display: flex;
        justify-content: space-between;
        margin-bottom: 16px;
        flex-grow: 1;
    }

    /* Bottom Border line */
    .saas-card-line {
        height: 4px;
        width: calc(100% - 48px);
        margin: 0 24px;
        border-radius: 4px 4px 0 0;
        position: absolute;
        bottom: 0;
        left: 0;
    }

    /* Theme Colors */
    .theme-blue .saas-icon-box { background: #eff6ff; color: #3b82f6; }
    .theme-blue .saas-card-line { background: #3b82f6; }
    
    .theme-green .saas-icon-box { background: #f0fdf4; color: #22c55e; }
    .theme-green .saas-card-line { background: #22c55e; }
    
    .theme-gold .saas-icon-box { background: #fffbeb; color: #f59e0b; }
    .theme-gold .saas-card-line { background: #f59e0b; }
    
    .theme-red .saas-icon-box { background: #fef2f2; color: #ef4444; }
    .theme-red .saas-card-line { background: #ef4444; }
    
    .theme-teal .saas-icon-box { background: #f0fdfa; color: #0d9488; }
    .theme-teal .saas-card-line { background: #0d9488; }
    
    .theme-purple .saas-icon-box { background: #faf5ff; color: #a855f7; }
    .theme-purple .saas-card-line { background: #a855f7; }


    /* Charts */
    .chart-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }
    .chart-card-title {
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .chart-card-title svg { width: 18px; height: 18px; }
    .view-all-link {
        font-size: 13px;
        font-weight: 500;
        color: #3b82f6;
        text-decoration: none;
    }
    .view-all-link:hover { text-decoration: underline; }

    /* Horizontal Bar Row */
    .h-bar-row {
        display: flex;
        align-items: center;
        margin-bottom: 16px;
        gap: 16px;
    }
    .h-bar-label {
        width: 100px;
        font-size: 13px;
        color: #475569;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .h-bar-track {
        flex-grow: 1;
        background: #f1f5f9;
        height: 10px;
        border-radius: 5px;
        overflow: hidden;
    }
    .h-bar-fill {
        height: 100%;
        border-radius: 5px;
    }
    .h-bar-value {
        width: 40px;
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        text-align: right;
    }

    /* Footer Cards */
    .footer-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        border: 1px solid #e2e8f0;
    }
    .footer-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        color: #64748b;
    }
    .footer-text h4 {
        font-size: 12px;
        color: #64748b;
        margin: 0 0 4px 0;
        font-weight: 500;
    }
    .footer-text p {
        font-size: 15px;
        font-weight: 600;
        color: #0f172a;
        margin: 0;
    }
    .footer-text span {
        font-size: 12px;
        color: #94a3b8;
        display: block;
        margin-top: 2px;
    }

    /* Action Card */
    .action-card {
        cursor: pointer;
        transition: border-color 0.2s;
    }
    .action-card:hover { border-color: #f59e0b; }
    .action-card .footer-icon { background: #fffbeb; color: #f59e0b; }
</style>

<div class="saas-dashboard">

    {{-- Top 6 Metric Cards Grid --}}
    <div class="saas-grid">
        
        {{-- 1. Population --}}
        <div class="saas-card theme-blue">
            <div class="saas-card-header">
                <div class="saas-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <div class="saas-card-title">Total Population</div>
            </div>
            <div class="saas-value">{{ number_format($totalChildren) }}</div>
            <div class="saas-sub-info">
                <span>Male: <strong>{{ number_format($totalMale) }}</strong></span>
                <span>Female: <strong>{{ number_format($totalFemale) }}</strong></span>
            </div>
            <div class="saas-card-line"></div>
        </div>

        {{-- 2. Survival --}}
        <div class="saas-card theme-green">
            <div class="saas-card-header">
                <div class="saas-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="saas-card-title">Survival Sector</div>
            </div>
            <div class="saas-value">{{ number_format($avgImmunization, 1) }}%</div>
            <div class="saas-sub-info" style="justify-content: flex-start; gap: 8px;">
                <span>Avg Immunization Rate</span>
            </div>
            <div class="saas-card-line"></div>
        </div>

        {{-- 3. Development --}}
        <div class="saas-card theme-gold">
            <div class="saas-card-header">
                <div class="saas-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                    </svg>
                </div>
                <div class="saas-card-title">Development Sector</div>
            </div>
            <div class="saas-value">{{ number_format($totalDevelopment) }}</div>
            <div class="saas-sub-info" style="background: #f0fdf4; color: #166534; padding: 6px 12px; border-radius: 4px; margin-left:0; margin-bottom:8px; border: 1px solid #dcfce7; display:flex; justify-content:space-between; width:100%;">
                <span>In School: <strong>{{ number_format($totalDevelopment) }}</strong></span>
                <span>M: <strong>{{ number_format($developmentMale) }}</strong> F: <strong>{{ number_format($developmentFemale) }}</strong></span>
            </div>
            <div class="saas-sub-info" style="background: #fef2f2; color: #b91c1c; padding: 6px 12px; border-radius: 4px; margin-left:0; margin-top:0; border: 1px solid #fee2e2; display:flex; justify-content:space-between; width:100%;">
                <span>Out of School: <strong>{{ number_format($totalOutOfSchool) }}</strong></span>
                <span>M: <strong>{{ number_format($outOfSchoolMale) }}</strong> F: <strong>{{ number_format($outOfSchoolFemale) }}</strong></span>
            </div>
            <div class="saas-card-line"></div>
        </div>

        {{-- 4. Protection --}}
        <div class="saas-card theme-red">
            <div class="saas-card-header">
                <div class="saas-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="saas-card-title">Protection Sector</div>
            </div>
            <div class="saas-value">{{ number_format($totalCNSP + $totalCAR + $totalCICL) }}</div>
            <div class="saas-sub-info" style="display:flex; flex-direction:column; align-items:flex-start; gap:4px; margin-bottom:8px;">
                <span>Total Cases (CNSP + CAR + CICL)</span>
                <span>Male: <strong>{{ number_format($protectionMale) }}</strong> &nbsp;|&nbsp; Female: <strong>{{ number_format($protectionFemale) }}</strong></span>
            </div>
            <div style="margin-left:64px; font-size:12px; display:flex; gap:8px; flex-wrap:wrap;">
                <div style="background:#fee2e2; color:#b91c1c; padding: 4px 10px; border-radius: 4px; border: 1px solid #fecaca;">
                    CNSP: <strong>{{ number_format($totalCNSP) }}</strong>
                </div>
                <div style="background:#fef9c3; color:#92400e; padding: 4px 10px; border-radius: 4px; border: 1px solid #fde68a;">
                    CAR: <strong>{{ number_format($totalCAR) }}</strong>
                </div>
                <div style="background:#f3e8ff; color:#6b21a8; padding: 4px 10px; border-radius: 4px; border: 1px solid #e9d5ff;">
                    CICL: <strong>{{ number_format($totalCICL) }}</strong>
                </div>
            </div>
            <div class="saas-card-line"></div>
        </div>

        {{-- 5. Disability --}}
        <div class="saas-card theme-teal">
            <div class="saas-card-header">
                <div class="saas-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 4.5a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zM12.44 11.451a5.25 5.25 0 00-6.732 6.732M15 15l4.5 4.5M10.5 19.5v-4.5l-4.5-4.5" />
                        <circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-dasharray="1 4" />
                    </svg>
                </div>
                <div class="saas-card-title">Children with Disability</div>
            </div>
            <div class="saas-value">{{ number_format($totalDisability) }}</div>
            <div class="saas-sub-info">
                <span>Male: <strong>{{ number_format($disabilityMale) }}</strong></span>
                <span>Female: <strong>{{ number_format($disabilityFemale) }}</strong></span>
            </div>
            <div class="saas-card-line"></div>
        </div>

        {{-- 6. IP Children --}}
        <div class="saas-card theme-purple">
            <div class="saas-card-header">
                <div class="saas-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                </div>
                <div class="saas-card-title">IP Children</div>
            </div>
            <div class="saas-value">{{ number_format($totalIP) }}</div>
            <div class="saas-sub-info">
                <span>Male: <strong>{{ number_format($ipMale) }}</strong></span>
                <span>Female: <strong>{{ number_format($ipFemale) }}</strong></span>
            </div>
            <div class="saas-card-line"></div>
        </div>

    </div>

    {{-- Data Visualization --}}
    <div class="saas-grid-2">
        {{-- Left: Top LGUs --}}
        <div class="saas-card">
            <div class="chart-card-header">
                <div class="chart-card-title theme-blue">
                    <svg style="color:#3b82f6;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    Top LGUs by Children Population
                </div>
                <a href="{{ route('records.population') }}" class="view-all-link">View All</a>
            </div>
            
            <div style="margin-top: 8px;">
                @php $maxPop = $topLGUs->max('total'); @endphp
                @foreach($topLGUs as $lgu)
                @php $pct = $maxPop > 0 ? ($lgu->total / $maxPop) * 100 : 0; @endphp
                <div class="h-bar-row">
                    <div class="h-bar-label" title="{{ $lgu->lgu_name }}">{{ $lgu->lgu_name }}</div>
                    <div class="h-bar-track">
                        <div class="h-bar-fill" style="width: {{ $pct }}%; background: #3b82f6;"></div>
                    </div>
                    <div class="h-bar-value">{{ number_format($lgu->total) }}</div>
                </div>
                @endforeach
            </div>
            
            <div style="margin-top: auto; padding-top: 16px;">
                <div style="background: #eff6ff; color: #1e40af; padding: 12px; border-radius: 8px; font-size: 12px; display: flex; align-items: center; gap: 8px;">
                    <svg style="width:16px; height:16px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    Based on total number of children recorded in each LGU.
                </div>
            </div>
        </div>

        {{-- Right: Immunization --}}
        <div class="saas-card theme-green">
            <div class="chart-card-header">
                <div class="chart-card-title">
                    <svg style="color:#22c55e;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Immunization Rates by LGU
                </div>
                <a href="{{ route('records.survival') }}" class="view-all-link">View All</a>
            </div>
            
            <div style="overflow-y: auto; max-height: 280px; padding-right: 8px; margin-top:8px;">
                @foreach($immunizationData as $item)
                @php
                    $rate = $item->immunization_rate ?? 0;
                    $bg = $rate >= 85 ? '#22c55e' : ($rate >= 70 ? '#f59e0b' : '#ef4444');
                @endphp
                <div class="h-bar-row" style="margin-bottom:12px;">
                    <div class="h-bar-label" style="width:110px;" title="{{ $item->lgu_name }}">{{ $item->lgu_name }}</div>
                    <div class="h-bar-track" style="height:6px; background:#f0fdf4;">
                        <div class="h-bar-fill" style="width: {{ $rate }}%; background: {{ $bg }};"></div>
                    </div>
                    <div class="h-bar-value" style="width:45px;">{{ number_format($rate, 1) }}%</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Footer Summary Cards --}}
    <div class="saas-footer-grid">
        <div class="footer-card theme-blue">
            <div class="footer-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:22px;height:22px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                </svg>
            </div>
            <div class="footer-text">
                <h4>Total LGUs</h4>
                <p>21</p>
                <span>Municipalities</span>
            </div>
        </div>

        <div class="footer-card theme-green">
            <div class="footer-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:22px;height:22px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="footer-text">
                <h4>Last Updated</h4>
                <p>{{ date('M d, Y') }}</p>
                <span>{{ date('h:i A') }}</span>
            </div>
        </div>

        <div class="footer-card theme-purple">
            <div class="footer-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:22px;height:22px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
            <div class="footer-text">
                <h4>Data Source</h4>
                <p style="color:#7e22ce;">PSWDO Database</p>
                <span>Surigao del Norte</span>
            </div>
        </div>

        <!-- Export Action Card -->
        <a href="{{ route('records.population') }}" style="text-decoration: none;">
            <div class="footer-card action-card theme-gold" style="height:100%;">
                <div class="footer-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:22px;height:22px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </div>
                <div class="footer-text" style="flex-grow:1;">
                    <h4>Export Reports</h4>
                    <span style="color:#f59e0b;">Generate custom reports</span>
                </div>
                <div style="color: #cbd5e1;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:18px;height:18px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </div>
        </a>
    </div>

</div>

@endsection

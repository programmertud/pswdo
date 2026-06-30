@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-sub', 'Overview of Children Data — Surigao del Norte 2025')

@section('content')

{{-- ── KPI Cards ────────────────────────────────────────────────── --}}
<div class="stat-grid">
    <div class="stat-card navy">
        <span class="stat-label">Total Children Population</span>
        <span class="stat-value">{{ number_format($totalChildren) }}</span>
        <span class="stat-sub">Male: {{ number_format($totalMale) }} · Female: {{ number_format($totalFemale) }}</span>
    </div>
    <div class="stat-card gold">
        <span class="stat-label">Avg. Immunization Rate</span>
        <span class="stat-value">{{ number_format($avgImmunization, 1) }}%</span>
        <span class="stat-sub">Children aged 12 months, fully immunized</span>
    </div>
    <div class="stat-card teal">
        <span class="stat-label">Children with Disability</span>
        <span class="stat-value">{{ number_format($totalDisability) }}</span>
        <span class="stat-sub">Across 21 LGUs</span>
    </div>
    <div class="stat-card red">
        <span class="stat-label">CNSP Cases</span>
        <span class="stat-value">{{ number_format($totalCNSP) }}</span>
        <span class="stat-sub">Children in Need of Special Protection</span>
    </div>
    <div class="stat-card purple">
        <span class="stat-label">IP Children</span>
        <span class="stat-value">{{ number_format($totalIP) }}</span>
        <span class="stat-sub">Indigenous Peoples</span>
    </div>
    <div class="stat-card navy">
        <span class="stat-label">Pregnant Adolescents</span>
        <span class="stat-value">{{ number_format($totalPregnant) }}</span>
        <span class="stat-sub">Aged 10–19 years old</span>
    </div>
</div>

{{-- ── Charts ───────────────────────────────────────────────────── --}}
<div class="chart-grid">
    {{-- Top LGUs Bar Chart --}}
    <div class="chart-card">
        <h3>Top LGUs by Children Population</h3>
        @php $maxPop = $topLGUs->max('total'); @endphp
        <div class="bar-chart">
            @foreach($topLGUs as $lgu)
            @php $pct = $maxPop > 0 ? ($lgu->total / $maxPop) * 100 : 0; @endphp
            <div class="bar-row">
                <span class="bar-label">{{ $lgu->lgu_name }}</span>
                <div class="bar-track">
                    <div class="bar-fill navy" style="width: {{ $pct }}%">
                        <span class="bar-val">{{ number_format($lgu->total) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Immunization Rate --}}
    <div class="chart-card" style="overflow-y:auto; max-height: 380px;">
        <h3>Immunization Rates by LGU</h3>
        @foreach($immunizationData as $item)
        @php
            $rate = $item->immunization_rate ?? 0;
            $cls  = $rate >= 85 ? 'rate-high' : ($rate >= 70 ? 'rate-mid' : 'rate-low');
        @endphp
        <div class="gauge-row">
            <span class="gauge-name" style="font-size:11px;">{{ $item->lgu_name }}</span>
            <div class="gauge-track">
                <div class="gauge-fill {{ $cls }}" style="width:{{ $rate }}%"></div>
            </div>
            <span class="gauge-pct">{{ number_format($rate, 1) }}%</span>
        </div>
        @endforeach
        <div style="display:flex; gap:14px; margin-top:12px; font-size:11px; color:var(--muted);">
            <span><span style="display:inline-block;width:10px;height:10px;background:#22c55e;border-radius:2px;margin-right:4px;"></span>≥85%</span>
            <span><span style="display:inline-block;width:10px;height:10px;background:var(--gold);border-radius:2px;margin-right:4px;"></span>70–84%</span>
            <span><span style="display:inline-block;width:10px;height:10px;background:var(--red);border-radius:2px;margin-right:4px;"></span>&lt;70%</span>
        </div>
    </div>
</div>

{{-- ── Quick links ──────────────────────────────────────────────── --}}
<div style="margin-bottom: 28px;">
    <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size:15px; font-weight:700; margin-bottom:14px;">Quick Access</h3>
    <div style="display:flex; flex-wrap:wrap; gap:10px;">
        <a href="{{ route('records.population') }}"  class="btn btn-outline btn-sm">Total Population</a>
        <a href="{{ route('records.survival') }}"    class="btn btn-outline btn-sm">Survival</a>
        <a href="{{ route('records.development') }}" class="btn btn-outline btn-sm">Development</a>
        <a href="{{ route('records.protection') }}"  class="btn btn-outline btn-sm">Protection</a>
        <a href="{{ route('records.disability') }}"  class="btn btn-outline btn-sm">Disability</a>
        <a href="{{ route('records.ip') }}"          class="btn btn-outline btn-sm">IP Children</a>
        <a href="{{ route('add.index') }}"           class="btn btn-gold btn-sm">+ Add Record</a>
    </div>
</div>

@endsection

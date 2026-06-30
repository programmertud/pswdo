@extends('layouts.app')
@section('title', 'History')
@section('page-title', 'History')
@section('page-sub', 'Archived children records by year')

@section('content')
@foreach($history as $year => $sets)
    <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:16px;">
        <div>
            <h3 style="font-family:'Plus Jakarta Sans', sans-serif; font-size:18px; color:var(--text);">Records for {{ $year }}</h3>
            <p style="font-size:12px; color:var(--muted); margin-top:3px;">Existing records moved here so the current-year pages can start fresh.</p>
        </div>
        <span class="year-badge">{{ $year }}</span>
    </div>

    <div class="table-card" style="margin-bottom:22px;">
        <div class="table-header">
            <h3>Total Population</h3>
            <div class="table-search"><input type="text" placeholder="Search LGU..."></div>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name of LGU</th>
                        <th class="num">Male</th>
                        <th class="num">Female</th>
                        <th class="num">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sets['population'] as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="lgu-name">{{ $r->lgu_name }}</td>
                        <td class="num">{!! $r->male !== null ? number_format($r->male) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->female !== null ? number_format($r->female) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->total !== null ? '<strong>'.number_format($r->total).'</strong>' : '<span class="null-dash">—</span>' !!}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center; color:var(--muted);">No archived population records.</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="num">{{ number_format($sets['population']->sum('male')) }}</td>
                        <td class="num">{{ number_format($sets['population']->sum('female')) }}</td>
                        <td class="num">{{ number_format($sets['population']->sum('total')) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="table-card" style="margin-bottom:22px;">
        <div class="table-header">
            <h3>Survival</h3>
            <div class="table-search"><input type="text" placeholder="Search LGU..."></div>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>LGU</th>
                        <th class="num">Immunization %</th>
                        <th class="num">Pop. 12 Mos.</th>
                        <th class="num">0-59 Mos. Weighed</th>
                        <th class="num">Total Pop. 0-59 Mos.</th>
                        <th class="num">Pregnant Adolescents</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sets['survival'] as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="lgu-name">{{ $r->lgu_name }}</td>
                        <td class="num">{!! $r->immunization_rate !== null ? number_format($r->immunization_rate, 2).'%' : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->total_pop_12_months !== null ? number_format($r->total_pop_12_months) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->actual_0_59_months_weighed !== null ? number_format($r->actual_0_59_months_weighed) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->total_pop_0_59_months !== null ? number_format($r->total_pop_0_59_months) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->pregnant_adolescents_10_19 !== null ? number_format($r->pregnant_adolescents_10_19) : '<span class="null-dash">—</span>' !!}</td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align:center; color:var(--muted);">No archived survival records.</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="num">{{ number_format($sets['survival']->whereNotNull('immunization_rate')->avg('immunization_rate') ?? 0, 2) }}% avg</td>
                        <td class="num">{{ number_format($sets['survival']->sum('total_pop_12_months')) }}</td>
                        <td class="num">{{ number_format($sets['survival']->sum('actual_0_59_months_weighed')) }}</td>
                        <td class="num">{{ number_format($sets['survival']->sum('total_pop_0_59_months')) }}</td>
                        <td class="num">{{ number_format($sets['survival']->sum('pregnant_adolescents_10_19')) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="table-card" style="margin-bottom:22px;">
        <div class="table-header">
            <h3>Development</h3>
            <div class="table-search"><input type="text" placeholder="Search LGU..."></div>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>LGU</th>
                        <th class="num">In School Male</th>
                        <th class="num">In School Female</th>
                        <th class="num">In School Total</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sets['development'] as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="lgu-name">{{ $r->lgu_name }}</td>
                        <td class="num">{!! $r->children_in_school_male !== null ? number_format($r->children_in_school_male) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->children_in_school_female !== null ? number_format($r->children_in_school_female) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->children_in_school_total !== null ? '<strong>'.number_format($r->children_in_school_total).'</strong>' : '<span class="null-dash">—</span>' !!}</td>
                        <td>{{ $r->remarks ?: '—' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align:center; color:var(--muted);">No archived development records.</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="num">{{ number_format($sets['development']->sum('children_in_school_male')) }}</td>
                        <td class="num">{{ number_format($sets['development']->sum('children_in_school_female')) }}</td>
                        <td class="num">{{ number_format($sets['development']->sum('children_in_school_total')) }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="table-card" style="margin-bottom:22px;">
        <div class="table-header">
            <h3>Protection</h3>
            <div class="table-search"><input type="text" placeholder="Search LGU..."></div>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>LGU</th>
                        <th class="num">CNSP Cases</th>
                        <th class="num">CAR/CICL Cases</th>
                        <th class="num">Male</th>
                        <th class="num">Female</th>
                        <th class="num">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sets['protection'] as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="lgu-name">{{ $r->lgu_name }}</td>
                        <td class="num">{!! $r->cnsp_cases !== null ? number_format($r->cnsp_cases) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->car_cicl_cases !== null ? number_format($r->car_cicl_cases) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->car_cicl_male !== null ? number_format($r->car_cicl_male) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->car_cicl_female !== null ? number_format($r->car_cicl_female) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->car_cicl_total !== null ? '<strong>'.number_format($r->car_cicl_total).'</strong>' : '<span class="null-dash">—</span>' !!}</td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align:center; color:var(--muted);">No archived protection records.</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="num">{{ number_format($sets['protection']->sum('cnsp_cases')) }}</td>
                        <td class="num">{{ number_format($sets['protection']->sum('car_cicl_cases')) }}</td>
                        <td class="num">{{ number_format($sets['protection']->sum('car_cicl_male')) }}</td>
                        <td class="num">{{ number_format($sets['protection']->sum('car_cicl_female')) }}</td>
                        <td class="num">{{ number_format($sets['protection']->sum('car_cicl_total')) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="table-card" style="margin-bottom:22px;">
        <div class="table-header">
            <h3>Children with Disability</h3>
            <div class="table-search"><input type="text" placeholder="Search LGU..."></div>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>LGU</th>
                        <th class="num">Male</th>
                        <th class="num">Female</th>
                        <th class="num">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sets['disability'] as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="lgu-name">{{ $r->lgu_name }}</td>
                        <td class="num">{!! $r->male !== null ? number_format($r->male) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->female !== null ? number_format($r->female) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->total !== null ? '<strong>'.number_format($r->total).'</strong>' : '<span class="null-dash">—</span>' !!}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center; color:var(--muted);">No archived disability records.</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="num">{{ number_format($sets['disability']->sum('male')) }}</td>
                        <td class="num">{{ number_format($sets['disability']->sum('female')) }}</td>
                        <td class="num">{{ number_format($sets['disability']->sum('total')) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="table-card" style="margin-bottom:32px;">
        <div class="table-header">
            <h3>IP Children</h3>
            <div class="table-search"><input type="text" placeholder="Search LGU..."></div>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>LGU</th>
                        <th class="num">Male</th>
                        <th class="num">Female</th>
                        <th class="num">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sets['ip'] as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="lgu-name">{{ $r->lgu_name }}</td>
                        <td class="num">{!! $r->male !== null ? number_format($r->male) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->female !== null ? number_format($r->female) : '<span class="null-dash">—</span>' !!}</td>
                        <td class="num">{!! $r->total !== null ? '<strong>'.number_format($r->total).'</strong>' : '<span class="null-dash">—</span>' !!}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center; color:var(--muted);">No archived IP children records.</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="num">{{ number_format($sets['ip']->sum('male')) }}</td>
                        <td class="num">{{ number_format($sets['ip']->sum('female')) }}</td>
                        <td class="num">{{ number_format($sets['ip']->sum('total')) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endforeach
@endsection

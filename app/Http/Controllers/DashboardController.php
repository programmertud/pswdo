<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $year = 2025;

        $totalChildren = DB::table('lgu_populations')->where('year', $year)->sum('total');
        $totalDisability = DB::table('children_with_disability')->where('year', $year)->sum('total');
        $totalIP = DB::table('ip_children')->where('year', $year)->sum('total');
        $totalCNSP = DB::table('protection_records')->where('year', $year)->sum('cnsp_cases');
        $totalPregnant = DB::table('survival_records')->where('year', $year)->sum('pregnant_adolescents_10_19');
        $avgImmunization = DB::table('survival_records')->where('year', $year)->avg('immunization_rate');

        $topLGUs = DB::table('lgu_populations')
            ->where('year', $year)
            ->whereNotNull('total')
            ->orderByDesc('total')
            ->limit(5)
            ->get(['lgu_name', 'total']);

        $immunizationData = DB::table('survival_records')
            ->where('year', $year)
            ->orderBy('lgu_name')
            ->get(['lgu_name', 'immunization_rate']);

        $totalMale = DB::table('lgu_populations')->where('year', $year)->sum('male');
        $totalFemale = DB::table('lgu_populations')->where('year', $year)->sum('female');

        return view('dashboard.index', compact(
            'totalChildren',
            'totalDisability',
            'totalIP',
            'totalCNSP',
            'totalPregnant',
            'avgImmunization',
            'topLGUs',
            'immunizationData',
            'totalMale',
            'totalFemale'
        ));
    }
}

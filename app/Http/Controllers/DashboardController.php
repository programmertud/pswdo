<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $year = (int) date('Y');

        // Population
        $totalChildren = DB::table('lgu_populations')->where('year', $year)->sum('total');
        $totalMale     = DB::table('lgu_populations')->where('year', $year)->sum('male');
        $totalFemale   = DB::table('lgu_populations')->where('year', $year)->sum('female');

        // Survival
        $avgImmunization = DB::table('survival_records')->where('year', $year)->avg('immunization_rate');
        $totalPregnant   = DB::table('survival_records')->where('year', $year)->sum('pregnant_adolescents_10_19');

        // Development
        $totalDevelopment  = DB::table('development_records')->where('year', $year)->sum('children_in_school_total');
        $developmentMale   = DB::table('development_records')->where('year', $year)->sum('children_in_school_male');
        $developmentFemale = DB::table('development_records')->where('year', $year)->sum('children_in_school_female');
        $totalOutOfSchool  = DB::table('development_records')->where('year', $year)->sum('children_out_of_school_total');
        $outOfSchoolMale   = DB::table('development_records')->where('year', $year)->sum('children_out_of_school_male');
        $outOfSchoolFemale = DB::table('development_records')->where('year', $year)->sum('children_out_of_school_female');

        // Protection
        $totalCNSP = DB::table('protection_records')->where('year', $year)->sum('cnsp_cases');
        $totalCAR  = DB::table('protection_records')->where('year', $year)->sum('car_cases');
        $totalCICL = DB::table('protection_records')->where('year', $year)->sum('cicl_cases');
        $protectionMale   = DB::table('protection_records')->where('year', $year)->sum('car_cicl_male');
        $protectionFemale = DB::table('protection_records')->where('year', $year)->sum('car_cicl_female');

        // Disability
        $totalDisability  = DB::table('children_with_disability')->where('year', $year)->sum('total');
        $disabilityMale   = DB::table('children_with_disability')->where('year', $year)->sum('male');
        $disabilityFemale = DB::table('children_with_disability')->where('year', $year)->sum('female');

        // IP Children
        $totalIP  = DB::table('ip_children')->where('year', $year)->sum('total');
        $ipMale   = DB::table('ip_children')->where('year', $year)->sum('male');
        $ipFemale = DB::table('ip_children')->where('year', $year)->sum('female');

        // Chart data
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

        return view('dashboard.index', compact(
            'totalChildren', 'totalMale', 'totalFemale',
            'avgImmunization', 'totalPregnant',
            'totalDevelopment', 'developmentMale', 'developmentFemale',
            'totalOutOfSchool', 'outOfSchoolMale', 'outOfSchoolFemale',
            'totalCNSP', 'totalCAR', 'totalCICL', 'protectionMale', 'protectionFemale',
            'totalDisability', 'disabilityMale', 'disabilityFemale',
            'totalIP', 'ipMale', 'ipFemale',
            'topLGUs', 'immunizationData'
        ));
    }
}

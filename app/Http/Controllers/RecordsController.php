<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RecordsController extends Controller
{
    private function currentYear(): int
    {
        return 2025;
    }

    private function tableForCurrentYear(string $table)
    {
        return DB::table($table)->where('year', $this->currentYear());
    }

    public function population()
    {
        $query = $this->tableForCurrentYear('lgu_populations');
        $records = (clone $query)->orderBy('lgu_name')->get();
        $totals = [
            'male' => (clone $query)->sum('male'),
            'female' => (clone $query)->sum('female'),
            'total' => (clone $query)->sum('total'),
        ];

        return view('records.population', compact('records', 'totals'));
    }

    public function survival()
    {
        $query = $this->tableForCurrentYear('survival_records');
        $records = (clone $query)->orderBy('lgu_name')->get();
        $totals = [
            'total_pop_12_months' => (clone $query)->sum('total_pop_12_months'),
            'actual_0_59_months_weighed' => (clone $query)->sum('actual_0_59_months_weighed'),
            'total_pop_0_59_months' => (clone $query)->sum('total_pop_0_59_months'),
            'pregnant_adolescents_10_19' => (clone $query)->sum('pregnant_adolescents_10_19'),
            'avg_immunization' => (clone $query)->avg('immunization_rate'),
        ];

        return view('records.survival', compact('records', 'totals'));
    }

    public function development()
    {
        $query = $this->tableForCurrentYear('development_records');
        $records = (clone $query)->orderBy('lgu_name')->get();
        $totals = [
            'male' => (clone $query)->sum('children_in_school_male'),
            'female' => (clone $query)->sum('children_in_school_female'),
            'total' => (clone $query)->sum('children_in_school_total'),
        ];

        return view('records.development', compact('records', 'totals'));
    }

    public function protection()
    {
        $query = $this->tableForCurrentYear('protection_records');
        $records = (clone $query)->orderBy('lgu_name')->get();
        $totals = [
            'cnsp_cases' => (clone $query)->sum('cnsp_cases'),
            'car_cicl_cases' => (clone $query)->sum('car_cicl_cases'),
            'male' => (clone $query)->sum('car_cicl_male'),
            'female' => (clone $query)->sum('car_cicl_female'),
            'total' => (clone $query)->sum('car_cicl_total'),
        ];

        return view('records.protection', compact('records', 'totals'));
    }

    public function disability()
    {
        $query = $this->tableForCurrentYear('children_with_disability');
        $records = (clone $query)->orderBy('lgu_name')->get();
        $totals = [
            'male' => (clone $query)->sum('male'),
            'female' => (clone $query)->sum('female'),
            'total' => (clone $query)->sum('total'),
        ];

        return view('records.disability', compact('records', 'totals'));
    }

    public function ip()
    {
        $query = $this->tableForCurrentYear('ip_children');
        $records = (clone $query)->orderBy('lgu_name')->get();
        $totals = [
            'male' => (clone $query)->sum('male'),
            'female' => (clone $query)->sum('female'),
            'total' => (clone $query)->sum('total'),
        ];

        return view('records.ip', compact('records', 'totals'));
    }

    public function history()
    {
        $currentYear = $this->currentYear();
        $years = DB::table('lgu_populations')
            ->select('year')
            ->where('year', '<', $currentYear)
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        if ($years->isEmpty()) {
            $years = collect([2025]);
        }

        $history = [];

        foreach ($years as $year) {
            $history[$year] = [
                'population' => DB::table('lgu_populations')->where('year', $year)->orderBy('lgu_name')->get(),
                'survival' => DB::table('survival_records')->where('year', $year)->orderBy('lgu_name')->get(),
                'development' => DB::table('development_records')->where('year', $year)->orderBy('lgu_name')->get(),
                'protection' => DB::table('protection_records')->where('year', $year)->orderBy('lgu_name')->get(),
                'disability' => DB::table('children_with_disability')->where('year', $year)->orderBy('lgu_name')->get(),
                'ip' => DB::table('ip_children')->where('year', $year)->orderBy('lgu_name')->get(),
            ];
        }

        return view('records.History', compact('history'));
    }
}

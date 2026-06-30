<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddRecordController extends Controller
{
    const LGUS = [
        'Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna',
        'Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso',
        'San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod','Surigao City'
    ];

    private function currentYear(): int
    {
        return (int) date('Y');
    }

    // ── Generic helpers ────────────────────────────────────────────────

    /**
     * Add data onto an existing LGU+year row (accumulate), or insert new if none exists.
     * Numeric fields are summed; string fields (lgu_name, remarks) are set directly.
     */
    private function accumulateRecord(string $table, array $data, array $numericFields): void
    {
        $year = $this->currentYear();
        $existing = DB::table($table)
            ->where('lgu_name', $data['lgu_name'])
            ->where('year', $year)
            ->first();

        if ($existing) {
            $updates = ['updated_at' => now()];
            foreach ($numericFields as $field) {
                $incoming = isset($data[$field]) && $data[$field] !== null ? (float) $data[$field] : 0;
                $current  = isset($existing->$field)  && $existing->$field  !== null ? (float) $existing->$field  : 0;
                $updates[$field] = $current + $incoming;
            }
            // String fields (e.g. remarks) — overwrite if provided
            foreach ($data as $key => $val) {
                if (!in_array($key, $numericFields) && $key !== 'lgu_name') {
                    $updates[$key] = $val;
                }
            }
            DB::table($table)
                ->where('lgu_name', $data['lgu_name'])
                ->where('year', $year)
                ->update($updates);
        } else {
            $data['year'] = $year;
            DB::table($table)->insert(array_merge($data, [
                'created_at' => now(), 'updated_at' => now()
            ]));
        }
    }

    private function updateById(string $table, int $id, array $data): void
    {
        DB::table($table)->where('id', $id)->update(array_merge($data, ['updated_at' => now()]));
    }

    private function destroyById(string $table, int $id): void
    {
        DB::table($table)->where('id', $id)->delete();
    }

    private function handleChildInfo(Request $request, string $category)
    {
        if ($request->filled('child_name') && $request->filled('child_age')) {
            \App\ChildInfo::create([
                'name'     => $request->child_name,
                'age'      => $request->child_age,
                'lgu_name' => $request->lgu_name,
                'category' => $category,
            ]);
        }
    }


    // ── Add form (sidebar link) ────────────────────────────────────────
    public function index()
    {
        return view('records.add', ['lgus' => self::LGUS]);
    }

    // ══════════════════════════════════════════════════════════════════
    //  POPULATION
    // ══════════════════════════════════════════════════════════════════
    public function storePopulation(Request $request)
    {
        $data = $request->validate([
            'lgu_name' => 'required|string|max:100',
            'male'     => 'nullable|integer|min:0',
            'female'   => 'nullable|integer|min:0',
            'total'    => 'nullable|integer|min:0',
        ]);
        $this->accumulateRecord('lgu_populations', $data, ['male','female','total']);
        return redirect()->route('records.population')->with('success', "Population record for {$data['lgu_name']} saved (values accumulated).");
    }

    public function updatePopulation(Request $request, int $id)
    {
        $data = $request->validate([
            'lgu_name' => 'required|string|max:100',
            'male'     => 'nullable|integer|min:0',
            'female'   => 'nullable|integer|min:0',
            'total'    => 'nullable|integer|min:0',
        ]);
        $this->updateById('lgu_populations', $id, $data);
        return redirect()->route('records.population')->with('success', "Population record for {$data['lgu_name']} updated.");
    }

    public function destroyPopulation(int $id)
    {
        $this->destroyById('lgu_populations', $id);
        return redirect()->route('records.population')->with('success', 'Population record deleted.');
    }

    // ══════════════════════════════════════════════════════════════════
    //  SURVIVAL
    // ══════════════════════════════════════════════════════════════════
    public function storeSurvival(Request $request)
    {
        $data = $request->validate([
            'lgu_name'                   => 'required|string|max:100',
            'immunization_rate'          => 'nullable|numeric|min:0|max:100',
            'total_pop_12_months'        => 'nullable|integer|min:0',
            'actual_0_59_months_weighed' => 'nullable|integer|min:0',
            'total_pop_0_59_months'      => 'nullable|integer|min:0',
            'pregnant_adolescents_10_19' => 'nullable|integer|min:0',
            'child_name'                 => 'required|string|max:255',
            'child_age'                  => 'required|integer|min:0',
        ]);
        $this->handleChildInfo($request, 'Survival');
        unset($data['child_name'], $data['child_age']);
        $this->accumulateRecord('survival_records', $data, [
            'immunization_rate','total_pop_12_months','actual_0_59_months_weighed',
            'total_pop_0_59_months','pregnant_adolescents_10_19'
        ]);
        return redirect()->route('records.survival')->with('success', "Survival record for {$data['lgu_name']} saved (values accumulated).");
    }

    public function updateSurvival(Request $request, int $id)
    {
        $data = $request->validate([
            'lgu_name'                   => 'required|string|max:100',
            'immunization_rate'          => 'nullable|numeric|min:0|max:100',
            'total_pop_12_months'        => 'nullable|integer|min:0',
            'actual_0_59_months_weighed' => 'nullable|integer|min:0',
            'total_pop_0_59_months'      => 'nullable|integer|min:0',
            'pregnant_adolescents_10_19' => 'nullable|integer|min:0',
        ]);
        $this->updateById('survival_records', $id, $data);
        return redirect()->route('records.survival')->with('success', "Survival record for {$data['lgu_name']} updated.");
    }

    public function destroySurvival(int $id)
    {
        $this->destroyById('survival_records', $id);
        return redirect()->route('records.survival')->with('success', 'Survival record deleted.');
    }

    // ══════════════════════════════════════════════════════════════════
    //  DEVELOPMENT
    // ══════════════════════════════════════════════════════════════════
    public function storeDevelopment(Request $request)
    {
        $data = $request->validate([
            'lgu_name' => 'required|string|max:100',
            'gender'   => 'required|in:male,female',
            'remarks'  => 'nullable|string|max:255',
            'child_name' => 'required|string|max:255',
            'child_age'  => 'required|integer|min:0',
        ]);
        $this->handleChildInfo($request, 'Development');
        $isMale   = $data['gender'] === 'male';
        $tableData = [
            'lgu_name'                  => $data['lgu_name'],
            'children_in_school_male'   => $isMale ? 1 : 0,
            'children_in_school_female' => $isMale ? 0 : 1,
            'children_in_school_total'  => 1,
            'remarks'                   => $data['remarks'] ?? null,
        ];
        $this->accumulateRecord('development_records', $tableData, [
            'children_in_school_male','children_in_school_female','children_in_school_total'
        ]);
        return redirect()->route('records.development')->with('success', "Development record for {$data['lgu_name']} saved.");
    }

    public function updateDevelopment(Request $request, int $id)
    {
        $data = $request->validate([
            'lgu_name'                  => 'required|string|max:100',
            'children_in_school_male'   => 'nullable|integer|min:0',
            'children_in_school_female' => 'nullable|integer|min:0',
            'children_in_school_total'  => 'nullable|integer|min:0',
            'remarks'                   => 'nullable|string|max:255',
        ]);
        $this->updateById('development_records', $id, $data);
        return redirect()->route('records.development')->with('success', "Development record for {$data['lgu_name']} updated.");
    }

    public function destroyDevelopment(int $id)
    {
        $this->destroyById('development_records', $id);
        return redirect()->route('records.development')->with('success', 'Development record deleted.');
    }

    // ══════════════════════════════════════════════════════════════════
    //  PROTECTION
    // ══════════════════════════════════════════════════════════════════
    public function storeProtection(Request $request)
    {
        $data = $request->validate([
            'lgu_name'       => 'required|string|max:100',
            'cnsp_cases'     => 'nullable|integer|min:0',
            'car_cicl_cases' => 'nullable|integer|min:0',
            'gender'         => 'required|in:male,female',
            'child_name'     => 'required|string|max:255',
            'child_age'      => 'required|integer|min:0',
        ]);
        $this->handleChildInfo($request, 'Protection');
        $isMale   = $data['gender'] === 'male';
        $tableData = [
            'lgu_name'        => $data['lgu_name'],
            'cnsp_cases'      => $data['cnsp_cases'] ?? null,
            'car_cicl_cases'  => $data['car_cicl_cases'] ?? null,
            'car_cicl_male'   => $isMale ? 1 : 0,
            'car_cicl_female' => $isMale ? 0 : 1,
            'car_cicl_total'  => 1,
        ];
        $this->accumulateRecord('protection_records', $tableData, [
            'cnsp_cases','car_cicl_cases','car_cicl_male','car_cicl_female','car_cicl_total'
        ]);
        return redirect()->route('records.protection')->with('success', "Protection record for {$data['lgu_name']} saved.");
    }

    public function updateProtection(Request $request, int $id)
    {
        $data = $request->validate([
            'lgu_name'        => 'required|string|max:100',
            'cnsp_cases'      => 'nullable|integer|min:0',
            'car_cicl_cases'  => 'nullable|integer|min:0',
            'car_cicl_male'   => 'nullable|integer|min:0',
            'car_cicl_female' => 'nullable|integer|min:0',
            'car_cicl_total'  => 'nullable|integer|min:0',
        ]);
        $this->updateById('protection_records', $id, $data);
        return redirect()->route('records.protection')->with('success', "Protection record for {$data['lgu_name']} updated.");
    }

    public function destroyProtection(int $id)
    {
        $this->destroyById('protection_records', $id);
        return redirect()->route('records.protection')->with('success', 'Protection record deleted.');
    }

    // ══════════════════════════════════════════════════════════════════
    //  DISABILITY
    // ══════════════════════════════════════════════════════════════════
    public function storeDisability(Request $request)
    {
        $data = $request->validate([
            'lgu_name'   => 'required|string|max:100',
            'gender'     => 'required|in:male,female',
            'child_name' => 'required|string|max:255',
            'child_age'  => 'required|integer|min:0',
        ]);
        $this->handleChildInfo($request, 'Disability');
        $isMale   = $data['gender'] === 'male';
        $tableData = [
            'lgu_name' => $data['lgu_name'],
            'male'     => $isMale ? 1 : 0,
            'female'   => $isMale ? 0 : 1,
            'total'    => 1,
        ];
        $this->accumulateRecord('children_with_disability', $tableData, ['male','female','total']);
        return redirect()->route('records.disability')->with('success', "Disability record for {$data['lgu_name']} saved.");
    }

    public function updateDisability(Request $request, int $id)
    {
        $data = $request->validate([
            'lgu_name' => 'required|string|max:100',
            'male'     => 'nullable|integer|min:0',
            'female'   => 'nullable|integer|min:0',
            'total'    => 'nullable|integer|min:0',
        ]);
        $this->updateById('children_with_disability', $id, $data);
        return redirect()->route('records.disability')->with('success', "Disability record for {$data['lgu_name']} updated.");
    }

    public function destroyDisability(int $id)
    {
        $this->destroyById('children_with_disability', $id);
        return redirect()->route('records.disability')->with('success', 'Disability record deleted.');
    }

    // ══════════════════════════════════════════════════════════════════
    //  IP CHILDREN
    // ══════════════════════════════════════════════════════════════════
    public function storeIP(Request $request)
    {
        $data = $request->validate([
            'lgu_name'   => 'required|string|max:100',
            'gender'     => 'required|in:male,female',
            'child_name' => 'required|string|max:255',
            'child_age'  => 'required|integer|min:0',
        ]);
        $this->handleChildInfo($request, 'IP Children');
        $isMale   = $data['gender'] === 'male';
        $tableData = [
            'lgu_name' => $data['lgu_name'],
            'male'     => $isMale ? 1 : 0,
            'female'   => $isMale ? 0 : 1,
            'total'    => 1,
        ];
        $this->accumulateRecord('ip_children', $tableData, ['male','female','total']);
        return redirect()->route('records.ip')->with('success', "IP Children record for {$data['lgu_name']} saved.");
    }

    public function updateIP(Request $request, int $id)
    {
        $data = $request->validate([
            'lgu_name' => 'required|string|max:100',
            'male'     => 'nullable|integer|min:0',
            'female'   => 'nullable|integer|min:0',
            'total'    => 'nullable|integer|min:0',
        ]);
        $this->updateById('ip_children', $id, $data);
        return redirect()->route('records.ip')->with('success', "IP Children record for {$data['lgu_name']} updated.");
    }

    public function destroyIP(int $id)
    {
        $this->destroyById('ip_children', $id);
        return redirect()->route('records.ip')->with('success', 'IP Children record deleted.');
    }
}

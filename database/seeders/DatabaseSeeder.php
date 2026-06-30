<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── TOTAL POPULATION OF CHILDREN ──────────────────────────────
        $populations = [
            ['lgu_name' => 'Alegria',       'male' => 3629,  'female' => 3320,  'total' => 6949],
            ['lgu_name' => 'Bacuag',        'male' => 2318,  'female' => 2128,  'total' => 4446],
            ['lgu_name' => 'Burgos',        'male' => null,  'female' => null,  'total' => 973],
            ['lgu_name' => 'Claver',        'male' => 8268,  'female' => 7551,  'total' => 15819],
            ['lgu_name' => 'Dapa',          'male' => null,  'female' => null,  'total' => 8462],
            ['lgu_name' => 'Del Carmen',    'male' => 4148,  'female' => 3789,  'total' => 7937],
            ['lgu_name' => 'General Luna',  'male' => 3549,  'female' => 3976,  'total' => 7525],
            ['lgu_name' => 'Gigaquit',      'male' => 4532,  'female' => 3778,  'total' => 8310],
            ['lgu_name' => 'Mainit',        'male' => 4624,  'female' => 4368,  'total' => 8992],
            ['lgu_name' => 'Malimono',      'male' => 1793,  'female' => 1697,  'total' => 3490],
            ['lgu_name' => 'Pilar',         'male' => null,  'female' => null,  'total' => null],
            ['lgu_name' => 'Placer',        'male' => 4681,  'female' => 4406,  'total' => 9087],
            ['lgu_name' => 'San Benito',    'male' => 1043,  'female' => 1008,  'total' => 2051],
            ['lgu_name' => 'San Franciso',  'male' => 2685,  'female' => 2529,  'total' => 5214],
            ['lgu_name' => 'San Isidro',    'male' => 1773,  'female' => 1632,  'total' => 3405],
            ['lgu_name' => 'Santa Monica',  'male' => 2750,  'female' => 2456,  'total' => 5206],
            ['lgu_name' => 'Sison',         'male' => 3083,  'female' => 2845,  'total' => 5928],
            ['lgu_name' => 'Socorro',       'male' => null,  'female' => null,  'total' => 6153],
            ['lgu_name' => 'Tagana-an',     'male' => null,  'female' => null,  'total' => 4796],
            ['lgu_name' => 'Tubod',         'male' => 2588,  'female' => 2438,  'total' => 5026],
            ['lgu_name' => 'Surigao City',  'male' => 30962, 'female' => 29080, 'total' => 60042],
        ];
        foreach ($populations as $row) {
            DB::table('lgu_populations')->insert(array_merge($row, [
                'created_at' => now(), 'updated_at' => now()
            ]));
        }

        // ── SURVIVAL ──────────────────────────────────────────────────
        $survival = [
            ['lgu_name' => 'Alegria',       'immunization_rate' => 97.85, 'total_pop_12_months' => 300,  'actual_0_59_months_weighed' => 1482,  'total_pop_0_59_months' => 1628,  'pregnant_adolescents_10_19' => 24],
            ['lgu_name' => 'Bacuag',        'immunization_rate' => 78.65, 'total_pop_12_months' => 249,  'actual_0_59_months_weighed' => 1098,  'total_pop_0_59_months' => 1250,  'pregnant_adolescents_10_19' => 15],
            ['lgu_name' => 'Burgos',        'immunization_rate' => 71.28, 'total_pop_12_months' => 88,   'actual_0_59_months_weighed' => 458,   'total_pop_0_59_months' => 388,   'pregnant_adolescents_10_19' => 1],
            ['lgu_name' => 'Claver',        'immunization_rate' => 83.42, 'total_pop_12_months' => 740,  'actual_0_59_months_weighed' => 4037,  'total_pop_0_59_months' => 4017,  'pregnant_adolescents_10_19' => 41],
            ['lgu_name' => 'Dapa',          'immunization_rate' => 91.92, 'total_pop_12_months' => 539,  'actual_0_59_months_weighed' => 2129,  'total_pop_0_59_months' => 2848,  'pregnant_adolescents_10_19' => 49],
            ['lgu_name' => 'Del Carmen',    'immunization_rate' => 58.68, 'total_pop_12_months' => 419,  'actual_0_59_months_weighed' => 1731,  'total_pop_0_59_months' => 2125,  'pregnant_adolescents_10_19' => 37],
            ['lgu_name' => 'General Luna',  'immunization_rate' => 56.23, 'total_pop_12_months' => 488,  'actual_0_59_months_weighed' => 1751,  'total_pop_0_59_months' => 2397,  'pregnant_adolescents_10_19' => 8],
            ['lgu_name' => 'Gigaquit',      'immunization_rate' => 80.38, 'total_pop_12_months' => 384,  'actual_0_59_months_weighed' => 4967,  'total_pop_0_59_months' => 2188,  'pregnant_adolescents_10_19' => 20],
            ['lgu_name' => 'Mainit',        'immunization_rate' => 86.70, 'total_pop_12_months' => 548,  'actual_0_59_months_weighed' => 2377,  'total_pop_0_59_months' => 2767,  'pregnant_adolescents_10_19' => 51],
            ['lgu_name' => 'Malimono',      'immunization_rate' => 77.15, 'total_pop_12_months' => 273,  'actual_0_59_months_weighed' => 1231,  'total_pop_0_59_months' => 1670,  'pregnant_adolescents_10_19' => 9],
            ['lgu_name' => 'Pilar',         'immunization_rate' => 61.37, 'total_pop_12_months' => 219,  'actual_0_59_months_weighed' => 856,   'total_pop_0_59_months' => 1056,  'pregnant_adolescents_10_19' => 15],
            ['lgu_name' => 'Placer',        'immunization_rate' => 74.58, 'total_pop_12_months' => 559,  'actual_0_59_months_weighed' => 2122,  'total_pop_0_59_months' => 2708,  'pregnant_adolescents_10_19' => 29],
            ['lgu_name' => 'San Benito',    'immunization_rate' => 82.50, 'total_pop_12_months' => 110,  'actual_0_59_months_weighed' => 659,   'total_pop_0_59_months' => 552,   'pregnant_adolescents_10_19' => 9],
            ['lgu_name' => 'San Franciso',  'immunization_rate' => 85.32, 'total_pop_12_months' => 230,  'actual_0_59_months_weighed' => 717,   'total_pop_0_59_months' => 1234,  'pregnant_adolescents_10_19' => 17],
            ['lgu_name' => 'San Isidro',    'immunization_rate' => 48.62, 'total_pop_12_months' => 169,  'actual_0_59_months_weighed' => 643,   'total_pop_0_59_months' => 797,   'pregnant_adolescents_10_19' => 4],
            ['lgu_name' => 'Santa Monica',  'immunization_rate' => 60.43, 'total_pop_12_months' => 171,  'actual_0_59_months_weighed' => 715,   'total_pop_0_59_months' => 850,   'pregnant_adolescents_10_19' => 8],
            ['lgu_name' => 'Sison',         'immunization_rate' => 98.95, 'total_pop_12_months' => 261,  'actual_0_59_months_weighed' => 1440,  'total_pop_0_59_months' => 1303,  'pregnant_adolescents_10_19' => 35],
            ['lgu_name' => 'Socorro',       'immunization_rate' => 51.90, 'total_pop_12_months' => 778,  'actual_0_59_months_weighed' => 2904,  'total_pop_0_59_months' => 3595,  'pregnant_adolescents_10_19' => 41],
            ['lgu_name' => 'Tagana-an',     'immunization_rate' => 83.28, 'total_pop_12_months' => 301,  'actual_0_59_months_weighed' => 1237,  'total_pop_0_59_months' => 1584,  'pregnant_adolescents_10_19' => 34],
            ['lgu_name' => 'Tubod',         'immunization_rate' => 99.22, 'total_pop_12_months' => 233,  'actual_0_59_months_weighed' => 1155,  'total_pop_0_59_months' => 1345,  'pregnant_adolescents_10_19' => 14],
            ['lgu_name' => 'Surigao City',  'immunization_rate' => 79.41, 'total_pop_12_months' => 3129, 'actual_0_59_months_weighed' => 14005, 'total_pop_0_59_months' => 16276, 'pregnant_adolescents_10_19' => 208],
        ];
        foreach ($survival as $row) {
            DB::table('survival_records')->insert(array_merge($row, [
                'created_at' => now(), 'updated_at' => now()
            ]));
        }

        // ── DEVELOPMENT ───────────────────────────────────────────────
        $development = [
            ['lgu_name' => 'Alegria',       'children_in_school_male' => 128,  'children_in_school_female' => 116,  'children_in_school_total' => 244,  'remarks' => null],
            ['lgu_name' => 'Bacuag',        'children_in_school_male' => 679,  'children_in_school_female' => 723,  'children_in_school_total' => 1402, 'remarks' => null],
            ['lgu_name' => 'Burgos',        'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => null, 'remarks' => null],
            ['lgu_name' => 'Claver',        'children_in_school_male' => 521,  'children_in_school_female' => 357,  'children_in_school_total' => 878,  'remarks' => 'Only ECCD enrollees'],
            ['lgu_name' => 'Dapa',          'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => null, 'remarks' => null],
            ['lgu_name' => 'Del Carmen',    'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => null, 'remarks' => null],
            ['lgu_name' => 'General Luna',  'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => null, 'remarks' => null],
            ['lgu_name' => 'Gigaquit',      'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => 547,  'remarks' => 'Only ECCD enrollees'],
            ['lgu_name' => 'Mainit',        'children_in_school_male' => 3509, 'children_in_school_female' => 3432, 'children_in_school_total' => 6941, 'remarks' => null],
            ['lgu_name' => 'Malimono',      'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => null, 'remarks' => null],
            ['lgu_name' => 'Pilar',         'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => null, 'remarks' => null],
            ['lgu_name' => 'Placer',        'children_in_school_male' => 1660, 'children_in_school_female' => 3555, 'children_in_school_total' => 310,  'remarks' => 'Only ECCD enrollees'],
            ['lgu_name' => 'San Benito',    'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => 7215, 'remarks' => null],
            ['lgu_name' => 'San Franciso',  'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => 202,  'remarks' => 'Only ECCD enrollees'],
            ['lgu_name' => 'San Isidro',    'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => 206,  'remarks' => 'Only ECCD enrollees'],
            ['lgu_name' => 'Santa Monica',  'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => 205,  'remarks' => 'Only ECCD enrollees'],
            ['lgu_name' => 'Sison',         'children_in_school_male' => 3083, 'children_in_school_female' => 2845, 'children_in_school_total' => 4198, 'remarks' => null],
            ['lgu_name' => 'Socorro',       'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => 5928, 'remarks' => null],
            ['lgu_name' => 'Tagana-an',     'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => 6153, 'remarks' => null],
            ['lgu_name' => 'Tubod',         'children_in_school_male' => 2049, 'children_in_school_female' => 1953, 'children_in_school_total' => 4002, 'remarks' => null],
            ['lgu_name' => 'Surigao City',  'children_in_school_male' => null, 'children_in_school_female' => null, 'children_in_school_total' => 2854, 'remarks' => 'Only ECCD enrollees'],
        ];
        foreach ($development as $row) {
            DB::table('development_records')->insert(array_merge($row, [
                'created_at' => now(), 'updated_at' => now()
            ]));
        }

        // ── PROTECTION ────────────────────────────────────────────────
        $protection = [
            ['lgu_name' => 'Alegria',       'cnsp_cases' => 2,    'car_cicl_cases' => 13,   'car_cicl_male' => 12,   'car_cicl_female' => 3,    'car_cicl_total' => 15],
            ['lgu_name' => 'Bacuag',        'cnsp_cases' => 4,    'car_cicl_cases' => 2,    'car_cicl_male' => 4,    'car_cicl_female' => 2,    'car_cicl_total' => 6],
            ['lgu_name' => 'Burgos',        'cnsp_cases' => 2,    'car_cicl_cases' => 4,    'car_cicl_male' => 2,    'car_cicl_female' => 4,    'car_cicl_total' => 6],
            ['lgu_name' => 'Claver',        'cnsp_cases' => null, 'car_cicl_cases' => null, 'car_cicl_male' => 35,   'car_cicl_female' => 37,   'car_cicl_total' => 72],
            ['lgu_name' => 'Dapa',          'cnsp_cases' => 2,    'car_cicl_cases' => 46,   'car_cicl_male' => 46,   'car_cicl_female' => 2,    'car_cicl_total' => 48],
            ['lgu_name' => 'Del Carmen',    'cnsp_cases' => 2,    'car_cicl_cases' => 5,    'car_cicl_male' => 6,    'car_cicl_female' => 1,    'car_cicl_total' => 7],
            ['lgu_name' => 'General Luna',  'cnsp_cases' => 14,   'car_cicl_cases' => 30,   'car_cicl_male' => 37,   'car_cicl_female' => 7,    'car_cicl_total' => 44],
            ['lgu_name' => 'Gigaquit',      'cnsp_cases' => 6,    'car_cicl_cases' => 5,    'car_cicl_male' => 7,    'car_cicl_female' => 4,    'car_cicl_total' => 11],
            ['lgu_name' => 'Mainit',        'cnsp_cases' => 7,    'car_cicl_cases' => null, 'car_cicl_male' => null, 'car_cicl_female' => 7,    'car_cicl_total' => 7],
            ['lgu_name' => 'Malimono',      'cnsp_cases' => 8,    'car_cicl_cases' => null, 'car_cicl_male' => null, 'car_cicl_female' => 8,    'car_cicl_total' => 8],
            ['lgu_name' => 'Pilar',         'cnsp_cases' => null, 'car_cicl_cases' => 16,   'car_cicl_male' => 5,    'car_cicl_female' => 11,   'car_cicl_total' => 16],
            ['lgu_name' => 'Placer',        'cnsp_cases' => 3,    'car_cicl_cases' => null, 'car_cicl_male' => null, 'car_cicl_female' => 3,    'car_cicl_total' => 3],
            ['lgu_name' => 'San Benito',    'cnsp_cases' => 4,    'car_cicl_cases' => null, 'car_cicl_male' => null, 'car_cicl_female' => 4,    'car_cicl_total' => 4],
            ['lgu_name' => 'San Franciso',  'cnsp_cases' => 4,    'car_cicl_cases' => null, 'car_cicl_male' => null, 'car_cicl_female' => 4,    'car_cicl_total' => 4],
            ['lgu_name' => 'San Isidro',    'cnsp_cases' => 1,    'car_cicl_cases' => null, 'car_cicl_male' => 1,    'car_cicl_female' => null, 'car_cicl_total' => 1],
            ['lgu_name' => 'Santa Monica',  'cnsp_cases' => 3,    'car_cicl_cases' => null, 'car_cicl_male' => 3,    'car_cicl_female' => null, 'car_cicl_total' => 3],
            ['lgu_name' => 'Sison',         'cnsp_cases' => 2,    'car_cicl_cases' => 4,    'car_cicl_male' => 4,    'car_cicl_female' => 2,    'car_cicl_total' => 6],
            ['lgu_name' => 'Socorro',       'cnsp_cases' => null, 'car_cicl_cases' => 17,   'car_cicl_male' => 14,   'car_cicl_female' => 3,    'car_cicl_total' => 17],
            ['lgu_name' => 'Tagana-an',     'cnsp_cases' => null, 'car_cicl_cases' => 24,   'car_cicl_male' => 7,    'car_cicl_female' => 17,   'car_cicl_total' => 24],
            ['lgu_name' => 'Tubod',         'cnsp_cases' => 4,    'car_cicl_cases' => null, 'car_cicl_male' => null, 'car_cicl_female' => 4,    'car_cicl_total' => 4],
            ['lgu_name' => 'Surigao City',  'cnsp_cases' => 32,   'car_cicl_cases' => null, 'car_cicl_male' => 19,   'car_cicl_female' => 13,   'car_cicl_total' => 32],
        ];
        foreach ($protection as $row) {
            DB::table('protection_records')->insert(array_merge($row, [
                'created_at' => now(), 'updated_at' => now()
            ]));
        }

        // ── CHILDREN WITH DISABILITY ──────────────────────────────────
        $disability = [
            ['lgu_name' => 'Alegria',       'male' => 40,   'female' => 43,   'total' => 83],
            ['lgu_name' => 'Bacuag',        'male' => 30,   'female' => 16,   'total' => 46],
            ['lgu_name' => 'Burgos',        'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'Claver',        'male' => 142,  'female' => 77,   'total' => 129],
            ['lgu_name' => 'Dapa',          'male' => null, 'female' => null, 'total' => 66],
            ['lgu_name' => 'Del Carmen',    'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'General Luna',  'male' => 76,   'female' => 48,   'total' => 124],
            ['lgu_name' => 'Gigaquit',      'male' => 42,   'female' => 29,   'total' => 71],
            ['lgu_name' => 'Mainit',        'male' => 4,    'female' => 5,    'total' => 9],
            ['lgu_name' => 'Malimono',      'male' => 62,   'female' => 32,   'total' => 94],
            ['lgu_name' => 'Pilar',         'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'Placer',        'male' => 53,   'female' => 43,   'total' => 96],
            ['lgu_name' => 'San Benito',    'male' => 14,   'female' => 6,    'total' => 20],
            ['lgu_name' => 'San Franciso',  'male' => 30,   'female' => 14,   'total' => 44],
            ['lgu_name' => 'San Isidro',    'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'Santa Monica',  'male' => 2,    'female' => 4,    'total' => 6],
            ['lgu_name' => 'Sison',         'male' => 81,   'female' => 50,   'total' => 131],
            ['lgu_name' => 'Socorro',       'male' => 35,   'female' => 11,   'total' => 41],
            ['lgu_name' => 'Tagana-an',     'male' => 40,   'female' => 13,   'total' => 53],
            ['lgu_name' => 'Tubod',         'male' => 40,   'female' => 32,   'total' => 72],
            ['lgu_name' => 'Surigao City',  'male' => 393,  'female' => 193,  'total' => 586],
        ];
        foreach ($disability as $row) {
            DB::table('children_with_disability')->insert(array_merge($row, [
                'created_at' => now(), 'updated_at' => now()
            ]));
        }

        // ── IP CHILDREN ───────────────────────────────────────────────
        $ip = [
            ['lgu_name' => 'Alegria',       'male' => 122,  'female' => 145,  'total' => 267],
            ['lgu_name' => 'Bacuag',        'male' => 27,   'female' => 37,   'total' => 64],
            ['lgu_name' => 'Burgos',        'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'Claver',        'male' => 183,  'female' => 171,  'total' => 354],
            ['lgu_name' => 'Dapa',          'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'Del Carmen',    'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'General Luna',  'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'Gigaquit',      'male' => 473,  'female' => 534,  'total' => 1012],
            ['lgu_name' => 'Mainit',        'male' => 4792, 'female' => 4664, 'total' => 9456],
            ['lgu_name' => 'Malimono',      'male' => 26,   'female' => 25,   'total' => 51],
            ['lgu_name' => 'Pilar',         'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'Placer',        'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'San Benito',    'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'San Franciso',  'male' => 108,  'female' => 95,   'total' => 203],
            ['lgu_name' => 'San Isidro',    'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'Santa Monica',  'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'Sison',         'male' => 115,  'female' => 112,  'total' => 227],
            ['lgu_name' => 'Socorro',       'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'Tagana-an',     'male' => null, 'female' => null, 'total' => null],
            ['lgu_name' => 'Tubod',         'male' => 88,   'female' => 105,  'total' => 193],
            ['lgu_name' => 'Surigao City',  'male' => 303,  'female' => 334,  'total' => 637],
        ];
        foreach ($ip as $row) {
            DB::table('ip_children')->insert(array_merge($row, [
                'year' => 2025, 'created_at' => now(), 'updated_at' => now()
            ]));
        }

        // ── INITIALIZE 2026 WITH ZEROS ───────────────────────────────
        $lgus = [
            'Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna',
            'Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso',
            'San Isidro','Santa Monica','Sison','Socorro','Surigao City','Tagana-an','Tubod'
        ];
        
        sort($lgus); // Ensure alphabetical order

        foreach ($lgus as $lgu) {
            $now = now();
            // Population
            DB::table('lgu_populations')->insert([
                'year' => 2026, 'lgu_name' => $lgu, 'male' => 0, 'female' => 0, 'total' => 0,
                'created_at' => $now, 'updated_at' => $now
            ]);

            // Survival
            DB::table('survival_records')->insert([
                'year' => 2026, 'lgu_name' => $lgu, 'immunization_rate' => 0, 'total_pop_12_months' => 0,
                'actual_0_59_months_weighed' => 0, 'total_pop_0_59_months' => 0,
                'pregnant_adolescents_10_19' => 0,
                'created_at' => $now, 'updated_at' => $now
            ]);

            // Development
            DB::table('development_records')->insert([
                'year' => 2026, 'lgu_name' => $lgu, 'children_in_school_male' => 0,
                'children_in_school_female' => 0, 'children_in_school_total' => 0, 'remarks' => null,
                'created_at' => $now, 'updated_at' => $now
            ]);

            // Protection
            DB::table('protection_records')->insert([
                'year' => 2026, 'lgu_name' => $lgu, 'cnsp_cases' => 0, 'car_cicl_cases' => 0,
                'car_cicl_male' => 0, 'car_cicl_female' => 0, 'car_cicl_total' => 0,
                'created_at' => $now, 'updated_at' => $now
            ]);

            // Disability
            DB::table('children_with_disability')->insert([
                'year' => 2026, 'lgu_name' => $lgu, 'male' => 0, 'female' => 0, 'total' => 0,
                'created_at' => $now, 'updated_at' => $now
            ]);

            // IP Children
            DB::table('ip_children')->insert([
                'year' => 2026, 'lgu_name' => $lgu, 'male' => 0, 'female' => 0, 'total' => 0,
                'created_at' => $now, 'updated_at' => $now
            ]);
        }
    }
}

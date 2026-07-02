<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Only seed if no users exist yet
        if (DB::table('users')->count() === 0) {
            DB::table('users')->insert([
                'name'       => 'Administrator',
                'username'   => 'admin',
                'password'   => Hash::make('cswdo2025'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

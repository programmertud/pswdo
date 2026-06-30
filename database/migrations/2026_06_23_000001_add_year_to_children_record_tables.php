<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'lgu_populations',
        'survival_records',
        'development_records',
        'protection_records',
        'children_with_disability',
        'ip_children',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (! Schema::hasColumn($tableName, 'year')) {
                    $table->unsignedSmallInteger('year')->default(2025)->after('lgu_name');
                }
            });
        }
    }

    public function down(): void
    {
        foreach (array_reverse($this->tables) as $tableName) {
            if (Schema::hasColumn($tableName, 'year')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('year');
                });
            }
        }
    }
};

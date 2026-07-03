<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('protection_records', function (Blueprint $table) {
            $table->integer('car_cases')->nullable()->after('cnsp_cases');
            $table->integer('cicl_cases')->nullable()->after('car_cases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('protection_records', function (Blueprint $table) {
            $table->dropColumn(['car_cases','cicl_cases']);
        });
    }
};

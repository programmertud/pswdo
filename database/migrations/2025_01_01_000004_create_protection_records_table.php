<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;
    public function up(): void
    {
        Schema::create('protection_records', function (Blueprint $table) {
            $table->id();
            $table->string('lgu_name');
            $table->unsignedSmallInteger('year')->default(2025);
            $table->integer('cnsp_cases')->nullable();
            $table->integer('car_cicl_cases')->nullable();
            $table->integer('car_cicl_male')->nullable();
            $table->integer('car_cicl_female')->nullable();
            $table->integer('car_cicl_total')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('protection_records');
    }
};

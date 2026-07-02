<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;
    public function up(): void
    {
        Schema::create('survival_records', function (Blueprint $table) {
            $table->id();
            $table->string('lgu_name');
            $table->unsignedSmallInteger('year')->default(2025);
            $table->decimal('immunization_rate', 5, 2)->nullable();
            $table->integer('total_pop_12_months')->nullable();
            $table->integer('actual_0_59_months_weighed')->nullable();
            $table->integer('total_pop_0_59_months')->nullable();
            $table->integer('pregnant_adolescents_10_19')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survival_records');
    }
};

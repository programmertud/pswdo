<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lgu_populations', function (Blueprint $table) {
            $table->id();
            $table->string('lgu_name');
            $table->integer('male')->nullable();
            $table->integer('female')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();
        });

        Schema::create('survival_records', function (Blueprint $table) {
            $table->id();
            $table->string('lgu_name');
            $table->decimal('immunization_rate', 5, 2)->nullable(); // % fully immunized children aged 12 months
            $table->integer('total_pop_12_months')->nullable();
            $table->integer('actual_0_59_months_weighed')->nullable();
            $table->integer('total_pop_0_59_months')->nullable();
            $table->integer('pregnant_adolescents_10_19')->nullable();
            $table->timestamps();
        });

        Schema::create('development_records', function (Blueprint $table) {
            $table->id();
            $table->string('lgu_name');
            $table->integer('children_in_school_male')->nullable();
            $table->integer('children_in_school_female')->nullable();
            $table->integer('children_in_school_total')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });

        Schema::create('protection_records', function (Blueprint $table) {
            $table->id();
            $table->string('lgu_name');
            $table->integer('cnsp_cases')->nullable(); // Children in Need of Special Protection
            $table->integer('car_cicl_cases')->nullable(); // CAR and CICL cases
            $table->integer('car_cicl_male')->nullable();
            $table->integer('car_cicl_female')->nullable();
            $table->integer('car_cicl_total')->nullable();
            $table->timestamps();
        });

        Schema::create('children_with_disability', function (Blueprint $table) {
            $table->id();
            $table->string('lgu_name');
            $table->integer('male')->nullable();
            $table->integer('female')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();
        });

        Schema::create('ip_children', function (Blueprint $table) {
            $table->id();
            $table->string('lgu_name');
            $table->integer('male')->nullable();
            $table->integer('female')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_children');
        Schema::dropIfExists('children_with_disability');
        Schema::dropIfExists('protection_records');
        Schema::dropIfExists('development_records');
        Schema::dropIfExists('survival_records');
        Schema::dropIfExists('lgu_populations');
    }
};

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
        Schema::table('development_records', function (Blueprint $table) {
            $table->integer('children_out_of_school_male')->nullable()->after('children_in_school_total');
            $table->integer('children_out_of_school_female')->nullable()->after('children_out_of_school_male');
            $table->integer('children_out_of_school_total')->nullable()->after('children_out_of_school_female');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('development_records', function (Blueprint $table) {
            $table->dropColumn(['children_out_of_school_male','children_out_of_school_female','children_out_of_school_total']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;
    public function up(): void
    {
        Schema::create('lgu_populations', function (Blueprint $table) {
            $table->id();
            $table->string('lgu_name');
            $table->unsignedSmallInteger('year')->default(2025);
            $table->integer('male')->nullable();
            $table->integer('female')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lgu_populations');
    }
};

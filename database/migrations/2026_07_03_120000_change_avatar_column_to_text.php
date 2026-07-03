<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Change avatar column from string (VARCHAR 255) to longText to support base64 images
        DB::statement('ALTER TABLE users ALTER COLUMN avatar TYPE TEXT');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE users ALTER COLUMN avatar TYPE VARCHAR(255) USING avatar::VARCHAR(255)');
    }
};

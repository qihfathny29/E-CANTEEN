<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Fix typo: istrahat_1 → istirahat_1
        DB::statement("ALTER TABLE orders MODIFY waktu_ambil ENUM('istirahat_1', 'istirahat_2') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE orders MODIFY waktu_ambil ENUM('istrahat_1', 'istirahat_2') NOT NULL");
    }
};

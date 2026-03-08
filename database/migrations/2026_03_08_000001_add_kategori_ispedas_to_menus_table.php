<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->enum('kategori', ['makanan_utama', 'minuman', 'cemilan', 'spesial_promo'])
                  ->default('makanan_utama')
                  ->after('foto');
            $table->boolean('is_pedas')->default(false)->after('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'is_pedas']);
        });
    }
};

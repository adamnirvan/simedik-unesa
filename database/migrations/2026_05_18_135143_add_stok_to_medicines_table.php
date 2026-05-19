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
        Schema::table('medicines', function (Blueprint $blueprint) {
            // Kita tambahkan kolom stok setelah kolom harga, defaultnya 0 jika tidak diisi
            $blueprint->integer('stok')->default(0)->after('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicines', function (Blueprint $blueprint) {
            // Aturan untuk membatalkan (rollback)
            $blueprint->dropColumn('stok');
        });
    }
};
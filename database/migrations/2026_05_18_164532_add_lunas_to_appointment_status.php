<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Memaksa MySQL untuk memperbarui daftar ENUM pada kolom status
        DB::statement("ALTER TABLE appointments MODIFY COLUMN status ENUM('menunggu', 'dijadwalkan', 'selesai', 'lunas') NOT NULL DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        // Kembalikan ke asal jika di-rollback
        DB::statement("ALTER TABLE appointments MODIFY COLUMN status ENUM('menunggu', 'dijadwalkan', 'selesai') NOT NULL DEFAULT 'menunggu'");
    }
};
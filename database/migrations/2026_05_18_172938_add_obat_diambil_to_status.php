<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        // Tambahkan status 'obat_diambil' ke ujung ENUM
        DB::statement("ALTER TABLE appointments MODIFY COLUMN status ENUM('menunggu', 'dijadwalkan', 'selesai', 'lunas', 'obat_diambil') NOT NULL DEFAULT 'menunggu'");
    }
    public function down(): void {
        DB::statement("ALTER TABLE appointments MODIFY COLUMN status ENUM('menunggu', 'dijadwalkan', 'selesai', 'lunas') NOT NULL DEFAULT 'menunggu'");
    }
};
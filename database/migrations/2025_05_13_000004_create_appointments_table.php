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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('poli_id')->constrained('polis')->onDelete('cascade');
            $table->date('tanggal_pengajuan');
            $table->dateTime('waktu_jadwal')->nullable();
            $table->enum('status', ['menunggu_jadwal', 'dijadwalkan', 'menunggu_pembayaran', 'selesai'])->default('menunggu_jadwal');
            $table->text('keluhan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

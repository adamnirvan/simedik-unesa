<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use app\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('patient', 'poli')
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.pendaftaran', compact('appointments'));
    }

    public function editJadwal($id)
    {
        // Cari antrean berdasarkan ID, sekalian bawa data pasien dan poli
        $appointment = Appointment::with(['patient', 'poli'])->findOrFail($id);
        
        // Ambil semua user yang memiliki role 'doctor' untuk dimasukkan ke dropdown
        $doctors = User::where('role', 'doctor')->get();
        
        return view('admin.form-jadwal', compact('appointment', 'doctors'));
    }

    // Fungsi MENYIMPAN Data Jadwal
    public function updateJadwal(Request $request, $id)
    {
        // 1. Validasi input dari Admin
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'waktu_jadwal' => 'required|date',
        ]);

        // 2. Cari data antrean, lalu update!
        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'doctor_id' => $request->doctor_id,
            'waktu_jadwal' => $request->waktu_jadwal,
            'status' => 'dijadwalkan', // Ajaib! Statusnya otomatis berubah
        ]);

        // 3. Kembalikan Admin ke halaman list dengan pesan sukses
        return redirect()->route('admin.pendaftaran')->with('success', 'Jadwal berhasil diberikan!');
    }

    public function kasir()
    {
    // Hanya mengambil pasien yang sudah bayar lewat Xendit
        $appointments = Appointment::with(['patient', 'doctor', 'poli', 'medicines'])
            ->where('status', 'lunas')
            ->latest()
            ->get();

        return view('admin.kasir', compact('appointments'));
    }

    public function serahkanObat($id)
    {
        // Cari antrean yang lunas
        $appointment = \App\Models\Appointment::findOrFail($id);
        
        // Ubah status ke tahapan final
        $appointment->update([
            'status' => 'obat_diambil'
        ]);

        // Kembalikan ke halaman kasir dengan pesan sukses
        return redirect()->route('admin.kasir')->with('success', 'Obat berhasil diserahkan. Pasien telah selesai!');
    }
}

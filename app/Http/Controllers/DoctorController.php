<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    // Menampilkan daftar antrean khusus untuk dokter yang sedang login
    public function index()
    {
        $doctorId = Auth::id(); // Ambil ID dokter yang sedang login

        // Ambil pendaftaran yang statusnya 'dijadwalkan' DAN khusus untuk dokter ini
        $appointments = Appointment::with(['patient', 'poli'])
                            ->where('doctor_id', $doctorId)
                            ->where('status', 'dijadwalkan')
                            ->orderBy('waktu_jadwal', 'asc') // Urutkan dari jadwal terdekat
                            ->get();

        return view('doctor.pasien', compact('appointments'));
    }

    public function createResep($id)
    {
        $appointment = Appointment::with('patient')->findOrFail($id);
        
        // Ambil semua daftar obat dari gudang (database) untuk dipilih dokter
        $medicines = Medicine::all(); 

        return view('doctor.form-resep', compact('appointment', 'medicines'));
    }

    // Fungsi MENYIMPAN Resep, Selesaikan Pemeriksaan & Potong Stok
    public function storeResep(Request $request, $id)
    {
        // 1. Validasi input
        $request->validate([
            'medicine_id' => 'required|array',
            'jumlah' => 'required|array',
        ]);

        $appointment = Appointment::findOrFail($id);

        // 2. Looping data obat yang diberikan dokter
        foreach ($request->medicine_id as $index => $medicineId) {
            $jumlahObat = $request->jumlah[$index];

            if ($medicineId != null && $jumlahObat != null && $jumlahObat > 0) {
                // A. Catat resep ke tabel pivot 'prescriptions'
                $appointment->medicines()->attach($medicineId, [
                    'jumlah' => $jumlahObat
                ]);

                // B. POTONG STOK OTOMATIS (Sihir Laravel)
                $medicine = Medicine::find($medicineId);
                if ($medicine) {
                    // Fungsi decrement() akan langsung mengurangi angka di kolom 'stok'
                    $medicine->decrement('stok', $jumlahObat);
                }
            }
        }

        // 3. Ubah status antrean menjadi 'selesai'
        $appointment->update([
            'status' => 'selesai'
        ]);

        // 4. Kembalikan dokter ke halaman jadwal
        return redirect()->route('doctor.pasien')->with('success', 'Pemeriksaan selesai. Resep dibuat dan stok obat otomatis terpotong!');
    }
    
}

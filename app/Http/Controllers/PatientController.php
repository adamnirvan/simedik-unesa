<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;  
use App\Models\Poli; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; 

class PatientController extends Controller
{
    // Fungsi menampilkan Dashboard
    public function dashboard()
    {
        $userId = Auth::id();
        
        //pendaftaran terbaru pasien
        $latestAppointment = Appointment::with('poli', 'medicines')
            ->where('patient_id', $userId)
            ->latest()
            ->first();


        $totalKunjungan = Appointment::where('patient_id', $userId)
        ->where('status', 'selesai')
        ->count();

        $appointmentsHistory = Appointment::with(['poli', 'doctor'])
        ->where('patient_id', $userId)
        ->where('status', 'selesai')
        ->orderBy('waktu_jadwal', 'desc') // Urutkan dari yang paling baru selesai
        ->get();

        $resepAktif = 0;

        return view('patient.dashboard', compact('latestAppointment', 'totalKunjungan', 'resepAktif', 'appointmentsHistory'));
    }

    // Fungsi MENAMPILKAN Form Pendaftaran
    public function create()
    {
        // 1. Ambil semua data master Poli dari tabel polis di MySQL
        $polis = Poli::all(); 

        // 2. Tampilkan halaman form, sambil "membawa" data poli tadi
        return view('patient.form-daftar', compact('polis'));
    }

    // Fungsi MENYIMPAN Data Form (Untuk tes selanjutnya)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'tanggal_pengajuan' => 'required|date',
            'poli_id' => 'required|exists:polis,id',
            'keluhan' => 'required|string',
            ]);

    // 2. Simpan ke Database
    Appointment::create([
        'patient_id' => Auth::id(),
        'poli_id' => $request->poli_id,
        'tanggal_pengajuan' => $request->tanggal_pengajuan,
        'keluhan' => $request->keluhan,
        ]);
        
        return redirect()->route('dashboard');
        }

    // Fungsi MENAMPILKAN Semua Riwayat Pasien
    public function riwayat()
    {
        $userId = Auth::id();

        // Ambil SEMUA riwayat pendaftaran milik pasien ini, urutkan dari yang paling baru
        $appointmentsHistory = Appointment::with(['poli', 'doctor'])
            ->where('patient_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.riwayat', compact('appointmentsHistory'));
    }

    public function pay($id)
    {
        // 1. Ambil data pendaftaran beserta obatnya
        $appointment = Appointment::with(['patient', 'medicines'])->findOrFail($id);

        // 2. Hitung total matematika tagihan obat
        $totalTagihan = 0;
        foreach ($appointment->medicines as $med) {
            $totalTagihan += $med->harga * $med->pivot->jumlah;
        }

        // Keamanan: Jika total tagihan ternyata 0, langsung lunaskan tanpa lewat API
        if ($totalTagihan <= 0) {
            $appointment->update(['status' => 'lunas']);
            return redirect()->route('dashboard')->with('success', 'Pemeriksaan selesai tanpa biaya.');
        }

        // 3. Tembak API Xendit menggunakan HTTP Facade Laravel
        // Kita menggunakan Basic Auth dengan format Base64 dari Secret Key + tanda titik dua (:)
        $secretKey = env('XENDIT_SECRET_KEY');
        
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($secretKey . ':'),
        ])->post('https://api.xendit.co/v2/invoices', [
            'external_id' => 'SIMEDIK-' . $appointment->id . '-' . time(), // ID unik transaksi
            'amount' => $totalTagihan,
            'payer_email' => Auth::user()->email,
            'description' => 'Pembayaran Obat & Konsultasi SIMEDIK #' . $appointment->id,
            'invoice_duration' => 86400, // Masa berlaku invoice (1 hari dalam detik)
            'success_redirect_url' => route('dashboard'), // Jika sukses bayar, pasien dibalikin ke sini
        ]);

        // 4. Periksa apakah Xendit sukses membuatkan invoice
        if ($response->successful()) {
            $result = $response->json();
            
            // Lempar pasien secara ajaib ke halaman checkout Xendit asli!
            return redirect($result['invoice_url']);
        }

        // Jika gagal terkoneksi ke Xendit, kembalikan dengan pesan error
        return back()->with('error', 'Gagal terhubung ke gateway pembayaran. Coba lagi nanti.');
    }

    // Fungsi MENERIMA PESAN GAIB DARI XENDIT (WEBHOOK)
public function xenditCallback(Request $request)
    {
        try {
            // 1. Catat semua payload yang masuk ke file log (storage/logs/laravel.log)
            Log::info('Webhook Xendit Masuk:', $request->all());

            $xenditXCallbackToken = env('XENDIT_CALLBACK_TOKEN');

            // 2. Verifikasi Token Keamanan
            if ($request->header('x-callback-token') !== $xenditXCallbackToken) {
                Log::warning('Token Xendit tidak cocok atau kosong!');
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $status = $request->status;
            $externalId = $request->external_id;

            // 3. Proses perubahan status jika dibayar
            if ($status === 'PAID' && !empty($externalId)) {
                $parts = explode('-', $externalId);
                
                // PENCEGAHAN CRASH: Pastikan array hasil explode minimal punya 2 bagian
                // dan memang berasal dari tagihan aplikasi SIMEDIK
                if (count($parts) >= 2 && $parts[0] === 'SIMEDIK') {
                    $appointmentId = $parts[1]; 
                    
                    $appointment = Appointment::find($appointmentId);
                    if ($appointment) {
                        $appointment->update(['status' => 'lunas']);
                        Log::info("Status antrean ID {$appointmentId} berhasil dilunaskan otomatis.");
                    }
                } else {
                    Log::warning("Format external_id tidak valid diabaikan: {$externalId}");
                }
            }

            return response()->json(['message' => 'Webhook processed successfully']);

        } catch (\Exception $e) {
            // Jika sistem tetap crash, pesan error aslinya akan dicatat, bukan sekadar "500"
            Log::error('Terjadi Error Webhook Xendit: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
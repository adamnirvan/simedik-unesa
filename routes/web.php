<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicineController;

// Halaman Depan (Langsung arahkan ke login)
Route::get('/', function () {
    return redirect()->route('login');
});

// -------------------------------------------------------------
// RUTE PASIEN (Screen 3, 4, 5, 6)
// -------------------------------------------------------------
Route::middleware(['auth', 'role:patient'])->group(function () {
    // Screen 3: Dashboard (Menggunakan Controller)
    Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('dashboard'); 

    // Screen 4: Form Pendaftaran (Menampilkan Form)
    Route::get('/pendaftaran/baru', [PatientController::class, 'create'])->name('patient.daftar');

    // Screen 4: Form Pendaftaran (Menyimpan Data - INI SOLUSI ERROR TADI)
    Route::post('/pendaftaran/baru', [PatientController::class, 'store'])->name('patient.store');

    Route::post('/dashboard/pay/{id}', [PatientController::class, 'pay'])->name('patient.pay');

    // Screen 5 & 6: Riwayat & Detail
    Route::get('/riwayat', [PatientController::class, 'riwayat'])->name('patient.riwayat');
});

// -------------------------------------------------------------
// RUTE ADMIN (Screen 7, 8, 9, 10, 11)
// -------------------------------------------------------------
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

Route::get('/pendaftaran',[AdminController::class, 'index'])->name('pendaftaran');

    // 2. Form Beri Jadwal 
    Route::get('/pendaftaran/{id}/jadwal', [AdminController::class, 'editJadwal'])->name('beri-jadwal');
    Route::put('/pendaftaran/{id}/jadwal', [AdminController::class, 'updateJadwal'])->name('update-jadwal');

    // 3. Kasir & Farmasi
    Route::get('/kasir', [AdminController::class, 'kasir'])->name('kasir');
    Route::post('/kasir/selesai/{id}', [AdminController::class, 'serahkanObat'])->name('serahkan-obat');

    // 4. RUTE CRUD MASTER DATA OBAT (Menggantikan rute /master/obat yang lama)
    Route::resource('medicines', MedicineController::class)->names('medicines');

   // Rute CRUD Dokter Khusus Admin (Menggunakan Controller Terpisah)
    Route::resource('doctors', \App\Http\Controllers\AdminDoctorController::class);

});

// -------------------------------------------------------------
// RUTE DOKTER (Screen 12, 13)
// -------------------------------------------------------------
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/pasien', [DoctorController::class, 'index'])->name('pasien');

    // 1. Rute MENAMPILKAN form resep
    Route::get('/pasien/{id}/resep', [DoctorController::class, 'createResep'])->name('resep');

    // 2. Rute MENYIMPAN data resep
    Route::post('/pasien/{id}/resep', [DoctorController::class, 'storeResep'])->name('store-resep');
});

// Bawaan Profile Breeze (Biarkan saja untuk fitur ganti password)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Bawaan Auth Breeze (Screen 1 & 2: Login/Register)
require __DIR__.'/auth.php';
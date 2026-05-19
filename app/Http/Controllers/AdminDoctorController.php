<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminDoctorController extends Controller
{
    // 1. Tampilkan daftar dokter di panel admin
    public function index()
    {
        $doctors = User::with('poli')->where('role', 'doctor')->latest()->get();
        
        // DISESUAIKAN: Langsung memanggil file di dalam folder admin
        return view('admin.data-dokter', compact('doctors'));
    }

    // 2. Form tambah dokter baru
    public function create()
    {
        $polis = Poli::all();
        
        // DISESUAIKAN: Langsung memanggil file di dalam folder admin
        return view('admin.data-dokter-form', compact('polis'));
    }

    // 3. Simpan akun dokter baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'poli_id' => 'required|exists:polis,id',
        ]);

        User::create([
            'name' => 'Dr. ' . str_replace('Dr. ', '', $request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'doctor', 
            'poli_id' => $request->poli_id,
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'Akun dokter berhasil didaftarkan!');
    }

    // 4. Form edit profil dokter
    public function edit($id)
    {
        $doctor = User::findOrFail($id);
        $polis = Poli::all();
        
        // DISESUAIKAN: Langsung memanggil file di dalam folder admin
        return view('admin.data-dokter-form', compact('doctor', 'polis'));
    }

    // 5. Simpan perubahan data dokter
    public function update(Request $request, $id)
    {
        $doctor = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($doctor->id)],
            'poli_id' => 'required|exists:polis,id',
            'password' => 'nullable|string|min:8', 
        ]);

        $data = [
            'name' => 'Dr. ' . str_replace('Dr. ', '', $request->name),
            'email' => $request->email,
            'poli_id' => $request->poli_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Profil dokter berhasil diperbarui!');
    }

    // 6. Cabut akses / Hapus akun dokter
    public function destroy($id)
    {
        $doctor = User::findOrFail($id);
        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'Akses login dokter berhasil dicabut!');
    }
}
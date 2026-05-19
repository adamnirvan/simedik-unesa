<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    // 1. READ: Menampilkan daftar obat
    public function index()
    {
        // Ambil semua data obat, urutkan dari yang terbaru ditambahkan
        $medicines = Medicine::latest()->get();
        return view('admin.data-obat', compact('medicines'));
    }

    // 2. CREATE: Menampilkan form tambah obat
    public function create()
    {
        return view('admin.data-obat-form');
    }

    // 3. STORE: Menyimpan data obat baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
        ]);

        Medicine::create([
            'nama_obat' => $request->nama_obat,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('admin.medicines.index')->with('success', 'Data obat baru berhasil ditambahkan!');
    }

    // 4. EDIT: Menampilkan form ubah data obat
    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('admin.data-obat-form', compact('medicine'));
    }

    // 5. UPDATE: Menyimpan perubahan data obat
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
        ]);

        $medicine = Medicine::findOrFail($id);
        $medicine->update([
            'nama_obat' => $request->nama_obat,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('admin.medicines.index')->with('success', 'Data obat berhasil diperbarui!');
    }

    // 6. DESTROY: Menghapus obat dari database
    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();

        return redirect()->route('admin.medicines.index')->with('success', 'Data obat berhasil dihapus!');
    }
}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($medicine) ? 'Ubah Data Obat' : 'Tambah Obat Baru' }} - SIMEDIK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-8 flex items-center space-x-4">
            <a href="{{ route('admin.medicines.index') }}" class="p-2 bg-white rounded-xl border border-slate-200 text-slate-500 hover:text-slate-900 shadow-sm transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">
                    {{ isset($medicine) ? 'Ubah Data Obat' : 'Tambah Obat Baru' }}
                </h1>
                <p class="text-slate-500 text-sm">
                    {{ isset($medicine) ? 'Perbarui informasi katalog atau sesuaikan stok obat.' : 'Masukkan detail informasi obat baru ke dalam sistem.' }}
                </p>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
            
            <form action="{{ isset($medicine) ? route('admin.medicines.update', $medicine->id) : route('admin.medicines.store') }}" method="POST" class="space-y-6">
                @csrf
                
                @if(isset($medicine))
                    @method('PUT')
                @endif

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Item Obat</label>
                    <input type="text" name="nama_obat" required 
                        value="{{ old('nama_obat', $medicine->nama_obat ?? '') }}" 
                        placeholder="Contoh: Paracetamol 500mg" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all font-medium">
                    @error('nama_obat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Harga Satuan (Rp)</label>
                        <input type="number" name="harga" required min="0" 
                            value="{{ old('harga', $medicine->harga ?? '') }}" 
                            placeholder="Contoh: 5000" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all font-medium">
                        @error('harga') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            {{ isset($medicine) ? 'Sisa Stok Gudang' : 'Jumlah Stok Awal' }}
                        </label>
                        <input type="number" name="stok" required min="0" 
                            value="{{ old('stok', $medicine->stok ?? '') }}" 
                            placeholder="Contoh: 100" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all font-medium">
                        @error('stok') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="px-8 py-3 font-bold rounded-xl shadow-sm transition-all transform hover:scale-105 {{ isset($medicine) ? 'bg-slate-900 hover:bg-slate-800 text-white' : 'bg-emerald-500 hover:bg-emerald-600 text-white' }}">
                        {{ isset($medicine) ? 'Simpan Perubahan' : 'Simpan Obat Baru' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
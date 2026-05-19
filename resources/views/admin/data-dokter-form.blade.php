<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($doctor) ? 'Ubah Data Dokter' : 'Tambah Dokter Baru' }} - SIMEDIK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-8 flex items-center space-x-4">
            <a href="{{ route('admin.doctors.index') }}" class="p-2 bg-white rounded-xl border border-slate-200 text-slate-500 hover:text-slate-900 shadow-sm transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">
                    {{ isset($doctor) ? 'Ubah Profil Dokter' : 'Pendaftaran Dokter Baru' }}
                </h1>
                <p class="text-slate-500 text-sm">
                    {{ isset($doctor) ? 'Perbarui data kontak atau penempatan poli dokter.' : 'Buatkan akun akses login dan penempatan poli untuk tenaga medis.' }}
                </p>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
            <form action="{{ isset($doctor) ? route('admin.doctors.update', $doctor->id) : route('admin.doctors.store') }}" method="POST" class="space-y-6">
                @csrf
                @if(isset($doctor)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap (Tanpa Gelar Dr.)</label>
                        <input type="text" name="name" required 
                            value="{{ old('name', str_replace('Dr. ', '', $doctor->name ?? '')) }}" 
                            placeholder="Contoh: Budi Santoso" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all font-medium">
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Penempatan Poli</label>
                        <select name="poli_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all font-medium bg-white">
                            <option value="" disabled {{ !isset($doctor) ? 'selected' : '' }}>-- Pilih Poli Spesialis --</option>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}" 
                                    {{ old('poli_id', $doctor->poli_id ?? '') == $poli->id ? 'selected' : '' }}>
                                    {{ $poli->nama_poli }}
                                </option>
                            @endforeach
                        </select>
                        @error('poli_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-6 mt-6">
                    <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span>Akses Login Ke Sistem</span>
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email Aktif</label>
                            <input type="email" name="email" required 
                                value="{{ old('email', $doctor->email ?? '') }}" 
                                placeholder="dokter@simedik.com" 
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all font-medium">
                            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Password Akses</label>
                            <input type="password" name="password" {{ !isset($doctor) ? 'required' : '' }} 
                                placeholder="{{ isset($doctor) ? 'Kosongkan jika tidak ingin ganti' : 'Minimal 8 karakter' }}" 
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all font-medium">
                            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="px-8 py-3 font-bold rounded-xl shadow-sm transition-all transform hover:scale-105 {{ isset($doctor) ? 'bg-slate-900 hover:bg-slate-800 text-white' : 'bg-blue-600 hover:bg-blue-700 text-white' }}">
                        {{ isset($doctor) ? 'Simpan Perubahan' : 'Buat Akun Dokter' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
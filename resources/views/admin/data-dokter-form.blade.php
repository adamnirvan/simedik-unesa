<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($doctor) ? 'Ubah Data Dokter' : 'Tambah Dokter Baru' }} - SIMEDIK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#FBFBFD] text-simedik-dark">

    {{-- ======================================= --}}
    {{-- NAVBAR - Apple Glassmorphism Style       --}}
    {{-- ======================================= --}}
    <div class="bg-white border-b border-slate-100/50 sticky top-0 z-10 supports-[backdrop-filter]:bg-white/70 supports-[backdrop-filter]:backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/simedik-logo.png') }}" alt="SIMEDIK" class="h-10 w-auto object-contain">
                </div>

                <div class="flex items-center space-x-5">
                    <div class="text-right hidden sm:block">
                        <p class="text-simedik-dark font-semibold text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-slate-500 text-xs font-medium">Administrator</p>
                    </div>
                    <div class="w-px h-8 bg-slate-200/50 hidden sm:block"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 text-slate-400 hover:text-simedik-primary hover:bg-simedik-light/30 rounded-full transition-all duration-300 ease-out">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ======================================= --}}
    {{-- MAIN CONTENT                            --}}
    {{-- ======================================= --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">

        {{-- Breadcrumb --}}
        <div class="mb-8">
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('admin.pendaftaran') }}" class="text-simedik-primary hover:text-simedik-primary/80 font-semibold transition-colors duration-300 ease-out">Dashboard Admin</a>
                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('admin.doctors.index') }}" class="text-simedik-primary hover:text-simedik-primary/80 font-semibold transition-colors duration-300 ease-out">Tenaga Medis</a>
                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-slate-500 font-medium">{{ isset($doctor) ? 'Ubah Profil Dokter' : 'Pendaftaran Dokter Baru' }}</span>
            </div>
        </div>

        {{-- Page Header --}}
        <div class="mb-10">
            <h1 class="text-4xl font-bold tracking-tight text-simedik-dark mb-2">
                {{ isset($doctor) ? 'Ubah Profil Dokter' : 'Pendaftaran Dokter Baru' }}
            </h1>
            <p class="text-slate-500 font-medium">
                {{ isset($doctor) ? 'Perbarui data kontak atau penempatan poli dokter.' : 'Buatkan akun akses login dan penempatan poli untuk tenaga medis.' }}
            </p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 overflow-hidden">

            {{-- Card Header Strip --}}
            <div class="bg-gradient-to-r from-simedik-primary/10 to-simedik-light/10 border-b border-slate-100/50 px-6 sm:px-8 py-4 flex items-center space-x-3">
                <div class="bg-simedik-light/40 text-simedik-primary rounded-2xl p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <p class="text-simedik-primary font-semibold text-xs tracking-widest uppercase">
                    {{ isset($doctor) ? 'Edit Profil Tenaga Medis' : 'Registrasi Tenaga Medis Baru' }}
                </p>
            </div>

            {{-- Form Body --}}
            <div class="p-6 sm:p-8">
                <form action="{{ isset($doctor) ? route('admin.doctors.update', $doctor->id) : route('admin.doctors.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @if(isset($doctor)) @method('PUT') @endif

                    {{-- Nama & Poli --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-simedik-dark font-semibold text-sm mb-3">
                                Nama Lengkap <span class="text-slate-400 font-medium">(Tanpa Gelar Dr.)</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                required
                                value="{{ old('name', str_replace('Dr. ', '', $doctor->name ?? '')) }}"
                                placeholder="Contoh: Budi Santoso"
                                class="w-full px-4 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark placeholder-slate-400 font-medium focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-2 focus:ring-simedik-primary/20 transition-all duration-300 ease-out shadow-[0_2px_8px_rgb(0,0,0,0.04)]"
                            >
                            @error('name')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-simedik-dark font-semibold text-sm mb-3">
                                Penempatan Poli
                                <span class="text-red-500">*</span>
                            </label>
                            <select
                                name="poli_id"
                                required
                                class="w-full px-4 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark font-medium focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-2 focus:ring-simedik-primary/20 transition-all duration-300 ease-out appearance-none cursor-pointer shadow-[0_2px_8px_rgb(0,0,0,0.04)]"
                                style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 20 20\" fill=\"%2356DFCF\"><path fill-rule=\"evenodd\" d=\"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z\" clip-rule=\"evenodd\" /></svg>'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em; padding-right: 2.5rem;"
                            >
                                <option value="" disabled {{ !isset($doctor) ? 'selected' : '' }}>-- Pilih Poli Spesialis --</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}"
                                        {{ old('poli_id', $doctor->poli_id ?? '') == $poli->id ? 'selected' : '' }}>
                                        {{ $poli->nama_poli }}
                                    </option>
                                @endforeach
                            </select>
                            @error('poli_id')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Login Access Section --}}
                    <div class="border-t border-slate-100/70 pt-6 mt-2">
                        <div class="flex items-center space-x-2 mb-6">
                            <div class="bg-simedik-light/30 text-simedik-primary rounded-xl p-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-simedik-dark font-semibold text-sm">Akses Login Ke Sistem</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-simedik-dark font-semibold text-sm mb-3">
                                    Alamat Email Aktif
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="email"
                                    name="email"
                                    required
                                    value="{{ old('email', $doctor->email ?? '') }}"
                                    placeholder="dokter@simedik.com"
                                    class="w-full px-4 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark placeholder-slate-400 font-medium focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-2 focus:ring-simedik-primary/20 transition-all duration-300 ease-out shadow-[0_2px_8px_rgb(0,0,0,0.04)]"
                                >
                                @error('email')
                                    <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-simedik-dark font-semibold text-sm mb-3">
                                    Password Akses
                                    @if(!isset($doctor))<span class="text-red-500">*</span>@endif
                                </label>
                                <input
                                    type="password"
                                    name="password"
                                    {{ !isset($doctor) ? 'required' : '' }}
                                    placeholder="{{ isset($doctor) ? 'Kosongkan jika tidak ingin ganti' : 'Minimal 8 karakter' }}"
                                    class="w-full px-4 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark placeholder-slate-400 font-medium focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-2 focus:ring-simedik-primary/20 transition-all duration-300 ease-out shadow-[0_2px_8px_rgb(0,0,0,0.04)]"
                                >
                                @error('password')
                                    <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Required Note --}}
                    <p class="text-slate-400 text-xs">
                        <span class="text-red-500 font-semibold">*</span> Semua field yang ditandai dengan bintang merah adalah wajib diisi
                    </p>

                    {{-- Action Buttons --}}
                    <div class="pt-6 border-t border-slate-100/70 flex gap-4">
                        <a href="{{ route('admin.doctors.index') }}" class="flex-1 text-center py-3.5 px-4 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark font-semibold hover:bg-slate-100/50 transition-all duration-300 ease-out shadow-[0_2px_8px_rgb(0,0,0,0.04)] hover:-translate-y-0.5">
                            Batal
                        </a>
                        <button
                            type="submit"
                            class="flex-1 inline-flex items-center justify-center space-x-2 bg-simedik-primary text-white font-semibold tracking-wide rounded-2xl py-3.5 px-4 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>{{ isset($doctor) ? 'Simpan Perubahan' : 'Buat Akun Dokter' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIMEDIK Admin - Beri Jadwal</title>

    <!-- Scripts -->
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
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">

        {{-- Breadcrumb --}}
        <div class="mb-8 flex items-center space-x-2 text-sm">
            <a href="{{ route('admin.pendaftaran') }}" class="text-simedik-primary hover:text-simedik-primary/80 font-semibold transition-colors duration-300 ease-out">Daftar Pendaftaran</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-slate-500 font-medium">Beri Jadwal Pemeriksaan</span>
        </div>

        {{-- Page Header --}}
        <div class="mb-10">
            <h1 class="text-4xl font-bold tracking-tight text-simedik-dark mb-2">Beri Jadwal Pemeriksaan</h1>
            <p class="text-slate-500 font-medium">Tentukan jadwal dan dokter untuk pemeriksaan pasien.</p>
        </div>

        {{-- Patient Summary Card --}}
        <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-simedik-primary/10 to-simedik-light/10 border-b border-slate-100/50 px-6 sm:px-8 py-4">
                <p class="text-simedik-primary font-semibold text-xs tracking-widest uppercase">Ringkasan Data Pasien</p>
            </div>

            <div class="p-6 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    {{-- Nama Pasien --}}
                    <div>
                        <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-3">Nama Pasien</p>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-simedik-light/40 text-simedik-primary rounded-2xl flex items-center justify-center flex-shrink-0">
                                <span class="font-bold">{{ substr($appointment->patient->name, 0, 1) }}</span>
                            </div>
                            <p class="text-simedik-dark font-bold text-base">{{ $appointment->patient->name }}</p>
                        </div>
                    </div>

                    {{-- Poli Tujuan --}}
                    <div>
                        <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-3">Poli Tujuan</p>
                        <span class="inline-flex items-center px-4 py-2 rounded-2xl bg-simedik-light/30 border border-simedik-primary/20">
                            <span class="text-simedik-primary font-bold text-sm">{{ $appointment->poli->nama_poli }}</span>
                        </span>
                    </div>

                    {{-- Tanggal Pengajuan --}}
                    <div>
                        <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-3">Tanggal Pengajuan</p>
                        <p class="text-simedik-dark font-bold text-base">{{ \Carbon\Carbon::parse($appointment->tanggal_pengajuan)->format('d M Y') }}</p>
                    </div>
                </div>

                {{-- Keluhan --}}
                <div class="mt-6 pt-6 border-t border-slate-100/70">
                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-2">Keluhan Pasien</p>
                    <p class="text-simedik-dark leading-relaxed font-medium">{{ $appointment->keluhan }}</p>
                </div>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 p-6 sm:p-8">

            {{-- Info Alert --}}
            <div class="mb-8 p-4 rounded-2xl bg-simedik-light/20 border border-simedik-primary/20 flex items-start space-x-3">
                <div class="flex-shrink-0 bg-simedik-primary/20 rounded-xl p-1.5">
                    <svg class="w-4 h-4 text-simedik-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-simedik-dark/80 text-sm font-medium leading-relaxed">
                    Pilih dokter yang tersedia dan waktu pemeriksaan yang sesuai dengan jadwal klinik.
                </p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.update-jadwal', $appointment->id) }}" class="space-y-8">
                @csrf
                @method('PUT')

                {{-- Pilih Dokter --}}
                <div>
                    <label for="doctor_id" class="block text-simedik-dark font-semibold text-sm mb-3">
                        Pilih Dokter
                        <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="doctor_id"
                        name="doctor_id"
                        required
                        class="w-full px-4 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-2 focus:ring-simedik-primary/20 transition-all duration-300 ease-out appearance-none cursor-pointer shadow-[0_2px_8px_rgb(0,0,0,0.04)]"
                        style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 20 20\" fill=\"%2356DFCF\"><path fill-rule=\"evenodd\" d=\"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z\" clip-rule=\"evenodd\" /></svg>'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em; padding-right: 2.5rem;"
                    >
                        <option value="" disabled selected hidden>Pilih Dokter Pemeriksaan</option>
                        @forelse($doctors as $doctor)
                            <option value="{{ $doctor->id }}" @selected(old('doctor_id') == $doctor->id)>
                                {{ $doctor->name }}
                            </option>
                        @empty
                            <option value="" disabled>Tidak ada dokter tersedia</option>
                        @endforelse
                    </select>
                    <p class="text-slate-500 text-xs mt-2 font-medium">Pilih dokter yang akan melakukan pemeriksaan</p>
                    @error('doctor_id')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal & Jam Pemeriksaan --}}
                <div>
                    <label for="waktu_jadwal" class="block text-simedik-dark font-semibold text-sm mb-3">
                        Tanggal & Jam Pemeriksaan
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="datetime-local"
                        id="waktu_jadwal"
                        name="waktu_jadwal"
                        value="{{ old('waktu_jadwal') }}"
                        required
                        class="w-full px-4 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-2 focus:ring-simedik-primary/20 transition-all duration-300 ease-out shadow-[0_2px_8px_rgb(0,0,0,0.04)]"
                    />
                    <p class="text-slate-500 text-xs mt-2 font-medium">Tentukan tanggal dan jam pemeriksaan yang sesuai</p>
                    @error('waktu_jadwal')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Required Fields Note --}}
                <p class="text-slate-400 text-xs">
                    <span class="text-red-500 font-semibold">*</span> Semua field yang ditandai dengan bintang merah adalah wajib diisi
                </p>

                {{-- Action Buttons --}}
                <div class="flex gap-4 pt-6 border-t border-slate-100/70">
                    <a href="{{ route('admin.pendaftaran') }}" class="flex-1 text-center py-3.5 px-4 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark font-semibold hover:bg-slate-100/50 transition-all duration-300 ease-out shadow-[0_2px_8px_rgb(0,0,0,0.04)] hover:-translate-y-0.5">
                        Batal
                    </a>
                    <button
                        type="submit"
                        class="flex-1 inline-flex items-center justify-center space-x-2 bg-simedik-primary text-simedik-dark font-semibold tracking-wide rounded-2xl py-3.5 px-4 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Simpan Jadwal</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Notes Card --}}
        <div class="mt-6 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 p-6 sm:p-8">
            <h4 class="text-simedik-dark font-bold text-sm mb-5">Catatan Penting</h4>
            <ul class="space-y-3.5">
                <li class="flex items-start space-x-3">
                    <div class="w-5 h-5 bg-simedik-light/40 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-simedik-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span class="text-slate-600 text-sm font-medium leading-relaxed">Pastikan jadwal yang dipilih tidak bentrok dengan jadwal dokter lain.</span>
                </li>
                <li class="flex items-start space-x-3">
                    <div class="w-5 h-5 bg-simedik-light/40 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-simedik-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span class="text-slate-600 text-sm font-medium leading-relaxed">Jadwal akan dikirim otomatis kepada pasien setelah disimpan.</span>
                </li>
                <li class="flex items-start space-x-3">
                    <div class="w-5 h-5 bg-simedik-light/40 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-simedik-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span class="text-slate-600 text-sm font-medium leading-relaxed">Jadwal tidak bisa diubah setelah disimpan. Hubungi admin jika perlu perubahan.</span>
                </li>
            </ul>
        </div>

    </div>

</body>
</html>

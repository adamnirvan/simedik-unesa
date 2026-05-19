<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($medicine) ? 'Ubah Data Obat' : 'Tambah Obat Baru' }} - SIMEDIK</title>
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
        <div class="mb-8">
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('admin.pendaftaran') }}" class="text-simedik-primary hover:text-simedik-primary/80 font-semibold transition-colors duration-300 ease-out">Dashboard Admin</a>
                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('admin.medicines.index') }}" class="text-simedik-primary hover:text-simedik-primary/80 font-semibold transition-colors duration-300 ease-out">Data Obat</a>
                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-slate-500 font-medium">{{ isset($medicine) ? 'Ubah Data Obat' : 'Tambah Obat Baru' }}</span>
            </div>
        </div>

        {{-- Page Header --}}
        <div class="mb-10">
            <h1 class="text-4xl font-bold tracking-tight text-simedik-dark mb-2">
                {{ isset($medicine) ? 'Ubah Data Obat' : 'Tambah Obat Baru' }}
            </h1>
            <p class="text-slate-500 font-medium">
                {{ isset($medicine) ? 'Perbarui informasi katalog atau sesuaikan stok obat.' : 'Masukkan detail informasi obat baru ke dalam sistem.' }}
            </p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 overflow-hidden">

            {{-- Card Header Strip --}}
            <div class="bg-gradient-to-r from-simedik-primary/10 to-simedik-light/10 border-b border-slate-100/50 px-6 sm:px-8 py-4 flex items-center space-x-3">
                <div class="bg-simedik-light/40 text-simedik-primary rounded-2xl p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <p class="text-simedik-primary font-semibold text-xs tracking-widest uppercase">
                    {{ isset($medicine) ? 'Edit Katalog Farmasi' : 'Katalog Farmasi Baru' }}
                </p>
            </div>

            {{-- Form Body --}}
            <div class="p-6 sm:p-8">
                <form action="{{ isset($medicine) ? route('admin.medicines.update', $medicine->id) : route('admin.medicines.store') }}" method="POST" class="space-y-6">
                    @csrf

                    @if(isset($medicine))
                        @method('PUT')
                    @endif

                    {{-- Nama Obat --}}
                    <div>
                        <label class="block text-simedik-dark font-semibold text-sm mb-3">
                            Nama Item Obat
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama_obat"
                            required
                            value="{{ old('nama_obat', $medicine->nama_obat ?? '') }}"
                            placeholder="Contoh: Paracetamol 500mg"
                            class="w-full px-4 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark placeholder-slate-400 font-medium focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-2 focus:ring-simedik-primary/20 transition-all duration-300 ease-out shadow-[0_2px_8px_rgb(0,0,0,0.04)]"
                        >
                        @error('nama_obat')
                            <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Harga & Stok --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-simedik-dark font-semibold text-sm mb-3">
                                Harga Satuan (Rp)
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="number"
                                name="harga"
                                required
                                min="0"
                                value="{{ old('harga', $medicine->harga ?? '') }}"
                                placeholder="Contoh: 5000"
                                class="w-full px-4 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark placeholder-slate-400 font-medium focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-2 focus:ring-simedik-primary/20 transition-all duration-300 ease-out shadow-[0_2px_8px_rgb(0,0,0,0.04)]"
                            >
                            @error('harga')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-simedik-dark font-semibold text-sm mb-3">
                                {{ isset($medicine) ? 'Sisa Stok Gudang' : 'Jumlah Stok Awal' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="number"
                                name="stok"
                                required
                                min="0"
                                value="{{ old('stok', $medicine->stok ?? '') }}"
                                placeholder="Contoh: 100"
                                class="w-full px-4 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark placeholder-slate-400 font-medium focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-2 focus:ring-simedik-primary/20 transition-all duration-300 ease-out shadow-[0_2px_8px_rgb(0,0,0,0.04)]"
                            >
                            @error('stok')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Required Note --}}
                    <p class="text-slate-400 text-xs">
                        <span class="text-red-500 font-semibold">*</span> Semua field yang ditandai dengan bintang merah adalah wajib diisi
                    </p>

                    {{-- Action Buttons --}}
                    <div class="pt-6 border-t border-slate-100/70 flex gap-4">
                        <a href="{{ route('admin.medicines.index') }}" class="flex-1 text-center py-3.5 px-4 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark font-semibold hover:bg-slate-100/50 transition-all duration-300 ease-out shadow-[0_2px_8px_rgb(0,0,0,0.04)] hover:-translate-y-0.5">
                            Batal
                        </a>
                        <button
                            type="submit"
                            class="flex-1 inline-flex items-center justify-center space-x-2 bg-simedik-primary text-white font-semibold tracking-wide rounded-2xl py-3.5 px-4 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>{{ isset($medicine) ? 'Simpan Perubahan' : 'Simpan Obat Baru' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIMEDIK - Buat Janji Temu</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50">
        <!-- Sticky Header -->
        <div class="sticky top-0 z-50 bg-white border-b border-slate-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center justify-between">
                    <!-- Logo & Branding -->
                    <div class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-emerald-500 rounded-2xl flex items-center justify-center">
                            <span class="text-white font-bold text-lg">S</span>
                        </div>
                        <span class="text-2xl font-bold text-emerald-600">SIMEDIK</span>
                    </div>
                    
                    <!-- Back Button -->
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-emerald-600 hover:text-emerald-700 font-semibold transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        <span class="hidden sm:inline">Kembali ke Dashboard</span>
                        <span class="sm:hidden">Kembali</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <!-- Page Header -->
                <div class="mb-10">
                    <h1 class="text-4xl font-bold text-slate-900 mb-3">Buat Janji Temu Baru</h1>
                    <p class="text-slate-600 text-lg">Silakan lengkapi formulir di bawah untuk membuat janji temu dengan dokter</p>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 sm:p-10">
                    <!-- Alert Info -->
                    <div class="mb-8 p-5 rounded-2xl bg-emerald-50 border border-emerald-100">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-emerald-800 text-sm font-medium">
                                    Perhatian: Pastikan semua data yang Anda masukkan sudah benar. Tim kami akan mengkonfirmasi jadwal Anda dalam 1×24 jam.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('patient.store') }}" class="space-y-8">
                        @csrf

                        <!-- Tanggal Pengajuan -->
                        <div>
                            <label for="tanggal_pengajuan" class="block text-slate-900 font-semibold text-sm mb-3">
                                Tanggal Pengajuan
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="date"
                                id="tanggal_pengajuan"
                                name="tanggal_pengajuan"
                                value="{{ old('tanggal_pengajuan') }}"
                                required
                                class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-10 transition-all duration-200"
                            />
                            <p class="text-slate-500 text-xs mt-2">Pilih tanggal kapan Anda ingin berkonsultasi</p>
                            @error('tanggal_pengajuan')
                                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Poli Selection -->
                        <div>
                            <label for="poli_id" class="block text-slate-900 font-semibold text-sm mb-3">
                                Pilih Poli Tujuan
                                <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="poli_id"
                                name="poli_id"
                                required
                                class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-10 transition-all duration-200 appearance-none cursor-pointer"
                                style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 20 20\" fill=\"%23475569\"><path fill-rule=\"evenodd\" d=\"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z\" clip-rule=\"evenodd\" /></svg>'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em; padding-right: 2.5rem;"
                            >
                                <option value=""disabled selected hidden>Pilih Poli Tujuan</option>
                                @forelse($polis as $poli)
                                    <option value="{{ $poli->id }}" @selected(old('poli_id') == $poli->id)>
                                        {{ $poli->nama_poli }}
                                    </option>
                                @empty
                                    <option value="" disabled>Tidak ada poli tersedia</option>
                                @endforelse
                            </select>
                            <p class="text-slate-500 text-xs mt-2">Pilih jenis poli sesuai dengan kebutuhan Anda</p>
                            @error('poli_id')
                                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keluhan -->
                        <div>
                            <label for="keluhan" class="block text-slate-900 font-semibold text-sm mb-3">
                                Keluhan / Riwayat Kesehatan
                                <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                id="keluhan"
                                name="keluhan"
                                rows="5"
                                required
                                placeholder="Jelaskan keluhan Anda atau riwayat kesehatan yang relevan..."
                                class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-10 transition-all duration-200 resize-none"
                            >{{ old('keluhan') }}</textarea>
                            <p class="text-slate-500 text-xs mt-2">Deskripsikan keluhan dengan detail agar dokter dapat mempersiapkan diri dengan baik</p>
                            @error('keluhan')
                                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Required Fields Note -->
                        <div class="pt-4">
                            <p class="text-slate-600 text-xs">
                                <span class="text-red-500 font-semibold">*</span> Semua field yang ditandai dengan bintang merah adalah wajib diisi
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 pt-8 border-t border-slate-200">
                            <a href="{{ route('dashboard') }}" class="flex-1 text-center py-3 px-4 rounded-2xl border-2 border-slate-200 text-slate-900 font-semibold hover:bg-slate-50 transition-all duration-200">
                                Batal
                            </a>
                            <button
                                type="submit"
                                class="flex-1 bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-2xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                            >
                                Ajukan Pendaftaran
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Help Section -->
                <div class="mt-12 bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Butuh bantuan?</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-slate-900 font-semibold text-sm">Email Kami</p>
                                <p class="text-slate-600 text-sm">info@simedik-unesa.id</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-slate-900 font-semibold text-sm">Telepon Kami</p>
                                <p class="text-slate-600 text-sm">(031) 1234-5678</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIMEDIK Admin - Beri Jadwal</title>

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
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-md">
                            <span class="text-white font-bold text-lg">S</span>
                        </div>
                        <div>
                            <span class="text-2xl font-bold text-emerald-600">SIMEDIK</span>
                            <span class="text-slate-600 text-xs ml-2 font-semibold">Admin Panel</span>
                        </div>
                    </div>
                    
                    <!-- Admin Info & Logout -->
                    <div class="flex items-center space-x-6">
                        <div class="hidden sm:block text-right">
                            <p class="text-slate-900 font-semibold text-sm">{{ Auth::user()->name }}</p>
                            <p class="text-slate-500 text-xs">Administrator</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-slate-700 hover:text-red-600 font-semibold text-sm transition-colors duration-200 flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="min-h-screen bg-slate-50">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
                <!-- Breadcrumb -->
                <div class="mb-8">
                    <div class="flex items-center space-x-2 text-sm">
                        <a href="{{ route('admin.pendaftaran') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">Daftar Pendaftaran</a>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-slate-600">Beri Jadwal Pemeriksaan</span>
                    </div>
                </div>

                <!-- Page Header -->
                <div class="mb-10">
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-2">Beri Jadwal Pemeriksaan</h1>
                    <p class="text-slate-600 text-base">Tentukan jadwal dan dokter untuk pemeriksaan pasien</p>
                </div>

                <!-- Patient Summary Card -->
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl border border-emerald-200 p-6 sm:p-8 mb-8">
                    <h3 class="text-slate-900 font-bold text-lg mb-6">Ringkasan Data Pasien</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <!-- Nama Pasien -->
                        <div>
                            <p class="text-slate-600 text-sm font-semibold mb-2">Nama Pasien</p>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-emerald-700 font-bold">{{ substr($appointment->patient->name, 0, 1) }}</span>
                                </div>
                                <p class="text-slate-900 font-bold text-lg">{{ $appointment->patient->name }}</p>
                            </div>
                        </div>

                        <!-- Poli Tujuan -->
                        <div>
                            <p class="text-slate-600 text-sm font-semibold mb-2">Poli Tujuan</p>
                            <div class="inline-flex items-center px-4 py-2 rounded-lg bg-emerald-100 border border-emerald-300">
                                <span class="text-emerald-800 font-bold">{{ $appointment->poli->nama_poli }}</span>
                            </div>
                        </div>

                        <!-- Tanggal Pengajuan -->
                        <div>
                            <p class="text-slate-600 text-sm font-semibold mb-2">Tanggal Pengajuan</p>
                            <p class="text-slate-900 font-bold text-lg">{{ \Carbon\Carbon::parse($appointment->tanggal_pengajuan)->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Keluhan -->
                    <div class="mt-6 pt-6 border-t border-emerald-200">
                        <p class="text-slate-600 text-sm font-semibold mb-2">Keluhan Pasien</p>
                        <p class="text-slate-900 leading-relaxed">{{ $appointment->keluhan }}</p>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 sm:p-10">
                    <!-- Alert Info -->
                    <div class="mb-8 p-5 rounded-2xl bg-blue-50 border border-blue-100">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-blue-800 text-sm font-medium">
                                    Pilih dokter yang tersedia dan waktu pemeriksaan yang sesuai dengan jadwal klinik.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('admin.update-jadwal', $appointment->id) }}" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Pilih Dokter -->
                        <div>
                            <label for="doctor_id" class="block text-slate-900 font-semibold text-sm mb-3">
                                Pilih Dokter
                                <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="doctor_id"
                                name="doctor_id"
                                required
                                class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-10 transition-all duration-200 appearance-none cursor-pointer"
                                style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 20 20\" fill=\"%23475569\"><path fill-rule=\"evenodd\" d=\"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z\" clip-rule=\"evenodd\" /></svg>'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em; padding-right: 2.5rem;"
                            >
                                <option value=""disabled selected hidden>Pilih Dokter Pemeriksaan</option>
                                @forelse($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" @selected(old('doctor_id') == $doctor->id)>
                                        {{ $doctor->name }}
                                    </option>
                                @empty
                                    <option value="" disabled>Tidak ada dokter tersedia</option>
                                @endforelse
                            </select>
                            <p class="text-slate-500 text-xs mt-2">Pilih dokter yang akan melakukan pemeriksaan</p>
                            @error('doctor_id')
                                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal & Jam Pemeriksaan -->
                        <div>
                            <label for="waktu_jadwal" class="block text-slate-900 font-semibold text-sm mb-3">
                                Tanggal & Jam Pemeriksaan
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="datetime-local"
                                id="waktu_jadwal"
                                name="waktu_jadwal"
                                value="{{ old('waktu_jadwal') }}"
                                required
                                class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-10 transition-all duration-200"
                            />
                            <p class="text-slate-500 text-xs mt-2">Tentukan tanggal dan jam pemeriksaan yang sesuai</p>
                            @error('waktu_jadwal')
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
                            <a href="{{ route('admin.pendaftaran') }}" class="flex-1 text-center py-3 px-4 rounded-2xl border-2 border-slate-200 text-slate-900 font-semibold hover:bg-slate-50 transition-all duration-200">
                                Batal
                            </a>
                            <button
                                type="submit"
                                class="flex-1 bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-2xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 flex items-center justify-center space-x-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Simpan Jadwal</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Info Box -->
                <div class="mt-8 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h4 class="text-slate-900 font-bold text-sm mb-3">Catatan Penting</h4>
                    <ul class="space-y-2 text-slate-600 text-sm">
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Pastikan jadwal yang dipilih tidak bentrok dengan jadwal dokter lain.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Jadwal akan dikirim otomatis kepada pasien setelah disimpan.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Jadwal tidak bisa diubah setelah disimpan. Hubungi admin jika perlu perubahan.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>

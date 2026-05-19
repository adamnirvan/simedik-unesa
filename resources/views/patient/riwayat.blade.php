<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIMEDIK - Riwayat Kunjungan</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#FBFBFD] text-simedik-dark">
        <!-- Sticky Header -->
        <div class="sticky top-0 z-50 bg-white border-b border-slate-100/50 backdrop-blur-xl supports-[backdrop-filter]:bg-white/70">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-6">
                <div class="flex items-center justify-between">
                    <!-- Logo & Branding -->
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/simedik-logo.png') }}" alt="SIMEDIK" class="h-10 w-auto object-contain">
                    </div>
                    
                    <!-- User Info & Back Button -->
                    <div class="flex items-center space-x-5">
                        <div class="text-right hidden sm:block">
                            <p class="text-slate-500 text-xs font-medium">Selamat datang,</p>
                            <p class="text-simedik-dark font-semibold">{{ Auth::user()->name ?? 'Pasien' }}</p>
                        </div>
                        <div class="w-px h-8 bg-slate-200/50 hidden sm:block"></div>
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-simedik-primary hover:text-simedik-primary/80 font-semibold transition-colors duration-300 ease-out">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span class="hidden sm:inline">Kembali</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
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

        <!-- Main Content -->
        <div class="min-h-screen bg-[#FBFBFD]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
                <!-- Breadcrumb -->
                <div class="mb-8">
                    <div class="flex items-center space-x-2 text-sm">
                        <a href="{{ route('dashboard') }}" class="text-simedik-primary hover:text-simedik-primary/80 font-semibold transition-colors duration-300 ease-out">Dashboard</a>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-slate-500 font-medium">Riwayat Kunjungan</span>
                    </div>
                </div>

                <!-- Page Header -->
                <div class="mb-10">
                    <h1 class="text-3xl sm:text-4xl font-bold text-simedik-dark tracking-tight mb-3">Riwayat Kunjungan</h1>
                    <p class="text-slate-500 font-medium">Lihat semua riwayat kunjungan dan pemeriksaan Anda di SIMEDIK Klinik UNESA</p>
                </div>

                <!-- Table Container -->
                <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 overflow-hidden">
                    <!-- Table Responsive Wrapper -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <!-- Table Head -->
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100/70">
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">Tanggal Pengajuan</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">Poli & Dokter</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">Keluhan</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">Status</th>
                                </tr>
                            </thead>

                            <!-- Table Body -->
                            <tbody class="divide-y divide-slate-100/50">
                                @forelse($appointmentsHistory as $history)
                                    <tr class="hover:bg-slate-50/30 transition-colors duration-200 ease-out">
                                        <!-- Tanggal Pengajuan -->
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-simedik-light/40">
                                                        <svg class="w-5 h-5 text-simedik-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="text-simedik-dark font-semibold text-sm">{{ \Carbon\Carbon::parse($history->tanggal_pengajuan ?? $history->waktu_jadwal)->format('d M Y') }}</p>
                                                    <p class="text-slate-500 text-xs font-medium">{{ \Carbon\Carbon::parse($history->tanggal_pengajuan ?? $history->waktu_jadwal)->format('l') }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Poli & Dokter -->
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div>
                                                <p class="text-simedik-dark font-semibold text-sm">{{ $history->poli->nama_poli }}</p>
                                                <p class="text-slate-500 text-xs font-medium">
                                                    @if($history->doctor)
                                                        Dr. {{ $history->doctor->name }}
                                                    @else
                                                        <span class="text-amber-600">Belum ditentukan</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </td>

                                        <!-- Keluhan -->
                                        <td class="px-6 py-5">
                                            <p class="text-slate-600 text-sm line-clamp-2 max-w-xs font-medium">{{ Str::limit($history->keluhan, 50) }}</p>
                                        </td>

                                        <!-- Status -->
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            @if($history->status === 'selesai')
                                                <span class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-simedik-light/40 text-simedik-primary border border-simedik-light/60">
                                                    <span class="w-2 h-2 bg-simedik-primary rounded-full"></span>
                                                    <span>Selesai</span>
                                                </span>
                                            @elseif($history->status === 'dijadwalkan')
                                                <span class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-100/50 text-blue-700 border border-blue-200/60">
                                                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                                    <span>Dijadwalkan</span>
                                                </span>
                                            @elseif($history->status === 'menunggu_jadwal')
                                                <span class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-100/50 text-amber-700 border border-amber-200/60">
                                                    <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                                                    <span>Menunggu Jadwal</span>
                                                </span>
                                            @else
                                                <span class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-slate-100/50 text-slate-700 border border-slate-200/60">
                                                    <span class="w-2 h-2 bg-slate-500 rounded-full"></span>
                                                    <span>{{ str_replace('_', ' ', ucfirst($history->status)) }}</span>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <!-- Empty State -->
                                    <tr>
                                        <td colspan="4" class="px-6 py-20">
                                            <div class="flex flex-col items-center justify-center">
                                                <!-- Empty Illustration -->
                                                <div class="mb-6">
                                                    <svg class="w-32 h-32 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                                <!-- Empty Text -->
                                                <h3 class="text-simedik-dark text-xl font-bold mb-2">Belum ada riwayat kunjungan</h3>
                                                <p class="text-slate-500 text-center max-w-md text-sm mb-6 font-medium">
                                                    Anda belum memiliki riwayat pemeriksaan. Mulai dengan membuat janji temu pertama Anda.
                                                </p>
                                                <a href="{{ route('patient.daftar') }}" class="inline-flex items-center space-x-2 px-6 py-3 rounded-2xl bg-simedik-primary text-simedik-dark font-semibold transition-all duration-300 ease-out shadow-sm hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                    </svg>
                                                    <span>Buat Janji Temu</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Statistics Card -->
                <div class="mt-10">
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                        <!-- Total Kunjungan -->
                        <div class="bg-white rounded-2xl shadow-[0_4px_16px_rgb(0,0,0,0.04)] border border-slate-100/50 p-6 hover:shadow-[0_8px_24px_rgb(0,0,0,0.08)] transition-shadow duration-300 ease-out">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-slate-500 text-sm font-semibold">Total Kunjungan</p>
                                <div class="bg-simedik-light/40 rounded-xl p-3">
                                    <svg class="w-5 h-5 text-simedik-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-3xl font-bold text-simedik-dark">{{ $appointmentsHistory->count() }}</p>
                            <p class="text-slate-500 text-xs mt-2 font-medium">Pemeriksaan</p>
                        </div>

                        <!-- Selesai -->
                        <div class="bg-white rounded-2xl shadow-[0_4px_16px_rgb(0,0,0,0.04)] border border-slate-100/50 p-6 hover:shadow-[0_8px_24px_rgb(0,0,0,0.08)] transition-shadow duration-300 ease-out">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-slate-500 text-sm font-semibold">Selesai</p>
                                <div class="bg-simedik-light/40 rounded-xl p-3">
                                    <svg class="w-5 h-5 text-simedik-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-3xl font-bold text-simedik-dark">{{ $appointmentsHistory->where('status', 'selesai')->count() }}</p>
                            <p class="text-slate-500 text-xs mt-2 font-medium">Selesai</p>
                        </div>

                        <!-- Dijadwalkan -->
                        <div class="bg-white rounded-2xl shadow-[0_4px_16px_rgb(0,0,0,0.04)] border border-slate-100/50 p-6 hover:shadow-[0_8px_24px_rgb(0,0,0,0.08)] transition-shadow duration-300 ease-out">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-slate-500 text-sm font-semibold">Dijadwalkan</p>
                                <div class="bg-blue-100/50 rounded-xl p-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-3xl font-bold text-simedik-dark">{{ $appointmentsHistory->where('status', 'dijadwalkan')->count() }}</p>
                            <p class="text-slate-500 text-xs mt-2 font-medium">Dijadwalkan</p>
                        </div>

                        <!-- Menunggu Jadwal -->
                        <div class="bg-white rounded-2xl shadow-[0_4px_16px_rgb(0,0,0,0.04)] border border-slate-100/50 p-6 hover:shadow-[0_8px_24px_rgb(0,0,0,0.08)] transition-shadow duration-300 ease-out">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-slate-500 text-sm font-semibold">Menunggu</p>
                                <div class="bg-amber-100/50 rounded-xl p-3">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-3xl font-bold text-simedik-dark">{{ $appointmentsHistory->where('status', 'menunggu_jadwal')->count() }}</p>
                            <p class="text-slate-500 text-xs mt-2 font-medium">Menunggu</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mt-10 bg-gradient-to-r from-simedik-light/20 to-simedik-light/10 rounded-3xl border border-simedik-light/40 p-8 sm:p-10">
                    <h3 class="text-simedik-dark font-bold text-lg mb-6">Akses Cepat</h3>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('patient.daftar') }}" class="flex-1 flex items-center justify-center space-x-2 px-6 py-3.5 rounded-2xl bg-simedik-primary text-simedik-dark font-semibold transition-all duration-300 ease-out shadow-sm hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="white" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span class="text-white">Buat Janji Temu Baru</span>
                        </a>
                        <a href="{{ route('dashboard') }}" class="flex-1 flex items-center justify-center space-x-2 px-6 py-3.5 rounded-2xl bg-white border border-slate-200/60 text-simedik-dark font-semibold transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-md hover:border-simedik-primary/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>Kembali ke Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIMEDIK Admin - Pendaftaran</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#FBFBFD] text-simedik-dark">
        <div class="bg-white border-b border-slate-100/50 sticky top-0 z-10 supports-[backdrop-filter]:bg-white/70 supports-[backdrop-filter]:backdrop-blur-xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
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

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
            
            <div class="mb-10">
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-simedik-dark mb-3">Menunggu Penjadwalan</h1>
                <p class="text-slate-500 font-medium">Daftar pasien yang masuk dalam antrean klinik dan membutuhkan konfirmasi jadwal.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-3xl border border-slate-100/50 shadow-[0_8px_30px_rgb(0,0,0,0.06)] overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse text-left">
                                <thead>
                                    <tr class="bg-slate-50/50 border-b border-slate-100/70 text-slate-500 text-xs font-bold uppercase tracking-widest">
                                        <th class="px-6 py-4 text-center w-16">No</th>
                                        <th class="px-6 py-4">Nama Pasien</th>
                                        <th class="px-6 py-4">Poli Tujuan</th>
                                        <th class="px-6 py-4">Tanggal Pengajuan</th>
                                        <th class="px-6 py-4">Keluhan</th>
                                        <th class="px-6 py-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100/50 text-slate-700 text-sm">
                                    @forelse($appointments as $index => $item)
                                        <tr class="hover:bg-slate-50/30 transition-colors duration-200 ease-out">
                                            <td class="px-6 py-5 text-center font-bold text-slate-400">
                                                {{ $index + 1 }}
                                            </td>

                                            <td class="px-6 py-5 font-semibold text-simedik-dark">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-8 h-8 bg-simedik-light/40 rounded-full flex items-center justify-center flex-shrink-0">
                                                        <span class="text-simedik-primary font-bold text-xs">{{ substr($item->patient->name, 0, 1) }}</span>
                                                    </div>
                                                    <span>{{ $item->patient->name }}</span>
                                                </div>
                                            </td>

                                            <td class="px-6 py-5">
                                                <span class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-slate-100/50 text-slate-700 border border-slate-200/50">
                                                    {{ $item->poli->nama_poli }}
                                                </span>
                                            </td>

                                            <td class="px-6 py-5 text-slate-600 font-medium">
                                                {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}
                                            </td>

                                            <td class="px-6 py-5 text-slate-600 font-medium">
                                                <span class="line-clamp-2 max-w-xs">{{ Str::limit($item->keluhan, 50) }}</span>
                                            </td>

                                            <td class="px-6 py-5 text-center whitespace-nowrap">
                                                <a href="{{ route('admin.beri-jadwal', $item->id) }}" class="inline-flex items-center px-5 py-2.5 rounded-2xl bg-simedik-primary text-white text-xs font-semibold shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95">
                                                    Beri Jadwal
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-24 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                    </svg>
                                                    <h3 class="text-simedik-dark text-lg font-bold mb-2">Belum ada antrean baru</h3>
                                                    <p class="text-slate-400 max-w-sm text-xs font-medium">Semua pasien sudah dijadwalkan atau belum ada pendaftaran baru.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    
                    <div class="space-y-4">
                        <a href="{{ route('admin.kasir') }}" class="block w-full bg-simedik-primary text-simedik-dark rounded-3xl py-5 px-6 shadow-sm hover:shadow-lg hover:brightness-105 transition-all duration-300 ease-out hover:-translate-y-1">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-white/30 rounded-xl">
                                    <svg class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l4-4h9a2 2 0 002-2V9z"></path>
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <p class="font-bold text-white leading-tight">Kasir & Pembayaran</p>
                                    <p class="text-white text-xs mt-0.5">Pantau tagihan masuk dari dokter</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.medicines.index') }}" class="block w-full bg-white hover:bg-slate-50/50 text-simedik-dark border border-slate-100/50 rounded-3xl py-5 px-6 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-md">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-simedik-light/40 rounded-xl text-simedik-primary">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <p class="font-bold text-base leading-tight text-simedik-dark">Manajemen Data Obat</p>
                                    <p class="text-slate-500 text-xs mt-0.5">Kelola stok, tambah item, & update harga</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.doctors.index') }}" class="block w-full bg-white hover:bg-slate-50/50 text-simedik-dark border border-slate-100/50 rounded-3xl py-5 px-6 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-md">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-simedik-light/40 rounded-xl text-simedik-primary">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <p class="font-bold text-base leading-tight text-simedik-dark">Manajemen Data Dokter</p>
                                    <p class="text-slate-500 text-xs mt-0.5">Atur daftar spesialis & akun klinik</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="space-y-4 pt-6 border-t border-slate-100/50">
                        
                        <div class="bg-white rounded-2xl border border-slate-100/50 p-6 shadow-[0_4px_16px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_24px_rgb(0,0,0,0.08)] transition-shadow duration-300 ease-out">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider">Total Antrean</p>
                                    <h3 class="text-3xl font-bold text-simedik-dark mt-2">{{ $appointments->count() }}</h3>
                                </div>
                                <div class="bg-simedik-light/40 text-simedik-primary rounded-xl p-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border border-slate-100/50 p-6 shadow-[0_4px_16px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_24px_rgb(0,0,0,0.08)] transition-shadow duration-300 ease-out">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider">Masuk Hari Ini</p>
                                    <h3 class="text-3xl font-bold text-simedik-dark mt-2">{{ $appointments->filter(fn($item) => $item->created_at->isToday())->count() }}</h3>
                                </div>
                                <div class="bg-blue-100/50 text-blue-600 rounded-xl p-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border border-slate-100/50 p-6 shadow-[0_4px_16px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_24px_rgb(0,0,0,0.08)] transition-shadow duration-300 ease-out">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider">Masuk Minggu Ini</p>
                                    <h3 class="text-3xl font-bold text-simedik-dark mt-2">{{ $appointments->filter(fn($item) => $item->created_at->isCurrentWeek())->count() }}</h3>
                                </div>
                                <div class="bg-purple-100/50 text-purple-600 rounded-xl p-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
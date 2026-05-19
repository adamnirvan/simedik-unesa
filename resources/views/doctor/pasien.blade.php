<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIMEDIK Doctor - Jadwal Pemeriksaan</title>

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
                        <p class="text-simedik-dark font-semibold text-sm">Dr. {{ Auth::user()->name }}</p>
                        <p class="text-slate-500 text-xs font-medium">Dokter Spesialis</p>
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">

        {{-- Page Header --}}
        <div class="mb-10 flex items-end justify-between">
            <div>
                <h1 class="text-4xl font-bold tracking-tight text-simedik-dark mb-2">Jadwal Pemeriksaan Hari Ini</h1>
                <p class="text-slate-500 font-medium">Daftar pasien yang akan Anda periksa hari ini</p>
            </div>
            <div class="hidden sm:block text-right">
                <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Hari ini</p>
                <p class="text-simedik-dark font-bold text-lg">{{ \Carbon\Carbon::today()->format('d M Y') }}</p>
            </div>
        </div>

        {{-- Patient Schedule Table --}}
        <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100/70 text-slate-500 text-xs font-bold uppercase tracking-wider">
                            <th class="px-6 py-5 w-16">No</th>
                            <th class="px-6 py-5">Waktu Jadwal</th>
                            <th class="px-6 py-5">Nama Pasien</th>
                            <th class="px-6 py-5">Keluhan</th>
                            <th class="px-6 py-5 text-center w-48">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100/50 text-sm">
                        @forelse($appointments as $index => $item)
                            <tr class="hover:bg-slate-50/30 transition-colors duration-200 ease-out">

                                {{-- No --}}
                                <td class="px-6 py-5 font-bold text-slate-300">
                                    {{ $index + 1 }}
                                </td>

                                {{-- Waktu Jadwal --}}
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-simedik-light/30 text-simedik-primary rounded-xl p-2 flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-simedik-dark font-semibold text-sm">{{ \Carbon\Carbon::parse($item->waktu_jadwal)->format('d M Y') }}</p>
                                            <p class="text-slate-500 text-xs font-medium">{{ \Carbon\Carbon::parse($item->waktu_jadwal)->format('H:i') }} WIB</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Nama Pasien --}}
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 bg-simedik-light/40 text-simedik-primary rounded-2xl flex items-center justify-center flex-shrink-0 font-bold text-sm">
                                            {{ substr($item->patient->name, 0, 1) }}
                                        </div>
                                        <span class="text-simedik-dark font-semibold">{{ $item->patient->name }}</span>
                                    </div>
                                </td>

                                {{-- Keluhan --}}
                                <td class="px-6 py-5">
                                    <span class="text-slate-500 text-sm font-medium line-clamp-2 max-w-sm">{{ $item->keluhan }}</span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-5 whitespace-nowrap text-center">
                                    <a href="{{ route('doctor.resep', $item->id) }}" class="inline-flex items-center space-x-2 bg-simedik-primary text-white font-semibold tracking-wide rounded-2xl px-4 py-2.5 shadow-sm transition-all duration-300 ease-out hover:-translate-y-0.5 hover:shadow-lg hover:brightness-105 active:scale-95 text-xs">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                        </svg>
                                        <span>Periksa & Beri Resep</span>
                                    </a>
                                </td>

                            </tr>
                        @empty
                            {{-- Empty State --}}
                            <tr>
                                <td colspan="5" class="px-6 py-24 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="mb-6">
                                            <svg class="w-32 h-32 text-simedik-light" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                {{-- Coffee Cup --}}
                                                <path d="M25 30H70V65C70 70.523 66.075 75 61 75H34C28.925 75 25 70.523 25 65V30Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                {{-- Cup Handle --}}
                                                <path d="M70 40C75 40 78 43 78 48C78 53 75 56 70 56" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                {{-- Coffee Inside --}}
                                                <ellipse cx="47.5" cy="32" rx="22.5" ry="4" fill="currentColor" opacity="0.3"/>
                                                <path d="M27 40C27 40 30 50 47.5 52C65 50 68 40 68 40" fill="currentColor" opacity="0.2"/>
                                                {{-- Steam --}}
                                                <path d="M35 25C35 20 37 15 40 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none" opacity="0.6"/>
                                                <path d="M47.5 23C47.5 18 49 13 52 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none" opacity="0.6"/>
                                                <path d="M60 25C60 20 62 15 65 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none" opacity="0.6"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-simedik-dark font-bold text-xl mb-2">Tidak ada jadwal pemeriksaan hari ini</h3>
                                        <p class="text-slate-500 font-medium text-center max-w-md text-sm leading-relaxed">
                                            Waktunya istirahat! ☕ Nikmati waktu Anda dan bersiaplah untuk hari esok yang penuh dengan pasien yang membutuhkan.
                                        </p>
                                        <p class="text-slate-400 text-xs font-medium mt-4">Jadwal berikutnya akan muncul di sini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-6">

            {{-- Total Pasien --}}
            <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 p-6 flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-2">Total Pasien Hari Ini</p>
                    <p class="text-4xl font-bold text-simedik-dark">{{ $appointments->count() }}</p>
                    <p class="text-slate-400 text-xs font-medium mt-1">Pasien akan diperiksa</p>
                </div>
                <div class="bg-simedik-light/40 text-simedik-primary rounded-2xl p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10h.01M11 20h8m-8-8h.01M7 20H4m0-2a3 3 0 015.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 0a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>

            {{-- Jam Kerja --}}
            <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 p-6 flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-2">Jam Kerja</p>
                    <p class="text-3xl font-bold text-simedik-dark">09:00 - 17:00</p>
                    <p class="text-slate-400 text-xs font-medium mt-1">WIB</p>
                </div>
                <div class="bg-simedik-light/40 text-simedik-primary rounded-2xl p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="mt-8 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 overflow-hidden">
            <div class="bg-gradient-to-r from-simedik-primary/10 to-simedik-light/10 border-b border-slate-100/50 px-6 sm:px-8 py-4">
                <p class="text-simedik-primary font-semibold text-xs tracking-widest uppercase">Akses Cepat</p>
            </div>
            <div class="p-6 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="{{ route('doctor.pasien') }}" class="flex items-center space-x-4 p-4 bg-slate-50/50 rounded-2xl border border-slate-100/70 hover:bg-simedik-light/10 hover:border-simedik-primary/20 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:shadow-sm group">
                        <div class="bg-simedik-light/40 text-simedik-primary rounded-xl p-2.5 flex-shrink-0 group-hover:bg-simedik-light/60 transition-colors duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-simedik-dark text-sm">Refresh Jadwal</p>
                            <p class="text-slate-500 text-xs font-medium">Muat ulang daftar pasien</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center space-x-4 p-4 bg-slate-50/50 rounded-2xl border border-slate-100/70 hover:bg-simedik-light/10 hover:border-simedik-primary/20 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:shadow-sm group">
                        <div class="bg-simedik-light/40 text-simedik-primary rounded-xl p-2.5 flex-shrink-0 group-hover:bg-simedik-light/60 transition-colors duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-simedik-dark text-sm">Bantuan</p>
                            <p class="text-slate-500 text-xs font-medium">Hubungi dukungan teknis</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>

</body>
</html>

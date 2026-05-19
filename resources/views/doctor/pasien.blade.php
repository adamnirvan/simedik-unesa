<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIMEDIK Doctor - Jadwal Pemeriksaan</title>

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
                            <span class="text-slate-600 text-xs ml-2 font-semibold">Doctor Panel</span>
                        </div>
                    </div>
                    
                    <!-- Doctor Info & Logout -->
                    <div class="flex items-center space-x-6">
                        <div class="hidden sm:block text-right">
                            <p class="text-slate-900 font-semibold text-sm">Dr. {{ Auth::user()->name }}</p>
                            <p class="text-slate-500 text-xs">Dokter Spesialis</p>
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
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
                <!-- Page Header -->
                <div class="mb-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-2">Jadwal Pemeriksaan Hari Ini</h1>
                            <p class="text-slate-600 text-base">Daftar pasien yang akan Anda periksa hari ini</p>
                        </div>
                        <div class="hidden sm:block text-right">
                            <p class="text-slate-500 text-xs">Hari ini</p>
                            <p class="text-slate-900 font-bold text-lg">{{ \Carbon\Carbon::today()->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <!-- Table Responsive Wrapper -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <!-- Table Head -->
                            <thead>
                                <tr class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200">
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Waktu Jadwal</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Pasien</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Keluhan</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>

                            <!-- Table Body -->
                            <tbody class="divide-y divide-slate-200">
                                @forelse($appointments as $index => $item)
                                    <tr class="hover:bg-emerald-50 transition-colors duration-150">
                                        <!-- No -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-slate-900 font-bold">{{ $index + 1 }}</span>
                                        </td>

                                        <!-- Waktu Jadwal -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center space-x-2">
                                                <div class="bg-emerald-100 rounded-lg p-2">
                                                    <svg class="w-4 h-4 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-slate-900 font-semibold text-sm">{{ \Carbon\Carbon::parse($item->waktu_jadwal)->format('d M Y') }}</p>
                                                    <p class="text-slate-600 text-xs">{{ \Carbon\Carbon::parse($item->waktu_jadwal)->format('H:i') }} WIB</p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Nama Pasien -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                    <span class="text-blue-700 font-bold text-xs">{{ substr($item->patient->name, 0, 1) }}</span>
                                                </div>
                                                <span class="text-slate-900 font-semibold">{{ $item->patient->name }}</span>
                                            </div>
                                        </td>

                                        <!-- Keluhan -->
                                        <td class="px-6 py-4">
                                            <span class="text-slate-600 text-sm line-clamp-2 max-w-sm">{{ $item->keluhan }}</span>
                                        </td>

                                        <!-- Aksi -->
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <a href="{{ route('doctor.resep', $item->id) }}" class="inline-flex items-center px-5 py-2 rounded-lg bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white text-sm font-semibold transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                                </svg>
                                                Periksa & Beri Resep
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <!-- Empty State -->
                                    <tr>
                                        <td colspan="5" class="px-6 py-20">
                                            <div class="flex flex-col items-center justify-center">
                                                <!-- Coffee Illustration -->
                                                <div class="mb-6">
                                                    <svg class="w-40 h-40 text-slate-200" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- Coffee Cup -->
                                                        <path d="M25 30H70V65C70 70.523 66.075 75 61 75H34C28.925 75 25 70.523 25 65V30Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        
                                                        <!-- Cup Handle -->
                                                        <path d="M70 40C75 40 78 43 78 48C78 53 75 56 70 56" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        
                                                        <!-- Coffee Inside -->
                                                        <ellipse cx="47.5" cy="32" rx="22.5" ry="4" fill="currentColor" opacity="0.3"/>
                                                        <path d="M27 40C27 40 30 50 47.5 52C65 50 68 40 68 40" fill="currentColor" opacity="0.2"/>
                                                        
                                                        <!-- Steam -->
                                                        <path d="M35 25C35 20 37 15 40 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none" opacity="0.6"/>
                                                        <path d="M47.5 23C47.5 18 49 13 52 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none" opacity="0.6"/>
                                                        <path d="M60 25C60 20 62 15 65 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none" opacity="0.6"/>
                                                    </svg>
                                                </div>
                                                <!-- Empty Text -->
                                                <h3 class="text-slate-900 text-2xl font-bold mb-2">Tidak ada jadwal pemeriksaan hari ini</h3>
                                                <p class="text-slate-600 text-center max-w-md text-base">
                                                    Waktunya istirahat! ☕ Nikmati waktu Anda dan bersiaplah untuk hari esok yang penuh dengan pasien yang membutuhkan.
                                                </p>
                                                <div class="mt-6 text-slate-400 text-sm">
                                                    <p>Jadwal berikutnya akan muncul di sini</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Total Pasien Hari Ini -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-slate-600 text-sm font-semibold">Total Pasien Hari Ini</p>
                            <div class="bg-emerald-100 rounded-lg p-3">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10h.01M11 20h8m-8-8h.01M7 20H4m0-2a3 3 0 015.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 0a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-slate-900">{{ $appointments->count() }}</p>
                        <p class="text-slate-500 text-xs mt-2">Pasien akan diperiksa</p>
                    </div>

                    <!-- Jam Kerja -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-slate-600 text-sm font-semibold">Jam Kerja</p>
                            <div class="bg-blue-100 rounded-lg p-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-slate-900">09:00 - 17:00</p>
                        <p class="text-slate-500 text-xs mt-2">WIB</p>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mt-10 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl border border-emerald-200 p-8">
                    <h3 class="text-slate-900 font-bold text-lg mb-4">Akses Cepat</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('doctor.pasien') }}" class="flex items-center space-x-3 p-4 bg-white rounded-xl border border-slate-200 hover:border-emerald-500 hover:shadow-md transition-all duration-200">
                            <div class="bg-emerald-100 rounded-lg p-3">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">Refresh Jadwal</p>
                                <p class="text-slate-600 text-sm">Muat ulang daftar pasien</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-center space-x-3 p-4 bg-white rounded-xl border border-slate-200 hover:border-emerald-500 hover:shadow-md transition-all duration-200">
                            <div class="bg-blue-100 rounded-lg p-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">Bantuan</p>
                                <p class="text-slate-600 text-sm">Hubungi dukungan teknis</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMEDIK Admin - Loket Farmasi</title>
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">

        {{-- Page Header --}}
        <div class="mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
            <div>
                <h1 class="text-4xl font-bold tracking-tight text-simedik-dark mb-2">Loket Farmasi & Apotek</h1>
                <p class="text-slate-500 font-medium">Serahkan obat kepada pasien yang telah menyelesaikan pembayaran.</p>
            </div>
            <a href="{{ route('admin.pendaftaran') }}" class="inline-flex items-center space-x-2 px-5 py-2.5 bg-white border border-slate-100 rounded-2xl text-sm font-semibold text-slate-600 shadow-[0_4px_16px_rgb(0,0,0,0.04)] hover:-translate-y-0.5 hover:shadow-md transition-all duration-300 ease-out">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Kembali ke Antrean</span>
            </a>
        </div>

        {{-- Appointment List --}}
        <div class="space-y-6">
            @forelse($appointments as $item)
                <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 overflow-hidden transition-all duration-300 ease-out hover:shadow-[0_16px_48px_rgb(0,0,0,0.09)] hover:-translate-y-0.5">

                    {{-- Card Header --}}
                    <div class="bg-gradient-to-r from-simedik-primary/10 to-simedik-light/10 border-b border-slate-100/50 px-6 sm:px-8 py-4 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <span class="px-3 py-1 bg-simedik-primary/20 text-simedik-primary text-xs font-bold rounded-full uppercase tracking-wider">Lunas Terverifikasi</span>
                            <span class="text-slate-400 text-sm font-medium">ID: #{{ $item->id }}</span>
                        </div>
                        <div class="bg-simedik-light/40 text-simedik-primary rounded-2xl p-2.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-6 sm:p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                            {{-- Left: Patient Info --}}
                            <div class="space-y-6">
                                {{-- Patient Name --}}
                                <div>
                                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-3">Nama Pasien</p>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-simedik-light/40 text-simedik-primary rounded-2xl flex items-center justify-center flex-shrink-0 shadow-sm">
                                            <span class="font-bold text-lg">{{ substr($item->patient->name, 0, 1) }}</span>
                                        </div>
                                        <span class="text-simedik-dark font-bold text-xl">{{ $item->patient->name }}</span>
                                    </div>
                                </div>

                                {{-- Doctor Info --}}
                                <div class="bg-slate-50/50 p-5 rounded-2xl border border-slate-100/70">
                                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-2">Resep Dari</p>
                                    <p class="text-simedik-dark font-semibold">Dr. {{ $item->doctor->name }}</p>
                                    <p class="text-simedik-primary font-medium text-sm mt-1">{{ $item->poli->nama_poli }}</p>
                                </div>
                            </div>

                            {{-- Right: Medicine List --}}
                            <div>
                                @php $totalTagihan = 0; @endphp

                                <div class="bg-slate-50/50 rounded-2xl p-5 border border-slate-100/70">
                                    <h3 class="text-simedik-dark font-bold text-base mb-4 flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-simedik-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                        </svg>
                                        <span>Daftar Obat Disiapkan</span>
                                    </h3>

                                    @if($item->medicines->count() > 0)
                                        <div class="space-y-3 mb-4">
                                            @foreach($item->medicines as $med)
                                                @php
                                                    $subtotal = $med->harga * $med->pivot->jumlah;
                                                    $totalTagihan += $subtotal;
                                                @endphp
                                                <div class="flex items-center justify-between text-sm bg-white rounded-2xl px-4 py-3 border border-slate-100/70 shadow-[0_2px_8px_rgb(0,0,0,0.04)]">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="w-2 h-2 bg-simedik-primary rounded-full"></div>
                                                        <p class="text-simedik-dark font-semibold">{{ $med->nama_obat }}</p>
                                                    </div>
                                                    <span class="px-3 py-1 bg-simedik-light/30 text-simedik-primary rounded-xl font-bold text-xs">{{ $med->pivot->jumlah }} x</span>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="border-t border-slate-200/70 pt-4 mt-4 flex items-center justify-between">
                                            <span class="text-slate-500 font-medium text-sm">Telah Dibayar</span>
                                            <span class="text-simedik-primary font-bold text-xl">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</span>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center h-24 text-slate-400">
                                            <p class="text-sm font-medium">Tidak ada obat fisik yang perlu disiapkan.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                        {{-- Action Button --}}
                        <div class="border-t border-slate-100/70 mt-8 pt-6 flex justify-end">
                            <form method="POST" action="{{ route('admin.serahkan-obat', $item->id) }}">
                                @csrf
                                <button type="submit" class="inline-flex items-center justify-center space-x-2 bg-simedik-primary text-simedik-dark font-semibold tracking-wide rounded-2xl px-8 py-3.5 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Serahkan Obat & Selesai</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 p-12 sm:p-20">
                    <div class="flex flex-col items-center justify-center text-center">
                        <div class="w-24 h-24 bg-simedik-light/30 rounded-3xl flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-simedik-primary/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>

                        <h2 class="text-2xl font-bold tracking-tight text-simedik-dark mb-3">Belum Ada Antrean Pengambilan Obat</h2>
                        <p class="text-slate-500 font-medium text-base max-w-md leading-relaxed">Saat ini tidak ada pasien berstatus lunas. Daftar resep akan otomatis muncul di sini setelah pasien menyelesaikan pembayaran via aplikasi.</p>

                        <a href="{{ route('admin.pendaftaran') }}" class="mt-8 inline-flex items-center space-x-2 bg-simedik-primary text-simedik-dark font-semibold tracking-wide rounded-2xl px-6 py-3.5 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span class="text-white">Kembali Pantau Antrean</span>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>
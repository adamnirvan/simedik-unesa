<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIMEDIK Admin - Loket Farmasi</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50">
        <div class="sticky top-0 z-50 bg-white border-b border-slate-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-md">
                            <span class="text-white font-bold text-lg">S</span>
                        </div>
                        <div>
                            <span class="text-2xl font-bold text-emerald-600">SIMEDIK</span>
                            <span class="text-slate-600 text-xs ml-2 font-semibold">Admin Panel</span>
                        </div>
                    </div>
                    
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

        <div class="min-h-screen bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
                
                <div class="mb-10 flex justify-between items-end">
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-2">Loket Farmasi & Apotek</h1>
                        <p class="text-slate-600 text-base">Serahkan obat kepada pasien yang telah menyelesaikan pembayaran.</p>
                    </div>
                    <a href="{{ route('admin.pendaftaran') }}" class="hidden sm:inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Antrean
                    </a>
                </div>

                <div class="space-y-6">
                    @forelse($appointments as $item)
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 hover:shadow-lg transition-all duration-300 overflow-hidden relative">
                            <div class="absolute top-0 left-0 w-2 h-full bg-emerald-500"></div>
                            
                            <div class="p-6 sm:p-8 pl-8">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                    
                                    <div class="space-y-6">
                                        <div>
                                            <div class="flex items-center space-x-2 mb-4">
                                                <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-md uppercase tracking-wider">Lunas Terverifikasi</span>
                                                <span class="text-slate-400 text-sm font-medium">ID: #{{ $item->id }}</span>
                                            </div>
                                            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-2">Nama Pasien</p>
                                            <div class="flex items-center space-x-3">
                                                <div class="w-12 h-12 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm border border-slate-200">
                                                    <span class="font-bold text-lg">{{ substr($item->patient->name, 0, 1) }}</span>
                                                </div>
                                                <span class="text-slate-900 font-bold text-xl">{{ $item->patient->name }}</span>
                                            </div>
                                        </div>

                                        <div class="border-t border-slate-100 pt-6">
                                            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-2">Resep Dari</p>
                                            <p class="text-slate-900 font-semibold">Dr. {{ $item->doctor->name }}</p>
                                            <p class="text-emerald-600 font-medium text-sm mt-1">{{ $item->poli->nama_poli }}</p>
                                        </div>

                                    </div>

                                    <div>
                                        @php $totalTagihan = 0; @endphp

                                        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6">
                                            <h3 class="text-slate-900 font-bold text-lg mb-4 flex items-center space-x-2">
                                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                                        <div class="flex items-center justify-between text-sm bg-white rounded-xl px-4 py-3 border border-slate-200 shadow-sm">
                                                            <div class="flex items-center space-x-3">
                                                                <div class="w-2 h-2 bg-emerald-400 rounded-full"></div>
                                                                <p class="text-slate-900 font-semibold">{{ $med->nama_obat }}</p>
                                                            </div>
                                                            <div class="flex items-center space-x-2">
                                                                <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-lg font-bold">{{ $med->pivot->jumlah }} x</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="border-t border-slate-200 pt-4 mt-4 flex items-center justify-between">
                                                    <span class="text-slate-500 font-medium text-sm">Telah Dibayar</span>
                                                    <span class="text-emerald-600 font-bold text-lg">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</span>
                                                </div>
                                            @else
                                                <div class="flex items-center justify-center h-24 text-slate-400">
                                                    <p class="text-sm">Tidak ada obat fisik yang perlu disiapkan.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="border-t border-slate-100 mt-8 pt-6 flex justify-end">
                                    <form method="POST" action="{{ route('admin.serahkan-obat', $item->id) }}">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center space-x-2 px-8 py-4 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 transform hover:scale-105">
                                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Serahkan Obat & Selesai</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-12 sm:p-20">
                            <div class="flex flex-col items-center justify-center text-center">
                                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6 border border-slate-100">
                                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>

                                <h2 class="text-2xl font-bold text-slate-900 mb-3">Belum Ada Antrean Pengambilan Obat</h2>
                                <p class="text-slate-500 text-base max-w-md">Saat ini tidak ada pasien berstatus lunas. Daftar resep akan otomatis muncul di sini setelah pasien menyelesaikan pembayaran via aplikasi.</p>
                                
                                <a href="{{ route('admin.pendaftaran') }}" class="mt-8 text-emerald-600 font-semibold hover:text-emerald-700 transition-colors">
                                    &larr; Kembali pantau antrean pendaftaran
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </body>
</html>
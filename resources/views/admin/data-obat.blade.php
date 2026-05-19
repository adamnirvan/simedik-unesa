<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIMEDIK Admin - Manajemen Obat</title>

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

        <div class="mb-6">
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('admin.pendaftaran') }}" class="text-simedik-primary hover:text-simedik-primary/80 font-semibold transition-colors duration-300 ease-out">Dashboard Admin</a>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-slate-500 font-medium">Data Obat</span>
            </div>
        </div>

        {{-- Success Flash Message (Desain Premium Berwarna Emerald Lembut dengan Blur) --}}
        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50/80 border border-emerald-100/50 rounded-2xl flex items-center space-x-4 backdrop-blur-md shadow-sm">
                <div class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <span class="text-emerald-800 text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Page Header --}}
        <div class="mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
            <div>
                <h1 class="text-4xl font-bold tracking-tight text-simedik-dark mb-2">Manajemen Data Obat</h1>
                <p class="text-slate-500 font-medium">Kelola informasi katalog, penyesuaian harga jual, dan kontrol stok gudang farmasi.</p>
            </div>

            <div class="flex items-center space-x-3 self-start sm:self-auto flex-shrink-0">
                <a href="{{ route('admin.pendaftaran') }}" class="inline-flex items-center space-x-2 px-5 py-2.5 bg-white border border-slate-100 rounded-2xl text-sm font-semibold text-slate-600 shadow-[0_4px_16px_rgb(0,0,0,0.04)] hover:-translate-y-0.5 hover:shadow-md transition-all duration-300 ease-out">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Antrean</span>
                </a>
                <a href="{{ route('admin.medicines.create') }}" class="inline-flex items-center space-x-2 bg-simedik-primary text-white font-semibold tracking-wide rounded-2xl px-5 py-2.5 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Tambah Obat Baru</span>
                </a>
            </div>
        </div>

        {{-- Data Table Card --}}
        <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100/70 text-slate-500 text-xs font-bold uppercase tracking-wider">
                            <th class="px-6 py-5 text-center w-16">No</th>
                            <th class="px-6 py-5">Nama Item Obat</th>
                            <th class="px-6 py-5">Harga Satuan</th>
                            <th class="px-6 py-5 text-center">Sisa Stok</th>
                            <th class="px-6 py-5 text-center w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100/50 text-sm">
                        @forelse($medicines as $index => $item)
                            <tr class="hover:bg-slate-50/30 transition-colors duration-200 ease-out">

                                {{-- No --}}
                                <td class="px-6 py-5 text-center font-bold text-slate-300">
                                    {{ $index + 1 }}
                                </td>

                                {{-- Nama Obat --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 bg-simedik-light/30 text-simedik-primary rounded-2xl flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-simedik-dark font-semibold">{{ $item->nama_obat }}</span>
                                    </div>
                                </td>

                                {{-- Harga --}}
                                <td class="px-6 py-5 font-semibold text-simedik-dark">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>

                                {{-- Stok Badge --}}
                                <td class="px-6 py-5 text-center whitespace-nowrap">
                                    @if($item->stok <= 0)
                                        <span class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-red-50 text-red-600 border border-red-100/80">
                                            Habis (0)
                                        </span>
                                    @elseif($item->stok < 15)
                                        <span class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-amber-50 text-amber-600 border border-amber-100/80">
                                            Menipis ({{ $item->stok }})
                                        </span>
                                    @else
                                        <span class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-simedik-light/30 text-simedik-primary border border-simedik-primary/20">
                                            {{ $item->stok }} Unit
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-5 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.medicines.edit', $item->id) }}" class="p-2 bg-slate-50 hover:bg-simedik-light/20 text-slate-500 hover:text-simedik-primary rounded-xl border border-slate-100/70 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.medicines.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-50 hover:bg-red-100 text-red-400 hover:text-red-600 rounded-xl border border-red-100/80 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-24 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-simedik-light/20 rounded-3xl flex items-center justify-center mb-5">
                                            <svg class="w-10 h-10 text-simedik-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-simedik-dark font-bold text-lg mb-2">Gudang Obat Kosong</h3>
                                        <p class="text-slate-500 font-medium text-sm max-w-xs">Belum ada katalog obat yang terdata di database SIMEDIK.</p>
                                        <a href="{{ route('admin.medicines.create') }}" class="mt-6 inline-flex items-center space-x-2 bg-simedik-primary text-white font-semibold tracking-wide rounded-2xl px-5 py-2.5 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            <span>Tambah Obat Pertama</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>
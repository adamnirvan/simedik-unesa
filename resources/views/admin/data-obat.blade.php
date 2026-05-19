<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIMEDIK Admin - Manajemen Obat</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
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

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center space-x-3 shadow-sm animate-fade-in">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="mb-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-950 mb-2">Manajemen Data Obat</h1>
                    <p class="text-slate-500 text-base">Kelola informasi katalog, penyesuaian harga jual, dan kontrol stok gudang farmasi.</p>
                </div>
                
                <div class="flex items-center space-x-3 self-start sm:self-center">
                    <a href="{{ route('admin.pendaftaran') }}" class="px-5 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all shadow-sm">
                        &larr; Antrean
                    </a>
                    <a href="{{ route('admin.medicines.create') }}" class="inline-flex items-center px-6 py-3 rounded-2xl bg-slate-900 hover:bg-slate-800 text-white text-sm font-bold shadow-md transition-all duration-200 transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Obat Baru
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                <th class="px-6 py-4 text-center w-16">No</th>
                                <th class="px-6 py-4">Nama Item Obat</th>
                                <th class="px-6 py-4">Harga Satuan</th>
                                <th class="px-6 py-4 text-center">Sisa Stok</th>
                                <th class="px-6 py-4 text-center w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700 text-sm">
                            @forelse($medicines as $index => $item)
                                <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                                    <td class="px-6 py-5 text-center font-bold text-slate-400">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-6 py-5 font-bold text-slate-900">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-9 h-9 bg-slate-50 border border-slate-200 text-slate-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                                </svg>
                                            </div>
                                            <span>{{ $item->nama_obat }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 font-semibold text-slate-800">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </td>

                                    <td class="px-6 py-5 text-center whitespace-nowrap">
                                        @if($item->stok <= 0)
                                            <span class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-red-50 text-red-700 border border-red-100">
                                                Habis (0)
                                            </span>
                                        @elseif($item->stok < 15)
                                            <span class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-amber-50 text-amber-700 border border-amber-100">
                                                Menipis ({{ $item->stok }})
                                            </span>
                                        @else
                                            <span class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-slate-100 text-slate-800 border border-slate-200/40">
                                                {{ $item->stok }} Unit
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-5 text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('admin.medicines.edit', $item->id) }}" class="p-2 bg-slate-50 hover:bg-slate-100 text-slate-600 hover:text-slate-900 rounded-xl border border-slate-200 transition-colors shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.medicines.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-600 rounded-xl border border-red-200/50 transition-colors shadow-sm">
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
                                            <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                            </svg>
                                            <h3 class="text-slate-900 text-lg font-bold mb-1">Gudang Obat Kosong</h3>
                                            <p class="text-slate-400 max-w-sm text-xs">Belum ada katalog obat yang terdata di database SIMEDIK.</p>
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
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIMEDIK Admin - Manajemen Dokter</title>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center space-x-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="mb-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-950 mb-2">Tenaga Medis</h1>
                    <p class="text-slate-500 text-base">Kelola akun, akses login, dan penempatan poli untuk dokter Anda.</p>
                </div>
                
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.pendaftaran') }}" class="px-5 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all shadow-sm">
                        &larr; Antrean
                    </a>
                    <a href="{{ route('admin.doctors.create') }}" class="inline-flex items-center px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold shadow-md transition-all duration-200 transform hover:scale-105">
                        + Tambah Dokter Baru
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                <th class="px-6 py-4 text-center w-16">No</th>
                                <th class="px-6 py-4">Profil Dokter & Kontak</th>
                                <th class="px-6 py-4">Penempatan Poli</th>
                                <th class="px-6 py-4 text-center w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700 text-sm">
                            @forelse($doctors as $index => $item)
                                <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                                    <td class="px-6 py-5 text-center font-bold text-slate-400">
                                        {{ $index + 1 }}
                                    </td>
                                    
                                    <td class="px-6 py-5">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold text-lg border border-blue-100">
                                                {{ substr($item->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900 text-base">Dr. {{ $item->name }}</p>
                                                <p class="text-xs text-slate-500">{{ $item->email }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1.5 inline-flex text-xs font-bold rounded-lg bg-slate-100 text-slate-700 border border-slate-200">
                                            {{ $item->poli->nama_poli ?? 'Belum Ditentukan' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-5 text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('admin.doctors.edit', $item->id) }}" class="p-2 bg-slate-50 hover:bg-slate-100 text-slate-600 hover:text-slate-900 rounded-xl border border-slate-200 transition-colors">
                                                Ubah
                                            </a>
                                            <form action="{{ route('admin.doctors.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin mencabut akses dokter ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 hover:bg-red-100 text-red-500 rounded-xl border border-red-100">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center text-slate-400">Belum ada data dokter yang terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
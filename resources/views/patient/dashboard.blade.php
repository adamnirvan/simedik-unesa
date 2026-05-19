<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pasien - SIMEDIK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">
    
    <div class="bg-white border-b border-slate-200/60 sticky top-0 z-10 supports-[backdrop-filter]:bg-white/60 supports-[backdrop-filter]:backdrop-blur-md">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-slate-900 rounded-2xl flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-lg">S</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight hidden sm:inline">SIMEDIK</span>
                </div>
                
                <div class="flex items-center space-x-5">
                    <div class="text-right hidden sm:block">
                        <p class="text-slate-900 font-bold text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-slate-500 text-xs font-medium">Pasien</p>
                    </div>
                    <div class="w-px h-8 bg-slate-200 hidden sm:block"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight mb-1">Halo, {{ Auth::user()->name }} 👋</h1>
            <p class="text-slate-500">Pusat layanan kesehatan dan informasi medis Anda.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                @if($latestAppointment && $latestAppointment->status == 'selesai')
                    <div class="bg-white rounded-3xl border border-blue-200 shadow-sm overflow-hidden relative">
                        <div class="absolute top-0 left-0 w-2 h-full bg-blue-500"></div>
                        <div class="p-6 sm:p-8">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <p class="text-blue-600 font-bold text-sm tracking-widest uppercase mb-1">Menunggu Pembayaran</p>
                                    <h2 class="text-2xl font-bold text-slate-900">Tagihan Obat & Konsultasi</h2>
                                </div>
                                <div class="bg-blue-50 text-blue-600 p-3 rounded-2xl">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                </div>
                            </div>

                            @php $totalTagihan = 0; @endphp
                            
                            <div class="bg-slate-50 rounded-2xl p-5 mb-6 border border-slate-100 space-y-3">
                                @forelse($latestAppointment->medicines as $med)
                                    @php 
                                        $subtotal = $med->harga * $med->pivot->jumlah; 
                                        $totalTagihan += $subtotal; 
                                    @endphp
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-slate-600">{{ $med->nama_obat }} ({{ $med->pivot->jumlah }}x)</span>
                                        <span class="text-slate-900 font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                    </div>
                                @empty
                                    <p class="text-sm text-slate-500 italic">Tidak ada resep obat.</p>
                                @endforelse
                                
                                <div class="border-t border-slate-200 pt-3 mt-3 flex justify-between items-center">
                                    <span class="font-bold text-slate-900">Total Pembayaran</span>
                                    <span class="font-bold text-xl text-blue-600">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('patient.pay', $latestAppointment->id) }}">
                                @csrf
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                    Bayar Sekarang
                                </button>
                            </form>
                        </div>
                    </div>

                @elseif($latestAppointment && $latestAppointment->status == 'lunas')
                    <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl shadow-md overflow-hidden relative">
                        <div class="absolute -right-6 -top-6 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                        <div class="absolute -left-6 -bottom-6 w-24 h-24 bg-black/10 rounded-full blur-xl"></div>
                        
                        <div class="p-6 sm:p-8 relative z-10">
                            <div class="flex items-center justify-between mb-8 border-b border-emerald-400/50 pb-6">
                                <div>
                                    <p class="text-emerald-100 font-bold text-xs tracking-widest uppercase mb-1">Pembayaran Terverifikasi</p>
                                    <h2 class="text-2xl font-bold text-white tracking-tight">Tiket Farmasi</h2>
                                </div>
                                <div class="bg-white/20 backdrop-blur-sm text-white p-3 rounded-2xl border border-white/20">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/20 mb-6">
                                <p class="text-emerald-50 text-sm mb-3">Silakan tunjukkan layar ini atau sebutkan nomor pendaftaran di loket farmasi untuk mengambil obat Anda.</p>
                                <div class="flex items-center justify-between bg-white/20 rounded-xl p-4">
                                    <span class="text-white font-medium">No. Pendaftaran</span>
                                    <span class="text-2xl font-bold text-white tracking-widest">#{{ $latestAppointment->id }}</span>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 text-emerald-100 text-sm">
                                <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Menunggu admin menyerahkan obat...</span>
                            </div>
                        </div>
                    </div>

                @else
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8">
                        <div class="flex items-start justify-between mb-8">
                            <div>
                                <p class="text-slate-500 font-semibold text-xs tracking-widest uppercase mb-2">Status Pemeriksaan Saat Ini</p>
                                <h2 class="text-3xl font-bold text-slate-950">
                                    @if($latestAppointment && $latestAppointment->status != 'obat_diambil')
                                        {{ str_replace('_', ' ', ucfirst($latestAppointment->status)) }}
                                    @else
                                        Belum Ada Antrean Aktif
                                    @endif
                                </h2>
                            </div>
                            <div class="bg-slate-100 rounded-2xl p-3 text-slate-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        @if($latestAppointment && $latestAppointment->status != 'obat_diambil')
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-1">Jadwal</p>
                                    <p class="text-slate-900 font-bold">
                                        {{ $latestAppointment->waktu_jadwal ? \Carbon\Carbon::parse($latestAppointment->waktu_jadwal)->translatedFormat('d M Y, H:i') : 'Menunggu Dokter' }}
                                    </p>
                                </div>
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-1">Poli Tujuan</p>
                                    <p class="text-slate-900 font-bold">{{ $latestAppointment->poli->nama_poli }}</p>
                                </div>
                            </div>
                        @else
                            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 text-center">
                                <p class="text-slate-500 text-sm">Anda sedang tidak dalam masa perawatan atau antrean.</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="space-y-6">
                
                @if(!$latestAppointment || $latestAppointment->status == 'obat_diambil')
                <a href="{{ route('patient.daftar') }}" class="block w-full bg-slate-900 hover:bg-slate-800 text-white rounded-3xl py-6 px-6 font-bold text-center shadow-md transition-all duration-200 transform hover:scale-[1.02]">
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Buat Janji Temu Baru</span>
                    </div>
                </a>
                @endif

                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-1">Total Kunjungan</p>
                        <p class="text-3xl font-bold text-slate-900">{{ $totalKunjungan }}</p>
                    </div>
                    <div class="bg-emerald-50 text-emerald-600 rounded-2xl p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-slate-900">Riwayat Kunjungan</h2>
                <a href="{{ route('patient.riwayat') }}" class="text-slate-500 hover:text-slate-900 font-semibold text-sm transition-colors">Lihat Semua &rarr;</a>
            </div>

            @if($totalKunjungan == 0)
                <div class="bg-white rounded-3xl border border-slate-200 p-10 text-center shadow-sm">
                    <p class="text-slate-500 text-sm">Belum ada data kunjungan yang selesai.</p>
                </div>
            @else
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs uppercase tracking-wider font-bold">
                                    <th class="p-5">Tanggal Pemeriksaan</th>
                                    <th class="p-5">Poli</th>
                                    <th class="p-5">Dokter</th>
                                    <th class="p-5">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm font-medium text-slate-700">
                                @foreach($appointmentsHistory as $history)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="p-5">{{ \Carbon\Carbon::parse($history->waktu_jadwal)->translatedFormat('d M Y, H:i') }} WIB</td>
                                        <td class="p-5">
                                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 border border-slate-200">{{ $history->poli->nama_poli }}</span>
                                        </td>
                                        <td class="p-5">Dr. {{ $history->doctor->name ?? '-' }}</td>
                                        <td class="p-5">
                                            <span class="inline-flex items-center space-x-1.5 text-emerald-600 font-bold">
                                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                <span>Selesai</span>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

    </div>
</body>
</html>
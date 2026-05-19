<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIMEDIK Doctor - Pemeriksaan & Resep</title>

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
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">

        {{-- Breadcrumb --}}
        <div class="mb-8 flex items-center space-x-2 text-sm">
            <a href="{{ route('doctor.pasien') }}" class="text-simedik-primary hover:text-simedik-primary/80 font-semibold transition-colors duration-300 ease-out">Jadwal Pemeriksaan</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-slate-500 font-medium">Pemeriksaan & Resep</span>
        </div>

        {{-- Page Header --}}
        <div class="mb-10">
            <h1 class="text-4xl font-bold tracking-tight text-simedik-dark mb-2">Pemeriksaan & Resep</h1>
            <p class="text-slate-500 font-medium">Catat hasil pemeriksaan dan berikan resep obat kepada pasien</p>
        </div>

        {{-- Patient Info Card --}}
        <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 overflow-hidden mb-6">
            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-simedik-primary/10 to-simedik-light/10 border-b border-slate-100/50 px-6 sm:px-8 py-4 flex items-center justify-between">
                <p class="text-simedik-primary font-semibold text-xs tracking-widest uppercase">Data Pasien</p>
                <div class="bg-simedik-light/40 text-simedik-primary rounded-2xl p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>

            {{-- Card Body --}}
            <div class="p-6 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    {{-- Nama Pasien --}}
                    <div>
                        <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-3">Nama Pasien</p>
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-simedik-light/40 text-simedik-primary rounded-2xl flex items-center justify-center flex-shrink-0 font-bold text-lg">
                                {{ substr($appointment->patient->name, 0, 1) }}
                            </div>
                            <p class="text-simedik-dark font-bold text-xl">{{ $appointment->patient->name }}</p>
                        </div>
                    </div>

                    {{-- Waktu Pemeriksaan --}}
                    <div>
                        <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-3">Waktu Pemeriksaan</p>
                        <div class="flex items-center space-x-3">
                            <div class="bg-simedik-light/30 text-simedik-primary rounded-xl p-2.5 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-simedik-dark font-semibold">{{ \Carbon\Carbon::parse($appointment->waktu_jadwal)->format('d M Y') }}</p>
                                <p class="text-slate-500 text-sm font-medium">{{ \Carbon\Carbon::parse($appointment->waktu_jadwal)->format('H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Keluhan --}}
                <div class="mt-6 pt-6 border-t border-slate-100/70">
                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-3">Keluhan Pasien</p>
                    <div class="bg-slate-50/50 rounded-2xl p-4 border border-slate-100/70">
                        <p class="text-simedik-dark leading-relaxed font-medium">{{ $appointment->keluhan }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Resep Form Card --}}
        <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 p-6 sm:p-8">

            {{-- Alert Info --}}
            <div class="mb-8 p-4 rounded-2xl bg-simedik-light/20 border border-simedik-primary/20 flex items-start space-x-3">
                <div class="flex-shrink-0 bg-simedik-primary/20 rounded-xl p-1.5">
                    <svg class="w-4 h-4 text-simedik-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-simedik-dark/80 text-sm font-medium leading-relaxed">
                    Pilih obat yang sesuai dan tentukan jumlah sesuai kebutuhan pasien. Anda dapat menambahkan lebih dari satu jenis obat.
                </p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('doctor.store-resep', $appointment->id) }}" class="space-y-8">
                @csrf

                {{-- Medicines Section --}}
                <div>
                    <label class="block text-simedik-dark font-bold text-base mb-6">
                        Resep Obat
                        <span class="text-red-500">*</span>
                    </label>

                    {{-- Medicine Item Container --}}
                    <div id="medicines-container" class="space-y-4">
                        {{-- Initial Medicine Row --}}
                        <div class="medicine-row">
                            <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                                {{-- Medicine Dropdown --}}
                                <div class="sm:col-span-3">
                                    <select
                                        name="medicine_id[]"
                                        required
                                        class="w-full px-4 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-2 focus:ring-simedik-primary/20 transition-all duration-300 ease-out appearance-none cursor-pointer shadow-[0_2px_8px_rgb(0,0,0,0.04)]"
                                        style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 20 20\" fill=\"%2356DFCF\"><path fill-rule=\"evenodd\" d=\"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z\" clip-rule=\"evenodd\" /></svg>'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em; padding-right: 2.5rem;"
                                    >
                                        <option value="">Pilih Obat</option>
                                        @forelse($medicines as $med)
                                            <option value="{{ $med->id }}">{{ $med->nama_obat }} ({{ $med->satuan }})</option>
                                        @empty
                                            <option value="" disabled>Tidak ada obat tersedia</option>
                                        @endforelse
                                    </select>
                                </div>

                                {{-- Quantity Input --}}
                                <div class="sm:col-span-1">
                                    <input
                                        type="number"
                                        name="jumlah[]"
                                        min="1"
                                        placeholder="Qty"
                                        class="w-full px-4 py-3.5 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark placeholder-slate-400 font-medium focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-2 focus:ring-simedik-primary/20 transition-all duration-300 ease-out shadow-[0_2px_8px_rgb(0,0,0,0.04)]"
                                    />
                                </div>

                                {{-- Remove Button --}}
                                <div class="sm:col-span-1 flex items-end">
                                    <button
                                        type="button"
                                        class="remove-medicine w-full px-4 py-3.5 rounded-2xl bg-red-50 hover:bg-red-100 text-red-400 hover:text-red-600 font-semibold transition-all duration-300 ease-out border border-red-100/80 hover:-translate-y-0.5 hover:shadow-sm hidden"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </div>
                            @error('medicine_id')
                                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                            @enderror
                            @error('jumlah')
                                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Add Medicine Button --}}
                    <button
                        type="button"
                        id="add-medicine-btn"
                        class="mt-5 inline-flex items-center space-x-2 px-5 py-2.5 rounded-2xl border border-simedik-primary/30 bg-simedik-light/20 hover:bg-simedik-light/40 text-simedik-primary font-semibold text-sm transition-all duration-300 ease-out hover:-translate-y-0.5"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Tambah Obat</span>
                    </button>
                </div>

                {{-- Required Fields Note --}}
                <p class="text-slate-400 text-xs">
                    <span class="text-red-500 font-semibold">*</span> Minimal satu obat harus dipilih
                </p>

                {{-- Action Buttons --}}
                <div class="flex gap-4 pt-6 border-t border-slate-100/70">
                    <a href="{{ route('doctor.pasien') }}" class="flex-1 text-center py-3.5 px-4 rounded-2xl border border-slate-100 bg-slate-50/50 text-simedik-dark font-semibold hover:bg-slate-100/50 transition-all duration-300 ease-out shadow-[0_2px_8px_rgb(0,0,0,0.04)] hover:-translate-y-0.5">
                        Batal
                    </a>
                    <button
                        type="submit"
                        class="flex-1 inline-flex items-center justify-center space-x-2 bg-simedik-primary text-white font-semibold tracking-wide rounded-2xl py-3.5 px-4 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Selesaikan Pemeriksaan</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Info Notes Card --}}
        <div class="mt-6 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/50 p-6 sm:p-8">
            <h4 class="text-simedik-dark font-bold text-sm mb-5">Informasi Penting</h4>
            <ul class="space-y-3.5">
                <li class="flex items-start space-x-3">
                    <div class="w-5 h-5 bg-simedik-light/40 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-simedik-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span class="text-slate-600 text-sm font-medium leading-relaxed">Pastikan obat yang dipilih sesuai dengan kondisi dan alergi pasien.</span>
                </li>
                <li class="flex items-start space-x-3">
                    <div class="w-5 h-5 bg-simedik-light/40 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-simedik-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span class="text-slate-600 text-sm font-medium leading-relaxed">Jumlah obat harus diisi untuk setiap obat yang dipilih.</span>
                </li>
                <li class="flex items-start space-x-3">
                    <div class="w-5 h-5 bg-simedik-light/40 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-simedik-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span class="text-slate-600 text-sm font-medium leading-relaxed">Resep akan dikirim otomatis kepada pasien setelah selesai.</span>
                </li>
                <li class="flex items-start space-x-3">
                    <div class="w-5 h-5 bg-simedik-light/40 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-simedik-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span class="text-slate-600 text-sm font-medium leading-relaxed">Pemeriksaan tidak bisa diubah setelah disimpan.</span>
                </li>
            </ul>
        </div>

    </div>

    <script>
        // Add Medicine Row Functionality
        document.getElementById('add-medicine-btn').addEventListener('click', function(e) {
            e.preventDefault();
            
            const container = document.getElementById('medicines-container');
            const firstRow = container.querySelector('.medicine-row');
            const newRow = firstRow.cloneNode(true);
            
            // Reset input values
            newRow.querySelector('select').value = '';
            newRow.querySelector('input[type="number"]').value = '';
            
            // Show remove button on new row
            const removeBtn = newRow.querySelector('.remove-medicine');
            removeBtn.classList.remove('hidden');
            removeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                newRow.remove();
            });
            
            // Show remove button on existing rows if there's more than one
            document.querySelectorAll('.medicine-row').forEach(row => {
                const removeBtn = row.querySelector('.remove-medicine');
                if (removeBtn) removeBtn.classList.remove('hidden');
            });
            
            container.appendChild(newRow);
        });

        // Show remove buttons if initially there are multiple rows
        const initialRows = document.querySelectorAll('.medicine-row');
        if (initialRows.length > 1) {
            initialRows.forEach(row => {
                const removeBtn = row.querySelector('.remove-medicine');
                if (removeBtn) removeBtn.classList.remove('hidden');
            });
        }

        // Remove button functionality for existing rows
        document.querySelectorAll('.remove-medicine').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                this.closest('.medicine-row').remove();
            });
        });
    </script>

</body>
</html>

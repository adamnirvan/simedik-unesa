<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIMEDIK Doctor - Pemeriksaan & Resep</title>

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
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
                <!-- Breadcrumb -->
                <div class="mb-8">
                    <div class="flex items-center space-x-2 text-sm">
                        <a href="{{ route('doctor.pasien') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">Jadwal Pemeriksaan</a>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-slate-600">Pemeriksaan & Resep</span>
                    </div>
                </div>

                <!-- Page Header -->
                <div class="mb-10">
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-2">Pemeriksaan & Resep</h1>
                    <p class="text-slate-600 text-base">Catat hasil pemeriksaan dan berikan resep obat kepada pasien</p>
                </div>

                <!-- Patient Info Card -->
                <div class="bg-gradient-to-br from-emerald-50 via-white to-teal-50 rounded-3xl border border-emerald-200 p-8 mb-8 shadow-sm">
                    <div class="flex items-start justify-between mb-6">
                        <h3 class="text-slate-900 font-bold text-lg">Data Pasien</h3>
                        <div class="bg-emerald-100 rounded-full p-3">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <!-- Nama Pasien -->
                        <div>
                            <p class="text-slate-600 text-sm font-semibold mb-3">Nama Pasien</p>
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0 text-lg">
                                    <span class="text-emerald-700 font-bold">{{ substr($appointment->patient->name, 0, 1) }}</span>
                                </div>
                                <p class="text-slate-900 font-bold text-xl">{{ $appointment->patient->name }}</p>
                            </div>
                        </div>

                        <!-- Waktu Pemeriksaan -->
                        <div>
                            <p class="text-slate-600 text-sm font-semibold mb-3">Waktu Pemeriksaan</p>
                            <div class="flex items-center space-x-3">
                                <div class="bg-blue-100 rounded-lg p-2.5">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-slate-900 font-semibold">{{ \Carbon\Carbon::parse($appointment->waktu_jadwal)->format('d M Y') }}</p>
                                    <p class="text-slate-600 text-sm">{{ \Carbon\Carbon::parse($appointment->waktu_jadwal)->format('H:i') }} WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Keluhan -->
                    <div class="mt-8 pt-8 border-t border-emerald-200">
                        <p class="text-slate-600 text-sm font-semibold mb-3">Keluhan Pasien</p>
                        <div class="bg-white rounded-2xl p-4 border border-slate-200">
                            <p class="text-slate-900 leading-relaxed text-base">{{ $appointment->keluhan }}</p>
                        </div>
                    </div>
                </div>

                <!-- Resep Form Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 sm:p-10">
                    <!-- Alert Info -->
                    <div class="mb-8 p-5 rounded-2xl bg-amber-50 border border-amber-100">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-amber-800 text-sm font-medium">
                                    Pilih obat yang sesuai dan tentukan jumlah sesuai kebutuhan pasien. Anda dapat menambahkan lebih dari satu jenis obat.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('doctor.store-resep', $appointment->id) }}" class="space-y-8">
                        @csrf

                        <!-- Medicines Section -->
                        <div>
                            <label class="block text-slate-900 font-bold text-lg mb-6">
                                Resep Obat
                                <span class="text-red-500">*</span>
                            </label>

                            <!-- Medicine Item Container -->
                            <div id="medicines-container" class="space-y-4">
                                <!-- Initial Medicine Row -->
                                <div class="medicine-row">
                                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                                        <!-- Medicine Dropdown -->
                                        <div class="sm:col-span-3">
                                            <select
                                                name="medicine_id[]"
                                                required
                                                class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-10 transition-all duration-200 appearance-none cursor-pointer"
                                                style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 20 20\" fill=\"%23475569\"><path fill-rule=\"evenodd\" d=\"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z\" clip-rule=\"evenodd\" /></svg>'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em; padding-right: 2.5rem;"
                                            >
                                                <option value="">Pilih Obat</option>
                                                @forelse($medicines as $med)
                                                    <option value="{{ $med->id }}">{{ $med->nama_obat }} ({{ $med->satuan }})</option>
                                                @empty
                                                    <option value="" disabled>Tidak ada obat tersedia</option>
                                                @endforelse
                                            </select>
                                        </div>

                                        <!-- Quantity Input -->
                                        <div class="sm:col-span-1">
                                            <input
                                                type="number"
                                                name="jumlah[]"
                                                min="1"
                                                placeholder="Qty"
                                                class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-10 transition-all duration-200"
                                            />
                                        </div>

                                        <!-- Remove Button -->
                                        <div class="sm:col-span-1 flex items-end">
                                            <button
                                                type="button"
                                                class="remove-medicine w-full px-4 py-3 rounded-2xl bg-red-50 hover:bg-red-100 text-red-600 font-semibold transition-all duration-200 border-2 border-red-200 hidden"
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

                            <!-- Add Medicine Button -->
                            <button
                                type="button"
                                id="add-medicine-btn"
                                class="mt-6 flex items-center space-x-2 px-6 py-3 rounded-2xl border-2 border-emerald-300 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold transition-all duration-200"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span>Tambah Obat</span>
                            </button>
                        </div>

                        <!-- Required Fields Note -->
                        <div class="pt-4">
                            <p class="text-slate-600 text-xs">
                                <span class="text-red-500 font-semibold">*</span> Minimal satu obat harus dipilih
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 pt-8 border-t border-slate-200">
                            <a href="{{ route('doctor.pasien') }}" class="flex-1 text-center py-3 px-4 rounded-2xl border-2 border-slate-200 text-slate-900 font-semibold hover:bg-slate-50 transition-all duration-200">
                                Batal
                            </a>
                            <button
                                type="submit"
                                class="flex-1 bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-2xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 flex items-center justify-center space-x-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Selesaikan Pemeriksaan</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Info Box -->
                <div class="mt-8 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h4 class="text-slate-900 font-bold text-sm mb-4">Informasi Penting</h4>
                    <ul class="space-y-3 text-slate-600 text-sm">
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Pastikan obat yang dipilih sesuai dengan kondisi dan alergi pasien.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Jumlah obat harus diisi untuk setiap obat yang dipilih.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Resep akan dikirim otomatis kepada pasien setelah selesai.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Pemeriksaan tidak bisa diubah setelah disimpan.</span>
                        </li>
                    </ul>
                </div>
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

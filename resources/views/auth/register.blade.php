<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIMEDIK - Daftar</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <!-- Register Container -->
        <div class="min-h-screen bg-slate-50 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8">
            <!-- Main Card -->
            <div class="w-full max-w-lg">
                <!-- Logo & Branding -->
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-14 h-14 bg-emerald-500 rounded-3xl flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-2xl">S</span>
                        </div>
                    </div>
                    <h1 class="text-3xl font-bold text-emerald-600 mb-2">SIMEDIK</h1>
                    <p class="text-slate-600 text-base">Daftar akun Pasien baru</p>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-3xl shadow-xl p-8 sm:p-10 border border-slate-100">
                    <!-- Session Status Alert -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-100">
                            <p class="text-red-600 text-sm font-medium">Pendaftaran gagal. Periksa kembali data Anda.</p>
                        </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-slate-900 font-semibold text-sm mb-3">
                                Nama Lengkap
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-10 transition-all duration-200"
                                placeholder="Nama lengkap Anda"
                            />
                            @error('name')
                                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-slate-900 font-semibold text-sm mb-3">
                                Email
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-10 transition-all duration-200"
                                placeholder="nama@email.com"
                            />
                            @error('email')
                                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-slate-900 font-semibold text-sm mb-3">
                                Password
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-10 transition-all duration-200"
                                placeholder="Minimal 8 karakter"
                            />
                            @error('password')
                                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-slate-900 font-semibold text-sm mb-3">
                                Konfirmasi Password
                            </label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-10 transition-all duration-200"
                                placeholder="Ulangi password Anda"
                            />
                            @error('password_confirmation')
                                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Terms Info -->
                        <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200">
                            <p class="text-slate-700 text-sm leading-relaxed">
                                Dengan mendaftar, Anda setuju dengan <span class="font-semibold text-slate-900">Syarat & Ketentuan</span> dan <span class="font-semibold text-slate-900">Kebijakan Privasi</span> SIMEDIK Klinik UNESA.
                            </p>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full mt-8 bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-2xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                        >
                            Daftar Sekarang
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="my-8 relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-3 bg-white text-slate-600">atau</span>
                        </div>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-slate-700 text-sm">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold transition-colors duration-200">
                                Masuk di sini
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Footer Info -->
                <div class="mt-8 text-center">
                    <p class="text-slate-600 text-xs">
                        Klinik UNESA © 2025 | Sistem Manajemen Medis Digital
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>

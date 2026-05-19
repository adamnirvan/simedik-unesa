<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIMEDIK - Daftar</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#FBFBFD]">
        <div class="min-h-screen bg-[#FBFBFD] flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8">
            <div class="w-full max-w-lg">
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('images/simedik_logo2.png') }}" alt="SIMEDIK UNESA" class="h-70 w-auto object-contain max-w-xs">
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-100/50 backdrop-blur-sm">
                    
                    <h1 class="text-2xl sm:text-3xl font-bold text-simedik-dark tracking-tight mb-8 text-center">Buat Akun Baru</h1>

                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-2xl bg-red-50/50 border border-red-100/70 backdrop-blur-sm">
                            <p class="text-red-700 text-sm font-medium">Pendaftaran gagal. Periksa kembali data Anda.</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="name" class="block text-simedik-dark font-semibold text-sm mb-2.5 tracking-tight">
                                Nama Lengkap
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                class="w-full px-4 py-3.5 rounded-2xl border border-slate-200/60 bg-slate-50/40 text-simedik-dark placeholder-slate-400 focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-1 focus:ring-simedik-primary/30 transition-all duration-300 ease-out"
                                placeholder="Nama lengkap Anda"
                            />
                            @error('name')
                                <p class="text-red-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-simedik-dark font-semibold text-sm mb-2.5 tracking-tight">
                                Email
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                class="w-full px-4 py-3.5 rounded-2xl border border-slate-200/60 bg-slate-50/40 text-simedik-dark placeholder-slate-400 focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-1 focus:ring-simedik-primary/30 transition-all duration-300 ease-out"
                                placeholder="nama@example.com"
                            />
                            @error('email')
                                <p class="text-red-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-simedik-dark font-semibold text-sm mb-2.5 tracking-tight">
                                Password
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                class="w-full px-4 py-3.5 rounded-2xl border border-slate-200/60 bg-slate-50/40 text-simedik-dark placeholder-slate-400 focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-1 focus:ring-simedik-primary/30 transition-all duration-300 ease-out"
                                placeholder="Minimal 8 karakter"
                            />
                            @error('password')
                                <p class="text-red-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-simedik-dark font-semibold text-sm mb-2.5 tracking-tight">
                                Konfirmasi Password
                            </label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                class="w-full px-4 py-3.5 rounded-2xl border border-slate-200/60 bg-slate-50/40 text-simedik-dark placeholder-slate-400 focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-1 focus:ring-simedik-primary/30 transition-all duration-300 ease-out"
                                placeholder="Ulangi password Anda"
                            />
                            @error('password_confirmation')
                                <p class="text-red-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-slate-50/50 rounded-2xl p-4 border border-slate-100/70 backdrop-blur-sm">
                            <p class="text-slate-600 text-sm leading-relaxed font-medium">
                                Dengan mendaftar, Anda setuju dengan <span class="text-simedik-dark font-semibold">Syarat & Ketentuan</span> dan <span class="text-simedik-dark font-semibold">Kebijakan Privasi</span> SIMEDIK.
                            </p>
                        </div>

                        <button
                            type="submit"
                            class="w-full mt-7 bg-simedik-primary text-white font-semibold tracking-wide rounded-2xl px-6 py-3.5 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95"
                        >
                            Daftar Sekarang
                        </button>
                    </form>

                    <div class="my-7 relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200/50"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-3 bg-white text-slate-500 font-medium text-xs tracking-wide">atau</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="text-slate-600 text-sm font-medium">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-simedik-primary hover:text-simedik-primary/80 font-semibold transition-colors duration-300 ease-out">
                                Masuk di sini
                            </a>
                        </p>
                    </div>
                </div>

                <div class="mt-10 text-center">
                    <p class="text-slate-400 text-xs font-medium tracking-wide">
                        Klinik UNESA © 2026 | Sistem Manajemen Medis Digital
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
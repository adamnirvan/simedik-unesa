<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIMEDIK - Lupa Password</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#FBFBFD]">
        <div class="min-h-screen bg-[#FBFBFD] flex items-center justify-center px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-md">


                {{-- Form Card --}}
                <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-100/50 backdrop-blur-sm">

                    <h1 class="text-2xl sm:text-3xl font-bold text-simedik-dark tracking-tight mb-3 text-center">Lupa Password?</h1>
                    <p class="text-slate-500 font-medium text-sm text-center mb-8 leading-relaxed">
                        Tidak masalah. Masukkan email Anda dan kami akan mengirimkan tautan untuk mereset password.
                    </p>

                    {{-- Session Status --}}
                    @if (session('status'))
                        <div class="mb-6 p-4 rounded-2xl bg-simedik-light/30 border border-simedik-primary/30 backdrop-blur-sm flex items-start space-x-3">
                            <div class="flex-shrink-0 bg-simedik-primary/20 rounded-xl p-1.5">
                                <svg class="w-4 h-4 text-simedik-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-simedik-dark text-sm font-semibold">{{ session('status') }}</p>
                        </div>
                    @endif

                    {{-- Error Alert --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-2xl bg-red-50/50 border border-red-100/70 backdrop-blur-sm">
                            <p class="text-red-700 text-sm font-medium">Terjadi kesalahan. Periksa kembali email Anda.</p>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-simedik-dark font-semibold text-sm mb-2.5 tracking-tight">
                                Alamat Email
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="email"
                                class="w-full px-4 py-3.5 rounded-2xl border border-slate-200/60 bg-slate-50/40 text-simedik-dark placeholder-slate-400 focus:outline-none focus:border-simedik-primary focus:bg-white focus:ring-1 focus:ring-simedik-primary/30 transition-all duration-300 ease-out"
                                placeholder="nama@example.com"
                            />
                            @error('email')
                                <p class="text-red-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <button
                            type="submit"
                            class="w-full mt-2 bg-simedik-primary text-white font-semibold tracking-wide rounded-2xl px-6 py-3.5 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-lg hover:brightness-105 active:scale-95"
                        >
                            Kirim Tautan Reset Password
                        </button>
                    </form>

                    {{-- Divider --}}
                    <div class="my-7 relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200/50"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-3 bg-white text-slate-500 font-medium text-xs tracking-wide">atau</span>
                        </div>
                    </div>

                    {{-- Back to Login --}}
                    <a href="{{ route('login') }}" class="w-full block text-center py-3.5 px-4 rounded-2xl border border-slate-200/60 text-simedik-dark font-semibold bg-white transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-md hover:border-simedik-primary/30">
                        Kembali ke Halaman Login
                    </a>
                </div>

                {{-- Footer --}}
                <div class="mt-10 text-center">
                    <p class="text-slate-400 text-xs font-medium tracking-wide">
                        Klinik UNESA © 2026 | Sistem Manajemen Medis Digital
                    </p>
                </div>

            </div>
        </div>
    </body>
</html>

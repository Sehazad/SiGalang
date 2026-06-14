@extends('layouts.app')

@section('title', 'Daftar - SIGALANG FC')

@section('content')
<div class="auth-page-wrapper bg-slate-950">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-[-10%] right-[-10%] w-96 h-96 rounded-full mix-blend-screen filter blur-3xl opacity-60 animate-pulse-soft" style="background:rgba(14,165,233,0.20);"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 rounded-full mix-blend-screen filter blur-3xl opacity-60 animate-pulse-soft" style="background:rgba(59,130,246,0.20);animation-delay:1.5s;"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="glass-dark rounded-3xl shadow-2xl overflow-hidden">

            {{-- Top Accent Bar --}}
            <div class="h-1 w-full gradient-brand"></div>

            <div class="p-8 sm:p-10 space-y-7">

                {{-- Header --}}
                <div class="text-center space-y-3">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl gradient-brand shadow-lg mb-2">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-extrabold text-white tracking-tight">Buat Akun</h1>
                    <p class="text-sm text-slate-400 font-medium">Daftar sekarang untuk booking lapangan futsal</p>
                </div>

                {{-- Errors --}}
                @if($errors->any())
                    <div class="animate-slide-down rounded-2xl px-5 py-4 text-sm space-y-1" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:#F87171;">
                        @foreach($errors->all() as $error)
                            <p class="flex items-center gap-2 font-medium">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ url('/register') }}" class="space-y-5">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="space-y-1.5">
                        <label for="name" style="color:#CBD5E1;font-size:0.8125rem;font-weight:700;margin-bottom:0.375rem;">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5" style="color:#64748B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap"
                                class="dark-input dark-input-icon"
                                required
                            />
                        </div>
                    </div>

                    {{-- No HP --}}
                    <div class="space-y-1.5">
                        <label for="no_hp" style="color:#CBD5E1;font-size:0.8125rem;font-weight:700;margin-bottom:0.375rem;">Nomor Handphone (WhatsApp)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5" style="color:#64748B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <input
                                type="text"
                                id="no_hp"
                                name="no_hp"
                                value="{{ old('no_hp') }}"
                                placeholder="08xxxxxxxxxx"
                                class="dark-input dark-input-icon"
                                required
                            />
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="space-y-1.5">
                        <label for="password" style="color:#CBD5E1;font-size:0.8125rem;font-weight:700;margin-bottom:0.375rem;">Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5" style="color:#64748B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Min. 8 karakter"
                                class="dark-input dark-input-icon"
                                required
                            />
                        </div>
                    </div>

                    {{-- Password Confirmation --}}
                    <div class="space-y-1.5">
                        <label for="password_confirmation" style="color:#CBD5E1;font-size:0.8125rem;font-weight:700;margin-bottom:0.375rem;">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5" style="color:#64748B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Ulangi kata sandi"
                                class="dark-input dark-input-icon"
                                required
                            />
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full flex items-center justify-center gap-2 py-4 px-4 rounded-2xl text-sm font-bold text-white gradient-brand focus:outline-none focus:ring-4 transition-all duration-300 shadow-brand transform hover:-translate-y-0.5 mt-2"
                        style="focus-ring-color:rgba(14,165,233,0.3);"
                    >
                        Daftar Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>

                {{-- Footer --}}
                <div class="pt-5 text-center" style="border-top:1px solid rgba(255,255,255,0.06);">
                    <p class="text-sm text-slate-400 font-medium">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-bold ml-1 hover:underline transition-colors" style="color:#0EA5E9;">Masuk di sini</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

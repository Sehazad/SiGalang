@extends('layouts.app')

@section('title', 'Masuk - SIGALANG FC')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-950 px-4 py-12 relative overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-brand/20 rounded-full mix-blend-screen filter blur-3xl opacity-60 animate-pulse-soft"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-blue-500/20 rounded-full mix-blend-screen filter blur-3xl opacity-60 animate-pulse-soft" style="animation-delay: 1.5s;"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="glass-dark rounded-3xl shadow-2xl p-8 sm:p-10 space-y-8">
            
            {{-- Header --}}
            <div class="text-center space-y-3">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-brand to-blue-600 shadow-lg mb-2">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-white tracking-tight">Selamat Datang</h1>
                <p class="text-sm text-slate-400 font-medium">Masuk untuk mulai booking lapangan futsal</p>
            </div>

            {{-- Errors --}}
            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl px-5 py-4 text-sm space-y-1 animate-slide-down">
                    @foreach($errors->all() as $error)
                        <p class="flex items-center gap-2 font-medium">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ url('/login') }}" class="space-y-6">
                @csrf

                <div class="space-y-5">
                    {{-- No HP --}}
                    <div class="space-y-2">
                        <label for="no_hp" class="block text-sm font-bold text-slate-300">Nomor Handphone (WhatsApp)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <input
                                type="text"
                                id="no_hp"
                                name="no_hp"
                                value="{{ old('no_hp') }}"
                                placeholder="08xxxxxxxxxx"
                                class="block w-full pl-11 pr-4 py-3.5 rounded-2xl border border-slate-800 bg-slate-900/50 focus:bg-slate-900 text-white placeholder-slate-500 focus:border-brand focus:ring-4 focus:ring-brand/10 transition-all duration-200"
                                required
                                autofocus
                            />
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-bold text-slate-300">Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                class="block w-full pl-11 pr-4 py-3.5 rounded-2xl border border-slate-800 bg-slate-900/50 focus:bg-slate-900 text-white placeholder-slate-500 focus:border-brand focus:ring-4 focus:ring-brand/10 transition-all duration-200"
                                required
                            />
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full flex items-center justify-center py-4 px-4 rounded-2xl text-sm font-bold text-white bg-gradient-to-r from-brand to-blue-600 hover:from-blue-600 hover:to-brand focus:outline-none focus:ring-4 focus:ring-brand/30 transition-all duration-300 shadow-brand transform hover:-translate-y-0.5"
                >
                    Masuk Sekarang
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>

            {{-- Footer --}}
            <div class="pt-6 text-center border-t border-slate-900">
                <p class="text-sm text-slate-400 font-medium">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-brand font-bold hover:text-blue-500 hover:underline transition-colors ml-1">Daftar sekarang</a>
                </p>
                <div class="mt-4 flex items-center justify-center gap-4 text-xs font-bold text-slate-500">
                    <a href="{{ route('admin.login') }}" class="hover:text-amber-500 transition-colors">Login Admin / Karyawan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

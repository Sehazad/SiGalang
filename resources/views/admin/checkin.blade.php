@extends('layouts.app')

@section('title', 'Check-In Tiket - Admin SIGALANG FC')

@section('content')
<div class="min-h-screen bg-slate-50 py-16 px-4 relative overflow-hidden flex items-center justify-center">
    {{-- Decorative Background Circles --}}
    <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-brand/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft" style="animation-delay: 1.5s;"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/50 p-8 sm:p-10 space-y-8">

            {{-- Icon & Title --}}
            <div class="text-center space-y-3">
                <div class="mx-auto w-16 h-16 rounded-2xl bg-gradient-to-br from-brand to-blue-600 flex items-center justify-center shadow-brand">
                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75ZM16.5 13.5h.75v.75h-.75v-.75Z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Check-In Tiket</h1>
                <p class="text-sm text-slate-500 font-medium leading-relaxed">Masukkan kode tiket secara manual untuk memvalidasi dan memproses kedatangan.</p>
            </div>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="rounded-2xl bg-emerald-50 border border-emerald-200 p-4 flex items-start gap-3 animate-slide-down shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p class="text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="rounded-2xl bg-red-50 border border-red-200 p-4 flex items-start gap-3 animate-slide-down shadow-sm">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    <p class="text-sm font-semibold text-red-800">{{ session('error') }}</p>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.checkin.process') }}" method="POST" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="qr_code" class="block text-sm font-bold text-slate-700">Kode Tiket</label>
                    <input type="text"
                           id="qr_code"
                           name="qr_code"
                           value="{{ old('qr_code') }}"
                           placeholder="TKT-XXXXXX"
                           required
                           autofocus
                           class="w-full px-4 py-4 border border-slate-200 rounded-2xl text-center font-mono text-xl tracking-widest uppercase placeholder:text-slate-300 placeholder:tracking-widest focus:outline-none focus:ring-4 focus:ring-brand/10 focus:border-brand transition bg-slate-50/50">
                    @error('qr_code')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full btn-primary py-4 rounded-2xl shadow-brand text-base font-bold flex items-center justify-center gap-2 transform hover:-translate-y-0.5 transition-all">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Proses Check-in
                </button>
            </form>

            {{-- Navigation back --}}
            <div class="text-center pt-2">
                <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-slate-500 hover:text-brand transition flex items-center justify-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Kembali ke Dashboard
                </a>
            </div>

        </div>
    </div>

</div>
@endsection

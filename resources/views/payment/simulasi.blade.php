@extends('layouts.app')

@section('title', 'Simulasi Pembayaran QRIS - SIGALANG FC')

@section('content')
<div class="min-h-screen bg-slate-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-brand/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft" style="animation-delay: 1.5s;"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl border border-white/50 p-8 sm:p-10 text-center space-y-6">

            {{-- QR Icon --}}
            <div class="mx-auto w-16 h-16 rounded-2xl flex items-center justify-center" style="background:rgba(14,165,233,0.10);box-shadow:0 4px 14px rgba(14,165,233,0.3);">
                <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z"/>
                </svg>
            </div>

            {{-- Title --}}
            <div class="space-y-1">
                <h1 class="text-xl font-extrabold text-[#0F172A] tracking-tight">Simulasi QRIS</h1>
                <p class="text-sm text-slate-500 font-medium">Scan kode QR di bawah untuk menyelesaikan pembayaran</p>
            </div>

            {{-- Divider --}}
            <div class="h-px bg-slate-100 w-full"></div>

            {{-- Dummy QRIS Image Container --}}
            <div class="mx-auto inline-flex rounded-3xl border-2 border-dashed border-slate-200 p-4 bg-slate-50/50 shadow-inner">
                <img
                    src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=DUMMY-QRIS-SIGALANGFC"
                    alt="QRIS Code"
                    class="w-48 h-48 rounded-2xl"
                />
            </div>

            {{-- Total Display --}}
            <div class="rounded-2xl p-5" style="background:rgba(14,165,233,0.05);border:1px solid rgba(14,165,233,0.10);">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Total Pembayaran</p>
                <p class="text-3xl font-black text-brand">Rp {{ number_format($total, 0, ',', '.') }}</p>
            </div>

            {{-- Form --}}
            <form action="{{ route('payment.process') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="total" value="{{ $total }}">

                <button
                    type="submit"
                    class="w-full btn-primary py-4 rounded-2xl text-base font-bold shadow-brand flex items-center justify-center gap-2 transform hover:-translate-y-0.5"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Selesai Bayar (Simulasi)
                </button>
            </form>

            {{-- Footer Note --}}
            <p class="text-xs text-slate-400 font-semibold leading-relaxed">Ini adalah simulasi sandbox pembayaran.<br>Tidak ada dana nyata yang akan dipotong.</p>
        </div>
    </div>

</div>
@endsection

@extends('layouts.app')

@section('title', 'E-Tiket SIGALANG FC')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-brand/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft" style="animation-delay: 1.5s;"></div>

    {{-- Success Flash Message --}}
    @if(session('success'))
        <div class="max-w-lg mx-auto mb-6 relative z-10">
            <div class="rounded-2xl bg-emerald-50 border border-emerald-200 p-4 flex items-center gap-3 shadow-sm animate-slide-down">
                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <p class="text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- Ticket Container --}}
    <div class="max-w-lg mx-auto relative z-10">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden ticket-perforated">

            {{-- Dark Header --}}
            <div class="gradient-dark px-6 py-8 text-center text-white relative">
                <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center mx-auto mb-3 shadow-inner">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                </div>
                <h1 class="text-xl font-extrabold tracking-wide">E-TIKET RESMI</h1>
                <p class="text-xs text-slate-400 font-bold mt-1 uppercase tracking-widest">SIGALANG FC · Futsal Cikoneng</p>
            </div>

            {{-- Info Section --}}
            <div class="px-6 py-6 space-y-6">
                <div class="space-y-4">
                    {{-- Kode Tiket --}}
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-sm font-bold text-slate-500">Kode Tiket</span>
                        <span class="text-xs font-mono bg-slate-100 text-slate-800 px-3 py-1 rounded-lg font-bold tracking-wider border border-slate-200">{{ $tiket->qr_code }}</span>
                    </div>

                    {{-- Jenis Transaksi --}}
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-sm font-bold text-slate-500">Kategori</span>
                        @php $type = $tiket->type; @endphp
                        <span class="badge {{ $type === 'turnamen' ? 'status-paid' : 'bg-purple-100 text-purple-700 border-purple-200' }}">
                            @if($type === 'turnamen')
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-4.5A3.375 3.375 0 0012.75 10.5h-1.5A3.375 3.375 0 007.875 13.875v4.875m4.125-12a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z"/></svg>
                                Turnamen
                            @else
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                Booking Lapangan
                            @endif
                        </span>
                    </div>

                    {{-- Tanggal Terbit --}}
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-sm font-bold text-slate-500">Tanggal Terbit</span>
                        <span class="text-sm font-extrabold text-slate-800">{{ $tiket->created_at->format('d M Y, H:i') }} WIB</span>
                    </div>

                    {{-- Total --}}
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-sm font-bold text-slate-500">Total Bayar</span>
                        <span class="text-base font-black text-brand">Rp {{ number_format($tiket->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Dashed Divider --}}
                <div class="relative py-2">
                    <div class="border-t-2 border-dashed border-slate-200"></div>
                </div>

                {{-- QR Code Section --}}
                <div class="text-center space-y-5">
                    <div class="inline-flex rounded-3xl border border-slate-200 p-4 bg-white shadow-md shadow-slate-100">
                        {!! QrCode::size(180)->generate($tiket->qr_code) !!}
                    </div>

                    {{-- Status Badge --}}
                    @if(!$tiket->used)
                        <div class="flex flex-col items-center gap-2">
                            <span class="badge status-paid px-6 py-2 text-xs font-bold uppercase tracking-wider">
                                <span class="relative flex h-2 w-2 mr-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-500 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-600"></span>
                                </span>
                                Tiket Aktif / Berlaku
                            </span>
                            <p class="text-[11px] text-slate-400 font-semibold leading-relaxed">Tunjukkan kode QR ini kepada petugas kasir untuk dipindai saat check-in</p>
                        </div>
                    @else
                        <div class="flex flex-col items-center gap-2">
                            <span class="badge bg-slate-100 text-slate-500 border-slate-200 px-6 py-2 text-xs font-bold uppercase tracking-wider">
                                Sudah Digunakan
                            </span>
                            <p class="text-[11px] text-slate-400 font-semibold leading-relaxed">Tiket ini telah divalidasi dan digunakan pada {{ $tiket->updated_at->format('d M Y, H:i') }} WIB</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-8 flex items-center justify-between no-print">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-brand transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Kembali ke Beranda
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-50 hover:text-dark transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/></svg>
                Cetak Tiket
            </button>
        </div>
    </div>

</div>
@endsection

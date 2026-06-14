@extends('layouts.app')

@section('title', 'Tiket Saya - SIGALANG FC')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-brand/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft" style="animation-delay: 1.5s;"></div>

    <div class="max-w-5xl mx-auto space-y-8 relative z-10">
        {{-- Page Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white/80 backdrop-blur-xl p-6 sm:p-8 rounded-3xl shadow-sm border border-slate-100">
            <div>
                <h1 class="text-3xl font-black text-[#0F172A] tracking-tight">Tiket Saya</h1>
                <p class="text-sm text-slate-500 font-semibold mt-1">Daftar semua tiket aktif dan riwayat pemesanan Anda di SIGALANG FC.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('booking.create') }}" class="inline-flex items-center gap-2 btn-primary px-5 py-3 rounded-2xl text-sm font-extrabold text-white shadow-brand transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Booking Baru
                </a>
            </div>
        </div>

        {{-- Ticket List --}}
        @if($tikets->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($tikets as $tiket)
                    @php
                        $type = $tiket->type;
                        $total = $tiket->total;
                        $used = $tiket->used;
                    @endphp
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                        
                        {{-- Top Part --}}
                        <div class="p-6 space-y-4">
                            {{-- Header Card --}}
                            <div class="flex items-center justify-between border-b border-slate-50 pb-3">
                                <span class="text-xs font-mono font-bold bg-slate-100 text-slate-600 px-2.5 py-1 rounded-lg border border-slate-200">
                                    {{ $tiket->qr_code }}
                                </span>
                                <span class="badge {{ $type === 'turnamen' ? 'status-paid' : 'bg-purple-100 text-purple-700 border-purple-200' }}">
                                    @if($type === 'turnamen')
                                        Turnamen
                                    @else
                                        Booking Lapangan
                                    @endif
                                </span>
                            </div>

                            {{-- Info Details --}}
                            <div class="space-y-3">
                                @if($type === 'booking' && $tiket->pembayaran?->booking)
                                    @php $booking = $tiket->pembayaran->booking; @endphp
                                    <div class="flex items-start gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 border border-slate-200">
                                            <svg class="w-4.5 h-4.5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 13.5a3 3 0 100-6 3 3 0 000 6z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tempat & Lapangan</p>
                                            <p class="text-sm font-extrabold text-[#0F172A] mt-0.5">{{ $booking->lapangan->nama_lapangan }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 border border-slate-200">
                                            <svg class="w-[18px] h-[18px] text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tanggal & Waktu Main</p>
                                            <p class="text-sm font-extrabold text-[#0F172A] mt-0.5">
                                                {{ \Carbon\Carbon::parse($booking->tanggal_main)->format('d M Y') }}
                                                <span class="text-slate-400 ml-1.5">•</span>
                                                <span class="text-brand ml-1.5 font-bold">{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }} WIB</span>
                                            </p>
                                        </div>
                                    </div>
                                @elseif($type === 'turnamen' && $tiket->pembayaran?->turnamen)
                                    @php $turnamen = $tiket->pembayaran->turnamen; @endphp
                                    <div class="flex items-start gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 border border-slate-200">
                                            <svg class="w-4.5 h-4.5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M18.75 4.236c.982.143 1.954.317 2.916.52A6.003 6.003 0 0016.27 9.728M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nama Turnamen</p>
                                            <p class="text-sm font-extrabold text-[#0F172A] mt-0.5">{{ $turnamen->nama_turnamen }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 border border-slate-200">
                                            <svg class="w-4.5 h-4.5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Format & Jumlah Tim</p>
                                            <p class="text-sm font-extrabold text-[#0F172A] mt-0.5">{{ $turnamen->jumlah_tim }} Tim Terdaftar</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Bottom Part --}}
                        <div class="p-6 border-t border-slate-50 bg-slate-50/50 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Status Check-in</p>
                                @if(!$used)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-wider mt-1 border border-emerald-200">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-500 text-xs font-bold uppercase tracking-wider mt-1 border border-slate-300">
                                        Digunakan
                                    </span>
                                @endif
                            </div>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('tiket.show', $tiket->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 bg-white hover:bg-slate-50 transition shadow-sm group-hover:border-slate-300">
                                    Lihat E-Tiket
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-16 text-center max-w-2xl mx-auto space-y-5">
                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100 mx-auto shadow-inner">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-3.375-12h.008v.008H13.125V6zm-3 0h.008v.008H10.125V6zm-3 0h.008v.008H7.125V6zm3.375 6h.008v.008H13.125V12zm-3 0h.008v.008H10.125V12zm-3 0h.008v.008H7.125V12zm3.375 6h.008v.008H13.125V18zm-3 0h.008v.008H10.125V18zm-3 0h.008v.008H7.125V18zm-3-12h.008v.008H4.125V6zm0 6h.008v.008H4.125V12zm0 6h.008v.008H4.125V18z"/>
                    </svg>
                </div>
                <div class="space-y-2">
                    <h3 class="text-xl font-bold text-[#0F172A]">Belum Ada Tiket</h3>
                    <p class="text-slate-500 text-sm max-w-sm mx-auto font-medium">Anda belum melakukan booking lapangan atau mendaftar turnamen apa pun saat ini.</p>
                </div>
                <div class="pt-2">
                    <a href="{{ route('booking.create') }}" class="inline-flex items-center gap-2 btn-primary px-6 py-3.5 rounded-2xl text-sm font-extrabold text-white shadow-brand">
                        Booking Sekarang
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

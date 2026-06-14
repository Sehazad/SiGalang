@extends('layouts.app')

@section('title', 'Kelola Turnamen - Admin SIGALANG FC')

@section('content')
<div class="min-h-screen bg-slate-50 py-10 px-4 relative overflow-hidden">
    {{-- Decorative Background Circles --}}
    <div class="absolute top-[-5%] right-[-5%] w-96 h-96 bg-brand/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft"></div>
    <div class="absolute bottom-[-5%] left-[-5%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft" style="animation-delay: 1.5s;"></div>

    <div class="max-w-7xl mx-auto space-y-8 relative z-10">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-sm border border-white/50">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-brand to-blue-600 text-white rounded-2xl flex items-center justify-center shrink-0 shadow-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M18.75 4.236c.982.143 1.954.317 2.916.52A6.003 6.003 0 0016.27 9.728M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228m0 0a6.023 6.023 0 01-2.27.308 6.023 6.023 0 01-2.27-.308"/></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Kelola Turnamen</h1>
                    <p class="text-slate-500 text-sm mt-0.5 font-medium">Daftar pengajuan turnamen, validasi status, dan generate bracket.</p>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-700 hover:bg-slate-50 hover:text-[#0F172A] font-bold transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Dashboard
            </a>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl px-5 py-4 text-sm font-semibold animate-slide-down shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-2xl px-5 py-4 text-sm font-semibold animate-slide-down shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Table Card --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-modern text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                            <th class="px-6 py-5">Turnamen</th>
                            <th class="px-6 py-5">Penyelenggara</th>
                            <th class="px-6 py-5">Status Pembayaran</th>
                            <th class="px-6 py-5">Status Bracket</th>
                            <th class="px-6 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($turnamens as $t)
                            @php
                                $paid = $t->pembayarans->where('status_bayar', 'success')->first();
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-5">
                                    <div class="font-extrabold text-[#0F172A]">{{ $t->nama_turnamen }}</div>
                                    <div class="text-xs text-slate-400 font-semibold mt-0.5">{{ $t->created_at->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-sm font-bold text-slate-700">{{ $t->user->name }}</div>
                                </td>
                                <td class="px-6 py-5">
                                    @if($paid)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Lunas
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-xs font-bold uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5 animate-pulse"></span>
                                            Belum Bayar
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-5">
                                    @if($t->status_pengajuan === 'approved')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-xs font-bold uppercase tracking-wider">
                                            Generated
                                        </span>
                                    @elseif($t->status_pengajuan === 'rejected')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 border border-red-200 text-red-700 text-xs font-bold uppercase tracking-wider">
                                            Ditolak/Batal
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-50 border border-slate-200 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($t->status_pengajuan === 'approved')
                                            <a href="{{ route('turnamen.bagan', $t->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand hover:underline">
                                                Lihat Bagan
                                            </a>
                                        @elseif($t->status_pengajuan === 'rejected')
                                            <span class="text-xs text-slate-400 font-medium italic">Tidak Ada Aksi</span>
                                        @else
                                            @if($paid)
                                                <form action="{{ route('admin.turnamen.generate', $t->id) }}" method="POST" onsubmit="return confirm('Generate bracket acak sekarang?');" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3.5 py-2 bg-slate-900 text-white text-xs font-extrabold rounded-xl hover:bg-black transition-all shadow-sm transform hover:-translate-y-0.5">
                                                        Generate Bracket
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.turnamen.reject', $t->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak turnamen ini?');" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3.5 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-extrabold rounded-xl transition-all shadow-sm transform hover:-translate-y-0.5">
                                                        Tolak
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.turnamen.confirm_payment', $t->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengonfirmasi pembayaran turnamen ini secara manual?');" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-extrabold rounded-xl transition-all shadow-sm transform hover:-translate-y-0.5">
                                                        ACC Bayar
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.turnamen.reject', $t->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak turnamen ini?');" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-extrabold rounded-xl transition-all shadow-sm transform hover:-translate-y-0.5">
                                                        Tolak
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-slate-400 font-medium">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100">
                                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872"/></svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-600">Belum ada pengajuan turnamen</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

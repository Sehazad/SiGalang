@extends('layouts.app')

@section('title', 'Kelola Booking - Admin SIGALANG FC')

@section('content')
<div class="min-h-screen bg-slate-50 py-10 px-4 relative overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-[-5%] right-[-5%] w-96 h-96 bg-brand/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft"></div>
    <div class="absolute bottom-[-5%] left-[-5%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft" style="animation-delay: 1s;"></div>

    <div class="max-w-7xl mx-auto space-y-8 relative z-10">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-sm border border-white/50">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-brand/10 text-brand rounded-2xl flex items-center justify-center shrink-0 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Kelola Booking</h1>
                    <p class="text-slate-500 text-sm mt-0.5 font-medium">Konfirmasi, pantau, dan kelola semua pemesanan lapangan</p>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-700 hover:bg-slate-50 hover:text-[#0F172A] font-bold transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Dashboard
            </a>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl px-5 py-4 text-sm animate-slide-down shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 rounded-2xl px-5 py-4 text-sm animate-slide-down shadow-sm">
                <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="font-semibold">{{ session('error') }}</p>
            </div>
        @endif

        {{-- Filter Tabs --}}
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-white/50 p-2 flex gap-2 flex-wrap sm:flex-nowrap overflow-x-auto">
            @foreach(['all' => 'Semua', 'pending' => 'Pending', 'paid' => 'Dikonfirmasi', 'cancelled' => 'Dibatalkan'] as $key => $label)
                <a
                    href="{{ route('admin.bookings.index', ['status' => $key]) }}"
                    class="flex-1 min-w-[120px] text-center text-sm font-bold px-4 py-3 rounded-xl transition-all duration-200 {{ $status === $key ? 'bg-brand text-white shadow-brand' : 'text-slate-500 hover:bg-slate-100/80 hover:text-slate-700' }}"
                >
                    {{ $label }}
                    @if($key !== 'all')
                        <span class="ml-1.5 px-2 py-0.5 rounded-md text-xs {{ $status === $key ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">
                            {{ \App\Models\Booking::where('status_booking', $key)->count() }}
                        </span>
                    @endif
                </a>
            @endforeach
        </div>

        {{-- Table Container --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            @if($bookings->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full table-modern text-sm">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-100">
                                <th class="text-left px-6 py-5 font-bold text-slate-400 text-xs uppercase tracking-wider">#ID</th>
                                <th class="text-left px-6 py-5 font-bold text-slate-400 text-xs uppercase tracking-wider">Pelanggan</th>
                                <th class="text-left px-6 py-5 font-bold text-slate-400 text-xs uppercase tracking-wider">Lapangan</th>
                                <th class="text-left px-6 py-5 font-bold text-slate-400 text-xs uppercase tracking-wider">Waktu Bermain</th>
                                <th class="text-left px-6 py-5 font-bold text-slate-400 text-xs uppercase tracking-wider">Total</th>
                                <th class="text-left px-6 py-5 font-bold text-slate-400 text-xs uppercase tracking-wider">Status</th>
                                <th class="text-center px-6 py-5 font-bold text-slate-400 text-xs uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($bookings as $booking)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-5 text-slate-400 font-mono text-xs font-semibold">
                                    <span class="bg-slate-50 border border-slate-100 px-2.5 py-1 rounded-lg">#{{ $booking->id }}</span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-brand/10 text-brand flex items-center justify-center font-bold text-xs uppercase shrink-0">
                                            {{ substr($booking->user->name ?? '?', 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-[#0F172A]">{{ $booking->user->name ?? '–' }}</p>
                                            <p class="text-xs text-slate-500 font-medium">{{ $booking->user->no_hp ?? '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-1.5 font-bold text-[#0F172A]">
                                        <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                        {{ $booking->lapangan->nama_lapangan ?? '–' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="space-y-1">
                                        <p class="font-bold text-[#0F172A]">{{ \Carbon\Carbon::parse($booking->tanggal_main)->translatedFormat('d M Y') }}</p>
                                        <div class="inline-flex items-center gap-1 bg-slate-50 border border-slate-100 px-2 py-0.5 rounded text-xs font-semibold text-slate-600">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="font-extrabold text-brand">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-5">
                                    @php
                                        $statusClass = $booking->status_booking === 'pending'
                                            ? 'status-pending'
                                            : ($booking->status_booking === 'paid' ? 'status-paid' : 'status-cancelled');
                                        $statusLabel = $booking->status_booking === 'pending'
                                            ? 'Pending'
                                            : ($booking->status_booking === 'paid' ? 'Dikonfirmasi' : 'Dibatalkan');
                                    @endphp
                                    <span class="badge {{ $statusClass }}">
                                        @if($booking->status_booking === 'pending')
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600 mr-1.5 animate-pulse"></span>
                                        @elseif($booking->status_booking === 'paid')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        @endif
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        @if($booking->status_booking === 'pending')
                                            {{-- Konfirmasi --}}
                                            <form method="POST" action="{{ route('admin.bookings.confirm', $booking->id) }}" class="inline" onsubmit="return confirm('Konfirmasi booking #{{ $booking->id }}?')">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold text-white bg-emerald-500 hover:bg-emerald-600 rounded-xl transition shadow-sm transform hover:-translate-y-0.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                    ACC
                                                </button>
                                            </form>
                                            {{-- Batalkan --}}
                                            <form method="POST" action="{{ route('admin.bookings.cancel', $booking->id) }}" class="inline" onsubmit="return confirm('Batalkan booking #{{ $booking->id }}?')">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold text-white bg-red-500 hover:bg-red-600 rounded-xl transition shadow-sm transform hover:-translate-y-0.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                                    Tolak
                                                </button>
                                            </form>
                                        @elseif($booking->status_booking === 'paid')
                                            {{-- Bisa batalkan meski sudah paid --}}
                                            <form method="POST" action="{{ route('admin.bookings.cancel', $booking->id) }}" onsubmit="return confirm('Yakin batalkan booking yang sudah dikonfirmasi?')">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition">
                                                    Batalkan
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-slate-400 font-medium px-4 py-2 bg-slate-50 border border-slate-100 rounded-xl">–</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($bookings->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                        {{ $bookings->links() }}
                    </div>
                @endif
            @else
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mb-5 border border-slate-100 shadow-sm">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-slate-950 font-extrabold text-lg">Tidak ada booking ditemukan</p>
                    <p class="text-slate-500 text-sm mt-1 max-w-sm">
                        @if($status !== 'all') Tidak ada booking dengan status <span class="font-bold">"{{ $status }}"</span> @else Belum ada riwayat booking lapangan sama sekali. @endif
                    </p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

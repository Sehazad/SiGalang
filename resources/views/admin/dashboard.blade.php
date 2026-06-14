@extends('layouts.app')

@section('title', 'Dashboard Admin — SIGALANG FC')

@section('content')
<div class="min-h-screen bg-slate-50">

    {{-- ========== PAGE HEADER ========== --}}
    <div class="gradient-dark border-b border-white/6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl gradient-brand flex items-center justify-center shadow-brand">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-black text-white tracking-tight">Dashboard Admin</h1>
                        <p class="text-slate-400 text-sm mt-0.5">
                            Selamat datang, <span class="font-semibold text-white">{{ Auth::user()->name }}</span>
                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/20 text-amber-400 uppercase tracking-wide border border-amber-500/25">{{ Auth::user()->role }}</span>
                        </p>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="flex items-center gap-2 flex-wrap">
                    <a href="{{ route('admin.bookings.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 gradient-brand text-white text-sm font-bold rounded-xl transition shadow-brand">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Kelola Booking
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/10 border border-white/15 text-white text-sm font-bold rounded-xl hover:bg-white/15 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Pengguna
                    </a>
                    <a href="{{ route('admin.checkin') }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/10 border border-white/15 text-white text-sm font-bold rounded-xl hover:bg-white/15 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5z"/></svg>
                        Check-in
                    </a>
                    <a href="{{ route('admin.turnamen.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/10 border border-white/15 text-white text-sm font-bold rounded-xl hover:bg-white/15 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3"/></svg>
                        Turnamen
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-500/15 border border-red-500/25 text-red-400 text-sm font-bold rounded-xl hover:bg-red-500/25 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        {{-- ========== STATS GRID ========== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            {{-- Total Booking --}}
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Total Booking</p>
                        <p class="text-4xl font-black text-dark tabular-nums">{{ $totalBooking }}</p>
                        <p class="text-xs text-slate-400 mt-2 font-medium">Semua waktu</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl gradient-brand flex items-center justify-center shadow-brand">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Pending --}}
            <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}"
               class="stat-card block hover:border-amber-300 group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Menunggu ACC</p>
                        <p class="text-4xl font-black text-dark tabular-nums">{{ $pendingBooking }}</p>
                        @if($pendingBooking > 0)
                            <p class="text-xs text-amber-500 mt-2 font-bold flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                Perlu tindakan
                            </p>
                        @else
                            <p class="text-xs text-slate-400 mt-2 font-medium">Tidak ada antrian</p>
                        @endif
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </a>

            {{-- Dikonfirmasi --}}
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Dikonfirmasi</p>
                        <p class="text-4xl font-black text-dark tabular-nums">{{ $paidBooking }}</p>
                        <p class="text-xs text-emerald-500 mt-2 font-medium">Booking aktif</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Turnamen --}}
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Total Turnamen</p>
                        <p class="text-4xl font-black text-dark tabular-nums">{{ \App\Models\Turnamen::count() }}</p>
                        <p class="text-xs text-slate-400 mt-2 font-medium">Terdaftar</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========== QUICK NAVIGATION CARDS ========== --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach([
                [route('admin.bookings.index'), 'Kelola Booking', 'Konfirmasi & pantau booking', 'from-brand to-sky-500', 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                [route('admin.users.index'), 'Kelola Pengguna', 'Manajemen akun user', 'from-purple-500 to-indigo-600', 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952'],
                [route('admin.checkin'), 'Scanner Check-in', 'Verifikasi tiket masuk', 'from-emerald-500 to-teal-600', 'M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5'],
                [route('admin.turnamen.index'), 'Kelola Turnamen', 'Generate bracket otomatis', 'from-amber-500 to-orange-500', 'M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3'],
            ] as [$url, $title, $desc, $grad, $icon])
                <a href="{{ $url }}" class="bg-white border border-slate-200 rounded-2xl p-5 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $grad }} flex items-center justify-center mb-4 shadow-md group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-dark">{{ $title }}</p>
                    <p class="text-xs text-slate-400 mt-1 font-medium">{{ $desc }}</p>
                </a>
            @endforeach
        </div>

        {{-- ========== RECENT BOOKINGS ========== --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg gradient-brand flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="font-black text-dark text-base">Booking Terbaru</h2>
                </div>
                <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}"
                   class="text-xs font-bold text-brand hover:text-brand-dark transition-colors flex items-center gap-1">
                    Lihat Perlu ACC
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
            @php $recentBookings = \App\Models\Booking::with(['user','lapangan'])->latest()->take(6)->get(); @endphp
            @if($recentBookings->count())
                <div class="divide-y divide-slate-50">
                    @foreach($recentBookings as $b)
                    <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-10 h-10 rounded-xl gradient-brand flex items-center justify-center text-white font-black text-xs shrink-0 shadow-brand">
                                #{{ $b->id }}
                            </div>
                            <div class="min-w-0">
                                <p class="font-bold text-sm text-dark truncate">{{ $b->user->name ?? '–' }}</p>
                                <p class="text-xs text-slate-400 truncate font-medium">
                                    {{ $b->lapangan->nama_lapangan ?? '–' }}
                                    · {{ \Carbon\Carbon::parse($b->tanggal_main)->format('d M') }}
                                    {{ \Carbon\Carbon::parse($b->jam_mulai)->format('H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <span class="text-sm font-black text-dark tabular-nums">Rp {{ number_format($b->total_harga, 0, ',', '.') }}</span>
                            @php
                                $cfg = [
                                    'pending'   => 'status-pending',
                                    'paid'      => 'status-paid',
                                    'cancelled' => 'status-cancelled',
                                ];
                                $lbl = ['pending'=>'Pending','paid'=>'Confirmed','cancelled'=>'Cancelled'];
                            @endphp
                            <span class="badge {{ $cfg[$b->status_booking] ?? 'bg-slate-100 text-slate-600' }}">
                                @if($b->status_booking === 'pending')
                                    <span class="w-1.5 h-1.5 bg-current rounded-full mr-1 animate-pulse"></span>
                                @endif
                                {{ $lbl[$b->status_booking] ?? $b->status_booking }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="px-6 py-16 text-center">
                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-slate-400 font-medium text-sm">Belum ada booking masuk.</p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

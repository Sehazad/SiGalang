@extends('layouts.app')

@section('title', 'Kelola Tanggal Libur — SIGALANG FC')

@section('content')
<div class="min-h-screen bg-slate-50">

    {{-- ========== PAGE HEADER ========== --}}
    <div class="gradient-dark border-b border-white/6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl gradient-brand flex items-center justify-center shadow-brand">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-black text-white tracking-tight">Kelola Tanggal Libur</h1>
                        <p class="text-slate-400 text-sm mt-0.5">Atur tanggal arena tutup. Pada tanggal libur, user tidak bisa booking.</p>
                    </div>
                </div>
                <a href="{{ route('admin.dashboard') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/10 border border-white/15 text-white text-sm font-bold rounded-xl hover:bg-white/15 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

        {{-- Flash --}}
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl px-5 py-4 text-sm flex items-center gap-3 font-semibold">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-2xl px-5 py-4 text-sm flex items-center gap-3 font-semibold">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-2xl px-5 py-4 text-sm font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ===== Tambah Tanggal Libur ===== --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-5">
                    <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                        <div class="w-10 h-10 rounded-xl bg-brand/10 text-brand flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <h2 class="text-lg font-extrabold text-dark">Tambah Libur</h2>
                    </div>

                    <form method="POST" action="{{ route('admin.libur.store') }}" class="space-y-4">
                        @csrf
                        <div class="space-y-2">
                            <label for="tanggal" class="block text-sm font-bold text-slate-700">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" min="{{ date('Y-m-d') }}"
                                   value="{{ old('tanggal') }}" required
                                   class="w-full rounded-2xl border-slate-200 px-4 py-3 text-dark focus:border-brand focus:ring-4 focus:ring-brand/10 transition" />
                        </div>
                        <div class="space-y-2">
                            <label for="keterangan" class="block text-sm font-bold text-slate-700">Keterangan <span class="text-slate-400 font-medium">(opsional)</span></label>
                            <input type="text" id="keterangan" name="keterangan" maxlength="255"
                                   value="{{ old('keterangan') }}" placeholder="cth: Hari Raya Idul Fitri"
                                   class="w-full rounded-2xl border-slate-200 px-4 py-3 text-dark focus:border-brand focus:ring-4 focus:ring-brand/10 transition" />
                        </div>
                        <button type="submit" class="btn-primary w-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Tandai Libur
                        </button>
                    </form>
                </div>
            </div>

            {{-- ===== Daftar Tanggal Libur ===== --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="font-black text-dark text-base">Daftar Tanggal Libur</h2>
                        <span class="text-xs font-bold bg-slate-100 text-slate-500 px-2.5 py-1 rounded-full">{{ $liburs->count() }} tanggal</span>
                    </div>

                    @if($liburs->count())
                        <div class="divide-y divide-slate-50">
                            @foreach($liburs as $libur)
                                @php $isPast = \Carbon\Carbon::parse($libur->tanggal)->isPast() && !\Carbon\Carbon::parse($libur->tanggal)->isToday(); @endphp
                                <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-slate-50 transition-colors {{ $isPast ? 'opacity-50' : '' }}">
                                    <div class="flex items-center gap-4 min-w-0">
                                        <div class="w-12 h-12 rounded-xl bg-red-50 border border-red-100 flex flex-col items-center justify-center shrink-0 leading-none">
                                            <span class="text-[10px] font-bold text-red-400 uppercase">{{ \Carbon\Carbon::parse($libur->tanggal)->translatedFormat('M') }}</span>
                                            <span class="text-lg font-black text-red-600">{{ \Carbon\Carbon::parse($libur->tanggal)->format('d') }}</span>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-bold text-sm text-dark truncate">{{ \Carbon\Carbon::parse($libur->tanggal)->translatedFormat('l, d F Y') }}</p>
                                            <p class="text-xs text-slate-400 truncate font-medium">{{ $libur->keterangan ?? 'Hari Libur' }}</p>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('admin.libur.delete', $libur->id) }}"
                                          onsubmit="return confirm('Hapus tanggal libur ini? User akan bisa booking lagi pada tanggal tersebut.');">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-2 bg-red-50 text-red-600 text-xs font-bold rounded-xl hover:bg-red-100 transition shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="px-6 py-16 text-center">
                            <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25"/></svg>
                            </div>
                            <p class="text-slate-400 font-medium text-sm">Belum ada tanggal libur. Semua hari terbuka untuk booking.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

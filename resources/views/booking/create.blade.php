@extends('layouts.app')

@section('title', 'Booking Lapangan - SIGALANG FC')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 px-4 relative overflow-hidden" x-data="bookingForm()">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-[-5%] left-[-5%] w-96 h-96 bg-brand/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft"></div>
    <div class="absolute bottom-[-5%] right-[-5%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft" style="animation-delay: 1.5s;"></div>

    <div class="max-w-4xl mx-auto space-y-8 relative z-10">

        {{-- Page Title --}}
        <div class="text-center space-y-2">
            <h1 class="text-3xl font-extrabold text-[#0F172A] tracking-tight">Booking Lapangan</h1>
            <p class="text-sm text-slate-500 font-medium leading-relaxed">Pilih lapangan terbaik, jadwalkan waktu bermain, dan nikmati pertandingan futsal premium Anda</p>
        </div>

        {{-- Error --}}
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-2xl px-5 py-4 text-sm flex items-start gap-3 animate-slide-down shadow-sm">
                <svg class="w-5 h-5 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="font-semibold">{{ session('error') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('booking.store') }}" class="space-y-8">
            @csrf

            {{-- Section 1: Pilih Lapangan --}}
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/50 p-6 sm:p-8 space-y-6">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                    <div class="w-10 h-10 rounded-xl bg-brand/10 text-brand flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h2 class="text-xl font-extrabold text-[#0F172A]">1. Pilih Lapangan</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($lapangans as $lapangan)
                        <label
                            class="relative flex items-center gap-4 rounded-2xl border-2 p-5 cursor-pointer transition-all duration-200 select-none"
                            :class="id_lapangan == '{{ $lapangan->id }}' ? 'border-brand bg-brand/5 shadow-brand' : 'border-slate-200 bg-white hover:border-slate-300'"
                        >
                            <input
                                type="radio"
                                name="id_lapangan"
                                value="{{ $lapangan->id }}"
                                x-model="id_lapangan"
                                @change="fetchJadwal()"
                                class="sr-only"
                            />
                            <div
                                class="w-6 h-6 rounded-full border-2 flex items-center justify-center shrink-0 transition"
                                :class="id_lapangan == '{{ $lapangan->id }}' ? 'border-brand' : 'border-slate-300'"
                            >
                                <div
                                    class="w-3 h-3 rounded-full bg-brand transition transform"
                                    :class="id_lapangan == '{{ $lapangan->id }}' ? 'scale-100' : 'scale-0'"
                                ></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-base font-extrabold text-[#0F172A] mb-1">{{ $lapangan->nama_lapangan }}</p>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand/10 text-brand text-xs font-bold uppercase tracking-wider">
                                    Rp {{ number_format($lapangan->harga, 0, ',', '.') }} / Jam
                                </span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Section 2: Pilih Jadwal --}}
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/50 p-6 sm:p-8 space-y-6">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h2 class="text-xl font-extrabold text-[#0F172A]">2. Pilih Waktu Main</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Tanggal --}}
                    <div class="space-y-2">
                        <label for="tanggal_main" class="block text-sm font-bold text-slate-700">Tanggal Main</label>
                        <input
                            type="date"
                            id="tanggal_main"
                            name="tanggal_main"
                            x-model="tanggal_main"
                            @change="fetchJadwal()"
                            min="{{ date('Y-m-d') }}"
                            class="w-full rounded-2xl border-slate-200 bg-white/50 px-4 py-3.5 text-[#0F172A] focus:border-brand focus:ring-4 focus:ring-brand/10 transition-all duration-200 font-medium"
                            required
                        />
                    </div>

                    {{-- Jam Mulai --}}
                    <div class="space-y-2">
                        <label for="jam_mulai" class="block text-sm font-bold text-slate-700">Jam Mulai <span x-show="isLoading" class="text-xs text-brand animate-pulse ml-2 font-semibold">Memuat jadwal...</span></label>
                        <div class="relative">
                            <select
                                id="jam_mulai"
                                name="jam_mulai"
                                x-model="jam_mulai"
                                class="w-full rounded-2xl border-slate-200 bg-white/50 px-4 py-3.5 text-[#0F172A] focus:border-brand focus:ring-4 focus:ring-brand/10 transition-all duration-200 disabled:bg-slate-100 disabled:text-slate-400 font-medium select-custom"
                                :disabled="availableHours.length === 0 || isLoading"
                                required
                            >
                                <template x-if="!id_lapangan || !tanggal_main">
                                    <option value="" disabled selected>Pilih lapangan & tanggal dulu</option>
                                </template>
                                <template x-if="id_lapangan && tanggal_main && availableHours.length === 0 && !isLoading">
                                    <option value="" disabled selected>Jadwal penuh</option>
                                </template>
                                <template x-if="id_lapangan && tanggal_main && availableHours.length > 0">
                                    <option value="" disabled selected>-- Pilih Jam --</option>
                                </template>
                                <template x-for="hour in availableHours" :key="hour">
                                    <option :value="hour" x-text="hour + ' WIB'"></option>
                                </template>
                            </select>
                        </div>
                        <p class="text-xs text-red-500 font-semibold mt-1.5 flex items-center gap-1" x-show="id_lapangan && tanggal_main && availableHours.length === 0 && !isLoading" x-cloak>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Semua jam pada tanggal ini sudah dibooking.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Section 3: Sewa Alat --}}
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/50 p-6 sm:p-8 space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h2 class="text-xl font-extrabold text-[#0F172A]">3. Sewa Alat Tambahan</h2>
                    </div>
                    <span class="text-[10px] font-bold bg-slate-100 text-slate-500 px-2.5 py-1 rounded-full uppercase tracking-wider">Opsional</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($alats as $alat)
                        <label class="relative flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 cursor-pointer hover:border-slate-300 transition-all duration-200 select-none">
                            <input
                                type="checkbox"
                                name="alats[]"
                                value="{{ $alat->id }}"
                                class="w-5 h-5 rounded-lg border-slate-300 text-brand focus:ring-brand cursor-pointer transition"
                            />
                            <div class="flex-1 min-w-0">
                                <p class="text-base font-extrabold text-[#0F172A]">{{ $alat->nama_alat }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs font-semibold px-2 py-0.5 rounded bg-slate-100 text-slate-600">Stok: {{ $alat->stok }}</span>
                                    <span class="text-xs text-slate-300">•</span>
                                    <span class="text-sm text-purple-600 font-bold">Rp {{ number_format($alat->harga_sewa, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-4">
                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-brand to-blue-600 px-6 py-4 text-base font-bold text-white hover:from-blue-600 hover:to-brand focus:outline-none focus:ring-4 focus:ring-brand/30 transition-all duration-300 shadow-lg transform hover:-translate-y-0.5 disabled:opacity-60 disabled:cursor-not-allowed"
                    :disabled="!id_lapangan || !tanggal_main || !jam_mulai"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Lanjutkan ke Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function bookingForm() {
        return {
            id_lapangan: '',
            tanggal_main: '',
            jam_mulai: '',
            availableHours: [],
            isLoading: false,

            fetchJadwal() {
                this.jam_mulai = '';
                if (this.id_lapangan && this.tanggal_main) {
                    this.isLoading = true;
                    fetch(`/booking/jadwal?id_lapangan=${this.id_lapangan}&tanggal=${this.tanggal_main}`)
                        .then(res => res.json())
                        .then(data => {
                            this.availableHours = data.available_hours;
                            this.isLoading = false;
                        })
                        .catch(() => {
                            this.isLoading = false;
                            this.availableHours = [];
                        });
                } else {
                    this.availableHours = [];
                }
            }
        }
    }
</script>
@endsection

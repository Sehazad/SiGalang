@extends('layouts.app')

@section('title', 'Pendaftaran Turnamen - SIGALANG FC')

@section('content')
<div class="min-h-screen bg-slate-50 py-10 px-4 relative overflow-hidden" x-data="turnamenForm()">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-[-5%] left-[-5%] w-96 h-96 bg-brand/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft"></div>
    <div class="absolute bottom-[-5%] right-[-5%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft" style="animation-delay: 1.5s;"></div>

    <div class="max-w-6xl mx-auto space-y-8 relative z-10">

        {{-- Header Section --}}
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <div class="inline-flex items-center gap-2 bg-slate-200 text-slate-700 rounded-full px-4 py-1.5 mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                </svg>
                <span class="text-[10px] font-bold tracking-wider uppercase">Musim Turnamen Futsal {{ date('Y') }}</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A] tracking-tight">Pendaftaran Turnamen</h1>
            <p class="text-slate-500 text-sm sm:text-base leading-relaxed font-medium">
                Daftarkan tim futsal terbaikmu, tantang tim rival, dan perebutkan piala juara utama di SIGALANG FC.
            </p>
        </div>

        {{-- Errors --}}
        @if($errors->any())
            <div class="max-w-2xl mx-auto bg-red-50 border border-red-200 text-red-800 rounded-2xl px-5 py-4 text-sm space-y-1 shadow-sm font-semibold animate-slide-down">
                @foreach($errors->all() as $error)
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $error }}
                    </p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('turnamen.store') }}" class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-slate-100">
                
                {{-- Left: Informasi Pendaftaran (Col 5) --}}
                <div class="lg:col-span-5 p-6 sm:p-8 space-y-6 bg-slate-50/50">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-slate-200 flex items-center justify-center shadow-inner">
                            <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M18.75 4.236c.982.143 1.954.317-2.916.52A6.003 6.003 0 0016.27 9.728M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228m0 0a6.023 6.023 0 01-2.27.308 6.023 6.023 0 01-2.27-.308"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-extrabold text-[#0F172A]">Detail Pengajuan</h2>
                    </div>

                    <div class="space-y-5">
                        {{-- Nama Turnamen --}}
                        <div class="space-y-1.5">
                            <label for="nama_turnamen" class="block text-sm font-bold text-[#0F172A]">Nama Turnamen</label>
                            <input type="text" id="nama_turnamen" name="nama_turnamen" value="{{ old('nama_turnamen', 'Cikoneng Futsal Cup II') }}" 
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-[#0F172A] font-medium outline-none transition duration-200 focus:border-brand focus:ring-4 focus:ring-brand/10" required>
                        </div>

                        {{-- Slot --}}
                        <div class="space-y-1.5">
                            <label for="jumlah_tim" class="block text-sm font-bold text-[#0F172A]">Format Turnamen</label>
                            <div class="input-group">
                                <select id="jumlah_tim" class="w-full rounded-xl border border-slate-200 bg-slate-100 pr-10 py-3.5 text-sm text-slate-500 cursor-not-allowed font-medium appearance-none" disabled>
                                    <option value="8" selected>8 Tim Peserta (Bracket QF)</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                    </svg>
                                </div>
                            </div>
                            <input type="hidden" name="jumlah_tim" value="8">
                        </div>

                        {{-- Info Box --}}
                        <div class="bg-brand/5 border border-brand/10 rounded-2xl p-5 flex gap-3">
                            <svg class="w-5 h-5 text-brand shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-extrabold text-[#0F172A]">Biaya Registrasi</p>
                                <p class="text-xs text-slate-500 mt-1 font-semibold leading-relaxed">Rp 350.000 / Tim (Sudah termasuk biaya kebersihan venue, asuransi dasar Staf Medis, dan air mineral).</p>
                            </div>
                        </div>


                    </div>
                </div>

                {{-- Right: Daftar Tim (Col 7) --}}
                <div class="lg:col-span-7 p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center border border-slate-100">
                                <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-extrabold text-[#0F172A]">Daftar Tim Pendaftar</h2>
                        </div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 border border-slate-200 rounded-full text-xs font-bold text-slate-600">
                            <span x-text="filledCount" class="text-brand">0</span> / 8 Tim
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @for($i = 1; $i <= 8; $i++)
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider pl-1">Slot Tim {{ $i }}</label>
                                <div class="input-group">
                                    <div class="input-icon">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="tim[]" x-model="tim[{{ $i-1 }}]" placeholder="Nama Tim Peserta {{ $i }}" 
                                        class="w-full rounded-xl border border-slate-200 bg-white pr-4 py-3 text-sm text-[#0F172A] font-medium outline-none transition duration-200 focus:border-brand focus:ring-4 focus:ring-brand/10" required>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

            </div>

            {{-- Submit Button (Full-Width Footer Row) --}}
            <div class="pt-6 mt-6 border-t border-slate-100 flex justify-end px-6 sm:px-8 pb-6 sm:pb-8">
                <button type="submit" class="w-full sm:w-auto sm:px-8 btn-primary py-3.5 rounded-xl text-sm font-extrabold text-white shadow-brand transform hover:-translate-y-0.5 transition-transform duration-200">
                    Konfirmasi &amp; Bayar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function turnamenForm() {
        return {
            tim: Array(8).fill(''),
            get filledCount() {
                return this.tim.filter(t => t.trim() !== '').length;
            }
        }
    }
</script>
@endsection

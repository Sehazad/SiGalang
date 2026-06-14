@extends('layouts.app')

@section('title', 'SIGALANG FC — Arena Futsal Premium Cikoneng')

@section('content')

    {{-- ========== HERO SECTION ========== --}}
    <section class="relative overflow-hidden bg-white hero-pattern">
        {{-- Floating Blobs --}}
        <div class="absolute top-[-20%] right-[-10%] w-[600px] h-[600px] bg-brand/6 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[400px] h-[400px] bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

                {{-- Left Column: Text --}}
                <div class="max-w-xl animate-fade-in">
                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 bg-brand/8 text-brand rounded-full px-4 py-2 mb-7 border border-brand/15">
                        <span class="w-2 h-2 bg-brand rounded-full animate-pulse"></span>
                        <span class="text-xs font-bold tracking-widest uppercase">Arena Terbaik di Cikoneng</span>
                    </div>

                    {{-- Title --}}
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black italic uppercase leading-[0.95] tracking-tighter text-dark mb-6">
                        Main Bola<br>
                        Tanpa<br>
                        <span class="relative inline-block">
                            <span class="relative z-10 text-transparent bg-clip-text bg-gradient-to-r from-brand to-indigo-500">Ribet.</span>
                        </span>
                    </h1>

                    {{-- Description --}}
                    <p class="text-base text-slate-500 leading-relaxed max-w-md">
                        Booking lapangan futsal instan, ikut turnamen bergengsi, dan nikmati fasilitas kelas premium — semua dalam satu platform yang mudah digunakan.
                    </p>

                    {{-- Buttons --}}
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('booking.create') }}"
                           class="btn-primary px-7 py-3.5 rounded-2xl text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Booking Sekarang
                        </a>
                        <a href="{{ route('turnamen.create') }}"
                           class="btn-secondary px-7 py-3.5 rounded-2xl text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375"/></svg>
                            Portal Turnamen
                        </a>
                    </div>

                    {{-- Stats Row --}}
                    <div class="mt-12 flex items-center gap-8 pt-8 border-t border-slate-100">
                        <div>
                            <p class="text-3xl font-black text-dark tabular-nums">1.2K+</p>
                            <p class="text-xs text-slate-400 mt-1 font-medium">Booking/Bulan</p>
                        </div>
                        <div class="w-px h-12 bg-slate-200"></div>
                        <div>
                            <p class="text-3xl font-black text-dark tabular-nums">50+</p>
                            <p class="text-xs text-slate-400 mt-1 font-medium">Turnamen</p>
                        </div>
                        <div class="w-px h-12 bg-slate-200"></div>
                        <div>
                            <p class="text-3xl font-black text-dark tabular-nums">4.9<span class="text-lg text-slate-300">/5</span></p>
                            <p class="text-xs text-slate-400 mt-1 font-medium">Rating User</p>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Visual Card --}}
                <div class="relative flex justify-center lg:justify-end">
                    {{-- Decorative Blur Blobs --}}
                    <div class="absolute -top-16 -right-16 w-80 h-80 bg-brand/15 rounded-full blur-3xl animate-pulse-soft"></div>
                    <div class="absolute -bottom-8 -left-8 w-64 h-64 bg-accent/10 rounded-full blur-3xl animate-pulse-soft" style="animation-delay: 1.5s;"></div>

                    {{-- Main Card --}}
                    <div class="relative w-full max-w-sm animate-float">
                        {{-- Outer Glow --}}
                        <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-brand/30 to-indigo-500/20 blur-xl -z-10 scale-105"></div>

                        <div class="relative rounded-3xl overflow-hidden shadow-2xl field-card-animated">

                            {{-- Field Visualization --}}
                            <div class="aspect-[4/5] relative">
                                {{-- Field outer border --}}
                                <div class="absolute inset-5 border-2 border-white/20 rounded-xl"></div>
                                {{-- Center line --}}
                                <div class="absolute top-1/2 left-5 right-5 h-px bg-white/20"></div>
                                {{-- Center circle --}}
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-28 h-28 border-2 border-white/20 rounded-full"></div>
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-4 h-4 bg-white/20 rounded-full"></div>
                                {{-- Goal areas --}}
                                <div class="absolute top-5 left-1/2 -translate-x-1/2 w-36 h-14 border-2 border-t-0 border-white/12 rounded-b-xl"></div>
                                <div class="absolute bottom-5 left-1/2 -translate-x-1/2 w-36 h-14 border-2 border-b-0 border-white/12 rounded-t-xl"></div>
                                {{-- Corner arcs --}}
                                <div class="absolute top-3 left-3 w-8 h-8 border-r-2 border-b-2 border-white/12 rounded-br-full"></div>
                                <div class="absolute top-3 right-3 w-8 h-8 border-l-2 border-b-2 border-white/12 rounded-bl-full"></div>
                                <div class="absolute bottom-3 left-3 w-8 h-8 border-r-2 border-t-2 border-white/12 rounded-tr-full"></div>
                                <div class="absolute bottom-3 right-3 w-8 h-8 border-l-2 border-t-2 border-white/12 rounded-tl-full"></div>

                                {{-- Floating Status Cards --}}
                                {{-- Top Right Badge --}}
                                <div class="absolute top-4 right-4">
                                    <div class="glass rounded-xl px-3 py-2 flex items-center gap-2">
                                        <span class="w-2 h-2 bg-accent rounded-full animate-pulse"></span>
                                        <span class="text-white text-[11px] font-bold uppercase tracking-wide">Live</span>
                                    </div>
                                </div>

                                {{-- Glass Overlay Card --}}
                                <div class="absolute bottom-5 left-5 right-5">
                                    <div class="glass rounded-2xl p-4">
                                        <div class="flex items-center justify-between mb-3">
                                            <div>
                                                <p class="text-white text-sm font-black tracking-wide">LAPANGAN UTAMA</p>
                                                <p class="text-white/60 text-xs mt-0.5">Premium Synthetic · Indoor</p>
                                            </div>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 bg-accent/25 border border-accent/35 rounded-xl">
                                                <span class="w-1.5 h-1.5 bg-accent rounded-full animate-pulse"></span>
                                                <span class="text-accent text-[10px] font-black uppercase">Available</span>
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-2 mt-3 pt-3 border-t border-white/12">
                                            <div class="flex -space-x-2">
                                                @foreach(['A','B','C'] as $i)
                                                    <div class="w-6 h-6 rounded-full gradient-sports border-2 border-white/20 flex items-center justify-center text-white text-[9px] font-bold">{{ $i }}</div>
                                                @endforeach
                                            </div>
                                            <span class="text-white/60 text-[11px] font-medium">+5 booking hari ini</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Floating Stats Card --}}
                        <div class="absolute -left-8 top-1/3 glass-dark rounded-2xl p-4 shadow-2xl border border-white/8 animate-bounce-subtle">
                            <p class="text-white/50 text-[10px] uppercase tracking-widest font-bold mb-1">Next Match</p>
                            <p class="text-white font-black text-sm">19:00 WIB</p>
                            <p class="text-brand text-xs font-semibold mt-0.5">Tim A vs Tim B</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== FEATURES STRIP ========== --}}
    <section class="bg-dark py-6 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center flex-wrap gap-8 sm:gap-16">
                @foreach([
                    ['Booking Online 24/7', 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    ['Pembayaran QRIS', 'M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5z'],
                    ['E-Tiket Instant', 'M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z'],
                    ['Turnamen Bulanan', 'M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375'],
                ] as [$label, $icon])
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
                        </svg>
                        <span class="text-sm font-semibold text-white/70 whitespace-nowrap">{{ $label }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== FASILITAS SECTION ========== --}}
    <section class="py-20 lg:py-28 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="text-center max-w-2xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 bg-brand/10 text-brand rounded-full px-4 py-2 mb-5 border border-brand/15">
                    <span class="text-xs font-bold tracking-widest uppercase">Fasilitas Premium</span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-dark tracking-tighter">
                    Semua yang Kamu<br>Butuhkan, Ada di Sini
                </h2>
                <p class="mt-4 text-base text-slate-500 leading-relaxed">
                    Fasilitas modern dan lengkap untuk pengalaman futsal terbaik di Cikoneng.
                </p>
            </div>

            {{-- Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                @foreach([
                    ['Sintetis Premium', 'Rumput sintetis berkualitas FIFA yang nyaman dan aman untuk permainan kompetitif maupun rekreasi.', 'M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068', 'from-brand/10 to-indigo-500/10', 'text-brand'],
                    ['Loker Pemain', 'Loker pribadi yang aman dengan kunci digital untuk menyimpan barang bawaan selama bermain.', 'M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z', 'from-purple-500/10 to-pink-500/10', 'text-purple-600'],
                    ['Lampu LED Pro', 'Pencahayaan LED stadium-grade 500 lux yang merata tanpa bayangan untuk main siang maupun malam.', 'M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189', 'from-amber-500/10 to-yellow-500/10', 'text-amber-600'],
                    ['Free High-Speed Wi-Fi', 'Koneksi internet cepat gratis di seluruh area arena. Livestream pertandingan secara real-time.', 'M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0', 'from-emerald-500/10 to-teal-500/10', 'text-emerald-600'],
                    ['Corner Cafe', 'Cafe di area arena dengan aneka minuman segar dan makanan ringan. Nyaman sebelum dan sesudah main.', 'M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048', 'from-orange-500/10 to-red-500/10', 'text-orange-600'],
                    ['Tribun Penonton', 'Tribun berkapasitas 200 orang dengan tempat duduk nyaman untuk mendukung tim favorit kamu.', 'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72', 'from-sky-500/10 to-cyan-500/10', 'text-sky-600'],
                ] as [$title, $desc, $icon, $grad, $iconColor])
                    <div class="card-premium p-6 bg-white group cursor-default">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br {{ $grad }} flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 {{ $iconColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-dark mb-2">{{ $title }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== HOW IT WORKS ========== --}}
    <section class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 bg-accent/10 text-accent rounded-full px-4 py-2 mb-5 border border-accent/15">
                    <span class="text-xs font-bold tracking-widest uppercase">Cara Bermain</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-dark tracking-tighter">Booking dalam 3 Langkah</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                {{-- Connector Line (desktop) --}}
                <div class="hidden md:block absolute top-12 left-1/4 right-1/4 h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent z-0"></div>

                @foreach([
                    ['01', 'Pilih Lapangan & Jadwal', 'Pilih lapangan yang tersedia dan tentukan tanggal serta jam bermain sesuai keinginan kamu.', 'gradient-brand'],
                    ['02', 'Bayar via QRIS', 'Lakukan pembayaran mudah dengan scan QRIS. Aman, cepat, dan terkonfirmasi instan.', 'bg-gradient-to-br from-purple-500 to-indigo-600'],
                    ['03', 'Terima E-Tiket', 'E-Tiket dikirim otomatis ke akun kamu. Tunjukkan saat check-in dan langsung bermain!', 'bg-gradient-to-br from-accent to-teal-600'],
                ] as [$num, $title, $desc, $bg])
                    <div class="relative flex flex-col items-center text-center group">
                        <div class="w-24 h-24 rounded-3xl {{ $bg }} flex items-center justify-center mb-6 shadow-xl group-hover:scale-110 transition-transform duration-300 z-10">
                            <span class="text-3xl font-black text-white">{{ $num }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-dark mb-2">{{ $title }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed max-w-xs">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('booking.create') }}" class="btn-primary px-8 py-4 rounded-2xl">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    Mulai Booking
                </a>
            </div>
        </div>
    </section>

    {{-- ========== PROMO BANNER SECTION ========== --}}
    <section class="py-20 lg:py-28 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl px-8 py-16 sm:px-16 sm:py-20"
                 style="background: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #0EA5E9 200%);">

                {{-- Decorative Elements --}}
                <div class="absolute top-0 right-0 w-96 h-96 bg-brand/15 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
                <div class="absolute bottom-0 left-0 w-72 h-72 bg-indigo-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
                <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 70% 50%, rgba(14,165,233,0.2) 0%, transparent 60%);"></div>

                <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    {{-- Left --}}
                    <div>
                        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/15 rounded-full px-4 py-2 mb-6">
                            <span class="w-2 h-2 bg-accent rounded-full animate-pulse"></span>
                            <span class="text-xs font-bold text-white/80 uppercase tracking-widest">Promo Spesial</span>
                        </div>
                        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black uppercase leading-[0.9] text-white tracking-tighter">
                            Siap Untuk<br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#38BDF8] to-[#818CF8]">Bertanding</span><br>
                            Hari Ini?
                        </h2>
                        <p class="mt-6 text-base text-white/60 leading-relaxed max-w-md">
                            Daftar sekarang dan dapatkan promo spesial untuk booking pertama kamu. Kuota terbatas setiap bulannya!
                        </p>
                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="{{ route('register') }}"
                               class="inline-flex items-center gap-2 px-8 py-4 bg-white text-dark font-black rounded-2xl hover:bg-slate-50 transition-colors shadow-xl text-sm">
                                Daftar & Klaim Promo
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Right: Glass Event Card --}}
                    <div class="flex justify-center lg:justify-end">
                        <div class="glass rounded-3xl p-8 max-w-xs w-full border border-white/15">
                            {{-- Trophy Icon --}}
                            <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-white/15">
                                <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M18.75 4.236c.982.143 1.954.317 2.916.52A6.003 6.003 0 0016.27 9.728M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228"/>
                                </svg>
                            </div>

                            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-white/40 mb-2 text-center">Next Event</p>
                            <h3 class="text-xl font-black text-white uppercase tracking-wide text-center">Cikoneng Cup 2025</h3>

                            <div class="mt-5 space-y-3">
                                @foreach([['Coming Soon', 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5'], ['16 Tim Peserta', 'M18 18.72a9.094 9.094 0 003.741-.479'], ['Hadiah Rp 2.5jt', 'M12 8v4l3 3m6-3a9 9 0 11-18 0']] as [$txt, $ic])
                                    <div class="flex items-center gap-3 bg-white/8 rounded-xl px-3 py-2.5">
                                        <svg class="w-4 h-4 text-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $ic }}"/></svg>
                                        <span class="text-sm text-white/70 font-medium">{{ $txt }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

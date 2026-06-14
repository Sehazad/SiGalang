<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIGALANG FC')</title>

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }

        /* Tailwind v4 opacity modifier fixes */
        .bg-brand\/5 { background-color: rgba(14, 165, 233, 0.05) !important; }
        .bg-brand\/6 { background-color: rgba(14, 165, 233, 0.06) !important; }
        .bg-brand\/8 { background-color: rgba(14, 165, 233, 0.08) !important; }
        .bg-brand\/10 { background-color: rgba(14, 165, 233, 0.10) !important; }
        .bg-brand\/12 { background-color: rgba(14, 165, 233, 0.12) !important; }
        .bg-brand\/15 { background-color: rgba(14, 165, 233, 0.15) !important; }
        .bg-brand\/20 { background-color: rgba(14, 165, 233, 0.20) !important; }
        .bg-brand\/25 { background-color: rgba(14, 165, 233, 0.25) !important; }
        .bg-brand\/30 { background-color: rgba(14, 165, 233, 0.30) !important; }
        .text-brand\/70  { color: rgba(14, 165, 233, 0.70) !important; }
        .border-brand\/10 { border-color: rgba(14, 165, 233, 0.10) !important; }
        .border-brand\/15 { border-color: rgba(14, 165, 233, 0.15) !important; }
        .border-brand\/20 { border-color: rgba(14, 165, 233, 0.20) !important; }
        .border-brand\/25 { border-color: rgba(14, 165, 233, 0.25) !important; }
        .border-brand\/35 { border-color: rgba(14, 165, 233, 0.35) !important; }
        .bg-accent\/10 { background-color: rgba(16, 185, 129, 0.10) !important; }
        .bg-accent\/15 { background-color: rgba(16, 185, 129, 0.15) !important; }
        .bg-accent\/25 { background-color: rgba(16, 185, 129, 0.25) !important; }
        .border-accent\/10 { border-color: rgba(16, 185, 129, 0.10) !important; }
        .border-accent\/15 { border-color: rgba(16, 185, 129, 0.15) !important; }
        .border-accent\/35 { border-color: rgba(16, 185, 129, 0.35) !important; }
        .bg-white\/6 { background-color: rgba(255,255,255,0.06) !important; }
        .bg-white\/8 { background-color: rgba(255,255,255,0.08) !important; }
        .bg-white\/10 { background-color: rgba(255,255,255,0.10) !important; }
        .bg-white\/12 { background-color: rgba(255,255,255,0.12) !important; }
        .bg-white\/15 { background-color: rgba(255,255,255,0.15) !important; }
        .bg-white\/80 { background-color: rgba(255,255,255,0.80) !important; }
        .bg-white\/95 { background-color: rgba(255,255,255,0.95) !important; }
        .border-white\/5 { border-color: rgba(255,255,255,0.05) !important; }
        .border-white\/6 { border-color: rgba(255,255,255,0.06) !important; }
        .border-white\/8 { border-color: rgba(255,255,255,0.08) !important; }
        .border-white\/12 { border-color: rgba(255,255,255,0.12) !important; }
        .border-white\/15 { border-color: rgba(255,255,255,0.15) !important; }
        .border-white\/50 { border-color: rgba(255,255,255,0.50) !important; }
        .shadow-brand { box-shadow: 0 4px 14px rgba(14, 165, 233, 0.3) !important; }

        /* Extra nav hover fix */
        a.hover\:bg-brand\/8:hover { background-color: rgba(14, 165, 233, 0.08) !important; }
        a.hover\:bg-brand\/20:hover { background-color: rgba(14, 165, 233, 0.20) !important; }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-slate-50 antialiased" style="font-family:'Inter',system-ui,sans-serif;color:#0F172A;">

    {{-- ========== NAVBAR ========== --}}
    <nav class="navbar-glass sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between" style="height:4.25rem;">

                {{-- Left: Brand + Nav Links --}}
                <div class="flex items-center gap-8">
                    {{-- Brand Logo --}}
                    <a href="/" class="flex items-center gap-2.5 shrink-0 group" style="text-decoration:none;">
                        <div class="gradient-brand flex items-center justify-center shadow-brand group-hover:scale-105 transition-transform" style="width:2.25rem;height:2.25rem;border-radius:0.75rem;">
                            <svg style="width:1.25rem;height:1.25rem;color:white;" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                            </svg>
                        </div>
                        <div class="flex flex-col leading-none">
                            <span style="font-size:1rem;font-weight:900;letter-spacing:-0.025em;color:#0F172A;">SIGALANG</span>
                            <span style="font-size:0.625rem;font-weight:700;color:#0EA5E9;text-transform:uppercase;letter-spacing:0.1em;margin-top:-1px;">FC</span>
                        </div>
                    </a>

                    {{-- Desktop Nav Links --}}
                    <div class="hidden md:flex items-center gap-1">
                        <a href="/"
                           @class([
                               'flex items-center px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 no-underline',
                               'bg-brand/8 text-brand font-semibold' => request()->is('/'),
                               'text-slate-600 hover:bg-slate-50 hover:text-slate-900' => !request()->is('/'),
                           ])>
                            Beranda
                        </a>
                        <a href="{{ route('booking.create') }}"
                           @class([
                               'flex items-center px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 no-underline',
                               'bg-brand/8 text-brand font-semibold' => request()->routeIs('booking.*'),
                               'text-slate-600 hover:bg-slate-50 hover:text-slate-900' => !request()->routeIs('booking.*'),
                           ])>
                            Booking
                        </a>
                        <a href="{{ route('turnamen.create') }}"
                           @class([
                               'flex items-center px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 no-underline',
                               'bg-brand/8 text-brand font-semibold' => request()->routeIs('turnamen.*'),
                               'text-slate-600 hover:bg-slate-50 hover:text-slate-900' => !request()->routeIs('turnamen.*'),
                           ])>
                            Turnamen
                        </a>
                        @auth
                        <a href="{{ route('tiket.saya') }}"
                           @class([
                               'flex items-center px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 no-underline',
                               'bg-brand/8 text-brand font-semibold' => request()->routeIs('tiket.saya'),
                               'text-slate-600 hover:bg-slate-50 hover:text-slate-900' => !request()->routeIs('tiket.saya'),
                           ])>
                            Tiket Saya
                        </a>
                        @endauth
                    </div>
                </div>

                {{-- Right: Auth Area --}}
                <div class="flex items-center gap-2">
                    @auth
                        {{-- User Dropdown --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                    @click.outside="open = false"
                                    class="flex items-center gap-2.5 pl-2 pr-3 py-1.5 rounded-xl hover:bg-slate-50 transition-all duration-200 border border-transparent hover:border-slate-200"
                                    style="background:transparent;">
                                <div class="gradient-sports flex items-center justify-center text-white text-xs font-bold uppercase" style="width:2rem;height:2rem;border-radius:0.5rem;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="hidden sm:flex flex-col text-left leading-none">
                                    <span style="font-size:0.75rem;font-weight:700;color:#0F172A;">{{ Str::limit(Auth::user()->name, 14) }}</span>
                                    <span style="font-size:0.625rem;font-weight:500;color:#94A3B8;margin-top:2px;text-transform:uppercase;letter-spacing:0.05em;">{{ Auth::user()->role }}</span>
                                </div>
                                <svg class="transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="width:1rem;height:1rem;color:#94A3B8;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </button>

                            {{-- Dropdown Menu --}}
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                                 class="absolute right-0 mt-3 bg-white rounded-2xl py-2 z-50 overflow-hidden"
                                 style="display:none;width:18rem;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);border:1px solid rgba(0,0,0,0.06);">

                                {{-- User Info Header --}}
                                @php
                                    $roleColors = [
                                        'admin' => 'from-amber-500 to-orange-500',
                                        'karyawan' => 'from-blue-500 to-blue-600',
                                        'customer' => 'from-emerald-500 to-teal-600',
                                    ];
                                    $roleGrad = $roleColors[Auth::user()->role] ?? 'from-slate-500 to-slate-600';
                                    $roleLabels = [
                                        'admin' => 'bg-amber-100 text-amber-700',
                                        'karyawan' => 'bg-blue-100 text-blue-700',
                                        'customer' => 'bg-emerald-100 text-emerald-700',
                                    ];
                                    $roleLabelCls = $roleLabels[Auth::user()->role] ?? 'bg-slate-100 text-slate-600';
                                @endphp
                                <div class="px-4 pb-3 pt-2 border-b border-slate-100">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-gradient-to-br {{ $roleGrad }} flex items-center justify-center text-white text-sm font-bold uppercase" style="width:2.5rem;height:2.5rem;border-radius:0.75rem;">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p style="font-size:0.875rem;font-weight:700;color:#0F172A;">{{ Auth::user()->name }}</p>
                                            <p style="font-size:0.75rem;color:#94A3B8;margin-top:2px;">{{ Auth::user()->no_hp }}</p>
                                            <span class="inline-flex items-center mt-1 px-2 py-0.5 rounded-full text-xs font-bold {{ $roleLabelCls }}" style="text-transform:uppercase;letter-spacing:0.05em;font-size:0.625rem;">
                                                {{ Auth::user()->role }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Menu Items --}}
                                <div class="py-1">
                                     <a href="{{ route('tiket.saya') }}"
                                        class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition-colors group"
                                        style="text-decoration:none;">
                                         <div class="w-8 h-8 rounded-lg bg-slate-50 group-hover:bg-slate-100 flex items-center justify-center transition-colors">
                                             <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                 <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-3.375-12h.008v.008H13.125V6zm-3 0h.008v.008H10.125V6zm-3 0h.008v.008H7.125V6zm3.375 6h.008v.008H13.125V12zm-3 0h.008v.008H10.125V12zm-3 0h.008v.008H7.125V12zm3.375 6h.008v.008H13.125V18zm-3 0h.008v.008H10.125V18zm-3 0h.008v.008H7.125V18zm-3-12h.008v.008H4.125V6zm0 6h.008v.008H4.125V12zm0 6h.008v.008H4.125V18z"/>
                                             </svg>
                                         </div>
                                         <div>
                                             <p style="font-weight:600;">Tiket Saya</p>
                                             <p style="font-size:0.75rem;color:#94A3B8;">Lihat tiket aktif</p>
                                         </div>
                                     </a>
                                    @if(in_array(Auth::user()->role, ['admin', 'karyawan']))
                                        <a href="{{ route('admin.dashboard') }}"
                                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition-colors group"
                                           style="text-decoration:none;">
                                            <div class="w-8 h-8 rounded-lg bg-amber-50 group-hover:bg-amber-100 flex items-center justify-center transition-colors">
                                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p style="font-weight:600;">Dashboard Admin</p>
                                                <p style="font-size:0.75rem;color:#94A3B8;">Kelola sistem</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('admin.users.index') }}"
                                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition-colors group"
                                           style="text-decoration:none;">
                                            <div class="w-8 h-8 rounded-lg bg-slate-50 group-hover:bg-slate-100 flex items-center justify-center transition-colors">
                                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                                                </svg>
                                            </div>
                                            <p style="font-weight:600;">Kelola Pengguna</p>
                                        </a>
                                    @endif
                                </div>

                                <div class="border-t border-slate-100 pt-1">
                                    {{-- Logout --}}
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors group"
                                                style="background:none;border:none;cursor:pointer;text-align:left;">
                                            <div class="w-8 h-8 rounded-lg bg-red-50 group-hover:bg-red-100 flex items-center justify-center transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                                                </svg>
                                            </div>
                                            <span style="font-weight:600;">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Guest Links --}}
                        <a href="{{ route('login') }}"
                           style="font-size:0.875rem;font-weight:600;color:#475569;text-decoration:none;padding:0.5rem 0.75rem;transition:color 200ms;"
                           onmouseover="this.style.color='#0EA5E9';"
                           onmouseout="this.style.color='#475569';">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                           class="btn-primary"
                           style="font-size:0.875rem;padding:0.5rem 1.25rem;border-radius:0.75rem;">
                            Daftar Gratis
                        </a>
                    @endauth

                    {{-- Mobile Menu Button --}}
                    <button x-data @click="$dispatch('toggle-mobile-menu')"
                            class="md:hidden p-2 rounded-xl text-slate-500 hover:bg-slate-100 transition-colors border border-slate-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-data="{ open: false }"
             @toggle-mobile-menu.window="open = !open"
             x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-3"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-3"
             class="md:hidden border-t border-slate-100"
             style="display:none;background:rgba(255,255,255,0.97);backdrop-filter:blur(12px);">
            <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
                <a href="/"
                   @class([
                       'flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-colors no-underline',
                       'bg-brand/8 text-brand font-bold' => request()->is('/'),
                       'font-semibold text-slate-700 hover:bg-slate-50' => !request()->is('/'),
                   ])>
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                    Beranda
                </a>
                <a href="{{ route('booking.create') }}"
                   @class([
                       'flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-colors no-underline',
                       'bg-brand/8 text-brand font-bold' => request()->routeIs('booking.*'),
                       'font-semibold text-slate-700 hover:bg-slate-50' => !request()->routeIs('booking.*'),
                   ])>
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Booking Lapangan
                </a>
                <a href="{{ route('turnamen.create') }}"
                   @class([
                       'flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-colors no-underline',
                       'bg-brand/8 text-brand font-bold' => request()->routeIs('turnamen.*'),
                       'font-semibold text-slate-700 hover:bg-slate-50' => !request()->routeIs('turnamen.*'),
                   ])>
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375"/></svg>
                    Turnamen
                </a>
                @auth
                <a href="{{ route('tiket.saya') }}"
                   @class([
                       'flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-colors no-underline',
                       'bg-brand/8 text-brand font-bold' => request()->routeIs('tiket.saya'),
                       'font-semibold text-slate-700 hover:bg-slate-50' => !request()->routeIs('tiket.saya'),
                   ])>
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    Tiket Saya
                </a>
                @endauth
                @guest
                    <div class="pt-3 border-t border-slate-100 flex gap-2">
                        <a href="{{ route('login') }}" class="flex-1 text-center px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors" style="text-decoration:none;">Masuk</a>
                        <a href="{{ route('register') }}" class="flex-1 text-center px-4 py-2.5 gradient-brand rounded-xl text-sm font-bold text-white" style="text-decoration:none;">Daftar</a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    {{-- ========== MAIN CONTENT ========== --}}
    <main class="grow">
        @yield('content')
    </main>

    {{-- ========== FOOTER ========== --}}
    <footer class="gradient-dark text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                {{-- Column 1: Brand --}}
                <div class="md:col-span-1">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="gradient-brand flex items-center justify-center" style="width:2.5rem;height:2.5rem;border-radius:0.75rem;box-shadow:0 4px 14px rgba(14,165,233,0.3);">
                            <svg style="width:1.25rem;height:1.25rem;color:white;" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                            </svg>
                        </div>
                        <div class="flex flex-col leading-none">
                            <span style="font-size:1.125rem;font-weight:900;letter-spacing:-0.025em;">SIGALANG</span>
                            <span style="font-size:0.625rem;font-weight:700;color:#0EA5E9;text-transform:uppercase;letter-spacing:0.1em;">FC · Futsal Cikoneng</span>
                        </div>
                    </div>
                    <p style="font-size:0.875rem;color:#94A3B8;line-height:1.7;max-width:18rem;">
                        Arena futsal modern dengan fasilitas premium di Cikoneng. Booking mudah, turnamen seru, dan pengalaman bermain yang tak terlupakan.
                    </p>
                    {{-- Social Links --}}
                    <div class="flex items-center gap-3 mt-6">
                        <a href="#" style="width:2.25rem;height:2.25rem;border-radius:0.75rem;background:rgba(255,255,255,0.08);display:flex;align-items:center;justify-content:center;transition:background 200ms;" onmouseover="this.style.background='rgba(14,165,233,0.2)';" onmouseout="this.style.background='rgba(255,255,255,0.08)';">
                            <svg style="width:1rem;height:1rem;color:#94A3B8;" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" style="width:2.25rem;height:2.25rem;border-radius:0.75rem;background:rgba(255,255,255,0.08);display:flex;align-items:center;justify-content:center;transition:background 200ms;" onmouseover="this.style.background='rgba(14,165,233,0.2)';" onmouseout="this.style.background='rgba(255,255,255,0.08)';">
                            <svg style="width:1rem;height:1rem;color:#94A3B8;" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Column 2: Contact --}}
                <div>
                    <h4 style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#64748B;margin-bottom:1.25rem;">Kontak</h4>
                    <ul style="list-style:none;display:flex;flex-direction:column;gap:1rem;">
                        <li class="flex items-start gap-3">
                            <div style="width:1.75rem;height:1.75rem;border-radius:0.5rem;background:rgba(14,165,233,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                                <svg style="width:0.875rem;height:0.875rem;color:#0EA5E9;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                            </div>
                            <span style="font-size:0.875rem;color:#94A3B8;line-height:1.6;">Jl. Raya Cikoneng No. 45, Ciamis, Jawa Barat</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div style="width:1.75rem;height:1.75rem;border-radius:0.5rem;background:rgba(14,165,233,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg style="width:0.875rem;height:0.875rem;color:#0EA5E9;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                            </div>
                            <span style="font-size:0.875rem;color:#94A3B8;">+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div style="width:1.75rem;height:1.75rem;border-radius:0.5rem;background:rgba(14,165,233,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg style="width:0.875rem;height:0.875rem;color:#0EA5E9;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span style="font-size:0.875rem;color:#94A3B8;">08:00 – 23:00 WIB (Setiap Hari)</span>
                        </li>
                    </ul>
                </div>

                {{-- Column 3: Quick Links --}}
                <div>
                    <h4 style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#64748B;margin-bottom:1.25rem;">Menu Cepat</h4>
                    <ul style="list-style:none;display:flex;flex-direction:column;gap:0.75rem;">
                        <li><a href="/" style="font-size:0.875rem;color:#94A3B8;text-decoration:none;display:flex;align-items:center;gap:0.5rem;transition:color 200ms;" onmouseover="this.style.color='#0EA5E9';" onmouseout="this.style.color='#94A3B8';"><span style="width:0.25rem;height:0.25rem;background:#0EA5E9;border-radius:50%;display:inline-block;"></span>Beranda</a></li>
                        <li><a href="{{ route('booking.create') }}" style="font-size:0.875rem;color:#94A3B8;text-decoration:none;display:flex;align-items:center;gap:0.5rem;transition:color 200ms;" onmouseover="this.style.color='#0EA5E9';" onmouseout="this.style.color='#94A3B8';"><span style="width:0.25rem;height:0.25rem;background:#0EA5E9;border-radius:50%;display:inline-block;"></span>Booking Lapangan</a></li>
                        <li><a href="{{ route('turnamen.create') }}" style="font-size:0.875rem;color:#94A3B8;text-decoration:none;display:flex;align-items:center;gap:0.5rem;transition:color 200ms;" onmouseover="this.style.color='#0EA5E9';" onmouseout="this.style.color='#94A3B8';"><span style="width:0.25rem;height:0.25rem;background:#0EA5E9;border-radius:50%;display:inline-block;"></span>Daftar Turnamen</a></li>
                        <li><a href="{{ route('login') }}" style="font-size:0.875rem;color:#94A3B8;text-decoration:none;display:flex;align-items:center;gap:0.5rem;transition:color 200ms;" onmouseover="this.style.color='#0EA5E9';" onmouseout="this.style.color='#94A3B8';"><span style="width:0.25rem;height:0.25rem;background:#0EA5E9;border-radius:50%;display:inline-block;"></span>Login</a></li>
                        <li><a href="{{ route('admin.login') }}" style="font-size:0.875rem;color:#94A3B8;text-decoration:none;display:flex;align-items:center;gap:0.5rem;transition:color 200ms;" onmouseover="this.style.color='#F59E0B';" onmouseout="this.style.color='#94A3B8';"><span style="width:0.25rem;height:0.25rem;background:#F59E0B;border-radius:50%;display:inline-block;"></span>Admin Panel</a></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Copyright Bar --}}
        <div style="border-top:1px solid rgba(255,255,255,0.06);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p style="font-size:0.75rem;color:#64748B;">
                    &copy; {{ date('Y') }} <span style="font-weight:600;color:#94A3B8;">SIGALANG FC</span>. All rights reserved.
                </p>
                <div class="flex items-center gap-1.5">
                    <span style="width:0.5rem;height:0.5rem;background:#10B981;border-radius:50%;animation:pulse-soft 2s ease-in-out infinite;"></span>
                    <span style="font-size:0.75rem;color:#64748B;font-weight:500;">Sistem Online</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>

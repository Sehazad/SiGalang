@extends('layouts.app')

@section('title', 'Bagan Turnamen - SIGALANG FC')

@section('content')
<div class="min-h-screen py-10 px-4 overflow-hidden relative" style="background:#020617;">
    {{-- Decorative Sports Background Glows --}}
    <div class="absolute rounded-full filter blur-3xl animate-pulse-soft" style="top:-10%;right:-10%;width:32rem;height:32rem;background:rgba(14,165,233,0.10);opacity:0.6;"></div>
    <div class="absolute rounded-full filter blur-3xl animate-pulse-soft" style="bottom:-10%;left:-10%;width:32rem;height:32rem;background:rgba(99,102,241,0.10);opacity:0.6;animation-delay:1.5s;"></div>

    <div class="max-w-7xl mx-auto space-y-8 relative" style="z-index:10;">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-6 rounded-3xl shadow-2xl backdrop-blur-xl" style="background:rgba(15,23,42,0.60);border:1px solid rgba(51,65,85,0.80);">
            <div>
                <h1 class="text-3xl font-black text-white tracking-tight">Bagan Turnamen</h1>
                <p class="text-slate-400 mt-1.5 text-sm font-medium">Bagan &amp; hasil pertandingan terkini untuk turnamen <span style="color:#0EA5E9;font-weight:700;">{{ $turnamen->nama_turnamen }}</span></p>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold" style="background:rgba(16,185,129,0.10);border:1px solid rgba(16,185,129,0.25);color:#34D399;">
                    <span class="relative flex" style="width:0.625rem;height:0.625rem;">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" style="background:#4ADE80;"></span>
                        <span class="relative inline-flex rounded-full" style="width:0.625rem;height:0.625rem;background:#22C55E;"></span>
                    </span>
                    Live Updates
                </span>
                <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold text-white transition" style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Bracket Container --}}
        <div class="rounded-3xl p-8 overflow-x-auto shadow-2xl backdrop-blur-md" style="background:rgba(15,23,42,0.40);border:1px solid rgba(51,65,85,0.60);">
            <div style="min-width:980px;">
                
                {{-- Column Headers --}}
                <div style="width:960px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;margin-bottom:2.5rem;" class="text-center">
                    <div style="width:256px;font-size:0.625rem;font-weight:700;text-transform:uppercase;letter-spacing:0.25em;color:#64748B;">Quarter-Finals</div>
                    <div style="width:256px;font-size:0.625rem;font-weight:700;text-transform:uppercase;letter-spacing:0.25em;color:#64748B;">Semi-Finals</div>
                    <div style="width:256px;font-size:0.625rem;font-weight:700;text-transform:uppercase;letter-spacing:0.25em;color:#64748B;">The Grand Final</div>
                </div>

                {{-- Bracket Grid --}}
                <div style="width:960px;height:660px;margin:0 auto;position:relative;">
                    
                    {{-- SVG Connector Lines --}}
                    <svg style="position:absolute;inset:0;width:100%;height:100%;pointer-events:none;z-index:0;">
                        {{-- QF to SF Lines --}}
                        <path d="M 256 64 L 300 64 L 300 160 L 340 160" fill="none" stroke="#1E293B" stroke-width="2.5"/>
                        <path d="M 256 256 L 300 256 L 300 160" fill="none" stroke="#1E293B" stroke-width="2.5"/>
                        
                        <path d="M 256 400 L 300 400 L 300 490 L 340 490" fill="none" stroke="#1E293B" stroke-width="2.5"/>
                        <path d="M 256 590 L 300 590 L 300 490" fill="none" stroke="#1E293B" stroke-width="2.5"/>

                        {{-- SF to F Lines --}}
                        <path d="M 596 160 L 640 160 L 640 328 L 680 328" fill="none" stroke="#1E293B" stroke-width="2.5"/>
                        <path d="M 596 490 L 640 490 L 640 328" fill="none" stroke="#1E293B" stroke-width="2.5"/>
                    </svg>

                    {{-- QF Matches positioned absolutely --}}
                    @php
                        $qf_positions = [16, 208, 352, 544];
                    @endphp
                    @for($i = 0; $i < 4; $i++)
                        @php
                            $match = $quarter_finals[$i] ?? null;
                            $top = $qf_positions[$i];
                        @endphp
                        <div style="position:absolute;left:0;top:{{ $top }}px;width:256px;background:#0F172A;border:1px solid #1E293B;border-radius:1rem;overflow:hidden;box-shadow:0 20px 25px -5px rgba(0,0,0,0.4);z-index:10;">
                            {{-- Team 1 --}}
                            <div style="display:flex;align-items:center;justify-content:space-between;height:3rem;padding:0 1rem;border-bottom:1px solid rgba(30,41,59,0.6);{{ ($match && $match->skor_tim1 > $match->skor_tim2) ? 'background:rgba(14,165,233,0.08);' : '' }}">
                                <span style="font-size:0.875rem;{{ ($match && $match->skor_tim1 > $match->skor_tim2) ? 'font-weight:700;color:#fff;' : 'font-weight:500;color:#94A3B8;' }}overflow:hidden;text-overflow:ellipsis;white-space:nowrap;padding-right:0.5rem;max-width:180px;">
                                    {{ $match ? ($match->tim1->nama_tim ?? 'TBD') : 'TBD' }}
                                </span>
                                <div style="width:2rem;height:2rem;border-radius:0.5rem;background:#0F172A;display:flex;align-items:center;justify-content:center;font-size:0.875rem;font-weight:700;color:white;border:1px solid rgba(30,41,59,0.8);flex-shrink:0;">
                                    {{ $match ? $match->skor_tim1 : '-' }}
                                </div>
                            </div>
                            {{-- Team 2 --}}
                            <div style="display:flex;align-items:center;justify-content:space-between;height:3rem;padding:0 1rem;{{ ($match && $match->skor_tim2 > $match->skor_tim1) ? 'background:rgba(14,165,233,0.08);' : '' }}">
                                <span style="font-size:0.875rem;{{ ($match && $match->skor_tim2 > $match->skor_tim1) ? 'font-weight:700;color:#fff;' : 'font-weight:500;color:#94A3B8;' }}overflow:hidden;text-overflow:ellipsis;white-space:nowrap;padding-right:0.5rem;max-width:180px;">
                                    {{ $match ? ($match->tim2->nama_tim ?? 'TBD') : 'TBD' }}
                                </span>
                                <div style="width:2rem;height:2rem;border-radius:0.5rem;background:#0F172A;display:flex;align-items:center;justify-content:center;font-size:0.875rem;font-weight:700;color:white;border:1px solid rgba(30,41,59,0.8);flex-shrink:0;">
                                    {{ $match ? $match->skor_tim2 : '-' }}
                                </div>
                            </div>
                        </div>
                    @endfor

                    {{-- SF Matches positioned absolutely --}}
                    @php
                        $sf_positions = [112, 442];
                    @endphp
                    @for($i = 0; $i < 2; $i++)
                        @php
                            $match = $semi_finals[$i] ?? null;
                            $top = $sf_positions[$i];
                        @endphp
                        <div style="position:absolute;left:340px;top:{{ $top }}px;width:256px;background:#0F172A;border:1px solid #1E293B;border-radius:1rem;overflow:hidden;box-shadow:0 20px 25px -5px rgba(0,0,0,0.4);z-index:10;">
                            {{-- Team 1 --}}
                            <div style="display:flex;align-items:center;justify-content:space-between;height:3rem;padding:0 1rem;border-bottom:1px solid rgba(30,41,59,0.6);{{ ($match && $match->skor_tim1 > $match->skor_tim2) ? 'background:rgba(14,165,233,0.08);' : '' }}">
                                <span style="font-size:0.875rem;{{ ($match && $match->skor_tim1 > $match->skor_tim2) ? 'font-weight:700;color:#fff;' : 'font-weight:500;color:#94A3B8;' }}overflow:hidden;text-overflow:ellipsis;white-space:nowrap;padding-right:0.5rem;max-width:180px;">
                                    {{ $match && $match->tim1 ? $match->tim1->nama_tim : 'TBD' }}
                                </span>
                                <div style="width:2rem;height:2rem;border-radius:0.5rem;background:#0F172A;display:flex;align-items:center;justify-content:center;font-size:0.875rem;font-weight:700;color:white;border:1px solid rgba(30,41,59,0.8);flex-shrink:0;">
                                    {{ $match ? $match->skor_tim1 : '-' }}
                                </div>
                            </div>
                            {{-- Team 2 --}}
                            <div style="display:flex;align-items:center;justify-content:space-between;height:3rem;padding:0 1rem;{{ ($match && $match->skor_tim2 > $match->skor_tim1) ? 'background:rgba(14,165,233,0.08);' : '' }}">
                                <span style="font-size:0.875rem;{{ ($match && $match->skor_tim2 > $match->skor_tim1) ? 'font-weight:700;color:#fff;' : 'font-weight:500;color:#94A3B8;' }}overflow:hidden;text-overflow:ellipsis;white-space:nowrap;padding-right:0.5rem;max-width:180px;">
                                    {{ $match && $match->tim2 ? $match->tim2->nama_tim : 'TBD' }}
                                </span>
                                <div style="width:2rem;height:2rem;border-radius:0.5rem;background:#0F172A;display:flex;align-items:center;justify-content:center;font-size:0.875rem;font-weight:700;color:white;border:1px solid rgba(30,41,59,0.8);flex-shrink:0;">
                                    {{ $match ? $match->skor_tim2 : '-' }}
                                </div>
                            </div>
                        </div>
                    @endfor

                    {{-- Final Column positioned absolutely --}}
                    @php
                        $match = $final ?? null;
                    @endphp
                    <div style="position:absolute;left:680px;top:200px;width:280px;background:#0F172A;border:1px solid #1E293B;box-shadow:0 25px 50px -12px rgba(0,0,0,0.5);padding:1.5rem;border-radius:1.5rem;position:absolute;overflow:hidden;z-index:10;">
                        {{-- Golden Glow Backdrop --}}
                        <div style="position:absolute;inset:0;background:linear-gradient(to bottom, rgba(245,158,11,0.10), transparent);z-index:-1;"></div>
                        
                        {{-- Trophy --}}
                        <div style="width:4rem;height:4rem;border-radius:1rem;background:rgba(245,158,11,0.10);border:1px solid rgba(245,158,11,0.20);display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem auto;box-shadow:0 10px 15px -3px rgba(0,0,0,0.3);">
                            <svg style="width:2rem;height:2rem;color:#FBBF24;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M18.75 4.236c.982.143 1.954.317 2.916.52A6.003 6.003 0 0016.27 9.728M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228"/>
                            </svg>
                        </div>

                        <div style="display:flex;flex-direction:column;gap:0.75rem;">
                            {{-- Team 1 --}}
                            <div style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem;border-radius:0.75rem;border:1px solid #1E293B;background:#020617;box-shadow:0 2px 4px rgba(0,0,0,0.2);{{ ($match && $match->skor_tim1 > $match->skor_tim2) ? 'outline:2px solid #FBBF24;border-color:transparent;' : '' }}">
                                <span style="font-size:0.875rem;{{ ($match && $match->skor_tim1 > $match->skor_tim2) ? 'font-weight:700;color:#fff;' : 'font-weight:600;color:#94A3B8;' }}overflow:hidden;text-overflow:ellipsis;white-space:nowrap;padding-right:0.5rem;max-width:200px;">
                                    {{ $match && $match->tim1 ? $match->tim1->nama_tim : 'TBD' }}
                                </span>
                                <div style="width:2rem;height:2rem;border-radius:0.5rem;background:#0F172A;border:1px solid #1E293B;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:white;flex-shrink:0;">
                                    {{ $match ? $match->skor_tim1 : '?' }}
                                </div>
                            </div>
                            
                            <div style="text-align:center;font-size:0.625rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.25em;font-style:italic;">vs</div>
                            
                            {{-- Team 2 --}}
                            <div style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem;border-radius:0.75rem;border:1px solid #1E293B;background:#020617;box-shadow:0 2px 4px rgba(0,0,0,0.2);{{ ($match && $match->skor_tim2 > $match->skor_tim1) ? 'outline:2px solid #FBBF24;border-color:transparent;' : '' }}">
                                <span style="font-size:0.875rem;{{ ($match && $match->skor_tim2 > $match->skor_tim1) ? 'font-weight:700;color:#fff;' : 'font-weight:600;color:#94A3B8;' }}overflow:hidden;text-overflow:ellipsis;white-space:nowrap;padding-right:0.5rem;max-width:200px;">
                                    {{ $match && $match->tim2 ? $match->tim2->nama_tim : 'TBD' }}
                                </span>
                                <div style="width:2rem;height:2rem;border-radius:0.5rem;background:#0F172A;border:1px solid #1E293B;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:white;flex-shrink:0;">
                                    {{ $match ? $match->skor_tim2 : '?' }}
                                </div>
                            </div>
                        </div>

                        <div style="margin-top:1.25rem;text-align:center;font-size:0.75rem;font-weight:600;color:#64748B;">🏆 Grand Final</div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Prize Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4">
            <div class="flex items-center gap-4 p-5 rounded-3xl" style="background:#0F172A;border:1px solid #1E293B;">
                <div style="width:3rem;height:3rem;border-radius:1rem;background:rgba(245,158,11,0.10);color:#FBBF24;font-weight:800;font-size:1.25rem;display:flex;align-items:center;justify-content:center;border:1px solid rgba(245,158,11,0.20);flex-shrink:0;">1</div>
                <div>
                    <div class="text-sm font-extrabold text-white">Juara I</div>
                    <div class="text-xs font-medium mt-0.5" style="color:#94A3B8;">Rp 2.500.000 + Trofi Utama</div>
                </div>
            </div>
            <div class="flex items-center gap-4 p-5 rounded-3xl" style="background:#0F172A;border:1px solid #1E293B;">
                <div style="width:3rem;height:3rem;border-radius:1rem;background:rgba(255,255,255,0.06);color:#94A3B8;font-weight:800;font-size:1.25rem;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.08);flex-shrink:0;">2</div>
                <div>
                    <div class="text-sm font-extrabold text-white">Runner Up</div>
                    <div class="text-xs font-medium mt-0.5" style="color:#94A3B8;">Rp 1.500.000 + Medali Perak</div>
                </div>
            </div>
            <div class="flex items-center gap-4 p-5 rounded-3xl" style="background:#0F172A;border:1px solid #1E293B;">
                <div style="width:3rem;height:3rem;border-radius:1rem;background:rgba(249,115,22,0.10);color:#FB923C;font-weight:800;font-size:1.25rem;display:flex;align-items:center;justify-content:center;border:1px solid rgba(249,115,22,0.20);flex-shrink:0;">3</div>
                <div>
                    <div class="text-sm font-extrabold text-white">Top Scorer</div>
                    <div class="text-xs font-medium mt-0.5" style="color:#94A3B8;">Rp 500.000 + Sepatu Emas</div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

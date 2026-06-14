@extends('layouts.app')

@section('title', 'Kelola Pengguna - SIGALANG FC')

@section('content')
<div class="min-h-screen bg-slate-50 relative overflow-hidden" x-data="userManager()">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-[-5%] right-[-5%] w-96 h-96 bg-brand/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft"></div>
    <div class="absolute bottom-[-5%] left-[-5%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse-soft" style="animation-delay: 1.5s;"></div>

    {{-- Header --}}
    <div class="bg-white/90 backdrop-blur-xl border-b border-slate-200/80 sticky top-[4.25rem] z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between gap-4 flex-wrap">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="p-2 rounded-xl text-slate-500 hover:bg-slate-100 hover:text-dark transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h1 class="text-xl font-extrabold text-[#0F172A] tracking-tight">Kelola Pengguna</h1>
                    <p class="text-slate-500 text-xs mt-0.5 font-medium">Total: {{ $users->total() }} pengguna terdaftar</p>
                </div>
            </div>
            <button
                @click="openModal('create-user')"
                class="btn-primary text-sm px-5 py-2.5 rounded-xl shadow-brand font-bold transition flex items-center gap-2"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah Pengguna
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 space-y-6 relative z-10">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl px-5 py-4 text-sm font-semibold animate-slide-down shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-2xl px-5 py-4 text-sm font-semibold animate-slide-down shadow-sm">
                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Stats Row --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach(['admin'=>['Administrator','amber'], 'karyawan'=>['Karyawan / Staf','blue'], 'customer'=>['Customer','emerald']] as $role => $cfg)
                @php
                    $statBgClass = $cfg[1] === 'amber' ? 'bg-amber-100/60 border-amber-200 text-amber-700' : ($cfg[1] === 'blue' ? 'bg-blue-100/60 border-blue-200 text-blue-700' : 'bg-emerald-100/60 border-emerald-200 text-emerald-700');
                    $count = \App\Models\User::where('role', $role)->count();
                @endphp
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center font-extrabold text-lg border {{ $statBgClass }}">
                        {{ $count }}
                    </div>
                    <div>
                        <p class="text-sm font-extrabold text-[#0F172A]">{{ $cfg[0] }}</p>
                        <p class="text-xs text-slate-400 font-medium">Terdaftar di database</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Users Table Container --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-modern text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="text-left px-6 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider">Nama</th>
                            <th class="text-left px-6 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider">No. HP</th>
                            <th class="text-left px-6 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider hidden sm:table-cell">Email</th>
                            <th class="text-left px-6 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider">Role</th>
                            <th class="text-center px-6 py-4 font-bold text-slate-400 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full flex items-center justify-center font-extrabold text-xs text-white shadow-sm
                                            @if($user->role === 'admin') bg-gradient-to-br from-amber-500 to-orange-500
                                            @elseif($user->role === 'karyawan') bg-gradient-to-br from-blue-500 to-indigo-500
                                            @else bg-gradient-to-br from-emerald-500 to-teal-500 @endif">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <p class="font-bold text-[#0F172A]">{{ $user->name }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 font-mono text-xs font-semibold">{{ $user->no_hp }}</td>
                                <td class="px-6 py-4 text-slate-500 font-medium hidden sm:table-cell">{{ $user->email ?? '–' }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $badgeClass = $user->role === 'admin'
                                            ? 'status-pending' {{-- Amber --}}
                                            : ($user->role === 'karyawan'
                                                ? 'status-paid' {{-- Emerald/Blue --}}
                                                : 'status-cancelled'); {{-- Slate/Gray --}}
                                        if($user->role === 'karyawan') {
                                            $badgeClass = 'bg-blue-50 text-blue-700 border-blue-200';
                                        } elseif($user->role === 'customer') {
                                            $badgeClass = 'bg-slate-100 text-slate-600 border-slate-200';
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button
                                            @click="openModal('edit-user-{{ $user->id }}')"
                                            class="p-2 text-brand hover:bg-brand/10 rounded-xl transition"
                                            title="Edit"
                                        >
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        @if($user->id !== Auth::id())
                                        <button
                                            @click="openModal('delete-user-{{ $user->id }}')"
                                            class="p-2 text-red-500 hover:bg-red-50 rounded-xl transition"
                                            title="Hapus"
                                        >
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-slate-400 font-medium">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100">
                                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-600">Tidak ada pengguna terdaftar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- ======== MODALS ======== --}}

    {{-- Backdrop --}}
    <div x-show="activeModal !== null"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="closeModal()"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40"
         style="display:none;"></div>

    {{-- Create User Modal --}}
    <div x-show="activeModal === 'create-user'"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 flex items-center justify-center z-50 p-4"
         style="display:none;" @click.stop>
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md border border-slate-100 overflow-hidden animate-slide-up">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-lg font-extrabold text-[#0F172A]">Tambah Pengguna Baru</h2>
                <button @click="closeModal()" class="p-2 rounded-xl hover:bg-slate-100 text-slate-400 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.users.create') }}" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required placeholder="Nama lengkap" class="w-full rounded-2xl border border-slate-200 px-4 py-3.5 focus:border-brand focus:ring-4 focus:ring-brand/10 transition bg-slate-50/50" />
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">No. Handphone <span class="text-red-500">*</span></label>
                    <input type="text" name="no_hp" required placeholder="08xxxxxxxxxx" class="w-full rounded-2xl border border-slate-200 px-4 py-3.5 focus:border-brand focus:ring-4 focus:ring-brand/10 transition bg-slate-50/50" />
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Email</label>
                    <input type="email" name="email" placeholder="contoh@domain.com" class="w-full rounded-2xl border border-slate-200 px-4 py-3.5 focus:border-brand focus:ring-4 focus:ring-brand/10 transition bg-slate-50/50" />
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Kata Sandi <span class="text-red-500">*</span></label>
                    <input type="password" name="password" required placeholder="Min. 8 karakter" class="w-full rounded-2xl border border-slate-200 px-4 py-3.5 focus:border-brand focus:ring-4 focus:ring-brand/10 transition bg-slate-50/50" />
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Role <span class="text-red-500">*</span></label>
                    <select name="role" required class="w-full rounded-2xl border border-slate-200 px-4 py-3.5 focus:border-brand focus:ring-4 focus:ring-brand/10 transition bg-slate-50/50 appearance-none">
                        <option value="customer">Customer</option>
                        <option value="karyawan">Karyawan</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="flex gap-3 pt-3">
                    <button type="button" @click="closeModal()" class="flex-1 px-4 py-3 border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="flex-1 btn-primary py-3 rounded-2xl text-sm font-bold shadow-brand">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit & Delete Modals --}}
    @foreach($users as $user)
        {{-- Edit Modal --}}
        <div x-show="activeModal === 'edit-user-{{ $user->id }}'"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 flex items-center justify-center z-50 p-4"
             style="display:none;" @click.stop>
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md border border-slate-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <h2 class="text-lg font-extrabold text-[#0F172A]">Edit Pengguna</h2>
                    <button @click="closeModal()" class="p-2 rounded-xl hover:bg-slate-100 text-slate-400 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ $user->name }}" required class="w-full rounded-2xl border border-slate-200 px-4 py-3.5 focus:border-brand focus:ring-4 focus:ring-brand/10 transition bg-slate-50/50" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">No. Handphone <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" value="{{ $user->no_hp }}" required class="w-full rounded-2xl border border-slate-200 px-4 py-3.5 focus:border-brand focus:ring-4 focus:ring-brand/10 transition bg-slate-50/50" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3.5 focus:border-brand focus:ring-4 focus:ring-brand/10 transition bg-slate-50/50" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Password Baru <span class="text-slate-400 font-normal">(kosongkan jika tidak diubah)</span></label>
                        <input type="password" name="password" placeholder="••••••••" class="w-full rounded-2xl border border-slate-200 px-4 py-3.5 focus:border-brand focus:ring-4 focus:ring-brand/10 transition bg-slate-50/50" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Role <span class="text-red-500">*</span></label>
                        <select name="role" required class="w-full rounded-2xl border border-slate-200 px-4 py-3.5 focus:border-brand focus:ring-4 focus:ring-brand/10 transition bg-slate-50/50">
                            <option value="customer" @if($user->role === 'customer') selected @endif>Customer</option>
                            <option value="karyawan" @if($user->role === 'karyawan') selected @endif>Karyawan</option>
                            <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option>
                        </select>
                    </div>
                    <div class="flex gap-3 pt-3">
                        <button type="button" @click="closeModal()" class="flex-1 px-4 py-3 border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                        <button type="submit" class="flex-1 btn-primary py-3 rounded-2xl text-sm font-bold shadow-brand">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Delete Modal --}}
        <div x-show="activeModal === 'delete-user-{{ $user->id }}'"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 flex items-center justify-center z-50 p-4"
             style="display:none;" @click.stop>
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-sm p-6 text-center border border-slate-100">
                <div class="w-14 h-14 rounded-2xl bg-red-50 border border-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                <h2 class="text-lg font-extrabold text-slate-900 mb-2">Hapus Pengguna?</h2>
                <p class="text-slate-500 text-sm mb-6 leading-relaxed">Anda yakin ingin menghapus <strong>{{ $user->name }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" class="flex gap-3">
                    @csrf
                    <button type="button" @click="closeModal()" class="flex-1 px-4 py-3 border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-red-600 text-white rounded-2xl text-sm font-bold hover:bg-red-700 transition shadow-sm">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach

</div>

<script>
    function userManager() {
        return {
            activeModal: null,
            openModal(name) {
                this.activeModal = name;
                document.body.style.overflow = 'hidden';
            },
            closeModal() {
                this.activeModal = null;
                document.body.style.overflow = '';
            }
        }
    }
</script>
@endsection

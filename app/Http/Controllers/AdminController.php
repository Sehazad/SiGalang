<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Turnamen;
use App\Models\Pertandingan;
use App\Models\User;
use App\Models\HariLibur;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBooking   = Booking::count();
        $pendingBooking = Booking::where('status_booking', 'pending')->count();
        $paidBooking    = Booking::where('status_booking', 'paid')->count();
        return view('admin.dashboard', compact('totalBooking', 'pendingBooking', 'paidBooking'));
    }

    // ─── Kelola Booking ───────────────────────────────────────────────────────

    public function bookingsIndex(Request $request)
    {
        $status = $request->get('status', 'all');
        $query  = Booking::with(['user', 'lapangan'])->latest();

        if ($status !== 'all') {
            $query->where('status_booking', $status);
        }

        $bookings = $query->paginate(15)->withQueryString();
        return view('admin.bookings.index', compact('bookings', 'status'));
    }

    public function confirmBooking($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status_booking !== 'pending') {
            return back()->with('error', 'Booking ini tidak dalam status pending.');
        }

        $booking->update(['status_booking' => 'paid']);
        return back()->with('success', 'Booking #' . $id . ' berhasil dikonfirmasi.');
    }

    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status_booking === 'cancelled') {
            return back()->with('error', 'Booking sudah dibatalkan sebelumnya.');
        }

        $booking->update(['status_booking' => 'cancelled']);
        return back()->with('success', 'Booking #' . $id . ' berhasil dibatalkan.');
    }

    // ─── Turnamen ─────────────────────────────────────────────────────────────

    public function turnamenIndex()
    {
        $turnamens = Turnamen::with('user', 'pembayarans')->orderBy('created_at', 'desc')->get();
        return view('admin.turnamen.index', compact('turnamens'));
    }

    public function generateBracket($id)
    {
        $turnamen = Turnamen::with('tims')->findOrFail($id);

        if ($turnamen->pertandingans()->count() > 0) {
            return back()->with('error', 'Bracket sudah dibuat untuk turnamen ini.');
        }

        if ($turnamen->tims->count() != 8) {
            return back()->with('error', 'Jumlah tim belum mencapai 8.');
        }

        $tims = $turnamen->tims->shuffle()->values();

        for ($i = 0; $i < 4; $i++) {
            Pertandingan::create([
                'id_turnamen' => $turnamen->id,
                'id_tim1'     => $tims[$i * 2]->id,
                'id_tim2'     => $tims[$i * 2 + 1]->id,
                'babak'       => 'quarter_final',
                'status'      => 'pending',
            ]);
        }

        for ($i = 0; $i < 2; $i++) {
            Pertandingan::create([
                'id_turnamen' => $turnamen->id,
                'babak'       => 'semi_final',
                'status'      => 'pending',
            ]);
        }

        Pertandingan::create([
            'id_turnamen' => $turnamen->id,
            'babak'       => 'final',
            'status'      => 'pending',
        ]);

        $turnamen->update(['status_pengajuan' => 'approved']);

        return back()->with('success', 'Bracket berhasil di-generate secara acak!');
    }

    public function confirmTournamentPayment($id)
    {
        $turnamen = Turnamen::findOrFail($id);

        $alreadyPaid = $turnamen->pembayarans()->where('status_bayar', 'success')->exists();
        if ($alreadyPaid) {
            return back()->with('error', 'Turnamen ini sudah dibayar.');
        }

        $pembayaran = \App\Models\Pembayaran::create([
            'id_booking' => null,
            'id_turnamen' => $turnamen->id,
            'tanggal_bayar' => now(),
            'total_bayar' => $turnamen->biaya_pendaftaran * 8,
            'metode_bayar' => 'cash',
            'status_bayar' => 'success',
        ]);

        // Generate Ticket
        $qrString = 'TKT-' . $pembayaran->id . '-' . time();
        \App\Models\Tiket::create([
            'id_pembayaran' => $pembayaran->id,
            'qr_code' => $qrString,
            'status_checkin' => 'unused'
        ]);

        return back()->with('success', 'Pembayaran turnamen #' . $id . ' berhasil dikonfirmasi.');
    }

    public function rejectTournament($id)
    {
        $turnamen = Turnamen::findOrFail($id);

        if ($turnamen->status_pengajuan === 'rejected') {
            return back()->with('error', 'Turnamen sudah ditolak/dibatalkan sebelumnya.');
        }

        $turnamen->update(['status_pengajuan' => 'rejected']);

        return back()->with('success', 'Pengajuan turnamen #' . $id . ' berhasil ditolak/dibatalkan.');
    }

    // ─── Check-in ─────────────────────────────────────────────────────────────

    public function checkinIndex()
    {
        return view('admin.checkin');
    }

    public function processCheckin(Request $request)
    {
        $qr    = $request->qr_code;
        $tiket = \App\Models\Tiket::where('qr_code', $qr)->first();

        if (!$tiket) {
            return back()->with('error', 'Tiket tidak ditemukan!');
        }

        if ($tiket->status_checkin == 'redeemed') {
            return back()->with('error', 'Tiket sudah digunakan sebelumnya!');
        }

        $tiket->update(['status_checkin' => 'redeemed']);

        return back()->with('success', 'Check-in Berhasil untuk tiket ' . $qr);
    }

    public function usersIndex()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function usersCreate(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20', 'unique:users,no_hp'],
            'email' => ['nullable', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:customer,admin,karyawan'],
        ]);

        $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);

        User::create($validated);

        return back()->with('success', 'User berhasil dibuat.');
    }

    public function usersUpdate(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20', 'unique:users,no_hp,' . $user->id],
            'email' => ['nullable', 'email', 'max:255'],
            'role' => ['required', 'in:customer,admin,karyawan'],
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => ['string', 'min:8']]);
            $validated['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $user->update($validated);

        return back()->with('success', 'User berhasil diperbarui.');
    }

    public function usersDelete(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    // ─── Kelola Tanggal Libur ───────────────────────────────────────────────

    public function liburIndex()
    {
        $liburs = HariLibur::orderBy('tanggal', 'asc')->get();
        return view('admin.libur.index', compact('liburs'));
    }

    public function liburStore(Request $request)
    {
        $request->validate([
            'tanggal'    => ['required', 'date', 'after_or_equal:today'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        $exists = HariLibur::whereDate('tanggal', $request->tanggal)->exists();
        if ($exists) {
            return back()->with('error', 'Tanggal tersebut sudah ditandai sebagai hari libur.');
        }

        HariLibur::create([
            'tanggal'    => $request->tanggal,
            'keterangan' => $request->keterangan,
            'id_user'    => Auth::id(),
        ]);

        return back()->with('success', 'Tanggal libur berhasil ditambahkan.');
    }

    public function liburDelete($id)
    {
        $libur = HariLibur::findOrFail($id);
        $libur->delete();
        return back()->with('success', 'Tanggal libur berhasil dihapus.');
    }
}

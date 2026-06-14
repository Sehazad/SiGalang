<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Alat;
use App\Models\Booking;
use App\Models\HariLibur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create()
    {
        $lapangans = Lapangan::all();
        $alats     = Alat::all();

        // Tanggal libur (60 hari ke depan) untuk dinonaktifkan di date picker
        $liburDates = HariLibur::whereDate('tanggal', '>=', Carbon::today())
            ->whereDate('tanggal', '<=', Carbon::today()->addDays(60))
            ->get()
            ->mapWithKeys(fn ($l) => [$l->tanggal->format('Y-m-d') => $l->keterangan ?? 'Hari Libur'])
            ->toArray();

        return view('booking.create', compact('lapangans', 'alats', 'liburDates'));
    }

    /**
     * Return available hours for a given lapangan & date.
     * If no bookings exist yet, ALL hours (08:00–21:00) are returned.
     */
    public function getJadwalTersedia(Request $request)
    {
        $tanggal     = $request->tanggal;
        $id_lapangan = $request->id_lapangan;

        // Jam operasional 08:00 – 21:00
        $allHours = [];
        for ($i = 8; $i <= 21; $i++) {
            $allHours[] = sprintf('%02d:00', $i);
        }

        // Jika lapangan atau tanggal belum dipilih, kembalikan semua jam
        if (!$tanggal || !$id_lapangan) {
            return response()->json(['available_hours' => $allHours]);
        }

        // Jika tanggal adalah hari libur, tidak ada jadwal tersedia
        if (HariLibur::isLibur($tanggal)) {
            return response()->json([
                'available_hours' => [],
                'is_holiday'      => true,
                'holiday_reason'  => HariLibur::keteranganFor($tanggal),
            ]);
        }

        // Ambil jam yang sudah dibooking (status paid atau pending)
        $bookings = Booking::where('id_lapangan', $id_lapangan)
            ->whereDate('tanggal_main', $tanggal)
            ->whereIn('status_booking', ['paid', 'pending'])
            ->get();

        $bookedHours = [];
        foreach ($bookings as $b) {
            $bookedHours[] = Carbon::parse($b->jam_mulai)->format('H:i');
        }

        $availableHours = array_values(array_diff($allHours, $bookedHours));

        return response()->json(['available_hours' => $availableHours]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_lapangan'  => 'required|exists:lapangans,id',
            'tanggal_main' => 'required|date|after_or_equal:today',
            'jam_mulai'    => 'required',
            'alats'        => 'nullable|array',
        ]);

        // Blokir booking pada hari libur
        if (HariLibur::isLibur($request->tanggal_main)) {
            $alasan = HariLibur::keteranganFor($request->tanggal_main);
            return back()->with('error', 'Tanggal yang dipilih adalah hari libur (' . $alasan . '). Silakan pilih tanggal lain.');
        }

        // Anti-bentrok: cek apakah jam sudah dibooking
        $isBooked = Booking::where('id_lapangan', $request->id_lapangan)
            ->whereDate('tanggal_main', $request->tanggal_main)
            ->whereTime('jam_mulai', '=', Carbon::parse($request->jam_mulai)->format('H:i:s'))
            ->whereIn('status_booking', ['paid', 'pending'])
            ->exists();

        if ($isBooked) {
            return back()->with('error', 'Jadwal sudah dibooking. Silakan pilih jadwal lain.');
        }

        $lapangan   = Lapangan::findOrFail($request->id_lapangan);
        $totalHarga = $lapangan->harga;

        if ($request->has('alats')) {
            $alats = Alat::whereIn('id', $request->alats)->get();
            foreach ($alats as $alat) {
                $totalHarga += $alat->harga_sewa;
            }
        }

        $jamSelesai = Carbon::parse($request->jam_mulai)->addHour()->format('H:i:s');

        $booking = Booking::create([
            'id_user'       => Auth::id(),
            'id_lapangan'   => $request->id_lapangan,
            'tanggal_main'  => $request->tanggal_main,
            'jam_mulai'     => $request->jam_mulai,
            'jam_selesai'   => $jamSelesai,
            'total_harga'   => $totalHarga,
            'status_booking'=> 'pending',
        ]);

        if ($request->has('alats')) {
            $alats = Alat::whereIn('id', $request->alats)->get();
            $attachData = [];
            foreach ($alats as $alat) {
                $attachData[$alat->id] = [
                    'jumlah' => 1,
                    'subtotal' => $alat->harga_sewa
                ];
            }
            $booking->alats()->attach($attachData);
        }

        return redirect()->route('payment.simulasi', ['type' => 'booking', 'id' => $booking->id]);
    }
}

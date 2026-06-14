<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Booking;
use App\Models\Turnamen;
use App\Models\Tiket;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PaymentController extends Controller
{
    public function simulasi(Request $request)
    {
        $type = $request->query('type');
        $id = $request->query('id');
        
        $total = 0;
        if ($type === 'turnamen') {
            $model = Turnamen::findOrFail($id);
            $total = $model->biaya_pendaftaran * 8; // Sesuai kesepakatan kolektif
        } else if ($type === 'booking') {
            $model = Booking::findOrFail($id);
            $total = $model->total_harga;
        } else {
            abort(404);
        }

        return view('payment.simulasi', compact('type', 'id', 'total'));
    }

    public function process(Request $request)
    {
        $type = $request->type;
        $id = $request->id;
        $total = $request->total;

        $pembayaran = Pembayaran::create([
            'id_booking' => $type === 'booking' ? $id : null,
            'id_turnamen' => $type === 'turnamen' ? $id : null,
            'tanggal_bayar' => now(),
            'total_bayar' => $total,
            'metode_bayar' => 'qris',
            'status_bayar' => 'success',
        ]);

        if ($type === 'booking') {
            Booking::where('id', $id)->update(['status_booking' => 'paid']);
        }

        // Generate Ticket
        $qrString = 'TKT-' . $pembayaran->id . '-' . time();
        $tiket = Tiket::create([
            'id_pembayaran' => $pembayaran->id,
            'qr_code' => $qrString,
            'status_checkin' => 'unused'
        ]);

        return redirect()->route('tiket.show', $tiket->id)->with('success', 'Pembayaran Berhasil! Tiket diterbitkan.');
    }
}

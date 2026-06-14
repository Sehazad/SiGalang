<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function show($id)
    {
        $tiket = Tiket::with('pembayaran.booking.lapangan', 'pembayaran.turnamen')->findOrFail($id);
        return view('tiket.show', compact('tiket'));
    }

    public function tiketSaya()
    {
        $userId = auth()->id();
        
        $tikets = Tiket::whereHas('pembayaran.booking', function ($q) use ($userId) {
            $q->where('id_user', $userId);
        })->orWhereHas('pembayaran.turnamen', function ($q) use ($userId) {
            $q->where('id_user', $userId);
        })->with('pembayaran.booking.lapangan', 'pembayaran.turnamen')->latest()->get();
        
        return view('tiket.index', compact('tikets'));
    }
}

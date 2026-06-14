<?php

namespace App\Http\Controllers;

use App\Models\Turnamen;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurnamenController extends Controller
{
    public function create()
    {
        return view('turnamen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_turnamen' => 'required|string',
            'jumlah_tim' => 'required|integer|in:8', // As per design, it's 8 teams
            'tim' => 'required|array|min:8|max:8',
            'tim.*' => 'required|string',
        ]);

        $turnamen = Turnamen::create([
            'id_user' => Auth::id(),
            'nama_turnamen' => $request->nama_turnamen,
            'jumlah_tim' => $request->jumlah_tim,
            'biaya_pendaftaran' => 350000,
            'status_pengajuan' => 'pending',
        ]);

        foreach($request->tim as $nama_tim) {
            Tim::create([
                'id_turnamen' => $turnamen->id,
                'nama_tim' => $nama_tim,
            ]);
        }

        // Redirect to payment simulation
        return redirect()->route('payment.simulasi', ['type' => 'turnamen', 'id' => $turnamen->id]);
    }

    public function bagan($id)
    {
        $turnamen = Turnamen::with(['pertandingans' => function($q) {
            $q->orderBy('id', 'asc');
        }, 'pertandingans.tim1', 'pertandingans.tim2'])->findOrFail($id);
        
        $quarter_finals = $turnamen->pertandingans->where('babak', 'quarter_final')->values();
        $semi_finals = $turnamen->pertandingans->where('babak', 'semi_final')->values();
        $final = $turnamen->pertandingans->where('babak', 'final')->first();
        
        return view('turnamen.bagan', compact('turnamen', 'quarter_finals', 'semi_finals', 'final'));
    }
}

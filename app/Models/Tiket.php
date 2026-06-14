<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $guarded = ['id'];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }

    /**
     * Apakah tiket sudah digunakan?
     */
    public function getUsedAttribute(): bool
    {
        return $this->status_checkin === 'redeemed';
    }

    /**
     * Ambil tipe transaksi (booking / turnamen) dari relasi pembayaran
     */
    public function getTypeAttribute(): string
    {
        if ($this->pembayaran?->id_turnamen) {
            return 'turnamen';
        }
        return 'booking';
    }

    /**
     * Ambil total pembayaran dari relasi pembayaran
     */
    public function getTotalAttribute(): float
    {
        return $this->pembayaran?->total_bayar ?? 0;
    }
}

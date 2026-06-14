<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $guarded = ['id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking');
    }

    public function turnamen()
    {
        return $this->belongsTo(Turnamen::class, 'id_turnamen');
    }

    public function tiket()
    {
        return $this->hasOne(Tiket::class, 'id_pembayaran');
    }
}

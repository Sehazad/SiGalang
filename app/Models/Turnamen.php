<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turnamen extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tims()
    {
        return $this->hasMany(Tim::class, 'id_turnamen');
    }

    public function pertandingans()
    {
        return $this->hasMany(Pertandingan::class, 'id_turnamen');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'id_turnamen');
    }
}

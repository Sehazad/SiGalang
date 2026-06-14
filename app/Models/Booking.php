<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'id_lapangan');
    }

    public function alats()
    {
        return $this->belongsToMany(Alat::class, 'booking_alat', 'booking_id', 'alat_id');
    }
}

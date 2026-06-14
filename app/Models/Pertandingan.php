<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertandingan extends Model
{
    protected $guarded = ['id'];

    public function tim1()
    {
        return $this->belongsTo(Tim::class, 'id_tim1');
    }

    public function tim2()
    {
        return $this->belongsTo(Tim::class, 'id_tim2');
    }
}

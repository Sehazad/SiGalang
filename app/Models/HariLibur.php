<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HariLibur extends Model
{
    protected $table = 'hari_liburs';

    protected $fillable = [
        'tanggal',
        'keterangan',
        'id_user',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Cek apakah suatu tanggal (Y-m-d atau Carbon) adalah hari libur.
     */
    public static function isLibur($tanggal): bool
    {
        $date = $tanggal instanceof Carbon ? $tanggal->toDateString() : Carbon::parse($tanggal)->toDateString();
        return static::whereDate('tanggal', $date)->exists();
    }

    /**
     * Ambil keterangan libur untuk tanggal tertentu (null jika bukan libur).
     */
    public static function keteranganFor($tanggal): ?string
    {
        $date = $tanggal instanceof Carbon ? $tanggal->toDateString() : Carbon::parse($tanggal)->toDateString();
        $libur = static::whereDate('tanggal', $date)->first();
        return $libur?->keterangan ?? ($libur ? 'Hari Libur' : null);
    }
}

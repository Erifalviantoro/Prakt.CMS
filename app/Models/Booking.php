<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

    protected $fillable = [
        'pelanggan_id',
        'kendaraan_id',
        'layanan_id',
        'tanggal_booking',
        'keluhan',
        'status'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

     public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
    public function detailServis()
    {
        return $this->hasOne(DetailServis::class);
    }
}
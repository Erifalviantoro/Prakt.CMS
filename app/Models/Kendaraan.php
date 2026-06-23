<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';

    protected $fillable = [
        'nomor_plat',
        'merk_kendaraan',
        'model_kendaraan',
        'nomor_mesin',
        'tahun_pembuatan'
    ];

    public function bookings()
{
    return $this->hasMany(Booking::class);
}
}

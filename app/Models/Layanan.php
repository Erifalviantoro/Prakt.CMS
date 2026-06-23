<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';

   protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'harga',
        'estimasi_waktu',
        'gambar',
        'status'
    ];
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

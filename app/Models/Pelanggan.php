<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'nama',
        'nomor_telepon',
        'email',
        'alamat',
        'tanggal_pendaftaran',
    ];

    public function bookings()
{
    return $this->hasMany(Booking::class);
}
}

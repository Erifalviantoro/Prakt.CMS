<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;

class DetailServis extends Model
{
    use HasFactory;

    protected $table = 'detail_servis';

    protected $fillable = [
        'booking_id',
        'teknisi_id',
        'jenis_servis',
        'deskripsi',
        'catatan',
        'waktu_mulai',
        'waktu_selesai',
        'estimasi_selesai',
        'biaya_jasa',
        'status_servis',
    ];
    protected $casts = [
    'waktu_mulai' => 'datetime',
    'waktu_selesai' => 'datetime',
    'estimasi_selesai' => 'datetime',
];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class);
    }
    public function penggunaanSparepart()
    {
        return $this->hasMany(PenggunaanSparepart::class, 'detail_servis_id');
    }
    public function transaksi()
{
    return $this->hasOne(Transaksi::class, 'detail_servis_id');
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'detail_servis_id',
        'total_jasa',
        'total_sparepart',
        'total_biaya',
        'status_pembayaran',
        'metode_pembayaran',
    ];

    public function detailServis()
    {
        return $this->belongsTo(DetailServis::class, 'detail_servis_id');
    }
}
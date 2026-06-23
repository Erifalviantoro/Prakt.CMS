<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaanSparepart extends Model
{
    use HasFactory;

    protected $table = 'penggunaan_sparepart';

    protected $fillable = [
    'detail_servis_id',
    'id_sparepart',
    'jumlah',
    'subtotal',
    ];

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'id_sparepart');
    }

    public function detailServis()
    {
        return $this->belongsTo(DetailServis::class, 'detail_servis_id');
    }
}
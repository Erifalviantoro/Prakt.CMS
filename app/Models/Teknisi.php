<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
     protected $table = 'teknisi';

    protected $fillable = [
        'nama',
        'spesialisasi',
        'nomor_telepon',
        'alamat',
    ];
    public function detailServis()
    {
        return $this->hasMany(DetailServis::class, 'teknisi_id');
    }
}

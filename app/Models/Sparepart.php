<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    protected $table = 'sparepart';

    protected $primaryKey = 'id'; // 🔥 INI KUNCI FIX

    protected $fillable = [
        'nama',
        'stok',
        'harga',
    ];
}
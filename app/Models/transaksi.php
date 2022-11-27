<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $fillable = [
        'tanggal_beli', 'nama', 'konser', 'jadwal', 'jumlah'
    ];
}

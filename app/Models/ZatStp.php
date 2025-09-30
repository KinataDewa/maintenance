<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZatStp extends Model
{
    use HasFactory;

    protected $table = 'zat_stp';

    protected $fillable = [
        'tanggal',
        'cek_ph_nilai',
        'cek_ph_foto',
        'klorin_nilai',
        'klorin_foto',
        'bakteri_nilai',
        'bakteri_foto',
        'lumpur_nilai',
        'lumpur_foto',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'np',
        'jenis_perangkat',
        'perangkat_id',
        'nama_perangkat',
        'jenis_kerusakan',
        'tindakan_perbaikan',
        'catatan',
        'foto',
        'user_id',
        'status',
        'biaya',
    ];
}

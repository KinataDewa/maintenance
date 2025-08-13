<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeteranListrikInduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'jam',
        'kwh',
        'kvar',
        'cosphi',
        'wbp',
        'lwbp',
        'total',
        'foto_kwh',
        'foto_cosphi',
        'foto_kvar',
        'foto_wbp',
        'foto_lwbp',
        'foto_total',
        'keterangan',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

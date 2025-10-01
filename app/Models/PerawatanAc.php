<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerawatanAc extends Model
{
    use HasFactory;

    protected $table = 'perawatan_ac';

    protected $fillable = [
        'ac_id',
        'user_id',
        'lokasi',
        'status',
        'pengecekan',
        'perawatan',
        'foto',
        'catatan',
    ];

    protected $casts = [
        'pengecekan' => 'array',
        'perawatan' => 'array',
        'foto' => 'array',
    ];

    public function ac()
    {
        return $this->belongsTo(Ac::class, 'ac_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerawatanPompa extends Model
{
    use HasFactory;

    protected $fillable = [
        'pompa_unit_id', 'pengecekan', 'perawatan', 'foto', 'catatan', 'status', 'user_id'
    ];

    protected $casts = [
        'pengecekan' => 'array',
        'perawatan' => 'array',
        'foto' => 'array',
    ];

    public function pompaUnit()
    {
        return $this->belongsTo(PompaUnit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

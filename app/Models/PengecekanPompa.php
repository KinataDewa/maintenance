<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengecekanPompa extends Model
{
    use HasFactory;

    protected $fillable = [
        'pompa_unit_id',
        'suhu',
        'tekanan',
        'pengecekan',
        'foto',
        'catatan',
        'user_id'
    ];

    protected $casts = [
        'pengecekan' => 'array',
        'foto' => 'array',
    ];

    // Relasi ke tabel pompa_units
    public function pompaUnit()
    {
        return $this->belongsTo(PompaUnit::class, 'pompa_unit_id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

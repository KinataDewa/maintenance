<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerawatanPanel extends Model
{
    use HasFactory;

    protected $table = 'perawatan_panels';

    protected $fillable = [
        'panel_id',
        'pengecekan',
        'perawatan',
        'foto',
        'catatan',
        'status',
        'user_id'
    ];

    protected $casts = [
        'pengecekan' => 'array',
        'perawatan' => 'array',
        'foto' => 'array',
    ];

    // Relasi ke panel
    public function panel()
    {
        return $this->belongsTo(Panel::class, 'panel_id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

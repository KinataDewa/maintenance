<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengecekanPanel extends Model
{
    use HasFactory;

    protected $fillable = [
        'panel_id',
        'pengecekan',
        'foto',
        'catatan',
        'user_id',
        'tegangan',
        'arus',
        'suhu',
        'thermal_imaging',
    ];

    protected $casts = [
        'pengecekan' => 'array',
        'foto' => 'array',
    ];

    public function panel()
    {
        return $this->belongsTo(Panel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

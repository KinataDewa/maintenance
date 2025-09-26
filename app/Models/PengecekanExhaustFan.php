<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengecekanExhaustFan extends Model
{
    use HasFactory;

    protected $fillable = [
        'exhaust_fan_id',
        'user_id',
        'daya_hisap',
        'suhu',
        'pengecekan',
        'foto',
        'catatan',
    ];

    protected $casts = [
        'pengecekan' => 'array',
        'foto' => 'array',
    ];

    public function exhaustFan()
    {
        return $this->belongsTo(ExhaustFan::class, 'exhaust_fan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

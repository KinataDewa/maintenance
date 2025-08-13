<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExhaustFanLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'exhaust_fan_id',
        'status',
        'perawatan',
        'foto_pembersihan',
        'keterangan',
        'tanggal',
        'jam',
        'user_id',
    ];

    public function exhaustFan()
    {
        return $this->belongsTo(ExhaustFan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

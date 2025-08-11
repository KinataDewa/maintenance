<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomTemperatureLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'user_id',
        'titik_1',
        'titik_2',
        'titik_3',
        'foto',
        'waktu_cek',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


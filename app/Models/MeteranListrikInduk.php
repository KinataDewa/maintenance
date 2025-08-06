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
        'foto',
        'keterangan',
        'user_id', // ← Pastikan ini juga ditambahkan
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

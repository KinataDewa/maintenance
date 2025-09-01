<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemakaianAir extends Model
{
    use HasFactory;

    protected $table = 'pemakaian_air';

    protected $fillable = [
        'user_id',
        'sumber_air',
        'meteran',
        'foto',
        'deskripsi',
        'tanggal',
        'waktu',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

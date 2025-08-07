<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checklist extends Model
{
    use HasFactory;

    protected $table = 'checklist';

    protected $fillable = [
        'perangkat_id',
        'user_id',
        'aksi',
        'tanggal',
        'jam',
    ];

    public function perangkat()
    {
        return $this->belongsTo(Perangkat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
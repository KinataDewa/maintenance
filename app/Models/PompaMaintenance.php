<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PompaMaintenance extends Model
{
    use HasFactory;

    protected $table = 'pompa_maintenance';

    protected $fillable = [
        'pompa_unit_id',
        'user_id',
        'voltase',
        'suhu',
        'tekanan',
        'oli',
        'suara',
        'tanggal_perawatan',
    ];

    // Cast kolom tanggal_perawatan ke datetime otomatis
    protected $casts = [
        'tanggal_perawatan' => 'datetime',
    ];

    // Relasi ke PompaUnit
    public function pompa()
    {
        return $this->belongsTo(PompaUnit::class, 'pompa_unit_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeteranListrik extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'kwh',
        'foto',
        'deskripsi',
        'waktu_input',
        'tanggal',
        'jam',
        'user_id', // ⬅️ tambah ini
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); // ⬅️ relasi ke staff/admin
    }
}

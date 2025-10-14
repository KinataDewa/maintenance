<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'jenis_kendala',
        'deskripsi',
        'perangkat_tipe',
        'perangkat_id',
        'perangkat_lainnya',
        'room_id',
        'pic_nama',
        'pic_telp',
        'foto',
        'status',
        'progres', // kolom baru
    ];

    // Relasi ke tabel rooms
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}

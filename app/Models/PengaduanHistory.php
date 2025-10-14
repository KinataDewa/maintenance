<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanHistory extends Model
{
    use HasFactory;

    protected $table = 'pengaduan_histories';

    protected $fillable = [
        'pengaduan_id',
        'updated_by',
        'status_lama',
        'status_baru',
        'progres_lama',
        'progres_baru',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }
}

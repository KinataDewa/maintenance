<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PompaStpLog extends Model
{
    use HasFactory;

    protected $table = 'pompa_stp_logs';

    protected $fillable = [
        'pompa',
        'voltase',
        'suhu',
        'oli',
        'pulling',
        'motor',
        'user_id',
    ];

    // Relasi ke user yang mengisi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

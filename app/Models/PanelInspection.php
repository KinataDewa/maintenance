<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelInspection extends Model
{
    protected $fillable = [
        'panel_id',
        'user_id',
        'kabel_terkupas',
        'mcb_rusak',
        'panel_bersih',
        'baut_terminal',
        'grounding_baik',
        'suhu_mcb',
        'suhu_terminal',
        'mcb_normal',
        'lampu_indikator',
        'panel_tertutup',
        'catatan', // Kolom catatan baru
    ];

    public function panel()
    {
        return $this->belongsTo(Panel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

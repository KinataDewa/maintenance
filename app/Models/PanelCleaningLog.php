<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanelCleaningLog extends Model
{
    protected $table = 'log_pembersihan_panel';

    protected $fillable = [
        'panel_id','user_id',
        'debu_bersih','luar_bersih','dalam_rapi','tidak_ada_sampah',
        'catatan','foto_before','foto_after',
        'tanggal','jam',
    ];

    protected $casts = [
        'debu_bersih' => 'boolean',
        'luar_bersih' => 'boolean',
        'dalam_rapi' => 'boolean',
        'tidak_ada_sampah' => 'boolean',
        'tanggal' => 'date',
    ];

    public function panel()
    {
        return $this->belongsTo(\App\Models\Panel::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

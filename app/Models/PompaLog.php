<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PompaUnit;

class PompaLog extends Model
{
    protected $fillable = [
        'pompa_unit_id', 'meteran', 'deskripsi', 'foto', 'user_id'
    ];

    public function pompa()
    {
        return $this->belongsTo(PompaUnit::class, 'pompa_unit_id');
    }

    public function pompaUnit()
    {
        return $this->belongsTo(PompaUnit::class, 'pompa_unit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
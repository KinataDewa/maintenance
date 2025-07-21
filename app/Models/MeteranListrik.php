<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeteranListrik extends Model
{
    use HasFactory;

    protected $fillable = ['tenant_id', 'kwh', 'foto', 'deskripsi', 'waktu_input'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}


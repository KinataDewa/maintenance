<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = ['aktivitas', 'jam_mulai', 'jam_selesai', 'status'];

    public function logs()
    {
        return $this->hasMany(ChecklistLog::class);
    }
}

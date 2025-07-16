<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistLog extends Model
{
    protected $fillable = ['checklist_id', 'status', 'tanggal'];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'checklist_log_staff');
    }
}

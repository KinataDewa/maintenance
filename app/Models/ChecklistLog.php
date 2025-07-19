<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistLog extends Model
{
    protected $fillable = ['checklist_id', 'status', 'tanggal', 'user_id'];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    
}


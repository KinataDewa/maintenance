<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    protected $fillable = ['name'];

   public function checklists()
{
    return $this->belongsToMany(Checklist::class, 'checklist_staff');
}
public function checklistLogs()
{
    return $this->belongsToMany(ChecklistLog::class, 'checklist_log_staff');
}

}
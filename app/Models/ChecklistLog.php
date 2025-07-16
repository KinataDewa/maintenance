<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'checklist_id',
        'tanggal',
        'staff_1_id',
        'staff_2_id',
        'status',
    ];

    // Relasi ke checklist utama
   public function checklist()
{
    return $this->belongsTo(Checklist::class);
}

public function staff1()
{
    return $this->belongsTo(Staff::class, 'staff_1_id');
}

public function staff2()
{
    return $this->belongsTo(Staff::class, 'staff_2_id');
}

}

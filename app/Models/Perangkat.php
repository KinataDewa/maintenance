<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perangkat extends Model
{
    use HasFactory;

    protected $table = 'perangkat';

    protected $fillable = ['nama'];

    public function checklist()
    {
        return $this->hasMany(Checklist::class);
    }

    public function checklists()
    {
        return $this->hasMany(Checklist::class)->orderBy('created_at', 'desc');
    }
}
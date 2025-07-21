<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function meteranListriks()
    {
        return $this->hasMany(MeteranListrik::class);
    }
}

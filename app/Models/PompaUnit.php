<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PompaUnit extends Model
{
    use HasFactory;
    protected $fillable = [
    'nama_pompa', 'jenis', 'merk', 'tipe', 'kapasitas', 'tekanan'
];
public function logs()
{
    return $this->hasMany(PompaLog::class);
}

}

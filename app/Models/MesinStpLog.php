<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MesinStpLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'mesin',
        'oli',
        'vanbelt',
        'suhu',
        'suara',
        'user_id',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

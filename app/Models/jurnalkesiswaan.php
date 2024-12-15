<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class jurnalkesiswaan extends Model
{
    use Uuid;

    protected $table = 'jurnalkesiswaan';

    protected $fillable = [
        'program',
        'waktu_realisasi',
        'evaluasi'
    ];
}

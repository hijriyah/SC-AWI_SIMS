<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class KalenderAkademik extends Model
{
    use Uuid;

    protected $fillable = [
        'title',
        'description',
        'start',
        'end'
    ];

}

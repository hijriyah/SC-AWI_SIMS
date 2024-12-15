<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class semester extends Model
{
    use Uuid;

    protected $table = 'semester';

    protected $fillable = [
        'semester',
        'semester_huruf',
        'aktif'
    ];
}

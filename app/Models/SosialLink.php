<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class SosialLink extends Model
{
    use Uuid;

    protected $fillable = [
        'facebook',
        'linkedin',
        'twitter',
        'google'
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ekstrakurikuler extends Model
{
    use Uuid;

    protected $table = 'ekstrakurikuler';

    protected $fillable = [
        'ekstrakurikuler',
        'keterangan'
    ];
}

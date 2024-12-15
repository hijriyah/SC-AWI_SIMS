<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class kategoriarsip extends Model
{
    use Uuid;

    protected $table = 'kategori_arsip';

    protected $fillable = [
        'kategori_arsip',
        'deskripsi'
    ];
}

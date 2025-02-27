<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class ImportFile extends Model
{
    use Uuid;

    protected $fillable = [
        'judul',
        'deskrispi',
        'file'
    ];

}

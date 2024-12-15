<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\kelas;
use App\Traits\Uuid;

class ebooks extends Model
{
   use Uuid;

    protected $table = 'ebooks';

    protected $fillable = [
        'nama',
        'author',
        'id_kelas',
        'authority',
        'coverfoto',
        'file'
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }
}

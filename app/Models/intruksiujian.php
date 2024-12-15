<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\mulaiujian;

class intruksiujian extends Model
{
    use Uuid;

    protected $table = 'instruksi_ujian';

    protected $fillable = [
        'judul',
        'konten'
    ];

    public function mulaiujian()
    {
        return $this->hasMany(mulaiujian::class, 'id_instruksi_ujian', 'id');
    }

}

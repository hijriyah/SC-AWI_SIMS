<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\kelas;

class izinkenaikankelas extends Model
{
    protected $table = 'izin_kenaikan_kelas';

    protected $fillable = [
        'id_kelas',
        'status'
    ];

    public function kelas()
    {
        return $this->hasMany(kelas::class, 'id_kelas');
    }
    
}

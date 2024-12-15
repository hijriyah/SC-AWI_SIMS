<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\tahunajaran;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\bimbingankonseling;

class databimbingankonseling extends Model
{
    protected $table = 'data_bimbingan_konseling';

    protected $fillable = [
        'id_tahun_ajaran',
        'id_kelas',
        'id_siswa',
        'id_bimbingan_konseling',
        'saran'
        
    ];

    public function tahunajaran()
    {
        return $this->hasOne(tahunajaran::class, 'id_tahun_ajaran');
    }

    public function kelas()
    {
        return $this->hasMany(kelas::class, 'id_kelas');
    }

    public function siswa()
    {
        return $this->hasMany(siswa::class, 'id_siswa', 'id');
    }

    public function bimbingankonseling()
    {
        return $this->hasMany(bimbingankonseling::class, 'id_bimbingan_konseling');
    }
}

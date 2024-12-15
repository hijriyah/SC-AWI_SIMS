<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\siswa;
use App\Models\semester;
use App\Models\tahunajaran;
use App\Models\kategoripenilaiansikap;

class nilaisikap extends Model
{
    protected $table = 'nilai_sikap';

    protected $fillable = [
        'id_siswa',
        'id_tahun_ajaran',
        'id_semester',
        'id_kategori_penilaian_sikap',
        'predikat',
        'deksripsi'
    ];

    
    public function siswa()
    {
        return $this->hasMany(siswa::class, 'id_siswa', 'id');
    }
    public function tahunajaran()
    {
        return $this->hasOne(tahunajaran::class, 'id_tahun_ajaran');
    }
    public function semester()
    {
        return $this->hasOne(semester::class, 'id_semester');
    }
    public function kategoripenilaiansikap()
    {
        return $this->hasOne(kategoripenilaiansikap::class, 'id_kategori_penilaian_sikap');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\siswa;
use App\Models\semester;
use App\Models\tahunajaran;
use App\Models\matapelajaran;
use App\Models\kkm;
use App\Models\catatanwalikelas;

class nilairaport extends Model
{
    protected $table = 'nilai_raport';

    protected $fillable = [
        'id_siswa',
        'id_tahun_ajaran',
        'id_semester',
        'id_mata_pelajaran',
        'kkm',
        'nilai_akhir',
        'id_kkm',
        'rata_rata_permapel',
        'id_catatan_walikelas'
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
    public function matapelajaran()
    {
        return $this->hasMany(matapelajaran::class, 'id_mata_pelajaran');
    }
    public function kkm()
    {
        return $this->hasOne(kkm::class, 'id_kkm');
    }
    public function catatanwalikelas()
    {
        return $this->hasOne(catatanwalikelas::class, 'id_catatan_walikelas');
    }
}

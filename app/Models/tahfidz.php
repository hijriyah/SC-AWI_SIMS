<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\guru;
use App\Models\tahunajaran;
use App\Models\kriteriapenilaianalquran;

class tahfidz extends Model
{
    protected $table = 'tahfidz';

    protected $fillable = [
        'id_kelas',
        'id_siswa',
        'id_guru',
        'id_tahun_ajaran',
        'semester',
        'surah',
        'hasil_perkembangan',
        'id_kriteria_penilaian_alquran',
        'kompetensi'
    ];

    
    public function kelas()
    {
        return $this->hasMany(kelas::class, 'id_kelas');
    }
    public function siswa()
    {
        return $this->hasMany(siswa::class, 'id_siswa', 'id');
    }

    public function guru()
    {
        return $this->hasMany(guru::class, 'id_guru', 'id');
    }

    public function tahunajaran()
    {
        return $this->hasOne(tahunajaran::class, 'id_tahun_ajaran');
    }
    public function kriteriapenilaianalquran()
    {
        return $this->hasOne(kriteriapenilaianalquran::class, 'id_kriteria_penilaian_alquran');
    }
}

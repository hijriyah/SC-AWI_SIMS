<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\kategoritahsin;
use App\Models\guru;
use App\Models\tahunajaran;

class pemetaantahsin extends Model
{
    protected $table = 'pemetaan_tahsin';

    protected $fillable = [
        'id_kelas',
        'id_siswa',
        'id_kategori_tahsin',
        'id_guru',
        'id_tahun_ajaran',
        'semester',
    ];

    public function kelas()
    {
        return $this->hasMany(kelas::class, 'id_kelas');
    }
    public function siswa()
    {
        return $this->hasMany(siswa::class, 'id_siswa', 'id');
    }

    public function kategoritahsin()
    {
        return $this->hasOne(kategoritahsin::class, 'id_kategori_tahsin');
    }

    public function guru()
    {
        return $this->hasMany(guru::class, 'id_guru', 'id');
    }

    public function tahunajaran()
    {
        return $this->hasOne(tahunajaran::class, 'id_tahun_ajaran');
    }
}

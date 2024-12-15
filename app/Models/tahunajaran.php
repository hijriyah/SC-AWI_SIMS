<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\penugasansiswa;
use App\Models\silabus;
use App\Models\jadwalujian;
use App\Models\mulaiujian;
use App\Models\jurnalbk;
use App\Models\jurnalkelas;
use App\Models\siswa;
use App\Models\komplain;


class tahunajaran extends Model
{
    use Uuid;

    protected $table = 'tahun_ajaran';

    protected $fillable = [
        'tipe_sekolah',
        'tahun_ajaran',
        'judul',
        'tanggal_mulai',
        'tanggal_selesai',
        'semester'
    ];


    public function penugasansiswa()
    {
        return $this->hasMany(penugasansiswa::class, 'id_tahun_ajaran');
    }

    public function silabus()
    {
        return $this->hasOne(silabus::class , 'id_tahun_ajaran');
    }

    public function jadwalujian()
    {
        return $this->hasOne(jadwalujian::class, 'id_tahun_ajaran');
    }

    public function mulaiujian()
    {
        return $this->hasMany(mulaiujian::class, 'id_tahun_ajaran', 'id');
    }

    public function jurnalbk()
    {
        return $this->hasMany(jurnalbk::class, 'id', 'id_tahun_ajaran');
    }

    public function jurnalkelas()
    {
        return $this->hasMany(jurnalkelas::class, 'id', 'id_tahun_ajaran');
    }

    public function siswa()
    {
        return $this->hasOne(siswa::class, 'id_tahun_ajaran');
    }

    public function komplain()
    {
        return $this->hasMany(komplain::class, 'id_tahun_ajaran', 'id');
    }

}

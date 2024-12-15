<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\materimatapelajaran;
use App\Models\materiqa;
use App\Models\jadwalujian;
use App\Models\section;
use App\Models\mulaiujian;
use App\Models\JadwalPelajaran;
use App\Models\jurnalbk;
use App\Models\tugassiswa;
use App\Models\siswa;

class kelas extends Model
{
    use Uuid;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'kelas_angka',
        'id_guru',
        'maksimal_siswa',
        'catatan'
    ];

    public function siswa()
    {
        return $this->hasOne(siswa::class, 'id_kelas');
    }

    public function materimatapelajaran()
    {
        return $this->hasMany(materimatapelajaran::class, 'id_kelas');
    }

    public function materiqa()
    {
        return $this->hasMany(materiqa::class, 'id_kelas');
    }

    public function jadwalujian()
    {
        return $this->hasOne(jadwalujian::class, 'id_kelas');
    }

    public function section()
    {
        return $this->hasMany(section::class, 'id_kelas');
    }

    public function guru()
    {
        return $this->belongsTo(guru::class, 'id_guru');
    }

    public function mulaiujian()
    {
        return $this->hasOne(mulaiujian::class, 'id_kelas');
    }

    public function jadwalpelajaran()
    {
        return $this->hasMany(jadwalpelajaran::class, 'id_kelas', 'id');
    }
    
    public function jurnalbk()
    {
        return $this->hasMany(jurnalbk::class, 'id', 'id_kelas');
    }

    public function tugassiswa()
    {
        return $this->hasMany(tugassiswa::class, 'id', 'id_kelas');
    }


}

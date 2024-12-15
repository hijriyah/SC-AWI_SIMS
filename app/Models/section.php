<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\guru;
use App\Models\kelas;
use App\Models\tugassiswa;
use App\Models\jadwalujian;
use App\Models\mulaiujian;
use App\Models\siswa;

class section extends Model
{
    use Uuid;

    protected $table = 'section';

    protected $fillable = [
        'section',
        'kategori',
        'kapasitas',
        'id_kelas',
        'id_guru',
        'catatan',
    ];

    public function guru()
    {
        return $this->belongsTo(guru::class, 'id_guru');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas', 'id');
    }

    public function tugassiswa()
    {
        return $this->hasOne(tugassiswa::class, 'id_tugas_guru');
    }

    public function jadwalujian()
    {
        return $this->hasOne(jadwalujian::class, 'id_jadwal_ujian');
    }

    public function mulaiujian()
    {
        return $this->hasMany(mulaiujian::class, 'id_mulai_ujian', 'id');
    }

    public function siswa()
    {
        return $this->hasOne(siswa::class, 'id_section');
    }
}

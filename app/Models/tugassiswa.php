<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\kelas;
use App\Models\tahunajaran;
use App\Models\section;
use App\Models\matapelajaran;
use App\Models\siswa;
use App\Traits\Uuid;

class tugassiswa extends Model
{
    use Uuid;

    protected $table = 'tugas_siswa';

    protected $fillable = [
        'judul',
        'deskripsi',
        'deadline',
        'file',
        "jawaban",
        'id_siswa',
        'id_kelas',
        'id_tahun_ajaran',
        'id_section',
        'id_mata_pelajaran'
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }

    public function section()
    {
        return $this->belongsTo(section::class, 'id_section');
    }

    public function matapelajaran()
    {
        return $this->belongsTo(matapelajaran::class, 'id_mata_pelajaran');
    }

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'id_siswa');
    }
}

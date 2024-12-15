<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\kelas;
use App\Models\section;
use App\Models\matapelajaran;
use App\Models\intruksiujian;
use App\Models\tahunajaran;
use App\Models\guru;
use App\Models\banksoal;

class mulaiujian extends Model
{
    use Uuid;

    protected $table = 'ujian';

    protected $fillable = [
        'nama',
        'deskripsi',
        'id_kelas',
        'id_section',
        'id_mata_pelajaran',
        'id_instruksi_ujian',
        'id_tahun_ajaran',
        'no_tipe_ujian',
        'hari',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'durasi',
        'random',
        'public',
        'status',
        'id_guru',
        'poin_benar',
        'total_poin',
        'persentase',
        'id_bank_soal',
        'gambar',
        'publish'
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }

    public function section()
    {
        return $this->belongsTo(section::class, 'id_section');
    }

    public function matapelajaran()
    {
        return $this->belongsTo(matapelajaran::class, 'id_mata_pelajaran');
    }
    
    public function intruksiujian()
    {
        return $this->belongsTo(intruksiujian::class, 'id_instruksi_ujian');
    }

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }

    public function guru()
    {
        return $this->belongsTo(guru::class, 'id_guru');
    }

    public function banksoal()
    {
        return $this->belongsTo(banksoal::class, 'id_bank_soal');
    }

}

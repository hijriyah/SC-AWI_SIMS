<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\rencanaujian;
use App\Models\kelas;
use App\Models\section;
use App\Models\matapelajaran;
use App\Models\tahunajaran;

class jadwalujian extends Model
{
    use Uuid;

    protected $table = 'jadwal_ujian';

    protected $fillable = [
        'id_rencana_ujian',
        'id_kelas',
        'id_section',
        'id_mata_pelajaran',
        'id_tahun_ajaran',
        'tanggal_ujian',
        'ujian_dari',
        'ujian_untuk',
        'ruangan',
    ];
    
    public function rencanaujian()
    {
        return $this->belongsTo(rencanaujian::class, 'id_rencana_ujian');
    }

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

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }


}

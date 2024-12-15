<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\matapelajaran;
use App\Models\tahunajaran;

class jurnalkelas extends Model
{
    use Uuid;

    protected $table = 'jurnalkelas';

    protected $fillable = [
        'jam',
        'jam_mulai',
        'jam_selesai',
        'tanggal',
        'id_mata_pelajaran',
        'id_tahun_ajaran',
        'materi_ajar',
        'siswa_hadir',
        'siswa_tidak_hadir',
        'status',
        'class'
    ];

    public function matapelajaran()
    {
        return $this->belongsTo(matapelajaran::class, 'id_mata_pelajaran');
    }

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }
}

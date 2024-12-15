<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\tahunajaran;
use App\Models\kelas;
use App\Models\bimbingankonseling;

class jurnalbk extends Model
{
    use Uuid;

    protected $table = 'jurnalbk';

    protected $fillable = [
        'id_tahun_ajaran',
        'semester',
        'bulan',
        'id_kelas',
        'minggu_ke',
        'tanggal_kegiatan',
        'sasaran_kegiatan',
        'id_bimbingan_konseling',
        'hasil_capai'
        
    ];

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }

    public function bimbingankonseling()
    {
        return $this->belongsTo(bimbingankonseling::class, 'id_bimbingan_konseling');
    }
}

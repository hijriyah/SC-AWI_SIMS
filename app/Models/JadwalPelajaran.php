<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\guru;
use App\Models\kelas;
use App\Models\matapelajaran;

class JadwalPelajaran extends Model
{
    use Uuid;

    protected $fillable = [
        'id_guru',
        'id_kelas',
        'id_mata_pelajaran',
        'waktu_mulai',
        'waktu_selesai',
    ];

    public function guru()
    {
        return $this->belongsTo(guru::class, 'id_guru');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }
    
    public function matapelajaran()
    {
        return $this->belongsTo(matapelajaran::class, 'id_mata_pelajaran');
    }


}

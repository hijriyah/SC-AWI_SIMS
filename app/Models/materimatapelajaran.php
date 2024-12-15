<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\kelas;
use App\Models\matapelajaran;
use App\Models\tahunajaran;

class materimatapelajaran extends Model
{
    use Uuid;

    protected $table = 'materi_mata_pelajaran';
    
    protected $fillable = [
        'id_tahun_ajaran',
        'id_kelas',
        'id_mata_pelajaran',
        'materi',
        'deskripsi',
        'author',
        'file'        
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }
    
    public function matapelajaran()
    {
        return $this->belongsTo(matapelajaran::class, 'id_mata_pelajaran');
    }
}

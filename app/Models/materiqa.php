<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\kelas;
use App\Models\tahunajaran;

class materiqa extends Model
{
    use Uuid;

    protected $table = 'materi_qa';
    
    protected $fillable = [
        'id_tahun_ajaran',
        'id_kelas',
        'materi',
        'kompetensi',
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
}

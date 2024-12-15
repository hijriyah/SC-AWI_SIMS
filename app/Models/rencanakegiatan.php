<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\tahunajaran;

class rencanakegiatan extends Model
{
    use Uuid;

    protected $table = 'rencana_kegiatan';

    protected $fillable = [
        'id_tahun_ajaran',
        'nama_kegiatan',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi_kegiatan',
        'file'
    ];

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tahunajaran;
use App\Traits\Uuid;

class event extends Model
{
    use Uuid;

    protected $table = 'event';

    protected $fillable = [
        'id_tahun_ajaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_mulai',
        'waktu_selesai',
        'judul',
        'deskripsi',
        'file',
        'status'
        
    ];

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }
}

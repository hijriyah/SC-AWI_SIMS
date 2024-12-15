<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\tahunajaran;

class pelanggaran extends Model
{
    protected $table = 'pelanggaran';

    protected $fillable = [
        'id_tahun_ajaran',
        'jenis_pelanggaran',
        'deskripsi',
        'poin_pelanggaran'
    ];

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }
}

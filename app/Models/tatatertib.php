<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\tahunajaran;

class tatatertib extends Model
{
    protected $table = 'tata_tertib';

    protected $fillable = [
        'id_tahun_ajaran',
        'jenis_tata_tertib',
        'deskripsi'
    ];

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }
}

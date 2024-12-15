<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\tahunajaran;
use App\Models\jurnalbk;

class bimbingankonseling extends Model
{
    use Uuid;

    protected $table = 'bimbingan_konseling';

    protected $fillable = [
        'id_tahun_ajaran',
        'jenis_konseling',
        'deskripsi'
    ];

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }

    public function jurnalbk()
    {
        return $this->hasMany(jurnalbkL::class, 'id', 'id_bimbingan_konseling');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\guru;
use App\Traits\Uuid;
use App\Models\banksoal;
use App\Models\mulaiujian;
use App\Models\JadwalPelajaran;
use App\Models\jurnalkelas;

class matapelajaran extends Model
{
    use Uuid;

    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'tipe_mata_pelajaran',
        'mata_pelajaran',
        'kode_mata_pelajaran',
        'id_guru'
    ];

    public function guru()
    {
        return $this->belongsTo(guru::class, 'id_guru');
    }

    public function banksoal()
    {
        return $this->hasMany(banksoal::class, 'id_mata_pelajaran', 'id');
    }

    public function mulaiuijan()
    {
        return $this->hasOne(mulaiuijan::class, 'id_mata_pelajaran');
    }

    public function jadwalpelajaran()
    {
        return $this->hasMany(jadwalpelajaran::class, 'id_mata_pelajaran', 'id');
    }

    public function jurnalkelas()
    {
        return $this->hasMany(jurnalkelas::class, 'id_mata_pelajaran', 'id');
    }

}

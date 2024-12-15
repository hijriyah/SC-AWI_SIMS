<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\siswa;
use App\Models\matapelajaran;

class nilaiumum extends Model
{
    protected $table = 'nilai_umum';

    protected $fillable = [
        'id_siswa',
        'id_mata_pelajaran',
        'nilai_uas',
        'nilai_tugas',
        'nilai_uh'
    ];

    
    public function siswa()
    {
        return $this->hasMany(siswa::class, 'id_siswa', 'id');
    }
    public function matapelajaran()
    {
        return $this->hasOne(matapelajaran::class, 'id_mata_pelajaran');
    }
}

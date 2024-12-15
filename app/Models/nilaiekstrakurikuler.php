<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\siswa;
use App\Models\semester;
use App\Models\tahunajaran;
use App\Models\ekstrakurikuler;

class nilaiekstrakurikuler extends Model
{
    protected $table = 'nilai_ekstrakurikuler';

    protected $fillable = [
        'id_ekstrakurikuler',
        'id_siswa',
        'id_tahun_ajaran',
        'id_semester',
        'nilai',
        'keterangan'
    ];

    
    public function siswa()
    {
        return $this->hasMany(siswa::class, 'id_siswa', 'id');
    }
    public function tahunajaran()
    {
        return $this->hasOne(tahunajaran::class, 'id_tahun_ajaran');
    }
    public function semester()
    {
        return $this->hasOne(semester::class, 'id_semester');
    }
    public function ekstrakurikuler()
    {
        return $this->hasOne(ekstrakurikuler::class, 'id_ekstrakurikuler');
    }
}

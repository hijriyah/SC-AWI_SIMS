<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\siswa;
use App\Models\semester;
use App\Models\tahunajaran;

class juaraumum extends Model
{
    protected $table = 'juara_umum';

    protected $fillable = [
        'id_siswa',
        'id_tahun_ajaran',
        'id_semester',
        'jumlah_nilai',
        'rata_rata_nilai',
        'juara',
        'tipe_juara'
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
}

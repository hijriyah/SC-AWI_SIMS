<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\siswa;
use App\Models\semester;
use App\Models\tahunajaran;

class jumlahketidakhadiran extends Model
{
    protected $table = 'jumlah_ketidakhadiran';

    protected $fillable = [
        'id_siswa',
        'id_tahun_ajaran',
        'id_semester',
        'sakit',
        'izin',
        'tanpa_keterangan',
        'terlambat'
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

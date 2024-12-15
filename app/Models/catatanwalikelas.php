<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\siswa;
use App\Models\semester;
use App\Models\tahunajaran;

class catatanwalikelas extends Model
{
    protected $table = 'catatan_walikelas';

    protected $fillable = [
        
        'id_tahun_ajaran',
        'id_semester',
        'id_siswa',
        'catatan'
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

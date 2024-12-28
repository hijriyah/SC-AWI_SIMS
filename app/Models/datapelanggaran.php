<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\tahunajaran;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\pelanggaran;
use App\Models\sanksipelanggaran;

class datapelanggaran extends Model
{
    use Uuid;
    
    protected $table = 'data_pelanggaran';

    protected $fillable = [
        'id_tahun_ajaran',
        'id_kelas',
        'id_siswa',
        'id_pelanggaran',
        'id_sanksi_pelanggaran',
        'subtotal_poin',
        'total_poin'
        
    ];

    public function tahunajaran()
    {
        return $this->hasOne(tahunajaran::class, 'id_tahun_ajaran');
    }

    public function kelas()
    {
        return $this->hasMany(kelas::class, 'id_kelas');
    }

    public function siswa()
    {
        return $this->hasMany(siswa::class, 'id_siswa', 'id');
    }

    public function pelanggaran()
    {
        return $this->hasMany(pelanggaran::class, 'id_pelanggaran');
    }

    public function sanksipelanggaran()
    {
        return $this->hasOne(sanksipelanggaran::class, 'id_sanksi_pelanggaran');
    }
}

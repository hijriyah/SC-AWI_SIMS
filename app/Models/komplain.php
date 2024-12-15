<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\staff;
use App\Models\siswa;
use App\Models\orangtua;
use App\Models\tahunajaran;

class komplain extends Model
{
    use Uuid;

    protected $fillable = [
        'judul', 
        'id_staff',
        'id_siswa',
        'id_orangtua',
        'id_tahun_ajaran',
        'deskripsi',
        'lampiran'
    ];

    public function staff()
    {
        return $this->belongsTo(staff::class, 'id_staff');
    }

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'id_siswa');
    }

    public function orangtua()
    {
        return $this->belongsTo(orangtua::class, 'id_orangtua');
    }

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }



}

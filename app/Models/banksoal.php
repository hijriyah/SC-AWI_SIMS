<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\kategorisoal;
use App\Models\orangtua;
use App\Models\matapelajaran;
use App\Models\mulaiujian;

class banksoal extends Model
{
    use Uuid;

    protected $table = 'bank_soal';

    protected $fillable = [
        'soal',
        'penjelasan',
        'level_soal',
        'tipe_soal',
        'id_grup_soal',
        'jumlah_soal',
        'jumlah_pilihan',
        'jawaban_benar',
        'id_orangtua',
        'waktu',
        'mark',
        'petunjuk',
        'file',
        'id_mata_pelajaran'
    ];

    public function kategorisoal()
    {
        return $this->belongsTo(kategorisoal::class, 'id_grup_soal');
    }

    public function orangtua()
    {
        return $this->belongsTo(orangtua::class, 'id_orangtua');
    }

    public function matapelajaran()
    {
        return $this->belongsTo(matapelajaran::class, 'id_mata_pelajaran');
    }

    public function mulaiujian()
    {
        return $this->hasMany(mulaiujian::class , 'id_bank_soal', 'id');
    }


}

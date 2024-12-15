<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\jadwalujian;

class rencanaujian extends Model
{
    use Uuid;

    protected $table = 'rencana_ujian';

    protected $fillable = [
        'rencana_ujian',
        'tanggal',
        'catatan'
    ];

    public function jadwalujian()
    {
        return $this->hasMany(jadwalujian::class, 'id_rencana_ujian');
    }
}

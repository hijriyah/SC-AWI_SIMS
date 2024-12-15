<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\matapelajaran;
use App\Models\guru;
use App\Models\uploadarsip;
use App\Traits\Uuid;

class rekapkelengkapanarsip extends Model
{
    use Uuid;

    protected $table = 'kelengkapan_arsip';

    protected $fillable = [
    	'id_guru',
    	'id_mata_pelajaran',
        'id_upload_arsip',
        'status_kelengkapan'

    ];

    public function uploadarsip()
    {
        return $this->belongsTo(uploadarsip::class, 'id_upload_arsip');
    }

    public function guru()
    {
        return $this->hasMany(guru::class, 'id_guru', 'id');
    }

    public function matapelajaran()
    {
        return $this->belongsTo(matapelajaran::class, 'id_mata_pelajaran');
    }
}

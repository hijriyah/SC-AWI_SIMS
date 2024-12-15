<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\rencanakegiatan;

class galerikegiatan extends Model
{
    use Uuid;

    protected $table = 'galeri_kegiatan';

    protected $fillable = [
        'id_rencana_kegiatan',
        'tanggal',
        'file'
    ];

    public function rencanakegiatan()
    {
        return $this->belongsTo(rencanakegiatan::class, 'id_rencana_kegiatan');
    }
}

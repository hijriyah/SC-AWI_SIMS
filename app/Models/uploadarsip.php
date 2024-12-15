<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\kategoriarsip;
use App\Models\guru;
use App\Traits\Uuid;

class uploadarsip extends Model
{
    use Uuid;

    protected $table = 'upload_arsip';

    protected $fillable = [
    	'id_kategori_arsip',
    	'judul',
        'file',
        'id_guru'

    ];

    public function kategoriarsip()
    {
        return $this->belongsTo(kategoriarsip::class, 'id_kategori_arsip');
    }

    public function guru()
    {
        return $this->hasMany(guru::class, 'id_guru', 'id');
    }
}

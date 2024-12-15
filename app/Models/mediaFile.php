<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\mediaSubF2;

class mediaFile extends Model
{
    use Uuid;

    protected $fillable = [
        'nama',
        'link',
        'file',
        'id_mediaSubF2'
    ];

    public function mediaSubF2()
    {
        return $this->belongsTo(mediaSubF2::class, 'id_mediaSubF2');
    }

}

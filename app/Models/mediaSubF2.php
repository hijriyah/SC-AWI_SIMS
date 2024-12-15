<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\mediaSubF1;
use App\Models\mediaFile;

class mediaSubF2 extends Model
{
    use Uuid;

    protected $table = 'mediaSubF2';

    protected $fillable = [
        'nama',
        'id_mediaSubF1'
    ];

    public function mediaSubF1()
    {
        return $this->belongsTo(mediaSubF1::class, 'id_mediaSubF1');
    }

    public function mediaFile()
    {
        return $this->hasMany(mediaFile::class, 'id_mediaSubF2', 'id');
    }


}

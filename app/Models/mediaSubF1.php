<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\mediaParent;
use App\Models\mediaSubF2;


class mediaSubF1 extends Model
{
    use Uuid;

    protected $table = 'mediaSubF1';

    protected $fillable = [
        'nama',
        'id_mediaParent'
    ];

    public function mediaParent()
    {
        return $this->belongsTo(mediaParent::class, 'id_mediaParent');
    }

    public function mediaSubF2()
    {
        return $this->hasMany(mediaSubF2::class, 'id_mediaSubF1', 'id');
    }

        
}

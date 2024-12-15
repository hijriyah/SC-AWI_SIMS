<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\mediaSubF1;

class mediaParent extends Model
{
    use Uuid;

    protected $table = 'mediaParent';

    protected $fillable = [
        'nama'
    ];

    public function mediaSubF1()
    {
        return $this->hasMany(mediaSubF1::class, 'id_mediaParent', 'id');
    }


}

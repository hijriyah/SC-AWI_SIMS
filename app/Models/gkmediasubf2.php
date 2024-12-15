<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\gkmediasubf1;
use App\Models\gkmediaFile;

class gkmediasubf2 extends Model
{
    use Uuid;

    protected $table = 'gkmediasubf2';

    protected $fillable = [
        'nama',
        'id_gkmediasubf1'
    ];

    public function gkmediaSubF1()
    {
        return $this->belongsTo(gkmediaSubF1::class, 'id_gkmediasubf1');
    }

    public function gkmediaFile()
    {
        return $this->hasMany(gkmediafile::class, 'id_gkmediasubf2', 'id');
    }
}

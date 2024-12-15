<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\gkmediaparent;
use App\Models\gkmediasubf2;

class gkmediasubf1 extends Model
{
    use Uuid;

    protected $table = 'gkmediasubf1';

    protected $fillable = [
        'nama',
        'id_gkmediaparent'
    ];

    public function gkmediaparent()
    {
        return $this->belongsTo(gkmediaparent::class, 'id_gkmediaparent');
    }

    public function gkmediasubf2()
    {
        return $this->hasMany(gkmediasubf2::class, 'id_gkmediasubf1', 'id');
    }
}

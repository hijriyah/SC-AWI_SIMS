<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\gkmediasubf1;

class gkmediaparent extends Model
{
    use Uuid;

    protected $table = 'gkmediaparent';

    protected $fillable = [
        'nama'
    ];

    public function gkmediasubf1()
    {
        return $this->hasMany(gkmediasubf1::class, 'id_gkmediaparent', 'id');
    }
}

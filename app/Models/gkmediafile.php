<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\gkmediasubf2;

class gkmediafile extends Model
{
    use Uuid;

    protected $fillable = [
        'nama',
        'file',
        'id_gkmediasubf2'
    ];

    public function gkmediasubf2()
    {
        return $this->belongsTo(gkmediasubf2::class, 'id_gkmediasubf2');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\banksoal;

class kategorisoal extends Model
{
    use Uuid;

    protected $table = 'grup_soal';

    protected $fillable = [
        'judul'
    ];

    public function banksoal()
    {
        return $this->hasMany(banksoal::class, 'id_grup_soal', 'id');
    }
}

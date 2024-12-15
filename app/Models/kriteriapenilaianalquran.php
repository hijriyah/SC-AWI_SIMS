<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class kriteriapenilaianalquran extends Model
{
    use Uuid;

    protected $table = 'kriteria_penilaian_alquran';

    protected $fillable = [
        'range_nilai',
        'nilai_huruf',
        'deskripsi'
    ];
}

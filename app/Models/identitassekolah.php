<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class identitassekolah extends Model
{
    use Uuid;

    protected $table = 'identitas_sekolah';

    protected $fillable = [
        'nama_sekolah',
        'alamat',
        'kabupaten',
        'provinsi',
        'file',
        'nama_kepala_sekolah',
        'nip_kepala_sekolah'
    ];
}

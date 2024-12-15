<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class lokasibarang extends Model
{
    use Uuid;

    protected $table = 'lokasi_barang';

    protected $fillable = [
        'lokasi_barang',
        'deskripsi',
        'aktif'
    ];
}

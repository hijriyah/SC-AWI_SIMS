<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\barangmasuk;
use App\Models\lokasibarang;
use App\Traits\Uuid;

class barangkeluar extends Model
{
    use Uuid;

    protected $table = 'barang_keluar';

    protected $fillable = [
        'id_barang_masuk',
        'jatuh_tempo',
        'catatan',
        'jumlah_keluar',
        'status',
        'kondisi_barang',
        'id_lokasi_barang',
        'tanggal_keluar',
        'tanggal_masuk'

    ];

    public function barangmasuk()
    {
        return $this->belongsTo(barangmasuk::class, 'id_barang_masuk');
    }

    public function lokasibarang()
    {
        return $this->belongsTo(lokasibarang::class, 'id_lokasi_barang');
    }
}

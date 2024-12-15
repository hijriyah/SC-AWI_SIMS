<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\kategoribarang;
use App\Models\lokasibarang;
use App\Traits\Uuid;

class barangmasuk extends Model
{
    use Uuid;

    protected $table = 'barang_masuk';

    protected $fillable = [
    	'nama_barang_masuk',
    	'serial',
        'deskripsi',
        'manufaktur',
        'brand',
        'nomor_barang',
        'tanggal_masuk',
        'jumlah_masuk',
        'status',
        'kondisi_barang',
        'file',
        'id_kategori_barang',
        'id_lokasi_barang'

    ];

    public function kategoribarang()
    {
        return $this->belongsTo(kategoribarang::class, 'id_kategori_barang');
    }

    public function lokasibarang()
    {
        return $this->belongsTo(lokasibarang::class, 'id_lokasi_barang');
    }
}

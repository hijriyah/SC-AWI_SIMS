<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\pelanggaran;

class sanksipelanggaran extends Model
{
    protected $table = 'sanksi_pelanggaran';

    protected $fillable = [
        'bentuk_sanksi',
        'maksimal_poin',
        'id_pelanggaran',
    ];

    public function pelanggaran()
    {
        return $this->belongsTo(pelanggaran::class, 'id_pelanggaran');
    }
}

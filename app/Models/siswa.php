<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\kelas;
use App\Models\orangtua;
use App\Models\tahunajaran;
use App\Models\section;
use App\Models\komplain;
use App\Models\tugassiswa;;

class siswa extends Authenticatable
{
    use Uuid;

    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'email',
        'no_telp',
        'alamat',
        'id_kelas',
        'id_section',
        'golongan_darah',
        'kebangsaan',
        'negara',
        'nomor_register',
        'tanggal_masuk',
        'id_orangtua',
        'photo',
        'id_tahun_ajaran',
        'username',
        'password',
        'DefaultHash',
        'aktif',
        'role_id'
    ];

    public function attemptWithoutHash($credentials)
    {
        $user = $this->where('username', $credentials['username'])->first();

        if (password_verify($credentials['password'], $user->password)) {

            session([
                'admin_name' => $user->username,
            ]);

            Auth::guard('siswa')->login($user);
            return true;
        }

        return false;
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }

    public function orangtua()
    {
        return $this->belongsTo(orangtua::class, 'id_orangtua');
    }

    public function tahunajaran()
    {
        return $this->belongsTo(tahunajaran::class, 'id_tahun_ajaran');
    }
    
    public function section()
    {
        return $this->belongsTo(section::class, 'id_section');
    }

    public function komplain()
    {
        return $this->hasMany(komplain::class, 'id_siswa', 'id');
    }

    public function tugassiswa()
    {
        return $this->hasMany(tugassiswa::class, 'id_siswa', 'id');
    }


}

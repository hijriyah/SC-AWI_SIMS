<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\section;
use App\Models\matapelajaran;
use App\Models\kelas;
use App\Models\mulaiujian;
use App\Models\JadwalPelajaran;

class guru extends Authenticatable
{
    use Uuid;

    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan',
        'tanggal_bergabung',
        'jenis_kelamin',
        'agama',
        'email',
        'no_telp',
        'alamat',
        'photo',
        //'id_jabatan_guru',
        'username',
        'password',
        'DefaultHash',
        'aktif',
        'warna',
        'role_id'
    ];

    public function attemptHash($credentials)
    {
        $user = $this->where('username', $credentials['username'])->first();

        if (password_verify($credentials['password'], $user->password)) {
            session([
                'admin_name' => $user->username,
            ]);
            Auth::guard('guru')->login($user);
            return true;
        }

        return false;
    }

    public function section()
    {
        return $this->hasOne(section::class, 'id_guru');
    }

    public function matapelajaran()
    {
        return $this->hasMany(matapelajaran::class, 'id_guru', 'id');
    }

    public function kelas()
    {
        return $this->hasOne(kelas::class, 'id_guru');
    }

    public function mulaiujian()
    {
        return $this->hasMany(mulaiujian::class, 'id_guru', 'id');
    }

    public function jadwalpelajaran()
    {
        return $this->hasMany(jadwalpelajaran::class, 'id_guru', 'id');
    }

    

    //public function jabatanguru()
    //{
        //return $this->hasMany(jabatanguru::class, 'id_jabatan_guru', 'id');
    //}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\penugasansiswa;
use App\Models\silabus;
use App\Models\komplain;

class staff extends Authenticatable
{
    use HasFactory, Uuid;

    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan',
        'deskripsi',
        'tanggal_bergabung',
        'jenis_kelamin',
        'agama',
        'no_telp',
        'alamat',
        'aktif',
        'email',
        'username',
        'password',
        'DefaultHash',
        'role_id'
    ];

    public function attemptHash($credentials)
    {
        $user = $this->where('username', $credentials['username'])->first();

        if (password_verify($credentials['password'], $user->password)) {

            session([
                'admin_name' => $user->username,
            ]);
            
            Auth::guard('staff')->login($user);
            return true;
        }

        return false;
    }

    public function penugasansiswa()
    {
        return $this->hasMany(penugasaansiswa::class, 'id_staff');
    }

    public function silabus()
    {
        return $this->hasMany(silabus::class, 'id_staff');
    }

    public function komplain()
    {
        return $this->hasMany(komplain::class, 'id_staff', 'id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\banksoal;
use App\Models\siswa;
use App\Models\komplain;

class orangtua extends Authenticatable
{
    use Uuid;

    protected $fillable = [
        // 'nama',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'email',
        'no_telp',
        'alamat',
        'photo',
        'aktif',
        'username',
        'password',
        'role_id'
    ];

    public function attemptWithoutHash($credentials)
    {
        $user = $this->where('username', $credentials['username'])->first();

        if ($user && $user->password === $credentials['password']) {
            session([
                'admin_name' => $user->username
            ]);

            Auth::guard('orangtua')->login($user);
            return true;
        }

        return false;
    }

    public function banksoal()
    {
        return $this->hasMany(banksoal::class, 'id_orangtua', 'id');
    }

    public function siswa()
    {
        return $this->hasOne(siswa::class, 'id_orangtua');
    }

    public function komplain()
    {
        return $this->hasMany(komplain::class, 'id_orangtua', 'id');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\staff;
use App\Models\guru;
use App\Models\siswa;
use App\Models\orangtua;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login_page()
    {
        return view('Auth.login');
    }

    public function login_process(Request $request)
    {
        // dd($request->all());
        $validation = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'username tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong'
        ]);

        $credentials = $request->only('username', 'password');

        if(isset($credentials))
        {
            // administrator Authentication
            $users = new User;

            // guru authentication
            $guru = new guru;

            // siswa authentication
            $siswa = new siswa;

            // orang tua authentication
            $orangtua = new orangtua;

            if($users->attemptWithoutHash($credentials))
            {
                return redirect()->route('admin_dashboard')->with('success', 'berhasil login');
            }
            elseif($guru->attemptWithoutHash($credentials))
            {
                return redirect()->route('Guru_Dashboard');
            }
            elseif($siswa->attemptWithoutHash($credentials))
            {
                return redirect()->route('Siswa_Dashboard');
            }
            elseif($orangtua->attemptWithoutHash($credentials))
            {
                return redirect()->route('Orangtua_Dashboard');
            }
            else {
                return redirect()->back()->with('error', 'email/password salah');
            }

            // staff Authentication
            // $staff = new staff;
            // if($staff->attemptWithoutHash($credentials))
            // {
            //     return redirect()->route('admin_dashboard');
            // }
            // else {
            //     return redirect()->route('login');
            // }


            // // siswa authentication
            // $siswa = new siswa;
            // if($siswa->attemptWithoutHash($credentials))
            // {
            //     return redirect()->route('Siswa_Dashboard')->with('login berhasil');
            // }
            // else {
            //     return redirect()->route('login');
            // }

            // // orangtua authentication
            // $orangtua = new orangtua;
            // if($orangtua->attemptWithoutHash($credentials))
            // {
            //     return redirect()->route('Orangtua_Dashboard')->with('login berhasil');
            // }
            //   else {
            //     return redirect()->route('login');
            // }

        }
        else {
            return redirect()->back()->fails()->with([
                'error' => 'username/password tidak boleh kosong'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

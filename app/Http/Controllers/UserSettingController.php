<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserSettingController extends Controller
{
    //

    public function index()
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $getUserProfile = User::where('username', $adminSession)->first();

        return view('Pages.pengaturan.pengaturansistem.pengaturansistem', compact(['adminSession', 'specAdmin', 'roleCheck', 'listMenu', 'getUserProfile']));
    }

    public function ModifyUserSetting(Request $request)
    {
        $adminSession = session('Admin_user');
        $getUserData = User::where('username', $adminSession)->first();

        $validation = $request->validate([
            'username' => 'required',
            'confirm_password' => 'required',
            'new_password' => 'required'
        ], [
            'username.required' => 'username tidak boleh kosong',
            'confirm_password.required' => 'confirm password tidak boleh kosong',
            'new_password.required' => 'new password tidak boleh kosong'
        ]);

        if(password_verify($request->confirm_password, $getUserData->password))
        {      
            $getUserData->update([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->new_password),
                'DefaultHash' => hash('sha256', $request->new_password)
            ]);
    
            return redirect()->route('pengaturan_pengaturansistem_page')->with('success', 'password berhasil diubah');
        }
        else {
            return redirect()->route('pengaturan_pengaturansistem_page')->with('error', 'password gagal diubah');
        }


    }
}

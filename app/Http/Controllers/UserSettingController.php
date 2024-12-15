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
            'password' => 'required'
        ], [
            'username.required' => 'username tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong'
        ]);

        $getUserData->update([
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email
        ]);

        return redirect()->route('pengaturan_pengaturansistem_page')->with('success', 'data berhasil disimpan');

    }
}

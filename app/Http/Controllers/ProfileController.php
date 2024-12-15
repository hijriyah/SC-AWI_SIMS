<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\Role;

class ProfileController extends Controller
{
    //

    public function SiswaProfile()
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = siswa::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $dataInfo = siswa::with(['kelas', 'section', 'orangtua', 'tahunajaran'])->where('id', $roleGet->id)->first();

        return view('Pages.admin.guru.master.siswa.info', compact(['adminSession', 'specAdmin', 'listMenu', 'dataInfo']));
    }
}

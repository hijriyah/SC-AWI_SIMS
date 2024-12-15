<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\staff;
use App\Models\guru;
use App\Models\siswa;
use App\Models\orangtua;
use App\Models\JadwalPelajaran;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    //

    public function AdminDashboard()
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;

        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $amountGuru = DB::table('gurus')->count();
        $amountSiswa = DB::table('siswas')->count();
        $amountMataPelajaran = DB::table('mata_pelajaran')->count();
        $amountKelas = DB::table('kelas')->count();
        $amountJadwalPelajaran = JadwalPelajaran::with(['kelas', 'matapelajaran', 'guru'])->get();
        $amountRencanaKegiatan = DB::table('rencana_kegiatan')->get();

        // $roleGet = staff::where('username', session('admin_name'))->first();
        // $roleStatus = Role::find($roleGet->role_id)->name;

        // session([
        //     'PhotoProfile' => $PhotoProfile
        // ]);

        return view('Pages.admin.dashboard', compact(['adminSession', 'specAdmin', 'listMenu', 'amountGuru', 'amountSiswa', 'amountMataPelajaran', 'amountKelas', 'amountJadwalPelajaran', 'amountRencanaKegiatan']));
    }

    public function GuruDashboard()
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);
        $GuruPhotoProfile = $roleGet->photo;

        session([
            'GuruPhotoProfile' => $GuruPhotoProfile
        ]);

        return view('Pages.admin.guru.dashboard', compact(['adminSession', 'listMenu', 'roleStatus', 'specAdmin', 'SectionType']));

    }

    public function SiswaDashboard()
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = siswa::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);
        $PhotoProfile = $roleStatus->photo;
 
        session([
            'SiswaPhotoProfile' => $PhotoProfile
        ]);

        return view('Pages.admin.siswa.dashboard', compact(['adminSession', 'listMenu', 'roleStatus', 'specAdmin']));

    }

    public function OrangtuaDashboard()
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = orangtua::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);
        $PhotoProfile = $roleStatus->photo;
 
        session([
            'OrangtuaPhotoProfile' => $PhotoProfile
        ]);

        return view('Pages.admin.orangtua.dashboard', compact(['adminSession', 'listMenu', 'roleStatus', 'specAdmin']));
    }
}

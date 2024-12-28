<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\staff;
use App\Models\guru;
use App\Models\siswa;
use App\Models\orangtua;
use App\Models\JadwalPelajaran;
use App\Models\databimbingankonseling;
use App\Models\rencanakegiatan;
use App\Models\datapelanggaran;
use App\Models\tugassiswa;
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

        return view('Pages.admin.dashboard', compact([
            'adminSession', 
            'specAdmin', 
            'listMenu', 
            'amountGuru', 
            'amountSiswa', 
            'amountMataPelajaran', 
            'amountKelas', 
            'amountJadwalPelajaran',
            'amountRencanaKegiatan'
        ]));
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

        // amounts
        
        $amountGuru = DB::table('gurus')->count();
        $amountSiswa = DB::table('siswas')->count();
        $amountKelas = DB::table('kelas')->count();
        $amountMataPelajaran = DB::table('mata_pelajaran')->count();
        $amountDataBimbinganKonseling = databimbingankonseling::query()->with(['tahunajaran', 'kelas', 'siswa', 'bimbingankonseling'])->paginate(10);
        $amountRencanaKegiatan = rencanakegiatan::query()->paginate(10);
        $amountDataPelanggaran = datapelanggaran::query()->with(['tahunajaran', 'kelas', 'siswa', 'pelanggaran', 'sanksipelanggaran'])->paginate(10);

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);
        $GuruPhotoProfile = $roleGet->photo;

        session([
            'GuruPhotoProfile' => $GuruPhotoProfile
        ]);

        return view('Pages.admin.guru.dashboard', compact([
            'adminSession', 
            'listMenu', 
            'roleStatus', 
            'specAdmin', 
            'SectionType',
            'amountGuru',
            'amountSiswa',
            'amountMataPelajaran',
            'amountKelas',
            'amountDataBimbinganKonseling',
            'amountRencanaKegiatan',
            'amountDataPelanggaran'
        ]));

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

        $amountGuru = DB::table('gurus')->count();
        $amountSiswa = DB::table('siswas')->count();
        $amountKelas = DB::table('kelas')->count();
        $amountMataPelajaran = DB::table('mata_pelajaran')->count();
        $amountRencanaKegiatan = rencanakegiatan::query()->paginate(10);
        $amountDataPelanggaran = datapelanggaran::where('uuid', $roleGet->uuid)->with(['tahunajaran', 'kelas', 'siswa', 'pelanggaran', 'sanksipelanggaran'])->paginate(10);
        $amountTugasSiswa = tugassiswa::where('id_siswa', $roleGet->id)->with(['siswa', 'kelas', 'tahunajaran', 'section', 'matapelajaran'])->paginate(10);

        session([
            'SiswaPhotoProfile' => $PhotoProfile
        ]);

        return view('Pages.admin.siswa.dashboard', compact([
            'adminSession', 
            'listMenu', 
            'roleStatus', 
            'specAdmin',
            'amountGuru',
            'amountSiswa',
            'amountKelas',
            'amountMataPelajaran',
            'amountRencanaKegiatan',
            'amountDataPelanggaran',
            'amountTugasSiswa'
        ]));

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

        $getStudent = siswa::where('id_orangtua', $roleGet->id)->first();

        $amountGuru = DB::table('gurus')->count();
        $amountSiswa = DB::table('siswas')->count();
        $amountKelas = DB::table('kelas')->count();
        $amountMataPelajaran = DB::table('mata_pelajaran')->count();
        $amountRencanaKegiatan = rencanakegiatan::query()->paginate(10);
        $amountDataPelanggaran = datapelanggaran::where('uuid', $getStudent->id)->with(['tahunajaran', 'kelas', 'siswa', 'pelanggaran', 'sanksipelanggaran'])->paginate(10);
        $amountTugasSiswa = tugassiswa::where('id_siswa', $getStudent->id)->with(['siswa', 'kelas', 'tahunajaran', 'section', 'matapelajaran'])->paginate(10);
        $amountDataBimbinganKonseling = databimbingankonseling::query()->with(['tahunajaran', 'kelas', 'siswa', 'bimbingankonseling'])->paginate(10);
        

        session([
            'OrangtuaPhotoProfile' => $PhotoProfile
        ]);

        return view('Pages.admin.orangtua.dashboard', compact([
            'adminSession', 
            'listMenu', 
            'roleStatus', 
            'specAdmin',
            'amountGuru',
            'amountSiswa',
            'amountKelas',
            'amountMataPelajaran',
            'amountRencanaKegiatan',
            'amountDataPelanggaran',
            'amountTugasSiswa',
            'amountDataBimbinganKonseling'
        ]));
    }
}

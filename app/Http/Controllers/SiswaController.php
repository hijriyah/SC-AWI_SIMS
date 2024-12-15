<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\kelas;
use App\Models\orangtua;
use App\Models\tahunajaran;
use App\Models\section;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\guru;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = siswa::query();
        
        if($request->has('search'))
        {
            $query->where('nama_lengkap', 'like', "%{$request->search}%")

            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('orangtua', function($q) use ($request) {
                $q->where('nama', 'like', "%{$request->search}%");
            })->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            })->orwhereHas('section', function($q) use ($request) {
                $q->where('section', 'like', "%{$request->search}%");
            });
        }

        $dataSiswa = $query->with(['kelas', 'orangtua', 'tahunajaran', 'section'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.master.siswa.partials.table', compact('dataSiswa'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.master.siswa.siswa', compact(['adminSession', 'specAdmin', 'listMenu', 'dataSiswa']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function storePage()
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();
        $dataKelas = kelas::all();
        $dataSection = section::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataOrangtua = orangtua::all();

        return view('Pages.master.siswa.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas', 'dataSection', 'dataTahunAjaran', 'dataOrangtua']));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        //
        // dd($request->all());

        // $validation = $request->validate([
            
        //     'nama_lengkap' => 'required',
        //     'nama_panggilan' => 'required',
        //     'tempat_lahir' => 'required',
        //     'tanggal_lahir' => 'required',
        //     'jenis_kelamin' => 'required',
        //     'agama' => 'required',
        //     'email' => 'required',
        //     'no_telp' => 'required',
        //     'alamat' => 'required',
        //     'id_kelas' => 'required',
        //     'id_section' => 'required',
        //     'golongan_darah' => 'required',
        //     'kebangsaan' => 'required',
        //     'negara' => 'required',
        //     'nomor_register' => 'required',
        //     'tanggal_masuk' => 'required',
        //     'id_orangtua' => 'required',
        //     'photo' => 'required',
        //     'id_tahun_ajaran' => 'required',
        //     'username' => 'required',
        //     'password' => 'required',
        //     'aktif' => 'required'

        // ]);

        $filePath = null;
        if(isset($request->file))
        {
            $file = $request->file('file'); 
            $filePath = $file->store('AdminMasterSiswa', 'public');
        }



        $roleSiswa = Role::where('name', 'Siswa')->first();

        $data = siswa::create([
            
            'nama_lengkap' => $request->nama_lengkap,
            'nama_panggilan' => $request->nama_panggilan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'id_kelas' => $request->id_kelas,
            'id_section' => $request->id_section,
            'golongan_darah' => $request->golongan_darah,
            'kebangsaan' => $request->kebangsaan,
            'negara' => $request->negara,
            'nomor_register' => $request->nomor_register,
            'tanggal_masuk' => $request->tanggal_masuk,
            'id_orangtua' => $request->id_orangtua,
            'photo' => $filePath,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'username' => $request->username,
            'password' => $request->password,
            'aktif' => $request->aktif,
            'role_id' => $roleSiswa->id
            
        ]);
        $data->save();

        return redirect()->route('siswa_master_page')->with('success', 'data siswa berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();
        $dataKelas = kelas::all();
        $dataSection = section::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataOrangtua = orangtua::all();

        $dataEdit = siswa::findByUuid($uuid);

        return view('Pages.master.siswa.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKelas', 'dataSection', 'dataTahunAjaran', 'dataOrangtua']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = siswa::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('siswa_master_page')->with('success', 'data siswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = siswa::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('siswa_master_page')->with('success', 'data siswa berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data siswa tidak ditemukan'
            ]);
        }
    }

    public function index2(Request $request)
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();

        $query = siswa::query();
        
        if($request->has('search'))
        {
            $query->where('nama_lengkap', 'like', "%{$request->search}%")

            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('orangtua', function($q) use ($request) {
                $q->where('nama', 'like', "%{$request->search}%");
            })->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            })->orwhereHas('section', function($q) use ($request) {
                $q->where('section', 'like', "%{$request->search}%");
            });
        }

        $dataSiswa = $query->with(['kelas', 'orangtua', 'tahunajaran', 'section'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.master.siswa.partials.table', compact('dataSiswa'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.guru.master.siswa.siswa', compact(['adminSession', 'specAdmin', 'listMenu', 'dataSiswa', 'SectionType']));
    }
    public function SiswaInfo($uuid)
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();

        $dataInfo = siswa::with(['kelas', 'section', 'orangtua', 'tahunajaran'])->where('uuid', $uuid)->first();

        return view('Pages.admin.guru.master.siswa.info', compact(['adminSession', 'specAdmin', 'listMenu', 'dataInfo', 'SectionType']));
    }

}

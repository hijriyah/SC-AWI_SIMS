<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\kelas;
use App\Models\guru;
use App\Models\siswa;
use App\Models\orangtua;
use App\Models\matapelajaran;

class JadwalPelajaranController extends Controller
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

        $query = JadwalPelajaran::query();
        
        if($request->has('search'))
        {
            $query->whereHas('guru', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            });
        }

        $dataJadwalPelajaran = $query->with(['guru', 'kelas', 'matapelajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.penjadwalan.jadwalpelajaran.partials.table', compact('dataJadwalPelajaran'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.penjadwalan.jadwalpelajaran.jadwalpelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataJadwalPelajaran']));

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
        $dataGuru = guru::all();
        $dataMataPelajaran = matapelajaran::all();

        return view('Pages.penjadwalan.jadwalpelajaran.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas', 'dataGuru', 'dataMataPelajaran']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validation = $request->validate([
            'id_guru' => 'required',
            'id_kelas' => 'required',
            'id_mata_pelajaran' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ], [
            'id_guru.required' => 'guru tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',
            'waktu_mulai.required' => 'waktu mulai tidak boleh kosong',
            'waktu_selesai.required' => 'waktu selesai tidak boleh kosong',
        ]);

        $data = JadwalPelajaran::create([
            'id_guru' => $request->id_guru,
            'id_kelas' => $request->id_kelas,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);
        $data->save();

        return redirect()->route('penjadwalan_jadwalpelajaran_page')->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalPelajaran $jadwalPelajaran)
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
        $dataGuru = guru::all();
        $dataMataPelajaran = matapelajaran::all();
        $dataEdit = JadwalPelajaran::findByUuid($uuid);

        return view('Pages.penjadwalan.jadwalpelajaran.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas', 'dataGuru', 'dataMataPelajaran', 'dataEdit']));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = JadwalPelajaran::findByUuid($uuid);
        $data->update($request->all());
        
        return redirect()->route('penjadwalan_jadwalpelajaran_page')->with('success', 'data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = JadwalPelajaran::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('penjadwalan_jadwalpelajaran_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return redirect()->back()->with('error', 'data tidak ditemukan');
        }

    }
    
    // this for admin guru
    public function index2(Request $request)
    {
        //
        $adminSession = session('admin_name');

       // Guru
       $roleGet = guru::where('username', $adminSession)->first();
       $roleStatus = Role::find($roleGet->role_id);
       $specAdmin = $roleStatus->name;

       $roleCheck = new Role;
       $listMenu = $roleCheck->permissionsId($roleGet->role_id);

       // section type
       $SectionType = guru::with('section')->where('username', $adminSession)->first();


        $query = JadwalPelajaran::query();
        
        if($request->has('search'))
        {
            $query->whereHas('guru', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            });
        }

        $dataJadwalPelajaran = $query->with(['guru', 'kelas', 'matapelajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.penjadwalan.jadwalpelajaran.partials.table', compact('dataJadwalPelajaran'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.guru.penjadwalan.jadwalpelajaran.jadwalpelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataJadwalPelajaran', 'SectionType']));
    }

    // this for admin siswa
    public function index3(Request $request)
    {
        //
        $adminSession = session('admin_name');

       // Guru
       $roleGet = siswa::where('username', $adminSession)->first();
       $roleStatus = Role::find($roleGet->role_id);
       $specAdmin = $roleStatus->name;

       $roleCheck = new Role;
       $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $query = JadwalPelajaran::query();
        
        if($request->has('search'))
        {
            $query->whereHas('guru', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            });
        }

        $dataJadwalPelajaran = $query->with(['guru', 'kelas', 'matapelajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.siswa.penjadwalan.jadwalpelajaran.partials.table', compact('dataJadwalPelajaran'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.siswa.penjadwalan.jadwalpelajaran.jadwalpelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataJadwalPelajaran']));

    }

    // this for admin orangtua
    public function index4(Request $request)
    {
        //
        $adminSession = session('admin_name');

       // orangtua
       $roleGet = orangtua::where('username', $adminSession)->first();
       $roleStatus = Role::find($roleGet->role_id);
       $specAdmin = $roleStatus->name;

       $roleCheck = new Role;
       $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $query = JadwalPelajaran::query();
        
        if($request->has('search'))
        {
            $query->whereHas('guru', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            });
        }

        $dataJadwalPelajaran = $query->with(['guru', 'kelas', 'matapelajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.orangtua.penjadwalan.jadwalpelajaran.partials.table', compact('dataJadwalPelajaran'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.orangtua.penjadwalan.jadwalpelajaran.jadwalpelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataJadwalPelajaran']));

    }

}

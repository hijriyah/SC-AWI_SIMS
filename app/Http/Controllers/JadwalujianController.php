<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jadwalujian;
use App\Models\rencanaujian;
use App\Models\kelas;
use App\Models\guru;
use App\Models\section;
use App\Models\matapelajaran;
use App\Models\tahunajaran;
use App\Models\Role;


class JadwalujianController extends Controller
{
    public function index(Request $request)
    {
    	$adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = jadwalujian::query();
        
        if($request->has('search'))
        {
            $query->whereHas('rencanaujian', function($q) use ($request) {
                $q->where('rencana_ujian', 'like', "%{$request->search}%");
            })->whereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->whereHas('section', function($q) use ($request) {
                $q->where('section', 'like', "%{$request->search}%");
            })->whereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            })->whereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataJadwalUjian = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.ujian.jadwalujian.partials.table', compact('dataJadwalUjian'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.ujian.jadwalujian.jadwalujian', compact(['adminSession', 'specAdmin', 'listMenu', 'dataJadwalUjian']));
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
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();
        $dataRencanaUjian = rencanaujian::all();
        $dataKelas = kelas::all();
        $dataSection = section::all();
        $dataMataPelajaran = matapelajaran::all();
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.ujian.jadwalujian.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataRencanaUjian', 'dataKelas', 'dataSection', 'dataMataPelajaran', 'dataTahunAjaran']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $validation = $request->validate([
            'id_rencana_ujian' => 'required|numeric',
            'id_kelas' => 'required|numeric',
            'id_section' => 'required|numeric',
            'id_mata_pelajaran' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'tanggal_ujian' => 'required',
            'ujian_dari' => 'required',
            'ujian_untuk' => 'required',
            'ruangan' => 'required'
        ], [
            'id_rencana_ujian.required' => 'rencana ujian tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong',
            'id_section.required' => 'section tidak kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'tanggal_ujian.required' => 'tanggal ujian tidak boleh kosong',
            'ujian_dari.required' => 'ujian dari tidak boleh kosong',
            'ujian_untuk.required' => 'ujian untuk tidak boleh kosong',
            'ruangan.required' => 'ruangan tidak boleh kosong'
        ]);

        $data = jadwalujian::create([
            'id_rencana_ujian' => $request->id_rencana_ujian,
            'id_kelas' => $request->id_kelas,
            'id_section' => $request->id_section,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'tanggal_ujian' => $request->tanggal_ujian,
            'ujian_dari' => $request->ujian_dari,
            'ujian_untuk' => $request->ujian_untuk,
            'ruangan' => $request->ruangan
        ]);
        $data->save();

        return redirect()->route('ujian_jadwalujian_page')->with('success', 'data jadwal ujian berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(staff $staff)
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
        $dataRencanaUjian = rencanaujian::all();
        $dataKelas = kelas::all();
        $dataSection = section::all();
        $dataMataPelajaran = matapelajaran::all();
        $dataTahunAjaran = tahunajaran::all();

        $dataEdit = jadwalujian::findByUuid($uuid);

        return view('Pages.ujian.jadwal-ujian.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataRencanaUjian', 'dataKelas', 'dataSection', 'dataMataPelajaran', 'dataTahunAjaran']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = jadwalujian::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('ujian_jadwalujian_page')->with('success', 'data jadwal ujian berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = jadwalujian::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('ujian_jadwalujian_page')->with('success', 'data jadwal ujian berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data jadwal ujian not found'
            ]);
        }
    }

    // this for Admin Guru
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

        $query = jadwalujian::query();
        
        if($request->has('search'))
        {
            $query->whereHas('rencanaujian', function($q) use ($request) {
                $q->where('rencana_ujian', 'like', "%{$request->search}%");
            })->whereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->whereHas('section', function($q) use ($request) {
                $q->where('section', 'like', "%{$request->search}%");
            })->whereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            })->whereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataJadwalUjian = $query->with(['rencanaujian', 'kelas', 'section', 'matapelajaran', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.ujian.jadwalujian.partials.table', compact('dataJadwalUjian'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.guru.ujian.jadwalujian.jadwalujian', compact(['adminSession', 'specAdmin', 'listMenu', 'dataJadwalUjian', 'SectionType']));
    }
    public function storePage2()
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

        $dataRencanaUjian = rencanaujian::all();
        $dataKelas = kelas::all();
        $dataSection = section::all();
        $dataMataPelajaran = matapelajaran::all();
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.admin.guru.ujian.jadwalujian.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRencanaUjian', 'dataKelas', 'dataSection', 'dataMataPelajaran', 'dataTahunAjaran', 'SectionType']));
    }
    public function store2(Request $request)
    {
        //
        // dd($request->all());
        $validation = $request->validate([
            'id_rencana_ujian' => 'required|numeric',
            'id_kelas' => 'required|numeric',
            'id_section' => 'required|numeric',
            'id_mata_pelajaran' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'tanggal_ujian' => 'required',
            'ujian_dari' => 'required',
            'ujian_untuk' => 'required',
            'ruangan' => 'required'
        ], [
            'id_rencana_ujian.required' => 'rencana ujian tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong',
            'id_section.required' => 'section tidak kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'tanggal_ujian.required' => 'tanggal ujian tidak boleh kosong',
            'ujian_dari.required' => 'ujian dari tidak boleh kosong',
            'ujian_untuk.required' => 'ujian untuk tidak boleh kosong',
            'ruangan.required' => 'ruangan tidak boleh kosong'
        ]);

        $data = jadwalujian::create([
            'id_rencana_ujian' => $request->id_rencana_ujian,
            'id_kelas' => $request->id_kelas,
            'id_section' => $request->id_section,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'tanggal_ujian' => $request->tanggal_ujian,
            'ujian_dari' => $request->ujian_dari,
            'ujian_untuk' => $request->ujian_untuk,
            'ruangan' => $request->ruangan
        ]);
        $data->save();

        return redirect()->route('guru_ujian-jadwalujian_page')->with('success', 'data jadwal ujian berhasil disimpan');
    }
    public function edit2($uuid)
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


        $dataRencanaUjian = rencanaujian::all();
        $dataKelas = kelas::all();
        $dataSection = section::all();
        $dataMataPelajaran = matapelajaran::all();
        $dataTahunAjaran = tahunajaran::all();

        $dataEdit = jadwalujian::findByUuid($uuid);

        return view('Pages.admin.ujian.jadwalujian.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEdit', 'dataRencanaUjian', 'dataKelas', 'dataSection', 'dataMataPelajaran', 'dataTahunAjaran', 'SectionType']));
    }
    public function update2(Request $request, $uuid)
    {
        //
        $data = jadwalujian::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('guru_ujian-jadwalujian_page')->with('success', 'data jadwal ujian berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = jadwalujian::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('guru_ujian-jadwalujian_page')->with('success', 'data jadwal ujian berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data jadwal ujian not found'
            ]);
        }
    }
}

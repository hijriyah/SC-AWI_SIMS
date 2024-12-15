<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\kehadiransiswaujian;
use App\Models\tahunajaran;
use App\Models\rencanaujian;
use App\Models\kelas;
use App\Models\section;
use App\Models\matapelajaran;
use App\Models\siswa;

class KehadiranSiswaUjianController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = kehadiransiswaujian::query();
        
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
            })->whereHas('siswa', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            });
        }

        $dataKehadiranSiswaUjian = $query->with(['rencanaujian', 'kelas', 'section', 'matapelajaran', 'tahunajaran', 'siswa'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.ujian.kehadiransiswaujian.partials.table', compact('dataKehadiranSiswaUjian'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.ujian.kehadiransiswaujian.kehadiransiswaujian', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKehadiranSiswaUjian']));
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
        $dataSiswa = siswa::all();


        return view('Pages.ujian.kehadiransiswaujian.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataRencanaUjian', 'dataKelas', 'dataSection', 'dataMataPelajaran', 'dataTahunAjaran', 'dataSiswa']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $validation = $request->validate([
            'id_tahun_ajaran' => 'required|numeric',
            'id_rencana_ujian' => 'required|numeric',
            'id_kelas' => 'required|numeric',
            'id_section' => 'required|numeric',
            'id_mata_pelajaran' => 'required|numeric',
            'tanggal_kehadiran_ujian' => 'required',
            'id_siswa' => 'required|numeric',
            'nama_siswa' => 'required',
            'kehadiran_ujian' => 'required',
            'tahun' => 'required|numeric',
            'e_extra' => 'required'

        ], [

        	'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'id_rencana_ujian.required' => 'rencana ujian tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong',
            'id_section.required' => 'section tidak kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',
            'tanggal_kehadiran_ujian.required' => 'tanggal kehadiran ujian tidak boleh kosong',
            'id_siswa.required' => 'siswa tidak boleh kosong',
            'nama_siswa.required' => 'nama siswa tidak boleh kosong',
            'kehadiran_ujian.required' => 'kehadiran ujian tidak boleh kosong',
            'tahun.required' => 'tahun dari tidak boleh kosong',
            'tahun.numeric' => 'tahun harus angka',
            'e_extra.required' => 'e_extra tidak boleh kosong'
        ]);

        $data = ekehadiran::create([
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_rencana_ujian' => $request->id_rencana_ujian,
            'id_kelas' => $request->id_kelas,
            'id_section' => $request->id_section,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'tanggal_kehadiran_ujian' => $request->tanggal_kehadiran_ujian,
            'id_siswa' => $request->id_siswa,
            'nama_siswa' => $request->nama_siswa,
            'kehadiran_ujian' => $request->kehadiran_ujian,
            'tahun' => $request->tahun,
            'e_extra' => $request->e_extra
        ]);

        $data->save();

        return redirect()->route('ujian_kehadiransiswaujian_page')->with('success', 'data kehadiran siswa ujian berhasil disimpan');
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
        $dataSiswa = siswa::all();

        $dataEdit = ekehadiran::findByUuid($uuid);

        return view('Pages.ujian.kehadiransiswaujian.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataRencanaUjian', 'dataKelas', 'dataSection', 'dataMataPelajaran', 'dataTahunAjaran', 'dataSiswa']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = ekehadiran::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('ujian_kehadiransiswajian_page')->with('success', 'data kehadiran siswa jian berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = ekehadiran::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('ujian_kehadiransiswaujian_page')->with('success', 'data kehadiran siswa ujian berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data kehadiran siswa jian not found'
            ]);
        }
    }
}

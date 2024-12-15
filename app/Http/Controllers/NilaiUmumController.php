<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nilaiumum;
use App\Models\siswa;
use App\Models\matapelajaran;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class NilaiUmumController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = nilaiumum::query();
        
        if($request->has('search'))
        {
            $query->whereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            })
            ->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            })
            ->orwhereHas('siswa', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            });
        }

        $dataNilaiUmum = $query->with(['siswa', 'tahunajaran', 'matapelajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.raport.nilaiumum.partials.table', compact('dataNilaiUmum'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.raport.nilaiumum.nilaiumum', compact(['adminSession', 'specAdmin', 'listMenu', 'dataNilaiUmum']));
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

        $dataSiswa = siswa::all();
        $dataMataPelajaran = matapelajaran::all();

        return view('Pages.raport.nilaiumum.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataSiswa', 'dataMataPelajaran']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	
        	'id_siswa' => 'required|numeric',
            'id_mata_pelajaran' => 'required|numeric',
            'nilai_uas' => 'required',
            'nilai_tugas' => 'required',
            'nilai_uh' => 'required'
        ]);

        $data = nilaiumum::create([
        	'id_siswa' => $request->id_siswa,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'nilai_uas' => $request->nilai_uas,
            'nilai_tugas' => $request->nilai_tugas,
            'nilai_uh' => $request->nilai_uh
        ]);
        $data->save();

        return redirect()->route('raport_nilaiumum_page')->with('success', 'data berhasil disimpan');
    }

    public function edit($uuid)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();

        $dataEdit = nilaiumum::findByUuid($uuid);
        $dataSiswa = siswa::all();
        $dataMataPelajaran = matapelajaran::all();

        return view('Pages.raport.nilaiumum.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataSiswa', 'dataMataPelajaran']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = nilaiumum::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('raport_nilaiumum_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = nilaiumum::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('raport_nilaiumum_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

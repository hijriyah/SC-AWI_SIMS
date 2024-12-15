<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nilaiekstrakurikuler;
use App\Models\siswa;
use App\Models\tahunajaran;
use App\Models\semester;
use App\Models\ekstrakurikuler;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class NilaiEkstrakurikulerController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = nilaiekstrakurikuler::query();
        
        if($request->has('search'))
        {
            $query->whereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            })
            ->orwhereHas('semester', function($q) use ($request) {
                $q->where('semester', 'like', "%{$request->search}%");
            })
            ->orwhereHas('siswa', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })
            ->orwhereHas('ekstrakurikuler', function($q) use ($request) {
                $q->where('ekstrakurikuler', 'like', "%{$request->search}%");
            });
        }

        $dataNilaiEkstrakurikuler = $query->with(['siswa', 'tahunajaran', 'semester', 'ekstrakurikuler'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.raport.nilaiekstrakurikuler.partials.table', compact('dataNilaiEkstrakurikuler'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.raport.nilaiekstrakurikuler.nilaiekstrakurikuler', compact(['adminSession', 'specAdmin', 'listMenu', 'dataNilaiEkstrakurikuler']));
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
        $dataSemester = semester::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataEkstrakurikuler = ekstrakurikuler::all();

        return view('Pages.raport.nilaiekstrakurikuler.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataSiswa', 'dataTahunAjaran', 'dataSemester', 'dataEkstrakurikuler']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	'id_ekstrakurikuler' => 'required|numeric',
        	'id_siswa' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'id_semester' => 'required|numeric',
            'nilai' => 'required',
            'keterangan' => 'required'
        ]);

        $data = nilaiekstrakurikuler::create([
        	'id_ekstrakurikuler' => $request->id_ekstrakurikuler,
        	'id_siswa' => $request->id_siswa,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_semester' => $request->id_semester,
            'nilai' => $request->nilai,
            'keterangan' => $request->keterangan
        ]);
        $data->save();

        return redirect()->route('raport_nilaiekstrakurikuler_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = nilaiekstrakurikuler::findByUuid($uuid);
        $dataSiswa = siswa::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSemester = semester::all();
        $dataEkstrakurikuler = ekstrakurikuler::all();

        return view('Pages.raport.nilaiekstrakurikuler.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataSiswa', 'dataTahunAjaran', 'dataSemester', 'dataEkstrakurikuler']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = nilaiekstrakurikuler::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('raport_nilaiekstrakurikuler_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = nilaiekstrakurikuler::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('raport_nilaiekstrakurikuler_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nilairaport;
use App\Models\siswa;
use App\Models\tahunajaran;
use App\Models\semester;
use App\Models\matapelajaran;
use App\Models\kkm;
use App\Models\catatanwalikelas;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class NilaiRaportController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = nilairaport::query();
        
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
            ->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            })
            ->orwhereHas('kkm', function($q) use ($request) {
                $q->where('predikat', 'like', "%{$request->search}%");
            })
            ->orwhereHas('catatanwalikelas', function($q) use ($request) {
                $q->where('catatan', 'like', "%{$request->search}%");
            });
        }

        $dataNilaiRaport = $query->with(['siswa', 'tahunajaran', 'semester', 'matapelajaran', 'kkm', 'catatanwalikelas'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.raport.nilairaport.partials.table', compact('dataNilaiRaport'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.raport.nilairaport.nilairaport', compact(['adminSession', 'specAdmin', 'listMenu', 'dataNilaiRaport']));
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
        $dataMataPelajaran = matapelajaran::all();
        $dataKkm = kkm::all();
        $dataCatatanWalikelas = catatanwalikelas::all();

        return view('Pages.raport.nilairaport.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataSiswa', 'dataTahunAjaran', 'dataSemester', 'dataMataPelajaran', 'dataKkm', 'dataCatatanWalikelas']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	'id_siswa' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'id_semester' => 'required|numeric',
            'id_mata_pelajaran' => 'required',
            'kkm' => 'required',
        	'nilai_akhir' => 'required',
        	'id_kkm' => 'required',
        	'rata_rata_permapel' => 'required',
        	'id_catatan_walikelas' => 'required'

        ]);

        $data = nilairaport::create([
        	'id_siswa' => $request->id_siswa,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_semester' => $request->id_semester,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'kkm' => $request->kkm ,
        	'nilai_akhir' => $request->nilai_akhir,
        	'id_kkm' => $request->id_kkm,
        	'rata_rata_permapel' => $request->rata_rata_permapel,
        	'id_catatan_walikelas' => $request->id_catatan_walikelas

        ]);
        $data->save();

        return redirect()->route('raport_nilairaport_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = nilairaport::findByUuid($uuid);
        $dataSiswa = siswa::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSemester = semester::all();
        $dataMataPelajaran = matapelajaran::all();
        $dataKkm = kkm::all();
        $dataCatatanWalikelas = catatanwalikelas::all();

        return view('Pages.raport.nilairaport.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataSiswa', 'dataTahunAjaran', 'dataSemester', 'dataMataPelajaran', 'dataKkm', 'dataCatatanWalikelas']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = nilairaport::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('raport_nilairaport_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = nilairaport::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('raport_nilairaport_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

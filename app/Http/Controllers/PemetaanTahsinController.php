<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pemetaantahsin;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\kategoritahsin;
use App\Models\guru;
use App\Models\tahunajaran;
use App\Models\Role;

class PemetaanTahsinController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = pemetaantahsin::query();
        
        if($request->has('search'))
        {
            $query->whereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })
            ->orwhereHas('siswa', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })
            ->orwhereHas('kategoritahsin', function($q) use ($request) {
                $q->where('kategori_tahsin', 'like', "%{$request->search}%");
            })
            ->orwhereHas('guru', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataPemetaanTahsin = $query->with(['kelas', 'siswa', 'kategoritahsin', 'guru', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.alquran.tahsin.pemetaantahsin.partials.table', compact('dataPemetaanTahsin'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.alquran.tahsin.pemetaantahsin.pemetaantahsin', compact(['adminSession', 'specAdmin', 'listMenu', 'dataPemetaanTahsin']));
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
        $dataSiswa = siswa::all();
        $dataKategoriTahsin = kategoritahsin::all();
        $dataGuru = guru::all();
        $dataTahunAjaran = tahunajaran::all();


        return view('Pages.alquran.tahsin.pemetaantahsin.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas', 'dataSiswa', 'dataKategoriTahsin', 'dataGuru', 'dataTahunAjaran']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	'id_kelas' => 'required|numeric',
        	'id_siswa' => 'required|numeric',
        	'id_kategori_tahsin' => 'required|numeric',
            'id_guru' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'semester' => 'required'
        ]);

        $data = pemetaantahsin::create([
        	'id_kelas' => $request->id_kelas,
        	'id_siswa' => $request->id_siswa,
        	'id_kategori_tahsin' => $request->id_kategori_tahsin,
            'id_guru' => $request->id_guru,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'semester' => $request->semester
        ]);
        $data->save();

        return redirect()->route('alquran_tahsin_pemetaantahsin_page')->with('success', 'data pemetaan tahsin berhasil disimpan');
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

        $dataEdit = pemetaantahsin::findByUuid($uuid);
        $dataKelas = kelas::all();
        $dataSiswa = siswa::all();
        $dataKategoriTahsin = kategoritahsin::all();
        $dataGuru = guru::all();
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.alquran.tahsin.pemetaantahsin.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKelas', 'dataSiswa', 'dataKategoriTahsin', 'dataGuru', 'dataTahunAjaran']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = pemetaantahsin::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('alquran_tahsin_pemetaantahsin_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = pemetaantahsin::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('alquran_tahsin_pemetaantahsin_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

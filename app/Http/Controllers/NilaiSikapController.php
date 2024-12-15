<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nilaisikap;
use App\Models\kategoripenilaiansikap;
use App\Models\siswa;
use App\Models\tahunajaran;
use App\Models\semester;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class NilaiSikapController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = nilaisikap::query();
        
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
            ->orwhereHas('kategoripenilaiansikap', function($q) use ($request) {
                $q->where('kategoripenilaiansikap', 'like', "%{$request->search}%");
            });
        }

        $dataNilaiSikap = $query->with(['siswa', 'tahunajaran', 'semester', 'kategoripenilaiansikap'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.raport.nilaisikap.partials.table', compact('dataNilaiSikap'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.raport.nilaisikap.nilaisikap', compact(['adminSession', 'specAdmin', 'listMenu', 'dataNilaiSikap']));
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
        $dataKategoriPenilaianSikap = kategoripenilaiansikap::all();

        return view('Pages.raport.nilaisikap.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataSiswa', 'dataTahunAjaran', 'dataSemester', 'dataKategoriPenilaianSikap']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	
        	'id_siswa' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'id_semester' => 'required|numeric',
            'id_kategori_penilaian_sikap' => 'required',
            'predikat' => 'required',
            'deskripsi' => 'required'
        ]);

        $data = penilaiansikap::create([
        	'id_siswa' => $request->id_siswa,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_semester' => $request->id_semester,
            'id_kategori_penilaian_sikap' => $request->id_kategori_penilaian_sikap,
            'predikat' => $request->predikat,
            'deskripsi' => $request->deskripsi
        ]);
        $data->save();

        return redirect()->route('raport_nilaisikap_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = nilaisikap::findByUuid($uuid);
        $dataSiswa = siswa::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSemester = semester::all();

        return view('Pages.raport.nilaisikap.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataSiswa', 'dataTahunAjaran', 'dataSemester', 'dataKategoriPenilaianSikap']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = nilaisikap::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('raport_nilaisikap_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = nilaisikap::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('raport_nilaisikap_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

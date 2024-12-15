<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tahfidz;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\guru;
use App\Models\tahunajaran;
use App\Models\kriteriapenilaianalquran;
use App\Models\Role;

class TahfidzController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = tahfidz::query();
        
        if($request->has('search'))
        {
            $query->whereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })
            
            ->orwhereHas('siswa', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })
           
            ->orwhereHas('guru', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            })
            ->orwhereHas('kriteriapenilaianalquran', function($q) use ($request) {
                $q->where('range_nilai', 'like', "%{$request->search}%");
            });
        }

        $dataTahfidz = $query->with(['kelas', 'siswa', 'guru', 'tahunajaran', 'kriteriapenilaianalquran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.alquran.tahfidz.partials.table', compact('dataTahfidz'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.alquran.tahfidz.tahfidz', compact(['adminSession', 'specAdmin', 'listMenu', 'dataTahfidz']));
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
        $dataGuru = guru::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataKriteriaPenilaianAlquran = kriteriapenilaianalquran::all();


        return view('Pages.alquran.tahfidz.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas', 'dataSiswa', 'dataGuru', 'dataTahunAjaran', 'dataKriteriaPenilaianAlquran']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	'id_kelas' => 'required|numeric',
        	'id_siswa' => 'required|numeric',
            'id_guru' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'semester' => 'required',
            'surah' => 'required',
            'hasil_perkembangan' => 'required',
            'id_kriteria_penilaian_alquran' => 'required|numeric'        ]);

        $data = tahfidz::create([
        	'id_kelas' => $request->id_kelas,
        	'id_siswa' => $request->id_siswa,
            'id_guru' => $request->id_guru,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'semester' => $request->semester,
            'surah' => $request->surah,
            'hasil_perkembangan' => $request->hasil_perkembangan,
            'id_kriteria_penilaian_alquran' => $request->id_kriteria_penilaian_alquran
        ]);
        $data->save();

        return redirect()->route('alquran_tahfidz_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = tahfidz::findByUuid($uuid);
        $dataKelas = kelas::all();
        $dataSiswa = siswa::all();
        $dataGuru = guru::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataKriteriaPenilaianAlquran = kriteriapenilaianalquran::all();

        return view('Pages.alquran.tahfidz.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKelas', 'dataSiswa', 'dataGuru', 'dataTahunAjaran', 'dataKriteriaPenilaianAlquran']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = tahfidz::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('alquran_tahfidz_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = tahfidz::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('alquran_tahfidz_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

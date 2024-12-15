<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\capaiantahsin;
use App\Models\pemetaantahsin;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\kategoritahsin;
use App\Models\guru;
use App\Models\tahunajaran;
use App\Models\kriteriapenilaianalquran;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;


class CapaianTahsinController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = capaiantahsin::query();
        
        if($request->has('search'))
        {
            $query->whereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })
            ->orwhereHas('pemetaantahsin', function($q) use ($request) {
                $q->where('semester', 'like', "%{$request->search}%");
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
            })
            ->orwhereHas('kriteriapenilaianalquran', function($q) use ($request) {
                $q->where('range_nilai', 'like', "%{$request->search}%");
            });
        }

        $dataCapaianTahsin = $query->with(['kelas', 'siswa', 'kategoritahsin', 'guru', 'tahunajaran', 'pemetaantahsin', 'kriteriapenilaianalquran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.alquran.tahsin.capaiantahsin.partials.table', compact('dataCapaianTahsin'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.alquran.tahsin.capaiantahsin.capaiantahsin', compact(['adminSession', 'specAdmin', 'listMenu', 'dataCapaianTahsin']));
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

        $dataPemetaanTahsin = pemetaantahsin::all();
        $dataKelas = kelas::all();
        $dataSiswa = siswa::all();
        $dataKategoriTahsin = kategoritahsin::all();
        $dataGuru = guru::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataKriteriaPenilaianAlquran = kriteriapenilaianalquran::all();


        return view('Pages.alquran.tahsin.capaiantahsin.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas', 'dataSiswa', 'dataKategoriTahsin', 'dataGuru', 'dataTahunAjaran', 'dataPemetaanTahsin', 'dataKriteriaPenilaianAlquran']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	'id_pemetaan_tahsin' => 'required|numeric',
        	'id_kelas' => 'required|numeric',
        	'id_siswa' => 'required|numeric',
        	'id_kategori_tahsin' => 'required|numeric',
            'id_guru' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'semester' => 'required',
            'materi' => 'required',
            'hasil_perkembangan' => 'required',
            'id_kriteria_penilaian_alquran' => 'required|numeric',
            'kompetensi' => 'required'
        ]);

        $data = capaiantahsin::create([
            'id_pemetaan_tahsin' => $request->id_pemetaan_tahsin,
        	'id_kelas' => $request->id_kelas,
        	'id_siswa' => $request->id_siswa,
        	'id_kategori_tahsin' => $request->id_kategori_tahsin,
            'id_guru' => $request->id_guru,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'semester' => $request->semester,
            'materi' => $request->materi,
            'hasil_perkembangan' => $request->hasil_perkembangan,
            'id_kriteria_penilaian_alquran' => $request->id_kriteria_penilaian_alquran,
            'kompetensi' => $request->kompetensi
        ]);
        $data->save();

        return redirect()->route('alquran_tahsin_capaiantahsin_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = capaiantahsin::findByUuid($uuid);
        $dataPemetaanTahsin = pemetaantahsin::all();
        $dataKelas = kelas::all();
        $dataSiswa = siswa::all();
        $dataKategoriTahsin = kategoritahsin::all();
        $dataGuru = guru::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataKriteriaPenilaianAlquran = kriteriapenilaianalquran::all();

        return view('Pages.alquran.tahsin.capaiantahsin.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKelas', 'dataSiswa', 'dataKategoriTahsin', 'dataGuru', 'dataTahunAjaran', 'dataPemetaanTahsin', 'dataKriteriaPenilaianAlquran']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = capaiantahsin::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('alquran_tahsin_capaiantahsin_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = capaiantahsin::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('alquran_tahsin_capaiantahsin_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

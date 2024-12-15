<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\capaianqa;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\guru;
use App\Models\tahunajaran;
use App\Models\materiqa;
use App\Models\kriteriapenilaianalquran;
use App\Models\Role;

class CapaianQaController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = capaianqa::query();
        
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
            })
            ->orwhereHas('materiqa', function($q) use ($request) {
                $q->where('materi', 'like', "%{$request->search}%");
            });
        }

        $dataCapaianQa = $query->with(['kelas', 'siswa', 'guru', 'tahunajaran', 'kriteriapenilaianalquran', 'materiqa'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.qa.capaianqa.partials.table', compact('dataCapaianQa'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.qa.capaianqa.capaianqa', compact(['adminSession', 'specAdmin', 'listMenu', 'dataCapaianQa']));
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
        $dataMateriQa = materiqa::all();
        $dataKriteriaPenilaianAlquran = kriteriapenilaianalquran::all();


        return view('Pages.qa.capaianqa.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas', 'dataSiswa', 'dataGuru', 'dataTahunAjaran', 'dataKriteriaPenilaianAlquran', 'dataMateriQa']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	'id_kelas' => 'required|numeric',
        	'id_siswa' => 'required|numeric',
            'id_guru' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'semester' => 'required',
            'id_materi_qa' => 'required',
            'kompetensi' => 'required',
            'hasil_perkembangan' => 'required',
            'id_kriteria_penilaian_alquran' => 'required|numeric',
            'status' => 'required'

        ]);

        $data = capaianqa::create([
        	'id_kelas' => $request->id_kelas,
        	'id_siswa' => $request->id_siswa,
            'id_guru' => $request->id_guru,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'semester' => $request->semester,
            'id_materi_qa' => $request->materi,
            'kompetensi' => $request->kompetensi,
            'hasil_perkembangan' => $request->hasil_perkembangan,
            'id_kriteria_penilaian_alquran' => $request->id_kriteria_penilaian_alquran,
            'status' => $request->status
        ]);
        $data->save();

        return redirect()->route('qa_capaianqa_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = capaianqa::findByUuid($uuid);
        $dataKelas = kelas::all();
        $dataSiswa = siswa::all();
        $dataGuru = guru::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataMateriQa = materiqa::all();
        $dataKriteriaPenilaianAlquran = kriteriapenilaianalquran::all();

        return view('Pages.qa.capaianqa.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKelas', 'dataSiswa', 'dataGuru', 'dataTahunAjaran', 'dataKriteriaPenilaianAlquran', 'dataMateriQa']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = capaianqa::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('qa_capaianqa_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = capaianqa::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('qa_capaianqa_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

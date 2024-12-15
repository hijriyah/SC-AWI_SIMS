<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catatanwalikelas;
use App\Models\siswa;
use App\Models\tahunajaran;
use App\Models\semester;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class CatatanWaliKelasController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = catatanwalikelas::query();
        
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
            });
        }

        $dataCatatanWaliKelas = $query->with(['siswa', 'tahunajaran', 'semester'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.raport.catatanwalikelas.partials.table', compact('dataCatatanWaliKelas'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.raport.catatanwalikelas.catatanwalikelas', compact(['adminSession', 'specAdmin', 'listMenu', 'dataCatatanWaliKelas']));
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

        return view('Pages.raport.catatanwalikelas.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataSiswa', 'dataTahunAjaran', 'dataSemester']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	'id_siswa' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'id_semester' => 'required|numeric',
            'catatan' => 'required'
        ]);

        $data = catatanwalikelas::create([
        	'id_siswa' => $request->id_siswa,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_semester' => $request->id_semester,
            'catatan' => $request->catatan
        ]);
        $data->save();

        return redirect()->route('raport_catatanwalikelas_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = catatanwalikelas::findByUuid($uuid);
        $dataSiswa = siswa::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSemester = semester::all();

        return view('Pages.raport.catatanwalikelas.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataSiswa', 'dataTahunAjaran', 'dataSemester']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = catatanwalikelas::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('raport_catatanwalikelas_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = catatanwalikelas::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('raport_catatanwalikelas_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

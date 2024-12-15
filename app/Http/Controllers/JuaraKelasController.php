<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\juarakelas;
use App\Models\siswa;
use App\Models\tahunajaran;
use App\Models\semester;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class JuaraKelasController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = juarakelas::query();
        
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

        $dataJuaraKelas = $query->with(['siswa', 'tahunajaran', 'semester'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.raport.juarakelas.partials.table', compact('dataJuaraKelas'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.raport.juarakelas.juarakelas', compact(['adminSession', 'specAdmin', 'listMenu', 'dataJuaraKelas']));
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

        return view('Pages.raport.juarakelas.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataSiswa', 'dataTahunAjaran', 'dataSemester']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	
        	'id_siswa' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'id_semester' => 'required|numeric',
            'jumlah_nilai' => 'required',
            'rata_rata_nilai' => 'required',
            'juara' => 'required'
        ]);

        $data = juarakelas::create([
        	'id_siswa' => $request->id_siswa,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_semester' => $request->id_semester,
            'jumlah_nilai' => $request->jumlah_nilai,
            'rata_rata_nilai' => $request->rata_rata_nilai,
            'juara' => $request->juara
        ]);
        $data->save();

        return redirect()->route('raport_juarakelas_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = juarakelas::findByUuid($uuid);
        $dataSiswa = siswa::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSemester = semester::all();
        
        return view('Pages.raport.juarakelas.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataSiswa', 'dataTahunAjaran', 'dataSemester']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = juarakelas::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('raport_juarakelas_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = juarakelas::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('raport_juarakelas_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

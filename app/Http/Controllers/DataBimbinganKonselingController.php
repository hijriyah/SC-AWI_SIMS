<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\databimbingankonseling;
use App\Models\tahunajaran;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\bimbingankonseling;
use App\Models\Role;

class DataBimbinganKonselingController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = databimbingankonseling::query();
        
        if($request->has('search'))
        {
            $query->whereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })
            
            ->orwhereHas('siswa', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })
           
            ->orwhereHas('bimbingankonseling', function($q) use ($request) {
                $q->where('jenis_konseling', 'like', "%{$request->search}%");
            })
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataDataBimbinganKonseling = $query->with(['kelas', 'siswa', 'bimbingankonseling', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.bk.databimbingankonseling.partials.table', compact('dataDataBimbinganKonseling'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.bk.databimbingankonseling.databimbingankonseling', compact(['adminSession', 'specAdmin', 'listMenu', 'dataDataBimbinganKonseling']));
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
        $dataBimbinganKonseling = bimbingankonseling::all();
        $dataTahunAjaran = tahunajaran::all();


        return view('Pages.bk.databimbingankonseling.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas', 'dataSiswa', 'dataBimbinganKonseling', 'dataTahunAjaran']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	'id_kelas' => 'required|numeric',
        	'id_siswa' => 'required|numeric',
            'id_bimbingan_konseling' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'saran' => 'required'      
        ]);

        $data = databimbingankonseling::create([
        	'id_kelas' => $request->id_kelas,
        	'id_siswa' => $request->id_siswa,
            'id_bimbingan_konseling' => $request->id_bimbingan_konseling,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'saran' => $request->saran
        ]);
        $data->save();

        return redirect()->route('bk_databimbingankonseling_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = datapelanggaran::findByUuid($uuid);
        $dataKelas = kelas::all();
        $dataSiswa = siswa::all();
        $dataBimbinganKonseling = bimbingankonseling::all();
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.bk.databimbingankonseling.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKelas', 'dataSiswa', 'dataBimbinganKonseling', 'dataTahunAjaran']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = databimbingankonseling::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('bk_databimbingankonseling_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = databimbingankonseling::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('bk_databimbingankonseling_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

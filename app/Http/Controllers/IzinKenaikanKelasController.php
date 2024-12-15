<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\izinkenaikankelas;
use App\Models\kelas;
use App\Models\Role;

class IzinKenaikanKelasController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = izinkenaikanakelas::query();
        
        if($request->has('search'))
        {
            $query->whereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            });
        }

        $dataIzinKenaikanKelas = $query->with(['kelas'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.raport.izinkenaikankelas.partials.table', compact('dataIzinKenaikanKelas'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.raport.izinkenaikankelas.izinkenaikankelas', compact(['adminSession', 'specAdmin', 'listMenu', 'dataIzinKenaikanKelas']));
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


        return view('Pages.raport.izinkenaikankelas.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	'id_kelas' => 'required|numeric',
            'status' => 'required'

        ]);

        $data = izinkenaikankelas::create([
        	'id_kelas' => $request->id_kelas,
            'status' => $request->status
        ]);
        $data->save();

        return redirect()->route('raport_izinkenaikankelas_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = izinkenaikankelas::findByUuid($uuid);
        $dataKelas = kelas::all();

        return view('Pages.raport.izinkenaikankelas.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKelas']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = izinkenaikankelas::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('raport_izinkenaikankelas_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = izinkenaikankelas::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('raport_izinkenaikankelas_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

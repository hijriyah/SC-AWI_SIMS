<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\pelanggaran;
use App\Models\tahunajaran;
use App\Models\guru;
use App\Models\Role;

class PelanggaranController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = pelanggaran::query();
        
        if($request->has('search'))
        {
            $query->where('jenis_pelanggaran', 'like', "%{$request->search}%")
            
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataPelanggaran = $query->with(['tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.kesiswaan.pelanggaran.partials.table', compact('dataPelanggaran'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.kesiswaan.pelanggaran.pelanggaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataPelanggaran']));
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

        $dataTahunAjaran = tahunajaran::all();


        return view('Pages.kesiswaan.pelanggaran.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataTahunAjaran']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	
            'id_tahun_ajaran' => 'required|numeric',
            'jenis_pelanggaran' => 'required',
            'deskripsi' => 'required',
            'poin_pelanggaran' => 'required|numeric'       
        ]);

        $data = pelanggaran::create([
        	
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'jenis_pelanggaran' => $request->jenis_pelanggaran,
            'deskripsi' => $request->deskripsi,
            'poin_pelanggaran' => $request->poin_pelanggaran
        ]);
        $data->save();

        return redirect()->route('kesiswaan_pelanggaran_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = pelanggaran::findByUuid($uuid);
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.kesiswaan.pelanggaran.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataTahunAjaran', ]));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = pelanggaran::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('kesiswaan_pelanggaran_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = pelanggaran::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('kesiswaan_pelanggaran_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }

    // this for admin guru
    public function index2(Request $request)
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();

        $query = pelanggaran::query();
        
        if($request->has('search'))
        {
            $query->where('jenis_pelanggaran', 'like', "%{$request->search}%")
            
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataPelanggaran = $query->with(['tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.kesiswaan.pelanggaran.partials.table', compact('dataPelanggaran'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.guru.kesiswaan.pelanggaran.pelanggaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataPelanggaran', 'SectionType']));
    }
    public function storePage2()
    {
        //
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();

        $dataTahunAjaran = tahunajaran::all();


        return view('Pages.admin.guru.kesiswaan.pelanggaran.add', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType', 'dataTahunAjaran']));
    }

    public function store2(Request $request)
    {
        $validation = $request->validate([
        	
            'id_tahun_ajaran' => 'required|numeric',
            'jenis_pelanggaran' => 'required',
            'deskripsi' => 'required',
            'poin_pelanggaran' => 'required|numeric'       
        ]);

        $data = pelanggaran::create([
        	
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'jenis_pelanggaran' => $request->jenis_pelanggaran,
            'deskripsi' => $request->deskripsi,
            'poin_pelanggaran' => $request->poin_pelanggaran
        ]);
        $data->save();

        return redirect()->route('guru_kesiswaan-pelanggaran_page')->with('success', 'data berhasil disimpan');
    }

    public function edit2($uuid)
    {
        //
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.admin.guru.kesiswaan.pelanggaran.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType', 'dataEdit', 'dataTahunAjaran' ]));
    }
    public function update2(Request $request, $uuid)
    {
        //
        $data = pelanggaran::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('guru_kesiswaan-pelanggaran_page')->with('success', 'data berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = pelanggaran::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('guru_kesiswaan-pelanggaran_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\tatatertib;
use App\Models\tahunajaran;
use App\Models\guru;
use App\Models\Role;

class TataTertibController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = tatatertib::query();
        
        if($request->has('search'))
        {
            $query->whereHas('tatatertib', function($q) use ($request) {
                $q->where('jenis_tata_tertib', 'like', "%{$request->search}%");
            })
            
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataTataTertib = $query->with(['tatatertib', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.kesiswaan.tatatertib.partials.table', compact('dataTataTertib'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.kesiswaan.tatatertib.tatatertib', compact(['adminSession', 'specAdmin', 'listMenu', 'dataTataTertib']));
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


        return view('Pages.kesiswaan.tatatertib.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataTahunAjaran']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	
            'id_tahun_ajaran' => 'required|numeric',
            'jenis_tata_tertib' => 'required',
            'deskripsi' => 'required'       
        ]);

        $data = tatatertib::create([
        	
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'jenis_tata_tertib' => $request->jenis_tata_tertib,
            'deskripsi' => $request->deskripsi
        ]);
        $data->save();

        return redirect()->route('kesiswaan_tatatertib_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = tatatertib::findByUuid($uuid);
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.kesiswaan.tatatertib.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataTahunAjaran', ]));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = tatatertib::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('kesiswaan_tatatertib_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = tatatertib::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('kesiswaan_tatatertib_page')->with('success', 'data berhasil dihapus');
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

        $query = tatatertib::query();
        
        if($request->has('search'))
        {
            $query->whereHas('tatatertib', function($q) use ($request) {
                $q->where('jenis_tata_tertib', 'like', "%{$request->search}%");
            })
            
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataTataTertib = $query->with(['tatatertib', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.kesiswaan.tatatertib.partials.table', compact('dataTataTertib'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.guru.kesiswaan.tatatertib.tatatertib', compact(['adminSession', 'specAdmin', 'listMenu', 'dataTataTertib', 'SectionType']));
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


        return view('Pages.admin.guru.kesiswaan.tatatertib.add', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType', 'dataTahunAjaran']));
    }
    public function store2(Request $request)
    {
        $validation = $request->validate([
        	
            'id_tahun_ajaran' => 'required|numeric',
            'jenis_tata_tertib' => 'required',
            'deskripsi' => 'required'       
        ]);

        $data = tatatertib::create([
        	
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'jenis_tata_tertib' => $request->jenis_tata_tertib,
            'deskripsi' => $request->deskripsi
        ]);
        $data->save();

        return redirect()->route('guru_kesiswaan-tatatertib_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = tatatertib::findByUuid($uuid);
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.admin.guru.kesiswaan.tatatertib.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType', 'dataEdit', 'dataTahunAjaran', ]));
    }
    public function update2(Request $request, $uuid)
    {
        //
        $data = tatatertib::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('guru_kesiswaan-tatatertib_page')->with('success', 'data berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = tatatertib::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('guru_kesiswaan-tatatertib_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

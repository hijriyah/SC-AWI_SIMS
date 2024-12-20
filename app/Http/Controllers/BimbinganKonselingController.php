<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bimbingankonseling;
use App\Models\tahunajaran;
use App\Models\guru;
use App\Models\Role;

class BimbinganKonselingController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = bimbingankonseling::query();
        
        if($request->has('search'))
        {
            $query->where('jenis_konseling', 'like', "%{$request->search}%")
            
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataBimbinganKonseling = $query->with('tahunajaran')->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.bk.bimbingankonseling.partials.table', compact('dataBimbinganKonseling'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.bk.bimbingankonseling.bimbingankonseling', compact(['adminSession', 'specAdmin', 'listMenu', 'dataBimbinganKonseling']));
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


        return view('Pages.bk.bimbingankonseling.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataTahunAjaran']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'id_tahun_ajaran' => 'required|numeric',
            'jenis_konseling' => 'required',
            'deskripsi' => 'required'     
        ]);

        $data = bimbingankonseling::create([
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'jenis_konseling' => $request->jenis_konseling,
            'deskripsi' => $request->deskripsi
        ]);
        $data->save();

        return redirect()->route('bk_bimbingankonseling_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = bimbingankonseling::findByUuid($uuid);
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.bk.bimbingankonseling.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataTahunAjaran', ]));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = bimbingankonseling::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('bk_bimbingankonseling_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = bimbingankonseling::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('bk_bimbingankonseling_page')->with('success', 'data berhasil dihapus');
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

        $query = bimbingankonseling::query();
        
        if($request->has('search'))
        {
            $query->where('jenis_konseling', 'like', "%{$request->search}%")
            
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataBimbinganKonseling = $query->with('tahunajaran')->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.bk.bimbingankonseling.partials.table', compact('dataBimbinganKonseling'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.guru.bk.bimbingankonseling.bimbingankonseling', compact(['adminSession', 'specAdmin', 'listMenu', 'dataBimbinganKonseling', 'SectionType']));
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


        return view('Pages.admin.guru.bk.bimbingankonseling.add', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType', 'dataTahunAjaran']));
    }

    public function store2(Request $request)
    {
        $validation = $request->validate([
            'id_tahun_ajaran' => 'required|numeric',
            'jenis_konseling' => 'required',
            'deskripsi' => 'required'     
        ]);

        $data = bimbingankonseling::create([
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'jenis_konseling' => $request->jenis_konseling,
            'deskripsi' => $request->deskripsi
        ]);
        $data->save();

        return redirect()->route('guru_bk-bimbingankonseling_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = bimbingankonseling::findByUuid($uuid);
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.admin.guru.bk.bimbingankonseling.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType', 'dataEdit', 'dataTahunAjaran', ]));
    }
    public function update2(Request $request, $uuid)
    {
        //
        $data = bimbingankonseling::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('guru_bk-bimbingankonseling_page')->with('success', 'data berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = bimbingankonseling::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('guru_bk-bimbingankonseling_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

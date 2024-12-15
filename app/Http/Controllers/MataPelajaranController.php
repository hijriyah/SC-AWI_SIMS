<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\matapelajaran;
use App\Models\guru;
use App\Models\siswa;
use App\Models\materimatapelajaran;
use App\Models\Role;

class MataPelajaranController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = matapelajaran::query();
        
        if($request->has('search'))
        {
            $query->where('mata_pelajaran', 'like', "%{$request->search}%")
            ->orwhereHas('guru', function($q) use ($request) {
                $q->where('nama_panggilan', 'like', "%{$request->search}%");
            });
        }

        $dataMataPelajaran = $query->with(['guru'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.akademik.matapelajaran.partials.table', compact('dataMataPelajaran'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.akademik.matapelajaran.matapelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMataPelajaran']));
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

        $dataGuru = guru::all();
        $dataMateriMataPelajaran = materimatapelajaran::all();


        return view('Pages.akademik.matapelajaran.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataGuru', 'dataMateriMataPelajaran']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	'tipe_mata_pelajaran' => 'required|numeric',
        	'mata_pelajaran' => 'required',
        	'kode_mata_pelajaran' => 'required',
            'id_guru' => 'required|numeric'
        ]);

        $data = matapelajaran::create([
        	'tipe_mata_pelajaran' => $request->tipe_mata_pelajaran,
        	'mata_pelajaran' => $request->mata_pelajaran,
        	'kode_mata_pelajaran' => $request->kode_mata_pelajaran,
            'id_guru' => $request->id_guru
        ]);
        $data->save();

        return redirect()->route('akademik_matapelajaran_page')->with('success', 'data mata pelajaran berhasil disimpan');
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

        $dataEdit = matapelajaran::findByUuid($uuid);
        $dataGuru = guru::all();
        $dataMateriMataPelajaran = materimatapelajaran::all();

        return view('Pages.akademik.matapelajaran.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataGuru', 'dataMateriMataPelajaran']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = matapelajaran::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('akademik_matapelajaran_page')->with('success', 'data mata pelajaran berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = matapelajaran::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('akademik_matapelajaran_page')->with('success', 'data mata pelajaran berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data mata pelajaran tidak ditemukan'
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

        $query = matapelajaran::query();
        
        if($request->has('search'))
        {
            $query->where('mata_pelajaran', 'like', "%{$request->search}%")
            ->orwhereHas('guru', function($q) use ($request) {
                $q->where('nama_panggilan', 'like', "%{$request->search}%");
            });
        }

        $dataMataPelajaran = $query->with(['guru'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.akademik.matapelajaran.partials.table', compact('dataMataPelajaran'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.guru.akademik.matapelajaran.matapelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMataPelajaran', 'SectionType']));
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

        $dataMateriMataPelajaran = materimatapelajaran::all();


        return view('Pages.admin.guru.akademik.matapelajaran.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMateriMataPelajaran', 'SectionType']));
    }
    public function store2(Request $request)
    {
        $roleGet = guru::where('username', $adminSession)->first();

        $validation = $request->validate([
        	'tipe_mata_pelajaran' => 'required|numeric',
        	'mata_pelajaran' => 'required',
        	'kode_mata_pelajaran' => 'required',
        ]);

        $data = matapelajaran::create([
        	'tipe_mata_pelajaran' => $request->tipe_mata_pelajaran,
        	'mata_pelajaran' => $request->mata_pelajaran,
        	'kode_mata_pelajaran' => $request->kode_mata_pelajaran,
            'id_guru' => $roleGet->id
        ]);
        $data->save();

        return redirect()->route('guru_akademik_matapelajaran_page')->with('success', 'data mata pelajaran berhasil disimpan');
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


        $dataEdit = matapelajaran::findByUuid($uuid);
        $dataMateriMataPelajaran = materimatapelajaran::all();

        return view('Pages.admin.guru.akademik.matapelajaran.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMateriMataPelajaran', 'SectionType']));
    }
    public function update2(Request $request, $uuid)
    {
        //
        $data = matapelajaran::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('guru_akademik_matapelajaran_page')->with('success', 'data mata pelajaran berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = matapelajaran::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('guru_akademik_matapelajaran_page')->with('success', 'data mata pelajaran berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data mata pelajaran tidak ditemukan'
            ]);
        }
    }



    // this for admin siswa
    public function index3(Request $request)
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = siswa::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $query = matapelajaran::query();
        
        if($request->has('search'))
        {
            $query->where('mata_pelajaran', 'like', "%{$request->search}%")
            ->orwhereHas('guru', function($q) use ($request) {
                $q->where('nama_panggilan', 'like', "%{$request->search}%");
            });
        }

        $dataMataPelajaran = $query->with(['guru'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.siswa.akademik.matapelajaran.partials.table', compact('dataMataPelajaran'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.siswa.akademik.matapelajaran.matapelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMataPelajaran']));
    }
}

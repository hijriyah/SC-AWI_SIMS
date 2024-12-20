<?php

namespace App\Http\Controllers;

use App\Models\orangtua;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\guru;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrangtuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = orangtua::query();
        
        if($request->has('search'))
        {
            $query->where('nama', 'like', "%{$request->search}%");
        }

        $dataOrangtua = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.master.orangtua.partials.table', compact('dataOrangtua'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.master.orangtua.orangtua', compact(['adminSession', 'specAdmin', 'listMenu', 'dataOrangtua']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function storePage()
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();

        return view('Pages.master.orangtua.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $validation = $request->validate([
            // 'nama' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ayah' => 'required',
            'pekerjaan_ibu' => 'required',
            'email' => 'required',            
            'no_telp' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
            'aktif' => 'required'
        ]);

        $filePath = null;
        if(isset($request->file))
        {
            $file = $request->file('file'); 
            $filePath = $file->store('AdminMasterOrangtua', 'public');
        }



        $roleOrangtua= Role::where('name', 'Orang tua')->first();

        $data = orangtua::create([
            // 'nama' => $request->nama,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'photo' => $filePath,
            'aktif' => $request->aktif,
            'username' => $request->username,
            'password' => $request->password,
            'role_id' => $roleOrangtua->id
            
            
        ]);
        $data->save();

        return redirect()->route('orangtua_master_page')->with('success', 'data orangtua berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(orangtua $orangtua)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();

        $dataEdit = orangtua::findByUuid($uuid);

        return view('Pages.master.orangtua.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = orangtua::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('orangtua_master_page')->with('success', 'data orangtua berhasil dihapus');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
         $data = orangtua::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('orangtua_master_page')->with('success', 'data orangtua berhasil dihapus');
        }
        else {
            return response()->json([
                'error', 'data orangtua tidak ditemukan'
            ]);
        }
    }

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

        $query = orangtua::query();
        
        if($request->has('search'))
        {
            $query->where('nama', 'like', "%{$request->search}%")
            ->orWhere('nama_ayah', 'like', "%{$request->search}%")
            ->orWhere('nama_ibu', 'like', "%{$request->search}%")
            ->orwhereHas('siswa', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            });
        }

        $dataOrangtua = $query->with(['siswa'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.master.orangtua.partials.table', compact('dataOrangtua'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.guru.master.orangtua.orangtua', compact(['adminSession', 'specAdmin', 'listMenu', 'dataOrangtua', 'SectionType']));
    }
    public function OrangTuaInfo($uuid)
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $dataInfo = orangtua::with(['siswa'])->where('uuid', $uuid)->first();

        return view('Pages.admin.guru.master.orangtua.info', compact(['adminSession', 'specAdmin', 'listMenu', 'dataInfo']));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mediaParent;
use App\Models\siswa;
use App\Models\guru;
use App\Models\orangtua;
use App\Models\Role;

class MediaParentController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = mediaParent::with('mediaSubF1.mediaSubF2.mediaFile')->get();

        return view('Pages.bukumedia.mediapembelajaran.mediapembelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'query']));
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

        return view('Pages.ujian.mediaparent.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong'
        ]);

        $data = mediaParent::create([
            'nama' => $request->nama,
        ]);
        $data->save();

        return redirect()->route('bukumedia_mediaparent_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(kategoribarang $kategoribarang)
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

        $dataEdit = mediaParent::findByUuid($uuid);

        // return view('Pages.ujian.mediaparent.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
        return response()->json([
            'data' =>  $dataEdit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = mediaParent::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('bukumedia_mediaparent_page')->with('success', 'data berhasil disimpan');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = mediaParent::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('bukumedia_mediaparent_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }

    // this for admin guru
    public function index2(Request $request)
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

        $query = mediaParent::with('mediaSubF1.mediaSubF2.mediaFile')->get();

        return view('Pages.admin.guru.bukumedia.mediapembelajaran.mediapembelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'query', 'SectionType']));
    }
    public function store2(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong'
        ]);

        $data = mediaParent::create([
            'nama' => $request->nama,
        ]);
        $data->save();

        return redirect()->route('guru_bukumedia_mediaparent_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = mediaParent::findByUuid($uuid);

        // return view('Pages.ujian.mediaparent.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
        return response()->json([
            'data' =>  $dataEdit
        ]);
    }
    public function update2(Request $request, $uuid)
    {
        //
        $data = mediaParent::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('guru_bukumedia_mediaparent_page')->with('success', 'data berhasil disimpan');
    }
    public function destroy2($uuid)
    {
        //
        $data = mediaParent::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('guru_bukumedia_mediaparent_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }

    // this for admin siswa
    public function index3(Request $request)
    {
        //
        $adminSession = session('admin_name');

        // Guru
        $roleGet = siswa::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $query = mediaParent::with('mediaSubF1.mediaSubF2.mediaFile')->get();

        return view('Pages.admin.siswa.bukumedia.mediapembelajaran.mediapembelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'query']));
    }


     // this for admin orangtua
     public function index4(Request $request)
     {
         //
         $adminSession = session('admin_name');
 
         // orangtua
         $roleGet = orangtua::where('username', $adminSession)->first();
         $roleStatus = Role::find($roleGet->role_id);
         $specAdmin = $roleStatus->name;
 
         $roleCheck = new Role;
         $listMenu = $roleCheck->permissionsId($roleGet->role_id);
 
         $query = mediaParent::with('mediaSubF1.mediaSubF2.mediaFile')->get();
 
         return view('Pages.admin.orangtua.bukumedia.mediapembelajaran.mediapembelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'query']));
     }
}

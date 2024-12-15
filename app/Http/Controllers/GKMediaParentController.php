<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gkmediaparent;
use App\Models\Role;

class GKMediaParentController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = gkmediaparent::with('gkmediasubf1.gkmediasubf2.gkmediafile')->get();

        return view('Pages.pemberitahuan.gkmedia.gkmedia', compact(['adminSession', 'specAdmin', 'listMenu', 'query']));
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

        return view('Pages.pemberitahuan.gkmediaparent.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
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

        $data = gkmediaparent::create([
            'nama' => $request->nama,
        ]);
        $data->save();

        return redirect()->route('pemberitahuan_gkmediaparent_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(gkmediaparent $gkmediaparent)
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

        $dataEdit = gkmediaparent::findByUuid($uuid);

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
        $data = gkmediaparent::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('pemberitahuan_gkmediaparent_page')->with('success', 'data berhasil disimpan');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = gkmediaparent::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('pemberitahuan_gkmediaparent_page')->with('success', 'data  berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data kategori barang tidak ditemukan'
            ]);
        }

    }
}

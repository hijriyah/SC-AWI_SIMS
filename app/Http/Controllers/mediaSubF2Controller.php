<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mediaParent;
use App\Models\Role;
use App\Models\mediaSubF2;

class mediaSubF2Controller extends Controller
{
    //
    public function store(Request $request, $mediaSubF1Id)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong'
        ]);

        $data = mediaSubF2::create([
            'nama' => $request->nama,
            'id_mediaSubF1' => $mediaSubF1Id
        ]);
        $data->save();

        return redirect()->route('bukumedia_mediaparent_page')->with('success', 'data berhasil disimpan');
    }

    public function edit($uuid)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();

        $dataEdit = mediaSubF2::findByUuid($uuid);

        // return view('Pages.ujian.mediaparent.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
        return response()->json([
            'data' =>  $dataEdit
        ]);
    }

    public function update(Request $request, $uuid, $mediaSubF1Id)
    {
        //
        $data = mediaSubF2::findbyUuid($uuid);
        $data->update([
            'nama' => $request->nama,
            'id_mediaSubF1' => $mediaSubF1Id
        ]);

        return redirect()->route('bukumedia_mediaparent_page')->with('success', 'data berhasil disimpan');
        
    }

    public function destroy($uuid)
    {
        //
        $data = mediaSubF2::findByUuid($uuid);

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
    public function store2(Request $request, $mediaSubF1Id)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong'
        ]);

        $data = mediaSubF2::create([
            'nama' => $request->nama,
            'id_mediaSubF1' => $mediaSubF1Id
        ]);
        $data->save();

        return redirect()->route('guru_bukumedia_mediaparent_page')->with('success', 'data berhasil disimpan');
    }
    public function edit2($uuid)
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $dataEdit = mediaSubF2::findByUuid($uuid);

        // return view('Pages.ujian.mediaparent.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
        return response()->json([
            'data' =>  $dataEdit
        ]);
    }
    public function update2(Request $request, $uuid, $mediaSubF1Id)
    {
        //
        $data = mediaSubF2::findbyUuid($uuid);
        $data->update([
            'nama' => $request->nama,
            'id_mediaSubF1' => $mediaSubF1Id
        ]);

        return redirect()->route('guru_bukumedia_mediaparent_page')->with('success', 'data berhasil disimpan');
    }
    public function destroy2($uuid)
    {
        //
        $data = mediaSubF2::findByUuid($uuid);

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

}

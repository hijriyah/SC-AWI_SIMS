<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gkmediaParent;
use App\Models\Role;
use App\Models\gkmediasubf2;

class GKMediaSubF2Controller extends Controller
{
    public function store(Request $request, $gkmediasubf1Id)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong'
        ]);

        $data = gkmediasubf2::create([
            'nama' => $request->nama,
            'id_gkmediasubf1' => $gkmediasubf1Id
        ]);
        $data->save();

        return redirect()->route('pemberitahuan_gkmediaparent_page')->with('success', 'data berhasil disimpan');
    

    }

    public function edit($uuid)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();

        $dataEdit = gkmediasubf2::findByUuid($uuid);

        // return view('Pages.ujian.mediaparent.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
        return response()->json([
            'data' =>  $dataEdit
        ]);
    }

    public function update(Request $request, $uuid, $gkmediasubf1Id)
    {
        //
        $data = gkmediasubf2::findbyUuid($uuid);
        $data->update([
            'nama' => $request->nama,
            'id_gkmediasubf1' => $gkmediasubf1Id
        ]);

        return redirect()->route('pemberitahuan_gkmediaparent_page')->with('success', 'data berhasil disimpan');
        
    }

    public function destroy($uuid)
    {
        //
        $data = gkmediasubf2::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('pemberitahuan_gkmediaparent_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }
}

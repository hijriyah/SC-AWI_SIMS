<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gkmediafile;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class GKMediaFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_gkmediasubf2)
    {
        //

        $validation = $request->validate([
            'nama' => 'required',
            'filepond' => 'required|mimes:pdf',
            'filepond' => 'required|array',
            'filepond' => 'required|max:2048'
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file maks 2mb'
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('GKMediaFile', 'public');
            }
        }

        $data = mediafile::create([
            'nama' => $request->nama,
            'file' => $filePath,
            'id_gkmediasubf2' => $id_gkmediasubf2
        ]);
        $data->save();

        return redirect()->route('pemberitahuan_gkmediaparent_page')->with('success', 'data berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(gkmediafile $gkmediafile)
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

        $dataEdit = gkmediafile::findByUuid($uuid);

        // return view('Pages.ujian.mediaparent.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
        return response()->json([
            'data' =>  $dataEdit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid, $id_gkmediasubf2)
    {
        //
        $validation = $request->validate([
            'nama' => 'required',
            'filepond' => 'required|mimes:pdf',
            'filepond' => 'required|array',
            'filepond' => 'required|max:2048'
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file maks 2mb'
        ]);

        $dataUpdate = gkmediafile::findByUuid($uuid);

        $filePath = $dataUpdate->file;
        if($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('GKMediaFile', 'public');
            }
        }
        
        $dataUpdate->update([
            'nama' => $request->nama,
            'file' => $filePath,
            'id_gkmediasubf2' => $id_gkmediasubf2
        ]);

        return redirect()->route('pemberitahuan_gkmediaparent_page')->with('success', 'data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = gkmediafile::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('pemberitahuan_gkmediaparent_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

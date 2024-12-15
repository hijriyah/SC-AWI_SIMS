<?php

namespace App\Http\Controllers;

use App\Models\mediaFile;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class MediaFileController extends Controller
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
    public function store(Request $request, $id_mediaSubF2)
    {
        //

        $validation = $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('MediaFile', 'public');
            }
        }

        $data = mediaFile::create([
            'nama' => $request->nama,
            'file' => $filePath,
            'link' => $request->link,
            'id_mediaSubF2' => $id_mediaSubF2
        ]);
        $data->save();

        return redirect()->route('bukumedia_mediaparent_page')->with('success', 'data berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(mediaFile $mediaFile)
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

        $dataEdit = mediaFile::findByUuid($uuid);

        // return view('Pages.ujian.mediaparent.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
        return response()->json([
            'data' =>  $dataEdit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid, $id_mediaSubF2)
    {
        //
        $validation = $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
        ]);

        $dataUpdate = mediaFile::findByUuid($uuid);

        $filePath = $dataUpdate->file;
        if($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('MediaFile', 'public');
            }
        }
        
        $dataUpdate->update([
            'nama' => $request->nama,
            'file' => $filePath,
            'link' => $request->link,
            'id_mediaSubF2' => $id_mediaSubF2
        ]);

        return redirect()->route('bukumedia_mediaparent_page')->with('success', 'data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = mediaFile::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('bukumedia_mediaparent_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }

    // this for admin guru
    public function store2(Request $request, $id_mediaSubF2)
    {
        //

        $validation = $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('MediaFile', 'public');
            }
        }

        $data = mediaFile::create([
            'nama' => $request->nama,
            'link' => $request->link,
            'file' => $filePath,
            'id_mediaSubF2' => $id_mediaSubF2
        ]);
        $data->save();

        return redirect()->route('guru_bukumedia_mediaparent_page')->with('success', 'data berhasil disimpan');
    }
    public function edit2($uuid)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();

        $dataEdit = mediaFile::findByUuid($uuid);

        // return view('Pages.ujian.mediaparent.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
        return response()->json([
            'data' =>  $dataEdit
        ]);
    }
    public function update2(Request $request, $uuid, $id_mediaSubF2)
    {
        //
        $validation = $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
        ]);

        $dataUpdate = mediaFile::findByUuid($uuid);

        $filePath = $dataUpdate->file;
        if($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('MediaFile', 'public');
            }
        }
        
        $dataUpdate->update([
            'nama' => $request->nama,
            'file' => $filePath,
            'link' => $request->link,
            'id_mediaSubF2' => $id_mediaSubF2
        ]);

        return redirect()->route('guru_bukumedia_mediaparent_page')->with('success', 'data berhasil disimpan');
    }
    public function destroy2($uuid)
    {
        //
        $data = mediaFile::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('guru_bukumedia_mediaparent_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

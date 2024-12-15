<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\identitassekolah;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IdentitasSekolahController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = identitassekolah::query();
        
        if($request->has('search'))
        {
            $query->where('nama_sekolah', 'like', "%{$request->search}%");
        }

        $dataIdentitasSekolah = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.raport.identitassekolah.partials.table', compact('dataIdentitasSekolah'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.raport.identitassekolah.identitassekolah', compact(['adminSession', 'specAdmin', 'listMenu', 'dataIdentitasSekolah']));
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

        return view('Pages.raport.identitassekolah.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'nama_sekolah' => 'required',
            'alamat' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'nama_kepala_sekolah' => 'required',
            'nip_kepala_sekolah' => 'required'
            
        ]);

        $filePath = null;
        if(isset($request->file))
        {
            $file = $request->file('file'); 
            $filePath = $file->store('RaportIdentitasSekolah', 'public');
        }

        $data = identitassekolah::create([
            
            'nama_sekolah' => $request->nama_sekolah,
            'alamat' => $request->alamat,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'file' => $filePath,
            'nama_kepala_sekolah' => $request->nama_kepala_sekolah,
            'nip_kepala_sekolah' => $request->nip_kepala_sekolah
            
        ]);
        $data->save();

        return redirect()->route('raport_identitassekolah_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(identitassekolah $identitassekolah)
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

        $dataEdit = identitassekolah::findByUuid($uuid);
    
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.raport.identitassekolah.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'fileSize']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = identitassekolah::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('raport_identitassekolah_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = identitassekolah::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('raport_identitassekolah_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

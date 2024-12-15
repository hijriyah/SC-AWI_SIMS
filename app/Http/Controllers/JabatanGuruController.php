<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jabatanguru;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JabatanGuruController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = jabatanguru::query();
        
        if($request->has('search'))
        {
            $query->where('jabatan_guru', 'like', "%{$request->search}%");
        }

        $dataJabatanGuru = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.jabatan.jabatanguru.partials.table', compact('dataJabatanGuru'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.jabatan.jabatanguru.jabatanguru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataJabatanGuru']));
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

        return view('Pages.jabatan.jabatanguru.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'jabatan_guru' => 'required'
        ]);

        $data = jabatanguru::create([
            'jabatan_guru' => $request->jabatan_guru
        ]);
        $data->save();

        return redirect()->route('jabatan_jabatanguru_page')->with('success', 'data jabatan guru berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(jabatanguru $jabatanguru)
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

        $dataEdit = jabatanguru::findByUuid($uuid);

        return view('Pages.jabatan.jabatanguru.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = jabatanguru::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('jabatan_jabatanguru_page')->with('success', 'data jabatan guru berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = jabatanguru::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('jabatan_jabatanguru_page')->with('success', 'data jabatan guru berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data jabatan guru tidak ditemukan'
            ]);
        }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategoritahsin;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriTahsinController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = kategoritahsin::query();
        
        if($request->has('search'))
        {
            $query->where('kategori_tahsin', 'like', "%{$request->search}%");
        }

        $dataKategoriTahsin = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.alquran.tahsin.kategoritahsin.partials.table', compact('dataKategoriTahsin'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.alquran.tahsin.kategoritahsin.kategoritahsin', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKategoriTahsin']));
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

        return view('Pages.alquran.tahsin.kategoritahsin.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'kategori_tahsin' => 'required',
            'deskripsi' => 'required'
        ]);

        $data = kategoritahsin::create([
            'kategori_tahsin' => $request->kategori_tahsin,
            'deskripsi' => $request->deskripsi
        ]);
        $data->save();

        return redirect()->route('alquran_tahsin_kategoritahsin_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(kategoritahsin $kategoritahsin)
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

        $dataEdit = kategoritahsin::findByUuid($uuid);

        return view('Pages.alquran.tahsin.kategoritahsin.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = kategoritahsin::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('alquran_tahsin_kategoritahsin_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = kategoritahsin::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('alquran_tahsin_kategoritahsin_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }
}

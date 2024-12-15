<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lokasibarang;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LokasiBarangController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = lokasibarang::query();
        
        if($request->has('search'))
        {
            $query->where('lokasi_barang', 'like', "%{$request->search}%");
        }

        $dataLokasiBarang = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.inventaris.lokasibarang.partials.table', compact('dataLokasiBarang'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.inventaris.lokasibarang.lokasibarang', compact(['adminSession', 'specAdmin', 'listMenu', 'dataLokasiBarang']));
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

        return view('Pages.inventaris.lokasibarang.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'lokasi_barang' => 'required',
            'deskripsi' => 'required',
            'aktif' => 'required'
        ]);

        $data = lokasibarang::create([
            'lokasi_barang' => $request->lokasi_barang,
            'deskripsi' => $request->deskripsi, 
            'aktif' => $request->aktif
        ]);
        $data->save();

        return redirect()->route('inventaris_lokasibarang_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(lokasibarang $lokasibarang)
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

        $dataEdit = lokasibarang::findByUuid($uuid);

        return view('Pages.inventaris.lokasibarang.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = lokasibarang::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('inventaris_lokasibarang_page')->with('success', 'data lokasi barang berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = lokasibarang::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('inventaris_lokasibarang_page')->with('success', 'data lokasi barang berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data lokasi barang tidak ditemukan'
            ]);
        }

    }
}

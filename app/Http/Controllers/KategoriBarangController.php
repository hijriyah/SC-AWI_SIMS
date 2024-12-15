<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategoribarang;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriBarangController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = kategoribarang::query();
        
        if($request->has('search'))
        {
            $query->where('kategori_barang', 'like', "%{$request->search}%");
        }

        $dataKategoriBarang = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.inventaris.kategoribarang.partials.table', compact('dataKategoribarang'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.inventaris.kategoribarang.kategoribarang', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKategoriBarang']));
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

        return view('Pages.inventaris.kategoribarang.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'kategori_barang' => 'required',
            'deskripsi' => 'required',
            'aktif' => 'required'
        ]);

        $data = kategoribarang::create([
            'kategori_barang' => $request->kategori_barang,
            'deskripsi' => $request->deskripsi,
            'aktif' => $request->aktif
        ]);
        $data->save();

        return redirect()->route('inventaris_kategoribarang_page')->with('success', 'data berhasil disimpan');
    

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

        $dataEdit = kategoribarang::findByUuid($uuid);

        return view('Pages.inventaris.kategoribarang.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = kategoribarang::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('inventaris_kategoribarang_page')->with('success', 'data kategori barang berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = kategoribarang::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('inventaris_kategoribarang_page')->with('success', 'data kategori barang berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data kategori barang tidak ditemukan'
            ]);
        }

    }
}

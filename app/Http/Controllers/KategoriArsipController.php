<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategoriarsip;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriArsipController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = kategoriarsip::query();
        
        if($request->has('search'))
        {
            $query->where('kategori_arsip', 'like', "%{$request->search}%");
        }

        $dataKategoriArsip = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.arsipguru.kategoriarsip.partials.table', compact('dataKategoriArsip'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.arsipguru.kategoriarsip.kategoriarsip', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKategoriArsip']));
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

        return view('Pages.arsipguru.kategoriarsip.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'kategori_arsip' => 'required',
            'deskripsi' => 'required'
        ]);

        $data = kategoriarsip::create([
            'kategori_arsip' => $request->kategori_arsip,
            'deskripsi' => $request->deskripsi
        ]);
        $data->save();

        return redirect()->route('arsipguru_kategoriarsip_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(kategoriarsip $kategoriarsip)
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

        $dataEdit = kategoriarsip::findByUuid($uuid);

        return view('Pages.arsipguru.kategoriarsip.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = kategoriarsip::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('arsipguru_kategoriarsip_page')->with('success', 'data kategori arsip berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = kategoriarsip::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('arsipguru_kategoriarsip_page')->with('success', 'data kategori arsip berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data kategori arsip tidak ditemukan'
            ]);
        }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategorisoal;
use App\Models\Role;
use App\Models\guru;

class KategorisoalController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = kategorisoal::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%");
        }

        $dataKategoriSoal = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.ujian.kategorisoal.partials.table', compact('dataKategoriSoal'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.ujian.kategorisoal.kategorisoal', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKategoriSoal']));
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

        return view('Pages.ujian.kategorisoal.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'judul' => 'required',
        ], [
            'judul.required' => 'judul tidak boleh kosong'
        ]);

        $data = kategorisoal::create([
            'judul' => $request->judul,
        ]);
        $data->save();

        return redirect()->route('ujian_kategorisoal_page')->with('success', 'data berhasil disimpan');
    

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

        $dataEdit = kategorisoal::findByUuid($uuid);

        return view('Pages.ujian.kategorisoal.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = kategorisoal::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('ujian_kategorisoal_page')->with('success', 'data kategori barang berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = kategorisoal::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('ujian_kategorisoal_page')->with('success', 'data kategori barang berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data kategori barang tidak ditemukan'
            ]);
        }

    }

    // this for admin guru
    public function index2(Request $request)
    {
        //
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();

        $query = kategorisoal::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%");
        }

        $dataKategoriSoal = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.ujian.kategorisoal.partials.table', compact('dataKategoriSoal'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.guru.ujian.kategorisoal.kategorisoal', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKategoriSoal', 'SectionType']));
    }
    public function storePage2()
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();


        return view('Pages.admin.guru.ujian.kategorisoal.add', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType']));
    }
    public function store2(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'judul' => 'required',
        ], [
            'judul.required' => 'judul tidak boleh kosong'
        ]);

        $data = kategorisoal::create([
            'judul' => $request->judul,
        ]);
        $data->save();

        return redirect()->route('guru_ujian-kategorisoal_page')->with('success', 'data berhasil disimpan');
    

    }
    public function edit2($uuid)
    {
        //
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);
       
        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();


        $dataEdit = kategorisoal::findByUuid($uuid);

        return view('Pages.admin.guru.ujian.kategorisoal.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEdit', 'SectionType']));
    }
    public function update2(Request $request, $uuid)
    {
        //
        $data = kategorisoal::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('guru_ujian-kategorisoal_page')->with('success', 'data kategori barang berhasil diupdate');
        
    }
    public function destroy2($uuid)
    {
        //
        $data = kategorisoal::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('guru_ujian-kategorisoal_page')->with('success', 'data kategori barang berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data kategori barang tidak ditemukan'
            ]);
        }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategoripenilaiansikap;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriPenilaianSikapController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = kategoripenilaiansikap::query();
        
        if($request->has('search'))
        {
            $query->where('kategoripenilaiansikap', 'like', "%{$request->search}%");
        }

        $dataKategoriPenilaianSikap = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.raport.kategoripenilaiansikap.partials.table', compact('dataKategoriPenilaianSikap'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.raport.kategoripenilaiansikap.kategoripenilaiansikap', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKategoriPenilaianSikap']));
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

        return view('Pages.raport.kategoripenilaiansikap.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'kategoripenilaiansikap' => 'required|number'
        ]);

        $data = kategoripenilaiansikap::create([
            'kategoripenilaiansikap' => $request->kategoripenilaiansikap
        ]);
        $data->save();

        return redirect()->route('raport_kategoripenilaiansikap_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(kategoripenilaiansikap $kategoripenilaiansikap)
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

        $dataEdit = kategoripenilaiansikap::findByUuid($uuid);

        return view('Pages.raport.kategoripenilaiansikap.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = kategoripenilaiansikap::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('raport_kategoripenilaiansikap_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = kategoripenilaiansikap::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('raport_kategoripenilaiansikap_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }
}

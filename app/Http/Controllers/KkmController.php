<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kkm;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KkmController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = kkm::query();
        
        if($request->has('search'))
        {
            $query->where('range_nilai_kkm', 'like', "%{$request->search}%");
        }

        $dataKkm = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.raport.kkm.partials.table', compact('dataKkm'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.raport.kkm.kkm', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKkm']));
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

        return view('Pages.raport.kkm.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'range_nilai_kkm' => 'required|numeric',
            'predikat' => 'required',
            'deskripsi' => 'required'
        ]);

        $data = kkm::create([
            'range_nilai_kkm' => $request->range_nilai_kkm,
            'predikat' => $request->predikat,
            'deskripsi' => $request->deskripsi
        ]);
        $data->save();

        return redirect()->route('raport_kkm_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(kkm $kkm)
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

        $dataEdit = kkm::findByUuid($uuid);

        return view('Pages.raport.kkm.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = kkm::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('raport_kkm_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = kkm::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('raport_kkm_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }
}

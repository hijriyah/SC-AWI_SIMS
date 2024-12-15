<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use Illuminate\Http\Request;
use App\Models\Role;

class KalenderAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        // $dataKalenderAkademik = KalenderAkademik::select('nama', 'warna', 'tanggal');

        return view('Pages.penjadwalan.kalenderakademik.kalenderakademik', compact(['adminSession', 'specAdmin', 'listMenu']));
        

    }

    public function GetEvents()
    {
        $Events = KalenderAkademik::select('id', 'title', 'start', 'end')->get();

        return response()->json($Events);
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
    public function store(Request $request)
    {
        //
        $validation = $request->validate([
            'title' => 'required',
            'start' => 'required',
        ]);

        $data = kalenderAkademik::create([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end
        ]);
        $data->save();

    }

    /**
     * Display the specified resource.
     */
    public function show(KalenderAkademik $kalenderAkademik)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $dataEdit = KalenderAkademik::find($id);

        return response()->json([
            'data' => $dataEdit
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        $validation = $request->validate([
            'title' => 'required',
            'start' => 'required',
        ]);

        $dataUpdate = KalenderAkademik::find($id);

        $dataUpdate->update([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end
        ]);

        return redirect()->route('penjadwalan_kalenderakademik_page');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KalenderAkademik $kalenderAkademik)
    {
        //
    }

    public function index2()
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

        // $dataKalenderAkademik = KalenderAkademik::select('nama', 'warna', 'tanggal');

        return view('Pages.admin.guru.penjadwalan.kalenderakademik.kalenderakademik', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType']));
    }

    public function GetEvents2()
    {
        $Events = KalenderAkademik::select('id', 'title', 'start', 'end')->get();

        return response()->json($Events);
    }
}

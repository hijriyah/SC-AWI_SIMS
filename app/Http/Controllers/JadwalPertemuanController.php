<?php

namespace App\Http\Controllers;

use App\Models\JadwalPertemuan;
use Illuminate\Http\Request;
use App\Models\guru;
use App\Models\siswa;
use App\Models\orangtua;
use App\Models\Role;

class JadwalPertemuanController extends Controller
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

        return view('Pages.penjadwalan.jadwalpertemuan.jadwalpertemuan', compact(['adminSession', 'specAdmin', 'listMenu']));
    }

    public function GetEvents()
    {
        $Events = JadwalPertemuan::select('id', 'title', 'start', 'end')->get();

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

        $data = JadwalPertemuan::create([
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
    public function show(JadwalPertemuan $jadwalPertemuan)
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

        $dataEdit = JadwalPertemuan::find($id);

        return response()->json([
            'data' => $dataEdit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validation = $request->validate([
            'title' => 'required',
            'start' => 'required',
        ]);

        $dataUpdate = JadwalPertemuan::find($id);

        $dataUpdate->update([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end
        ]);

        return redirect()->route('penjadwalan_jadwalpertemuan_page');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalPertemuan $jadwalPertemuan)
    {
        //
    }

    // this for admin guru
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

        return view('Pages.admin.guru.penjadwalan.jadwalpertemuan.jadwalpertemuan', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType']));
    }
    public function GetEvents2()
    {
        $Events = JadwalPertemuan::select('id', 'title', 'start', 'end')->get();

        return response()->json($Events);
    }


    // this for admin siswa
    public function index3()
    {
        //
        $adminSession = session('admin_name');

        // Guru
        $roleGet = siswa::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;
 
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // $dataKalenderAkademik = KalenderAkademik::select('nama', 'warna', 'tanggal');

        return view('Pages.admin.siswa.penjadwalan.jadwalpertemuan.jadwalpertemuan', compact(['adminSession', 'specAdmin', 'listMenu']));
    }

    public function GetEvents3()
    {
        $Events = JadwalPertemuan::select('id', 'title', 'start', 'end')->get();

        return response()->json($Events);
    }

    // this for admin orangtua
    public function index4()
    {
        //
        $adminSession = session('admin_name');

        // orangtua
        $roleGet = orangtua::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;
 
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // $dataKalenderAkademik = KalenderAkademik::select('nama', 'warna', 'tanggal');

        return view('Pages.admin.orangtua.penjadwalan.jadwalpertemuan.jadwalpertemuan', compact(['adminSession', 'specAdmin', 'listMenu']));
    }

    public function GetEvents4()
    {
        $Events = JadwalPertemuan::select('id', 'title', 'start', 'end')->get();

        return response()->json($Events);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tahunajaran;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TahunAjaranController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = tahunajaran::query();
        
        if($request->has('search'))
        {
            $query->where('tahun_ajaran', 'like', "%{$request->search}%");
        }

        $dataTahunAjaran = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.pengaturan.tahunajaran.partials.table', compact('dataTahunAjaran'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.pengaturan.tahunajaran.tahunajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataTahunAjaran']));
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

        return view('Pages.pengaturan.tahunajaran.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'tipe_sekolah' => 'required',
            'tahun_ajaran' => 'required',
            'judul' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'semester' => 'required'
        ]);

        $data = tahunajaran::create([
            'tipe_sekolah' => $request->tipe_sekolah,
            'tahun_ajaran' => $request->tahun_ajaran,
            'judul' => $request->judul,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'semester' => $request->semester
        ]);
        $data->save();

        return redirect()->route('pengaturan_tahunajaran_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(tahunajaran $tahunajaran)
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

        $dataEdit = tahunajaran::findByUuid($uuid);

        return view('Pages.pengaturan.tahunajaran.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = tahunajaran::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('pengaturan_tahunajaran_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = tahunajaran::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('pengaturan_tahunajaran_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }
}

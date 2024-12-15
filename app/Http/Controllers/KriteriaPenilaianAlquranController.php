<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kriteriapenilaianalquran;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KriteriaPenilaianAlquranController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = kriteriapenilaianalquran::query();
        
        if($request->has('search'))
        {
            $query->where('range_nilai', 'like', "%{$request->search}%");
        }

        $dataKriteriaPenilaianAlquran = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.alquran.kriteriapenilaianalquran.partials.table', compact('dataKriteriaPenilaianAlquran'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.alquran.kriteriapenilaianalquran.kriteriapenilaianalquran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKriteriaPenilaianAlquran']));
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

        return view('Pages.alquran.kriteriapenilaianalquran.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'range_nilai' => 'required|number',
            'nilai_huruf' => 'required',
            'deskripsi' => 'required'
        ]);

        $data = kriteriapenilaianalquran::create([
            'range_nilai' => $request->range_nilai,
            'nilai_huruf' => $request->nilai_huruf,
            'deskripsi' => $request->deskripsi
        ]);
        $data->save();

        return redirect()->route('alquran_kriteriapenilaianalquran_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(kriteriapenilaianalquran $kriteriapenilaianalquran)
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

        $dataEdit = kriteriapenilaianalquran::findByUuid($uuid);

        return view('Pages.alquran.kriteriapenilaianalquran.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = kriteriapenilaianalquran::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('alquran_kriteriapenilaianalquran_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = kriteriapenilaianalquran::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('alquran_kriteriapenilaianalquran_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }
}

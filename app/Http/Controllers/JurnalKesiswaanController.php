<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jurnalkesiswaan;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class JurnalKesiswaanController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = jurnalkesiswaan::query();
        
        if($request->has('search'))
        {
            $query->where('program', 'like', "%{$request->search}%");
        }

        $dataJurnalKesiswaan = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.jurnal.jurnalkesiswaan.partials.table', compact('dataJurnalKesiswaan'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.jurnal.jurnalkesiswaan.jurnalkesiswaan', compact(['adminSession', 'specAdmin', 'listMenu', 'dataJurnalKesiswaan']));
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

        return view('Pages.jurnal.jurnalkesiswaan.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'program' => 'required',
            'waktu_realisasi' => 'required',
            'evaluasi' => 'required'
        ]);

        $data =jurnalkesiswaan::create([
            'program' => $request->program,
            'waktu_realisasi' => $request->waktu_realisasi,
            'evaluasi' => $request->evaluasi
        ]);
        $data->save();

        return redirect()->route('jurnal_jurnalkesiswaan_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(jurnalkesiswaan $jurnalkesiswaan)
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

        $dataEdit = jurnalkesiswaan::findByUuid($uuid);

        return view('Pages.jurnal.jurnalkesiswaan.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = jurnalkesiswaan::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('jurnal_jurnalkesiswaan_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = jurnalkesiswaan::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('jurnal_jurnalkesiswaan_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }

    public function DownloadReport($id)
    {
        $data = jurnalkesiswaan::find($id);
        $pdf = PDF::loadView('Laporan.JurnalKesiswaan.JurnalKesiswaanReport', ['data' => $data]);

        return $pdf->download('Jurnal Kesiswaan Report.pdf');


    }

}

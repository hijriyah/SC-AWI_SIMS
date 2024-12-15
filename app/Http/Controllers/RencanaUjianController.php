<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rencanaujian;
use App\Models\jadwalujian;
use App\Models\Role;

class RencanaUjianController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = rencanaujian::query();
        
        if($request->has('search'))
        {
            $query->where('rencana_ujian', 'like', "%{$request->search}%")
            ->orwhereHas('jadwalujian', function($q) use ($request) {
                $q->where('tanggal_ujian', 'like', "%{$request->search}%");
            });
        }

        $dataRencanaUjian = $query->with(['jadwalujian'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.ujian.rencanaujian.partials.table', compact('dataRencanaUjian'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.ujian.rencanaujian.rencanaujian ', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRencanaUjian']));
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

        return view('Pages.ujian.rencanaujian.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validation = $request->validate([
            'rencana_ujian' => 'required',
            'tanggal' => 'required',
            'catatan' => 'required'
        ], [
            'rencana_ujian.required' => 'rencana ujian tidak boleh kosong',
            'tanggal.required' => 'tanggal tidak boleh kosong',
            'catatan.required' => 'catatan tidak boleh kosong' 
        ]);

        $data = rencanaujian::create([
            'rencana_ujian' => $request->ujian,
            'tanggal' => $request->tanggal,
            'catatan' => $request->catatan
        ]);
        $data->save();

        return redirect()->route('ujian_rencanaujian_page')->with('success', 'data rencana ujian berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(staff $staff)
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

        $dataEdit = rencanaujian::findByUuid($uuid);

        return view('Pages.ujian.rencanaujian.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = ujian::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('ujian_rencanaujian_page')->with('success', 'data rencana ujian berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = rencanaujian::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('ujian_rencanaujian_page')->with('success', 'data rencana ujian berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data rencana ujian tidak ditemukan'
            ]);
        }
    }
}

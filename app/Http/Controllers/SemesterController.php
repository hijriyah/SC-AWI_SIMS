<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\semester;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SemesterController extends Controller
{
     public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = semester::query();
        
        if($request->has('search'))
        {
            $query->where('semester', 'like', "%{$request->search}%");
        }

        $dataSemester = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.pengaturan.semester.partials.table', compact('dataSemester'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.pengaturan.semester.semester', compact(['adminSession', 'specAdmin', 'listMenu', 'dataSemester']));
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

        return view('Pages.pengaturan.semester.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'semester' => 'required',
            'semester_huruf' => 'required',
            'aktif' => 'required'
        ]);

        $data = semester::create([
            'semester' => $request->semester,
            'semester_huruf' => $request->semester_huruf,
            'aktif' => $request->aktif
        ]);
        $data->save();

        return redirect()->route('pengaturan_semester_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(semester $semester)
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

        $dataEdit = semester::findByUuid($uuid);

        return view('Pages.pengaturan.semester.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = semester::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('pengaturan_semester_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = semester::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('pengaturan_semester_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }
}

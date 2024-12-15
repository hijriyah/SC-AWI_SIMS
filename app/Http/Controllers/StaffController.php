<?php

namespace App\Http\Controllers;

use App\Models\staff;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = staff::query();
        
        if($request->has('search'))
        {
            $query->where('nama', 'like', "%{$request->search}%");
        }

        $dataStaff = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.master.staff.partials.table', compact('dataStaff'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.master.staff.staff ', compact(['adminSession', 'specAdmin', 'listMenu', 'dataStaff']));
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

        return view('Pages.master.staff.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validation = $request->validate([
            'nama' => 'required',
            'nama_panggilan' => 'required',
            'tanggal' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_telp' => 'required',
            'username' => 'required',
            'password' => 'required',
            'aktif' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'required'
        ]);

        $filePath = null;
        if(isset($request->file))
        {
            $file = $request->file('file'); 
            $filePath = $file->store('AdminMasterGuru', 'public');
        }



        $roleGuru = Role::where('name', 'Staff')->first();

        $data = staff::create([
            'nama' => $request->nama,
            'nama_panggilan' => $request->nama_panggilan,
            'tanggal' => $request->tanggal,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'aktif' => $request->aktif,
            'photo' => $filePath,
            'no_telp' => $request->no_telp,
            'username' => $request->username,
            'password' => $request->password,
            'role_id' => $roleGuru->id,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi
        ]);
        $data->save();

        return redirect()->route('staff_master_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = staff::findByUuid($uuid);

        return view('Pages.master.staff.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = staff::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('staff_master_page')->with('success', 'data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = staff::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('staff_master_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data not found'
            ]);
        }
    }
}

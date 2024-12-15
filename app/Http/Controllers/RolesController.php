<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = Role::query();
        
        if($request->has('search'))
        {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $dataRole = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.pengaturan.roles.partials.table', compact('dataRole'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.pengaturan.roles.roles', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
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
        $dataPermission = DB::table('permissions')->get();

        return view('Pages.pengaturan.roles.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataPermission']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong'
        ]);

        $data = Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        // $data->save();

        $Permissions = $request->permission;

        foreach($request->permission as $permissions)
        {
            $roleHasPermission = DB::table('role_has_permissions')->insert([
                'role_id' => $data->id,
                'permission_id' => $permissions
            ]);

        }

        return redirect()->route('pengaturan_role_page')->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(guru $guru)
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
        // $dataRoles = Role::get();

        $dataEdit = Role::find($id);
        $dataPermission = DB::table('permissions')->get();
        $dataRolesHas = DB::table('role_has_permissions')->where('role_id', $dataEdit->id)->pluck('permission_id')->toArray();

        return view('Pages.pengaturan.roles.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEdit', 'dataPermission', 'dataRolesHas']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $data = Role::find($id);
        $data->update([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        $Permissions = $request->permission;

        foreach($request->permission as $permissions)
        {
            $roleHasPermission = DB::table('role_has_permissions')->updateOrInsert([
                'role_id' => $data->id,
                'permission_id' => $permissions
            ]);

        }

        return redirect()->route('pengaturan_role_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $data = Role::find($id);

        if($data)
        {
            $data->delete();
            $deleteRoleHas = DB::table('role_has_permissions')->where('role_id', $data->id)->delete();
            return redirect()->route('pengaturan_role_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }
}

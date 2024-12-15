<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ekstrakurikuler;
use App\Models\Role;
use App\Models\siswa;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EkstrakurikulerController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = ekstrakurikuler::query();
        
        if($request->has('search'))
        {
            $query->where('ekstrakurikuler', 'like', "%{$request->search}%");
        }

        $dataEkstrakurikuler = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.pemberitahuan.ekstrakurikuler.partials.table', compact('dataEkstrakurikuler'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.pemberitahuan.ekstrakurikuler.ekstrakurikuler', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEkstrakurikuler']));
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

        return view('Pages.pemberitahuan.ekstrakurikuler.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'ekstrakurikuler' => 'required',
            'keterangan' => 'required'
        ]);

        $data = ekstrakurikuler::create([
            'ekstrakurikuler' => $request->ekstrakurikuler,
            'keterangan' => $request->keterangan
        ]);
        $data->save();

        return redirect()->route('pemberitahuan_ekstrakurikuler_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(ekstrakurikuler $ekstrakurikuler)
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

        $dataEdit = ekstrakurikuler::findByUuid($uuid);

        return view('Pages.pemberitahuan.ekstrakurikuler.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = ekstrakurikuler::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('pemberitahuan_ekstrakurikuler_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = ekstrakurikuler::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('pemberitahuan_ekstrakurikuler_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }

    // this for admin siswa
    public function index3(Request $request)
    {
        //
        $adminSession = session('admin_name');

       // Guru
       $roleGet = siswa::where('username', $adminSession)->first();
       $roleStatus = Role::find($roleGet->role_id);
       $specAdmin = $roleStatus->name;

       $roleCheck = new Role;
       $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $query = ekstrakurikuler::query();
        
        if($request->has('search'))
        {
            $query->where('ekstrakurikuler', 'like', "%{$request->search}%");
        }

        $dataEkstrakurikuler = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.siswa.pemberitahuan.ekstrakurikuler.partials.table', compact('dataEkstrakurikuler'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.siswa.pemberitahuan.ekstrakurikuler.ekstrakurikuler', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEkstrakurikuler']));
    }
}

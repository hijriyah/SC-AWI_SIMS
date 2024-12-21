<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\liburan;
use App\Models\Role;
use App\Models\guru;
use App\Models\siswa;
use App\Models\orangtua;
use App\Models\tahunajaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LiburanController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = liburan::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")

            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataLiburan = $query->with(['tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.pemberitahuan.liburan.partials.table', compact('dataLiburan'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.pemberitahuan.liburan.liburan', compact(['adminSession', 'specAdmin', 'listMenu', 'dataLiburan']));
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
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();

        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.pemberitahuan.liburan.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataTahunAjaran']));
    }

    /**
     * Store a newly created resource in storage.
     */
    
     public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'id_tahun_ajaran' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            
        ]);

        $filePath = null;
        if(isset($request->file))
        {
            $file = $request->file('file'); 
            $filePath = $file->store('PemberitahuanLiburan', 'public');
        }

        $data = liburan::create([
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            
            'file' => $filePath
            
        ]);
        $data->save();

        return redirect()->route('pemebritahuan_liburan_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(liburan $liburan)
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

        $dataEdit = liburan::findByUuid($uuid);
        $dataTahunAjaran = tahunajaran::all();
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.pemberitahuan.liburan.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataTahunAjaran', 'fileSize']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = liburan::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('pemebritahuan_liburan_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = liburan::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('pemberitahuan_liburan_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }

    // this for admin guru
    public function index2(Request $request)
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


        $query = liburan::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")

            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataLiburan = $query->with(['tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.pemberitahuan.liburan.partials.table', compact('dataLiburan'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.guru.pemberitahuan.liburan.liburan', compact(['adminSession', 'specAdmin', 'listMenu', 'dataLiburan', 'SectionType']));
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

        $query = liburan::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")

            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataLiburan = $query->with(['tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.siswa.pemberitahuan.liburan.partials.table', compact('dataLiburan'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.siswa.pemberitahuan.liburan.liburan', compact(['adminSession', 'specAdmin', 'listMenu', 'dataLiburan']));
    }

    // this for admin orangtua
    public function index4(Request $request)
    {
        //
        $adminSession = session('admin_name');

        // Guru
        $roleGet = orangtua::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $query = liburan::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")

            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataLiburan = $query->with(['tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.orangtua.pemberitahuan.liburan.partials.table', compact('dataLiburan'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.orangtua.pemberitahuan.liburan.liburan', compact(['adminSession', 'specAdmin', 'listMenu', 'dataLiburan']));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rencanakegiatan;
use App\Models\Role;
use App\Models\tahunajaran;
use App\Models\guru;
use App\Models\siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class RencanaKegiatanController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = rencanakegiatan::query();
        
        if($request->has('search'))
        {
            $query->where('nama_kegiatan', 'like', "%{$request->search}%")

            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataRencanaKegiatan = $query->with(['tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.pemberitahuan.rencanakegiatan.partials.table', compact('dataRencanaKegiatan'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.pemberitahuan.rencanakegiatan.rencanakegiatan', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRencanaKegiatan']));
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

        return view('Pages.pemberitahuan.rencanakegiatan.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataTahunAjaran']));
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
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi_kegiatan' => 'required'
            
        ]);

        $filePath = null;
        if(isset($request->file))
        {
            $file = $request->file('file'); 
            $filePath = $file->store('PemberitahuanRencanaKegiatan', 'public');
        }

        $data = rencanakegiatan::create([
            
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'nama_kegiatan' => $request->nama_kegiatan,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
            'file' => $filePath,
            
        ]);
        $data->save();

        return redirect()->route('pemberitahuan_rencanakegiatan_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(rencanakegiatan $rencanakegiatan)
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

        $dataEdit = rencanakegiatan::findByUuid($uuid);
        $dataTahunAjaran = tahunajaran::all();
        

        $fileSize = null;
        if($dataEdit->file != null)
        {
            $fileSize = Storage::disk('public')->size($dataEdit->file);
        }

        return view('Pages.pemberitahuan.rencanakegiatan.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataTahunAjaran', 'fileSize']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = rencanakegiatan::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('pemberitahuan_rencanakegiatan_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = rencanakegiatan::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('pemberitahuan_rencanakegiatan_page')->with('success', 'data berhasil dihapus');
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

        $query = rencanakegiatan::query();
        
        if($request->has('search'))
        {
            $query->where('nama_kegiatan', 'like', "%{$request->search}%")

            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataRencanaKegiatan = $query->with(['tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.pemberitahuan.rencanakegiatan.partials.table', compact('dataRencanaKegiatan'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.guru.pemberitahuan.rencanakegiatan.rencanakegiatan', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRencanaKegiatan', 'SectionType']));
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

        $query = rencanakegiatan::query();
        
        if($request->has('search'))
        {
            $query->where('nama_kegiatan', 'like', "%{$request->search}%")

            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataRencanaKegiatan = $query->with(['tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.siswa.pemberitahuan.rencanakegiatan.partials.table', compact('dataRencanaKegiatan'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.siswa.pemberitahuan.rencanakegiatan.rencanakegiatan', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRencanaKegiatan']));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\guru;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GuruController extends Controller
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

        $query = guru::query();
        
        if($request->has('search'))
        {
            $query->where('nama_panggilan', 'like', "%{$request->search}%");
        }

        $dataGuru = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.master.guru.partials.table', compact('dataGuru'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']));
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

        return view('Pages.master.guru.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'nama_lengkap' => 'required',
            'nama_panggilan' => 'required',
            'tanggal_bergabung' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
            'aktif' => 'required',
            // 'warna' => 'required'
        ], [
            'nama_lengkap.required' => 'nama lengkap tidak boleh kosong',
            'nama_panggilan.required' => 'nama panggilan tidak boleh kosong',
            'tanggal_bergabung.required' => 'tanggal bergabung tidak kosong',
            'jenis_kelamin.required' => 'jenis_kelamin tidak boleh kosong',
            'agama.required' => 'agama tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
            'no_telp.required' => 'no telp tidak boleh kosong',
            'alamat.required' => 'alamat tidak boleh kosong',
            'username.required' => 'username tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong',
            'aktif.required' => 'aktif tidak boleh kosong',
            // 'warna.required' => 'warna tidak boleh kosong'
        ]);

        $filePath = null;
        if(isset($request->file))
        {
            $file = $request->file('file'); 
            $filePath = $file->store('AdminMasterGuru', 'public');
        }



        $roleGuru = Role::where('name', 'Guru')->first();

        $data = guru::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nama_panggilan' => $request->nama_panggilan,
            'tanggal_bergabung' => $request->tanggal_bergabung,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'photo' => $filePath,
            'username' => $request->username,
            'password' => $request->password,
            'aktif' => $request->aktif,
            'warna' => $request->warna,
            'role_id' => $roleGuru->id
        ]);
        $data->save();

        return redirect()->route('guru_master_page')->with('success', 'data berhasil disimpan');
    

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

    
    
    public function edit($uuid)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();

        $dataEdit = guru::findByUuid($uuid);

        return view('Pages.master.guru.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        // dd($request->all());

        $data = guru::findbyUuid($uuid);
        $validation = $request->validate([
            'nama_lengkap' => 'required',
            'nama_panggilan' => 'required',
            'tanggal_bergabung' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
            'aktif' => 'required',
            // 'warna' => 'required'
        ], [
            'nama_lengkap.required' => 'nama lengkap tidak boleh kosong',
            'nama_panggilan.required' => 'nama panggilan tidak boleh kosong',
            'tanggal_bergabung.required' => 'tanggal bergabung tidak kosong',
            'jenis_kelamin.required' => 'jenis_kelamin tidak boleh kosong',
            'agama.required' => 'agama tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
            'no_telp.required' => 'no telp tidak boleh kosong',
            'alamat.required' => 'alamat tidak boleh kosong',
            'username.required' => 'username tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong',
            'aktif.required' => 'aktif tidak boleh kosong',
            // 'warna.required' => 'warna tidak boleh kosong'
        ]);

        $filePath = null;
        if(isset($request->file))
        {
            $file = $request->file('file'); 
            $filePath = $file->store('AdminMasterGuru', 'public');
        }


        $roleGuru = Role::where('name', 'Guru')->first();

        $data->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nama_panggilan' => $request->nama_panggilan,
            'tanggal_bergabung' => $request->tanggal_bergabung,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'photo' => $filePath,
            'username' => $request->username,
            'password' => $request->password,
            'aktif' => $request->aktif,
            'warna' => $request->warna,
            'role_id' => $roleGuru->id
        ]);

        return redirect()->route('guru_master_page')->with('success', 'data berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = guru::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('guru_master_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ]);
        }

    }

    public function index2(Request $request)
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();


        $query = guru::query();
        
        if($request->has('search'))
        {
            $query->where('nama_lengkap', 'like', "%{$request->search}%")

            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('section', function($q) use ($request) {
                $q->where('section', 'like', "%{$request->search}%");
            });
        }

        $dataGuru = $query->with(['kelas', 'section'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.master.guru.partials.table', compact('dataGuru'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.guru.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru', 'SectionType']));
    }
    public function GuruInfo($uuid)
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();


        $dataInfo = guru::with(['kelas', 'section'])->where('uuid', $uuid)->first();

        return view('Pages.admin.guru.master.guru.info', compact(['adminSession', 'specAdmin', 'listMenu', 'dataInfo', 'SectionType']));
    }

}

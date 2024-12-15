<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\materimatapelajaran;
use App\Models\kelas;
use App\Models\guru;
use App\Models\orangtua;
use App\Models\tahunajaran;
use App\Models\matapelajaran;
use Illuminate\Support\Facades\Storage;

class MateriMataPelajaranController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = materimatapelajaran::query();
        
        if($request->has('search'))
        {
            $query->where('materi', 'like', "%{$request->search}%")

            ->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            })->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataMateriMataPelajaran = $query->with(['matapelajaran', 'kelas', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.akademik.materimatapelajaran.partials.table', compact('dataMateriMataPelajaran'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.akademik.materimatapelajaran.materimatapelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMateriMataPelajaran']));
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

        $dataMataPelajaran = matapelajaran::all();
        $dataKelas = kelas::all();
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.akademik.materimatapelajaran.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataMataPelajaran', 'dataKelas', 'dataTahunAjaran',]));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $validation = $request->validate([
            
            'id_tahun_ajaran' => 'required',
            'id_kelas' => 'required',
            'id_mata_pelajaran' => 'required',
            'materi' => 'required',
            'deskripsi' => 'required',
            'author' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array'

        ], [

        	'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
        	'id_kelas.required' => 'kelas tidak boleh kosong',
        	'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',

            'materi.required' => 'materi tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'author.required' => 'author tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB'

        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikMateriMataPelajaran', 'public');
            }
        }

        $data = materimatapelajaran::create([
        	'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_kelas' => $request->id_kelas,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'materi' => $request->materi,
            'deskripsi' => $request->deskripsi,
            'author' => $request->author,
            'file' => $filePath
            
        ]);
        $data->save();

        return redirect()->route('akademik_materimatapelajaran_page')->with('success', 'data materi matapelajaran berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(materimatapelajaran $materimatapelajaran)
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

        $dataEdit = materimatapelajaran::findByUuid($uuid);
        $dataMataPelajaran = matapelajaran::all();
        $dataKelas = kelas::all();
        $dataTahunAjaran = tahunajaran::all();
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.akademik.materimatapelajaran.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataMataPelajaran', 'dataKelas', 'dataTahunAjaran', 'fileSize']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        // dd($request->all());
        
        $validation = $request->validate([
            'id_tahun_ajaran' => 'required',
            'id_kelas' => 'required',
            'id_mata_pelajaran' => 'required',
            'materi' => 'required',
            'deskripsi' => 'required',
            'author' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array'

        ], [

        	'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',
            'materi.required' => 'materi tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'author.required' => 'author tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB'

        ]);

        $data = materimatapelajaran::findbyUuid($uuid);

        $filePath = $data->file;
        // if($request->hasFile('filepond'))
        // {
        //     $updateFile = $request->file('filepond');
        //     $filePath = $updateFile->store('AkademikPenugasanSiswa', 'public');
        // }
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikMateriMataPelajaran', 'public');
            }
        }

        $data->update([

        	'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_kelas' => $request->id_kelas,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'materi' => $request->materi,
            'deskripsi' => $request->deskripsi,
            'author' => $request->author,
            'file' => $filePath
            
        ]);

        return redirect()->route('akademik_materimatapelajaran_page')->with('success', 'data Materi Mata Pelajaran berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = materimatapelajaran::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('akademik_materimatapelajaran_page')->with('success', 'data materi mata pelajaran berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data materi mata pelajaran tidak ditemukan'
            ]);
        }
    }

    // For Admin Guru
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


        $query = materimatapelajaran::query();
        
        if($request->has('search'))
        {
            $query->where('materi', 'like', "%{$request->search}%")

            ->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            })->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataMateriMataPelajaran = $query->with(['matapelajaran', 'kelas', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.akademik.materi.partials.table', compact('dataMateriMataPelajaran'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.guru.akademik.materi.materi', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMateriMataPelajaran', 'SectionType']));
    }
    public function storePage2()
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


        $dataMataPelajaran = matapelajaran::all();
        $dataKelas = kelas::all();
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.admin.guru.akademik.materi.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMataPelajaran', 'dataKelas', 'dataTahunAjaran', 'SectionType']));
    }
    public function store2(Request $request)
    {
        // dd($request->all());
        $validation = $request->validate([
            
            'id_tahun_ajaran' => 'required',
            'id_kelas' => 'required',
            'id_mata_pelajaran' => 'required',
            'materi' => 'required',
            'deskripsi' => 'required',
            'author' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array'

        ], [

        	'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
        	'id_kelas.required' => 'kelas tidak boleh kosong',
        	'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',

            'materi.required' => 'materi tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'author.required' => 'author tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB'

        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikMateriMataPelajaran', 'public');
            }
        }

        $data = materimatapelajaran::create([
        	'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_kelas' => $request->id_kelas,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'materi' => $request->materi,
            'deskripsi' => $request->deskripsi,
            'author' => $request->author,
            'file' => $filePath
            
        ]);
        $data->save();

        return redirect()->route('guru_akademik-materi_page')->with('success', 'data materi matapelajaran berhasil disimpan');
    }
    public function edit2($uuid)
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


        $dataEdit = materimatapelajaran::findByUuid($uuid);
        $dataMataPelajaran = matapelajaran::all();
        $dataKelas = kelas::all();
        $dataTahunAjaran = tahunajaran::all();
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.admin.guru.akademik.materi.edit', compact(['adminSession', 'specAdmin', 'listMenu','dataEdit', 'dataMataPelajaran', 'dataKelas', 'dataTahunAjaran', 'fileSize', 'SectionType']));
    }
    public function update2(Request $request, $uuid)
    {
        //
        // dd($request->all());
        
        $validation = $request->validate([
            'id_tahun_ajaran' => 'required',
            'id_kelas' => 'required',
            'id_mata_pelajaran' => 'required',
            'materi' => 'required',
            'deskripsi' => 'required',
            'author' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array'

        ], [

        	'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',
            'materi.required' => 'materi tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'author.required' => 'author tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB'

        ]);

        $data = materimatapelajaran::findbyUuid($uuid);

        $filePath = $data->file;
        // if($request->hasFile('filepond'))
        // {
        //     $updateFile = $request->file('filepond');
        //     $filePath = $updateFile->store('AkademikPenugasanSiswa', 'public');
        // }
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikMateriMataPelajaran', 'public');
            }
        }

        $data->update([

        	'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_kelas' => $request->id_kelas,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'materi' => $request->materi,
            'deskripsi' => $request->deskripsi,
            'author' => $request->author,
            'file' => $filePath
            
        ]);

        return redirect()->route('guru_akademik-materi_page')->with('success', 'data Materi Mata Pelajaran berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = materimatapelajaran::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('guru_akademik-materi_page')->with('success', 'data materi mata pelajaran berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data materi mata pelajaran tidak ditemukan'
            ]);
        }
    }

    // this for admin orangtua
    public function index4(Request $request)
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = orangtua::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $query = materimatapelajaran::query();
        
        if($request->has('search'))
        {
            $query->where('materi', 'like', "%{$request->search}%")

            ->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            })->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataMateriMataPelajaran = $query->with(['matapelajaran', 'kelas', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.orangtua.akademik.materimatapelajaran.partials.table', compact('dataMateriMataPelajaran'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.orangtua.akademik.materimatapelajaran.materimatapelajaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMateriMataPelajaran']));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tugassiswa;
use App\Models\Role;
use App\Models\kelas;
use App\Models\guru;
use App\Models\siswa;
use App\Models\orangtua;
use App\Models\tahunajaran;
use App\Models\section;
use App\Models\matapelajaran;
use Illuminate\Support\Facades\Storage;

class TugasSiswaController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = tugassiswa::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")

            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");

            })->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            })->orwhereHas('section', function($q) use ($request) {
                $q->where('section', 'like', "%{$request->search}%");
            })->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            });
        }

        $dataTugasSiswa = $query->with(['kelas', 'tahunajaran', 'section', 'matapelajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.akademik.tugassiswa.partials.table', compact('dataTugasSiswa'))->render();

            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.akademik.tugassiswa.tugassiswa', compact(['adminSession', 'specAdmin', 'listMenu', 'dataTugasSiswa']));
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

        $dataKelas = kelas::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSection = section::all();
        $dataMataPelajaran = matapelajaran::all();

        return view('Pages.akademik.tugassiswa.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas', 'dataTahunAjaran', 'dataSection', 'dataMataPelajaran']));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $validation = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'deadline' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array',
            'id_kelas' => 'required',
            'id_tahun_ajaran' => 'required',
            'id_section' => 'required',
            'id_mata_pelajaran' => 'required'

        ], [

            'judul.required' => 'judul tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'deadline.required' => 'deadline tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB',

            'id_kelas.required' => 'kelas tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'id_section.required' =>  'section tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong'
            
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikTugasSiswa', 'public');
            }
        }

        $CountSiswa = siswa::where('id_kelas', $request->id_kelas)->get();

        foreach($CountSiswa as $csiswa)
        {
            
            $data = tugassiswa::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'deadline' => $request->deadline,
                'file' => $filePath,
                'id_siswa' => $csiswa->id,
                'id_kelas' => $request->id_kelas,
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'id_section' => $request->id_section,
                'id_mata_pelajaran' => $request->id_mata_pelajaran
            ]);
        }


        return redirect()->route('akademik_tugassiswa_page')->with('success', 'data tugas siswa berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(tugassiswa $tugassiswa)
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

        $dataEdit = tugassiswa::findByUuid($uuid);
        $dataKelas = kelas::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSection = section::all();
        $dataMataPelajaran = matapelajaran::all();
        // $fileSource = Storage::disk('public')->url($dataEdit->file);
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.akademik.tugassiswa.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKelas', 'dataTahunAjaran', 'dataSection', 'dataMataPelajaran', 'fileSize']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        // dd($request->all());
        
        $validation = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'deadline' => 'required',
            'filepond' => 'required|mimes:pdf',
            'filepond' => 'required|array',
            'id_kelas' => 'required',
            'id_tahun_ajaran' => 'required',
            'id_section' => 'required',
            'id_mata_pelajaran' => 'required'

        ], [

            'judul.required' => 'judul tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'deadline.required' => 'deadline tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB',

            'id_kelas.required' => 'kelas tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'id_section.required' =>  'section tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong'
            
        ]);

        $data = tugassiswa::findbyUuid($uuid);

        $filePath = $data->file;
        // if($request->hasFile('filepond'))
        // {
        //     $updateFile = $request->file('filepond');
        //     $filePath = $updateFile->store('AkademikPenugasanSiswa', 'public');
        // }
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikTugasSiswa', 'public');
            }
        }

        $Siswa = siswa::where('id_kelas', $request->id_kelas)->first();

        $data->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            'file' => $filePath,
            'id_siswa' => $Siswa->id,
            'id_kelas' => $request->id_kelas,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_section' => $request->id_section,
            'id_mata_pelajaran' => $request->id_mata_pelajaran
        ]);

        return redirect()->route('akademik_tugassiswa_page')->with('success', 'data tugas siswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = tugassiswa::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('akademik_tugassiswa_page')->with('success', 'data tugas siswa berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tugas siswa tidak ditemukan'
            ]);
        }
    }

    // For Admin Guru
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

        $query = tugassiswa::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")

            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");

            })->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            })->orwhereHas('section', function($q) use ($request) {
                $q->where('section', 'like', "%{$request->search}%");
            })->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            });
        }

        $dataTugasSiswa = $query->with(['kelas', 'tahunajaran', 'section', 'matapelajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.akademik.tugassiswa.partials.table', compact('dataTugasSiswa'))->render();

            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.guru.akademik.tugassiswa.tugassiswa', compact(['adminSession', 'specAdmin', 'listMenu', 'dataTugasSiswa', 'SectionType']));
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

        $dataKelas = kelas::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSection = section::all();
        $dataMataPelajaran = matapelajaran::all();

        return view('Pages.admin.guru.akademik.tugassiswa.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKelas', 'dataTahunAjaran', 'dataSection', 'dataMataPelajaran', 'SectionType']));
    }
    public function store2(Request $request)
    {
        $validation = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'deadline' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array',
            'id_kelas' => 'required',
            'id_tahun_ajaran' => 'required',
            'id_section' => 'required',
            'id_mata_pelajaran' => 'required'

        ], [

            'judul.required' => 'judul tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'deadline.required' => 'deadline tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB',

            'id_kelas.required' => 'kelas tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'id_section.required' =>  'section tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong'
            
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikTugasSiswa', 'public');
            }
        }
        $CountSiswa = siswa::where('id_kelas', $request->id_kelas)->get();

        foreach($CountSiswa as $csiswa)
        {
            
            $data = tugassiswa::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'deadline' => $request->deadline,
                'file' => $filePath,
                'id_siswa' => $csiswa->id,
                'id_kelas' => $request->id_kelas,
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'id_section' => $request->id_section,
                'id_mata_pelajaran' => $request->id_mata_pelajaran
            ]);
        }

        return redirect()->route('guru_akademik-tugassiswa_page')->with('success', 'data tugas siswa berhasil disimpan');
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

        $dataEdit = tugassiswa::findByUuid($uuid);
        $dataKelas = kelas::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSection = section::all();
        $dataMataPelajaran = matapelajaran::all();
        // $fileSource = Storage::disk('public')->url($dataEdit->file);
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.admin.guru.akademik.tugassiswa.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEdit', 'dataKelas', 'dataTahunAjaran', 'dataSection', 'dataMataPelajaran', 'fileSize', 'SectionType']));
    }
    public function update2(Request $request, $uuid)
    {
        //
        // dd($request->all());
        
        $validation = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'deadline' => 'required',
            'filepond' => 'required|mimes:pdf',
            'filepond' => 'required|array',
            'id_kelas' => 'required',
            'id_tahun_ajaran' => 'required',
            'id_section' => 'required',
            'id_mata_pelajaran' => 'required'

        ], [

            'judul.required' => 'judul tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'deadline.required' => 'deadline tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB',

            'id_kelas.required' => 'kelas tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'id_section.required' =>  'section tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong'
            
        ]);

        $data = tugassiswa::findbyUuid($uuid);

        $filePath = $data->file;
        // if($request->hasFile('filepond'))
        // {
        //     $updateFile = $request->file('filepond');
        //     $filePath = $updateFile->store('AkademikPenugasanSiswa', 'public');
        // }
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikTugasSiswa', 'public');
            }
        }

        $Siswa = siswa::where('id_kelas', $request->id_kelas)->first();

        $data->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            'file' => $filePath,
            'id_siswa' => $Siswa->id,
            'id_kelas' => $request->id_kelas,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_section' => $request->id_section,
            'id_mata_pelajaran' => $request->id_mata_pelajaran
        ]);

        return redirect()->route('guru_akademik-tugassiswa_page')->with('success', 'data tugas siswa berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = tugassiswa::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('guru_akademik-tugassiswa_page')->with('success', 'data tugas siswa berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tugas siswa tidak ditemukan'
            ]);
        }
    }

    // this for admin siswa
    public function index3(Request $request)
    {
        //
        $adminSession = session('admin_name');

        // Guru
        $roleGet = siswa::with('kelas')->where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $query = tugassiswa::where('id_siswa', $roleGet->id);
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")

            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");

            })->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            })->orwhereHas('section', function($q) use ($request) {
                $q->where('section', 'like', "%{$request->search}%");
            })->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            });
        }

        $dataTugasSiswa = $query->with(['kelas', 'tahunajaran', 'section', 'matapelajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.siswa.akademik.tugassiswa.partials.table', compact('dataTugasSiswa'))->render();

            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.siswa.akademik.tugassiswa.tugassiswa', compact(['adminSession', 'specAdmin', 'listMenu', 'dataTugasSiswa']));
    }
    public function storePage3()
    {
        $adminSession = session('admin_name');

        // siswa
        $roleGet = siswa::with('kelas')->where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);
        
        return view('Pages.admin.siswa.akademik.tugassiswa.add', compact(['adminSession', 'specAdmin', 'listMenu']));
    }
    public function store3(Request $request)
    {
        $validation = $request->validate([
            'filepond' => 'required',
            'filepond' => 'required|mimes:pdf',
            'filepond' => 'required|max:2048',
            'filepond' => 'required|array'
        ], [
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file max 2mb',
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikTugasSiswaJawaban', 'public');
            }
        }

        $adminSession = session('admin_name');
        $SiswaGet = siswa::where('username', $adminSession)->first();

        $data = tugassiswa::where('id_siswa', $SiswaGet->id)->first();
        $data->update([
            'jawaban' => $filePath
        ]);

        return redirect()->route('siswa_akademik-tugassiswa_page')->with('success', 'data berhasil disimpan');
    }
    public function edit3()
    {
        $adminSession = session('admin_name');
        // siswa
        $roleGet = siswa::with('kelas')->where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;
  
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $SiswaGet = siswa::where('username', $adminSession)->first();

        $dataEdit = tugassiswa::where('id_siswa', $SiswaGet->id)->first();
        $fileSize = Storage::disk('public')->size($dataEdit->jawaban);

        return view('Pages.admin.siswa.akademik.tugassiswa.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEdit', 'fileSize']));
    }
    public function update3(Request $request)
    {
        $validation = $request->validate([
            'filepond' => 'required',
            'filepond' => 'required|mimes:pdf',
            'filepond' => 'required|max:2048',
            'filepond' => 'required|array'
        ], [
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file max 2mb',
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikTugasSiswaJawaban', 'public');
            }
        }

        $adminSession = session('admin_name');
        $SiswaGet = siswa::where('username', $adminSession)->first();

        $data = tugassiswa::where('id_siswa', $SiswaGet->id)->first();

        $data->update([
            'jawaban' => $filePath
        ]);

        return redirect()->route('siswa_akademik-tugassiswa_page')->with('success', 'data berhasil disimpan');
    }

    // this for admin orangtua
    public function index4(Request $request)
    {
        //
        $adminSession = session('admin_name');

        // Orang Tua
        $roleGet = orangtua::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $TheParentOfStudent = siswa::where('id_orangtua', $roleGet->id)->first();

        $query = tugassiswa::where('id_siswa', $TheParentOfStudent->id);
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")

            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");

            })->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            })->orwhereHas('section', function($q) use ($request) {
                $q->where('section', 'like', "%{$request->search}%");
            })->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            });
        }

        $dataTugasSiswa = $query->with(['kelas', 'tahunajaran', 'section', 'matapelajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.orangtua.akademik.tugassiswa.partials.table', compact('dataTugasSiswa'))->render();

            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.orangtua.akademik.tugassiswa.tugassiswa', compact(['adminSession', 'specAdmin', 'listMenu', 'dataTugasSiswa']));
    }
    

}

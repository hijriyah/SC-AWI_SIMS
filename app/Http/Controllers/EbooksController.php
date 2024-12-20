<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ebooks;
use App\Models\Role;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\guru;
use App\Models\orangtua;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EbooksController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = ebooks::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")

            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");

            });
        }

        $dataEbooks = $query->with(['kelas'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.bukumedia.ebooks.partials.table', compact('dataEbooks'))->render();

            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.bukumedia.ebooks.ebooks', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEbooks']));
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

        return view('Pages.bukumedia.ebooks.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas']));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $validation = $request->validate([
            'judul' => 'required',
            'author' => 'required',
            'id_kelas' => 'required',
            'authority' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array'



        ], [

            'judul.required' => 'judul tidak boleh kosong',
            'author.required' => 'author tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong',
            'authority.required' => 'authority tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB'
            
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('BukuMediaEbooks', 'public');
            }
        }

        $filePath2 = null;
        if(isset($request->file))
        {
            $file = $request->file('file'); 
            $filePath2 = $file->store('BukuMediaEbooksCover', 'public');
        }

        $data = ebooks::create([
            'judul' => $request->judul,
            'author' => $request->author,
            'id_kelas' => $request->id_kelas,
            'authority' => $request->authority,
            'coverfoto' => $filePath2,
            'file' => $filePath
        ]);
        $data->save();

        return redirect()->route('bukumedia_ebooks_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(ebooks $ebooks)
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

        $dataEdit = ebooks::findByUuid($uuid);
        $dataKelas = kelas::all();
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.bukumedia.ebooks.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKelas', 'fileSize']));
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
            'author' => 'required',
            'id_kelas' => 'required',
            'authority' => 'required',
            'filepond' => 'required|mimes:pdf',
            'filepond' => 'required|array'

        ], [

            'judul.required' => 'judul tidak boleh kosong',
            'author.required' => 'author tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong',
            'authority.required' => 'authority tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB'
            
        ]);

        $data = ebooks::findbyUuid($uuid);

        $filePath = $data->file;
        // if($request->hasFile('filepond'))
        // {
        //     $updateFile = $request->file('filepond');
        //     $filePath = $updateFile->store('AkademikPenugasanSiswa', 'public');
        // }
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('BukuMediaEbooks', 'public');
            }
        }

        $data->update([
            'judul' => $request->judul,
            'author' => $request->author,
            'id_kelas' => $request->id_kelas,
            'authority' => $request->authority,
            'coverfoto' => $filePath2,
            'file' => $filePath
        ]);

        return redirect()->route('bukumedia_ebooks_page')->with('success', 'data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = ebooks::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('bukumedia_ebooks_page')->with('success', 'data berhasil dihapus');
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
        
        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $query = ebooks::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")

            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");

            });
        }

        $dataEbooks = $query->with(['kelas'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.bukumedia.ebook.partials.table', compact('dataEbooks'))->render();

            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.guru.bukumedia.ebook.ebook', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEbooks', 'SectionType']));
    }
    public function storePage2()
    {
        //
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $dataKelas = kelas::all();

        return view('Pages.admin.guru.bukumedia.ebook.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKelas', 'SectionType']));
    }
    public function store2(Request $request)
    {
        $validation = $request->validate([
            'judul' => 'required',
            'author' => 'required',
            'id_kelas' => 'required',
            'authority' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array'



        ], [

            'judul.required' => 'judul tidak boleh kosong',
            'author.required' => 'author tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong',
            'authority.required' => 'authority tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB'
            
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('BukuMediaEbooks', 'public');
            }
        }

        $filePath2 = null;
        if(isset($request->file))
        {
            $file = $request->file('file'); 
            $filePath2 = $file->store('BukuMediaEbooksCover', 'public');
        }

        $data = ebooks::create([
            'nama' => $request->judul,
            'author' => $request->author,
            'id_kelas' => $request->id_kelas,
            'authority' => $request->authority,
            'coverfoto' => $filePath2,
            'file' => $filePath
        ]);
        $data->save();

        return redirect()->route('guru_bukumedia-ebooks_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = ebooks::findByUuid($uuid);
        $dataKelas = kelas::all();
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.admin.guru.bukumedia.ebooks.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEdit', 'dataKelas', 'fileSize', 'SectionType']));
    }
    public function update2(Request $request, $uuid)
    {
        //
        // dd($request->all());
        
        $validation = $request->validate([
            'judul' => 'required',
            'author' => 'required',
            'id_kelas' => 'required',
            'authority' => 'required',
            'filepond' => 'required|mimes:pdf',
            'filepond' => 'required|array'

        ], [

            'judul.required' => 'judul tidak boleh kosong',
            'author.required' => 'author tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong',
            'authority.required' => 'authority tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB'
            
        ]);

        $data = ebooks::findbyUuid($uuid);

        $filePath = $data->file;
        // if($request->hasFile('filepond'))
        // {
        //     $updateFile = $request->file('filepond');
        //     $filePath = $updateFile->store('AkademikPenugasanSiswa', 'public');
        // }
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('BukuMediaEbooks', 'public');
            }
        }

        $data->update([
            'nama' => $request->judul,
            'author' => $request->author,
            'id_kelas' => $request->id_kelas,
            'authority' => $request->authority,
            'coverfoto' => $filePath2,
            'file' => $filePath
        ]);

        return redirect()->route('guru_bukumedia-ebooks_page')->with('success', 'data berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = ebooks::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('guru_bukumedia-ebooks_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
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

        $query = ebooks::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")

            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");

            });
        }

        $dataEbooks = $query->with(['kelas'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.siswa.bukumedia.ebook.partials.table', compact('dataEbooks'))->render();

            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.siswa.bukumedia.ebook.ebook', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEbooks']));
    }

    // this for admin orangtua
    public function index4(Request $request)
    {
        //
        $adminSession = session('admin_name');

        // orangtua
        $roleGet = orangtua::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $query = ebooks::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")

            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");

            });
        }

        $dataEbooks = $query->with(['kelas'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.orangtua.bukumedia.ebook.partials.table', compact('dataEbooks'))->render();

            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.orangtua.bukumedia.ebook.ebook', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEbooks']));
    }
}

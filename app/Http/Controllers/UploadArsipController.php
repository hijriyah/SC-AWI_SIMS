<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\uploadarsip;
use App\Models\kategoriarsip;
use App\Models\guru;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class UploadArsipController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = uploadarsip::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")
            
            ->orwhereHas('kategoriarsip', function($q) use ($request) {
                $q->where('kategori_arsip', 'like', "%{$request->search}%");
            })

            ->orwhereHas('guru', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            });
        }

        $dataUploadArsip = $query->with(['kategoriarsip', 'guru'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.arsipguru.uploadarsip.partials.table', compact('dataUploadArsip'))->render();

            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.arsipguru.uploadarsip.uploadarsip', compact(['adminSession', 'specAdmin', 'listMenu', 'dataUploadArsip']));
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

        $dataKategoriArsip = kategoriArsip::all();
        $dataGuru = guru::all();

        return view('Pages.arsipguru.uploadarsip.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKategoriArsip', 'dataGuru']));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $validation = $request->validate([

            'id_kategori_arsip' => 'required',
            'judul' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array',
            'id_guru' => 'required'

        ], [

            'id_kategori_arsip.required' => 'kategori arsip_masuk tidak boleh kosong',
            'judul.required' => 'judul tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB',

            'id_guru.required' => 'guru tidak boleh kosong'
            
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('UploadArsip', 'public');
            }
        }

        $data = uploadarsip::create([
            'id_kategori_arsip' => $request->kategori_arsip,
            'judul' => $request->judul,
            
            'file' => $filePath,
            'id_guru' => $request->id_guru
        ]);
        $data->save();

        return redirect()->route('arsipguru_uploadarsip_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(uploadarsip $uploadarsip)
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

        $dataEdit = uploadarsip::findByUuid($uuid);
        $dataKategoriArsip = kategoriarsip::all();
        $dataGuru = guru::all();
        $fileSource = Storage::disk('public')->url($dataEdit->file);
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.arsipguru.uploadarsip.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKategoriArsip', 'dataGuru', 'fileSize', 'fileSource']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        // dd($request->all());
        
        $validation = $request->validate([
            
            'id_kategori_arsip' => 'required',
            'judul' => 'required',
            
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array',
            'id_guru' => 'required'

        ], [

            'id_kategori_arsip.required' => 'kategori arsip tidak boleh kosong',
            'judul.required' => 'judul tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB',

            'id_guru.required' => 'nama guru tidak boleh kosong'
            
        ]);

        $data = uploadarsip::findbyUuid($uuid);

        $filePath = $data->file;
        // if($request->hasFile('filepond'))
        // {
        //     $updateFile = $request->file('filepond');
        //     $filePath = $updateFile->store('AkademikPenugasanSiswa', 'public');
        // }
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('UploadArsip', 'public');
            }
        }

        $data->update([
            'id_kategori_arsip' => $request->id_kategori_arsip,
            'judul' => $request->judul,
            
            'file' => $filePath,
            'id_guru' => $request->id_guru
            
        ]);

        return redirect()->route('arsipguru_uploadarsip_page')->with('success', 'data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = uploadarsip::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('arsipguru_uploadarsip_page')->with('success', 'data berhasil dihapus');
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

        $query = uploadarsip::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")
            
            ->orwhereHas('kategoriarsip', function($q) use ($request) {
                $q->where('kategori_arsip', 'like', "%{$request->search}%");
            })

            ->orwhereHas('guru', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            });
        }

        $dataUploadArsip = $query->with(['kategoriarsip', 'guru'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.arsipguru.uploadarsip.partials.table', compact('dataUploadArsip'))->render();

            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.guru.arsipguru.uploadarsip.uploadarsip', compact(['adminSession', 'specAdmin', 'listMenu', 'dataUploadArsip', 'SectionType']));
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

        $dataKategoriArsip = kategoriArsip::all();
        $dataGuru = guru::all();

        return view('Pages.admin.guru.arsipguru.uploadarsip.add', compact(['adminSession', 'specAdmin', 'listMenu','dataKategoriArsip', 'dataGuru', 'SectionType']));
    }
    public function store2(Request $request)
    {
        $validation = $request->validate([

            'id_kategori_arsip' => 'required',
            'judul' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array',
            'id_guru' => 'required'

        ], [

            'id_kategori_arsip.required' => 'kategori arsip_masuk tidak boleh kosong',
            'judul.required' => 'judul tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB',

            'id_guru.required' => 'guru tidak boleh kosong'
            
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('UploadArsip', 'public');
            }
        }

        $data = uploadarsip::create([
            'id_kategori_arsip' => $request->kategori_arsip,
            'judul' => $request->judul,
            
            'file' => $filePath,
            'id_guru' => $request->id_guru
        ]);
        $data->save();

        return redirect()->route('guru_arsipguru_uploadarsip_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = uploadarsip::findByUuid($uuid);
        $dataKategoriArsip = kategoriarsip::all();
        $dataGuru = guru::all();
        $fileSource = Storage::disk('public')->url($dataEdit->file);
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.admin.guru.arsipguru.uploadarsip.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEdit', 'dataKategoriArsip', 'dataGuru', 'fileSize', 'fileSource', 'SectionTytpe']));
    }
    public function update2(Request $request, $uuid)
    {
        //
        // dd($request->all());
        
        $validation = $request->validate([
            
            'id_kategori_arsip' => 'required',
            'judul' => 'required',
            
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array',
            'id_guru' => 'required'

        ], [

            'id_kategori_arsip.required' => 'kategori arsip tidak boleh kosong',
            'judul.required' => 'judul tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB',

            'id_guru.required' => 'nama guru tidak boleh kosong'
            
        ]);

        $data = uploadarsip::findbyUuid($uuid);

        $filePath = $data->file;
        // if($request->hasFile('filepond'))
        // {
        //     $updateFile = $request->file('filepond');
        //     $filePath = $updateFile->store('AkademikPenugasanSiswa', 'public');
        // }
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('UploadArsip', 'public');
            }
        }

        $data->update([
            'id_kategori_arsip' => $request->id_kategori_arsip,
            'judul' => $request->judul,
            
            'file' => $filePath,
            'id_guru' => $request->id_guru
            
        ]);

        return redirect()->route('guru_arsipguru_uploadarsip_page')->with('success', 'data berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = uploadarsip::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('guru_arsipguru_uploadarsip_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

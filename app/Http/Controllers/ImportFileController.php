<?php

namespace App\Http\Controllers;

use App\Models\ImportFile;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;

class ImportFileController extends Controller
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

        $query = ImportFile::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")
            ->orWhere('deskripsi', 'like', "%{$request->search}%");
        }

        $dataImportFile = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.pengaturan.importfile.partials.table', compact('dataImportFile'))->render();

            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.pengaturan.importfile.importfile', compact(['adminSession', 'specAdmin', 'listMenu', 'dataImportFile']));
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

        return view('Pages.pengaturan.importfile.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validation = $request->validate([
            'judul' => 'required',
            'filepond' => 'required|mimes:pdf,xsl,csv|max:2048',
            'filepond' => 'required|array',

        ], [

            'judul.required' => 'judul tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf/xsl/csv',
            'filepond.max' => 'file tidak boleh lebih dari 2MB',
            
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('PengaturanImportFile', 'public');
            }
        }

        $data = ImportFile::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
        ]);
        $data->save();

        return redirect()->route('pengaturan_importfile_page')->with('success', 'data tugas siswa berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(ImportFile $importFile)
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

        $dataEdit = ImportFile::findByUuid($uuid);
        // $fileSource = Storage::disk('public')->url($dataEdit->file);
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.akademik.tugassiswa.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'fileSize']));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $validation = $request->validate([
            'judul' => 'required',
            'filepond' => 'required|mimes:pdf',
            'filepond' => 'required|array',
        ], [

            'judul.required' => 'judul tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB',
            
        ]);

        $data = ImportFile::findbyUuid($uuid);

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

        $data->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
        ]);

        return redirect()->route('pengaturan_importfile_page')->with('success', 'data tugas siswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
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
}

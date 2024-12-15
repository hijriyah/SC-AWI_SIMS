<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\materiqa;
use App\Models\kelas;
use App\Models\tahunajaran;
use Illuminate\Support\Facades\Storage;

class MateriQaController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = materiqa::query();
        
        if($request->has('search'))
        {
            $query->where('materi', 'like', "%{$request->search}%")

            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataMateriQa = $query->with(['kelas', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.qa.materiqa.partials.table', compact('dataMateriQa'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.qa.materiqa.materiqa', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMateriQa']));
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

        return view('Pages.qa.materiqa.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas', 'dataTahunAjaran',]));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $validation = $request->validate([
            
            'id_tahun_ajaran' => 'required',
            'id_kelas' => 'required',
            'materi' => 'required',
            'kompetensi' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array'

        ], [

        	'id_kelas.required' => 'kelas tidak boleh kosong',
        	'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',

            'materi.required' => 'materi tidak boleh kosong',
            'kompetensi.required' => 'kompetensi tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB'

        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('MateriQa', 'public');
            }
        }

        $data = materiqa::create([
        	'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_kelas' => $request->id_kelas,
            'materi' => $request->materi,
            'kompetensi' => $request->kompetensi,
            'file' => $filePath
            
        ]);
        $data->save();

        return redirect()->route('qa_materiqa_page')->with('success', 'data materi qa berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(materiqa $materiqa)
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

        $dataEdit = materiqa::findByUuid($uuid);
        $dataKelas = kelas::all();
        $dataTahunAjaran = tahunajaran::all();
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.qa.materiqa.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKelas', 'dataTahunAjaran', 'fileSize']));
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
            'materi' => 'required',
            'kompetensi' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array'

        ], [

        	'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong',
            'materi.required' => 'materi tidak boleh kosong',
            'kompetensi.required' => 'kompetensi tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB'

        ]);

        $data = materiqa::findbyUuid($uuid);

        $filePath = $data->file;
        // if($request->hasFile('filepond'))
        // {
        //     $updateFile = $request->file('filepond');
        //     $filePath = $updateFile->store('AkademikPenugasanSiswa', 'public');
        // }
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('MateriQa', 'public');
            }
        }

        $data->update([

        	'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_kelas' => $request->id_kelas,
            'materi' => $request->materi,
            'kompetensi' => $request->kompetensi,
            'file' => $filePath
            
        ]);

        return redirect()->route('qa_materiqa_page')->with('success', 'data Materi QA berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = materiqa::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('qa_materiqa_page')->with('success', 'data materi qa berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data materi qa tidak ditemukan'
            ]);
        }
    }
}

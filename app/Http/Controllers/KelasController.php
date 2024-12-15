<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\guru;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = kelas::query();
        
        if($request->has('search'))
        {
            $query->whereHas('guru', function($q) use ($request) {
                $q->where('nama_panggilan', 'like', "%{$request->search}%");
            });
        }

        $dataKelas = $query->with(['guru'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.akademik.kelas.partials.table', compact('dataKelas'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.akademik.kelas.kelas', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKelas']));
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

        $dataGuru = guru::all();

        return view('Pages.akademik.kelas.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataGuru']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'nama_kelas' => 'required',
            'kelas_angka' => 'required',
            'id_guru' => 'required',
            'maksimal_siswa' => 'required',
            'catatan' => 'required'
        ]);

        // $filePath = null;
        // if(isset($request->file))
        // {
        //     $file = $request->file('file'); 
        //     $filePath = $file->store('AdminMasterGuru', 'public');
        // }

        $roleGuru = Role::where('name', 'Guru')->first();

        $data = kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kelas_angka' => $request->kelas_angka,
            'id_guru' => $request->id_guru,
            'maksimal_siswa' => $request->maksimal_siswa,
            'catatan' => $request->catatan,
        ]);
        $data->save();

        return redirect()->route('akademik_kelas_page')->with('success', 'data kelas berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(kelas $kelas)
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

        $dataEdit = kelas::findByUuid($uuid);
        $dataGuru = guru::all();

        return view('Pages.akademik.kelas.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataGuru']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = kelas::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('akademik_kelas_page')->with('success', 'data guru berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = kelas::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('akademik_kelas_page')->with('success', 'data kelas berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data kelas tidak ditemukan'
            ]);
        }

    }
}

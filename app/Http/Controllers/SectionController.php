<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section;
use App\Models\kelas;
use App\Models\Role;
use App\Models\guru;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = section::query();
        
        if($request->has('search'))
        {
            $query->where('section', 'like', "%{$request->search}%");
        }

        $dataSection = $query->with(['guru', 'kelas'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.akademik.section.partials.table', compact('dataSection'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.akademik.section.section', compact(['adminSession', 'specAdmin', 'listMenu', 'dataSection']));
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
        $dataKelas = kelas::all();

        return view('Pages.akademik.section.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataGuru', 'dataKelas']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'section' => 'required',
            'kategori' => 'required',
            'kapasitas' => 'required|numeric',
            'id_kelas' => 'required|numeric',
            'id_guru' => 'required|numeric',
            'catatan' => 'required'
        ]);

        $data = section::create([
            'section' => $request->section,
            'kategori' => $request->kategori,
            'kapasitas' => $request->kapasitas,
            'id_kelas' => $request->id_kelas,
            'id_guru' => $request->id_guru,
            'catatan' => $request->catatan
        ]);
        $data->save();

        return redirect()->route('akademik_section_page')->with('success', 'data section berhasil disimpan');
    }   

    public function edit($uuid)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();

        $dataEdit = section::findByUuid($uuid);
        $dataGuru = guru::all();
        $dataKelas = kelas::all();

        return view('Pages.akademik.section.edit', compact(['dataEdit', 'adminSession', 'specAdmin', 'roleCheck', 'listMenu', 'dataRole', 'dataGuru', 'dataKelas']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $dataUpdate = section::findByUuid($uuid);
        $dataUpdate->update($request->all());

        return redirect()->route('akademik_section_page')->with('success', 'data section berhasil diupdate');

    }

    public function destroy($uuid)
    {
        //
        $delete = section::findByUuid($uuid);

        if($delete)
        {
            $delete->delete();
            return redirect()->route('akademik_section_page')->with('success', 'data section berhasil dihapus');
        }
        else {
            return response()->json([
                'error', 'data section tidak ditemukan'
            ]);
        }
    }
}

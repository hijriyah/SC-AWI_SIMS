<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rekapkelengkapanarsip;
use App\Models\uploadarsip;
use App\Models\guru;
use App\Models\matapelajaran;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class RekapKelengkapanArsipController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = rekapkelengkapanarsip::query();
        
        if($request->has('search'))
        {
            $query->whereHas('guru', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })
            ->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            })
            ->orwhereHas('uploadarsip', function($q) use ($request) {
                $q->where('judul', 'like', "%{$request->search}%");
            });
        }

        $dataRekapKelengkapanArsip = $query->with(['guru', 'matapelajaran', 'uploadarsip'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.arsipguru.rekapkelengkapanarsip.partials.table', compact('dataRekapKelengkapanArsip'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.arsipguru.rekapkelengkapanarsip.rekapkelengkapanarsip', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRekapKelengkapanArsip']));
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

        $dataUploadArsip = uploadarsip::all();
        $dataGuru = guru::all();
        $dataMataPelajaran = matapelajaran::all();

        return view('Pages.arsipguru.rekapkelengkapanarsip.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataUploadArsip', 'dataGuru', 'dataMataPelajaran']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'id_upload_arsip' => 'required|numeric',
            'id_mata_pelajaran' => 'required|numeric',
            'id_guru' => 'required|numeric',
            'status_kelengkapan' => 'required'

        ]);

        $data = rekapkelengkapanarsip::create([
            'id_upload_arsip' => $request->id_upload_arsip,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'id_guru' => $request->guru,
            'status_kelengkapan' => $request->status_kelengkapan

        ]);
        $data->save();

        return redirect()->route('arsipguru_rekapkelengkapanarsip_page')->with('success', 'data berhasil disimpan');
    }

    public function edit($uuid)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();

        $dataEdit = rekapkelengkapanarsip::findByUuid($uuid);
        $dataUploadArsip = uploadarsip::all();
        $dataMataPelajaran = matapelajaran::all();
        $dataGuru = guru::all();

        return view('Pages.arsipguru.rekapkelengkapanarsip.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataUploadArsip', 'dataGuru', 'dataMataPelajaran']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = rekapkelengkapanarsip::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('arsipguru_rekapkelengkapanarsip_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = rekapkelengkapanarsip::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('arsipguru_rekapkelengkapanarsip_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

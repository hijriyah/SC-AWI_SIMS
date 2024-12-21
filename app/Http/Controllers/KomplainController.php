<?php

namespace App\Http\Controllers;

use App\Models\komplain;
use App\Models\Role;
use App\Models\siswa;
use App\Models\orangtua;
use App\Models\tahunajaran;
use Illuminate\Http\Request;

class KomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        $query = komplain::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")
            ->orWhere('deskripsi', 'like', "%{$request->search}%")
            ->orWhere('lampiran', 'like', "%{$request->search}%")
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataKomplain = $query->with(['tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.siswa.pengaturan.komplain.partials.table', compact('dataKomplain'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.siswa.pengaturan.komplain.komplain', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKomplain']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function storePage3()
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = siswa::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.admin.siswa.pengaturan.komplain.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataTahunAjaran']));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store3(Request $request)
    {
        //
        $validation = $request->validate([
            'judul' => 'required',
            'id_tahun_ajaran' => 'required|numeric',
            'deskripsi' => 'required',
            'lampiran' => 'required'
        ], [
            'judul.required' => 'judul tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'lampiran.required' => 'lampiran tidak boleh kosong'
        ]);

        $adminSession = session('admin_name');
        $roleGet = siswa::where('username', $adminSession)->first();

        $data = komplain::create([
            'judul' => $request->judul,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_siswa' => $roleGet->id,
            'deskripsi' => $request->deskripsi,
            'lampiran' => $request->lampiran
        ]);
        $data->save();

        return redirect()->route('siswa_pengaturan_komplain_page')->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(komplain $komplain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit3(Request $request, $uuid)
    {
        //
        $adminSession = session('admin_name');

        // Guru
        $roleGet = siswa::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $dataEdit = komplain::findByUuid($uuid);

        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.admin.siswa.pengaturan.komplain.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataTahunAjaran', 'dataEdit']));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update3(Request $request, $uuid)
    {
        //
        $data = komplain::findByUuid($uuid);
        $data->update($request->all());

        return redirect()->route('siswa_pengaturan_komplain_page')->with('success', 'data berhasil disimpan');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy3($uuid)
    {
        //
        $data = komplain::findByUuid($uuid);

        if($data)
        {
            $data->delete();

            return redirect()->route('siswa_pengaturan_komplain_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return redirect()->route('siswa_pengaturan_komplain_page')->with('error', 'data tidak ditemukan');
        }
    }

    // this for admin orangtua
    public function index4(Request $request)
    {
        //
        $adminSession = session('admin_name');

        // Guru
        $roleGet = orangtua::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $query = komplain::query();
        
        if($request->has('search'))
        {
            $query->where('judul', 'like', "%{$request->search}%")
            ->orWhere('deskripsi', 'like', "%{$request->search}%")
            ->orWhere('lampiran', 'like', "%{$request->search}%")
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataKomplain = $query->with(['tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.orangtua.pengaturan.komplain.partials.table', compact('dataKomplain'))->render();

            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.orangtua.pengaturan.komplain.komplain', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKomplain']));
    }

    public function storePage4()
    {
        $adminSession = session('admin_name');

        // Guru
        $roleGet = orangtua::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.admin.orangtua.pengaturan.komplain.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataTahunAjaran']));

    }

    public function store4(Request $request)
    {
        //
        $validation = $request->validate([
            'judul' => 'required',
            'id_tahun_ajaran' => 'required|numeric',
            'deskripsi' => 'required',
            'lampiran' => 'required'
        ], [
            'judul.required' => 'judul tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'lampiran.required' => 'lampiran tidak boleh kosong'
        ]);

        $adminSession = session('admin_name');
        $roleGet = orangtua::where('username', $adminSession)->first();

        $data = komplain::create([
            'judul' => $request->judul,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_siswa' => $roleGet->id,
            'deskripsi' => $request->deskripsi,
            'lampiran' => $request->lampiran
        ]);
        $data->save();

        return redirect()->route('orangtua_pengaturan-komplain_page')->with('success', 'data berhasil disimpan');
    }

    public function edit4(Request $request, $uuid)
    {
        //
        $adminSession = session('admin_name');

        // Guru
        $roleGet = orangtua::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $dataEdit = komplain::findByUuid($uuid);

        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.admin.orangtua.pengaturan.komplain.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataTahunAjaran', 'dataEdit']));

    }

    public function update4(Request $request, $uuid)
    {
        //
        $data = komplain::findByUuid($uuid);
        $data->update($request->all());

        return redirect()->route('orangtua_pengaturan-komplain_page')->with('success', 'data berhasil disimpan');

    }

    public function destroy4($uuid)
    {
        //
        $data = komplain::findByUuid($uuid);

        if($data)
        {
            $data->delete();

            return redirect()->route('orangtua_pengaturan-komplain_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return redirect()->route('orangtua_pengaturan-komplain_page')->with('error', 'data tidak ditemukan');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\pelanggaran;
use App\Models\sanksipelanggaran;
use App\Models\guru;
use App\Models\Role;

class SanksiPelanggaranController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = sanksipelanggaran::query();
        
        if($request->has('search'))
        {
            $query->where('bentuk_sanksi', 'like', "%{$request->search}%")
            
            ->orwhereHas('pelanggaran', function($q) use ($request) {
                $q->where('jenis_pelanggaran', 'like', "%{$request->search}%");
            });
        }

        $dataSanksiPelanggaran = $query->with(['sanksipelanggaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.kesiswaan.sanksipelanggaran.partials.table', compact('dataSanksiPelanggaran'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.kesiswaan.sanksipelanggaran.sanksipelanggaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataSanksiPelanggaran']));
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

        $dataPelanggaran = pelanggaran::all();


        return view('Pages.kesiswaan.sanksipelanggaran.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataPelanggaran']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	
            'bentuk_sanksi' => 'required|numeric',
            'maksimal_poin' => 'required',
            'id_pelanggaran' => 'required|numeric'       
        ]);

        $data = sanksipelanggaran::create([
        	
            'bentuk_sanksi' => $request->bentuk_sanksi,
            'maksimal_poin' => $request->maksimal_poin,
            'id_pelanggaran' => $request->id_pelanggaran
        ]);
        $data->save();

        return redirect()->route('kesiswaan_sanksipelanggaran_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = sanksipelanggaran::findByUuid($uuid);
        $dataTahunAjaran = pelanggaran::all();

        return view('Pages.kesiswaan.sanksipelanggaran.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataPelanggaran', ]));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = sanksipelanggaran::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('kesiswaan_sanksipelanggaran_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = sanksipelanggaran::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('kesiswaan_sanksipelanggaran_page')->with('success', 'data berhasil dihapus');
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
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();

        $query = sanksipelanggaran::query();
        
        if($request->has('search'))
        {
            $query->where('bentuk_sanksi', 'like', "%{$request->search}%")
            
            ->orwhereHas('pelanggaran', function($q) use ($request) {
                $q->where('jenis_pelanggaran', 'like', "%{$request->search}%");
            });
        }

        $dataSanksiPelanggaran = $query->with(['sanksipelanggaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.kesiswaan.sanksipelanggaran.partials.table', compact('dataSanksiPelanggaran'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.guru.kesiswaan.sanksipelanggaran.sanksipelanggaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataSanksiPelanggaran', 'SectionType']));
    }
    public function storePage2()
    {
        //
        $adminSession = session('Admin_user');
        $adminSession = session('admin_name');

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();
        $roleStatus = Role::find($roleGet->role_id);
        $specAdmin = $roleStatus->name;

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();

        $dataPelanggaran = pelanggaran::all();


        return view('Pages.admin.guru.kesiswaan.sanksipelanggaran.add', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType', 'dataPelanggaran']));
    }
    public function store2(Request $request)
    {
        $validation = $request->validate([
        	
            'bentuk_sanksi' => 'required|numeric',
            'maksimal_poin' => 'required',
            'id_pelanggaran' => 'required|numeric'       
        ]);

        $data = sanksipelanggaran::create([
        	
            'bentuk_sanksi' => $request->bentuk_sanksi,
            'maksimal_poin' => $request->maksimal_poin,
            'id_pelanggaran' => $request->id_pelanggaran
        ]);
        $data->save();

        return redirect()->route('guru_kesiswaan-sanksipelanggaran_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = sanksipelanggaran::findByUuid($uuid);
        $dataTahunAjaran = pelanggaran::all();

        return view('Pages.admin.guru.kesiswaan.sanksipelanggaran.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType', 'dataEdit', 'dataPelanggaran', ]));
    }
    public function update2(Request $request, $uuid)
    {
        //
        $data = sanksipelanggaran::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('guru_kesiswaan-sanksipelanggaran_page')->with('success', 'data berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = sanksipelanggaran::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('guru_kesiswaan-sanksipelanggaran_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

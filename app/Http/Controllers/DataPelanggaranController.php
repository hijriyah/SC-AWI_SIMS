<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\datapelanggaran;
use App\Models\tahunajaran;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\guru;
use App\Models\pelanggaran;
use App\Models\sanksipelanggaran;
use App\Models\Role;

class DataPelanggaranController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = datapelanggaran::query();
        
        if($request->has('search'))
        {
            $query->whereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })
            
            ->orwhereHas('siswa', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })
           
            ->orwhereHas('pelanggaran', function($q) use ($request) {
                $q->where('jenis_pelanggaran', 'like', "%{$request->search}%");
            })
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            })
            ->orwhereHas('sanksipelanggaran', function($q) use ($request) {
                $q->where('bentuk_sanksi', 'like', "%{$request->search}%");
            });
        }

        $dataDataPelanggaran = $query->with(['kelas', 'siswa', 'pelanggaran', 'tahunajaran', 'sanksipelanggaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.kesiswaan.datapelanggaran.partials.table', compact('dataDataPelanggaran'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.kesiswaan.datapelanggaran.datapelanggaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataDataPelanggaran']));
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
        $dataSiswa = siswa::all();
        $dataPelanggaran = pelanggaran::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSanksiPelanggaran = sanksipelanggaran::all();


        return view('Pages.kesiswaan.datapelanggaran.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas', 'dataSiswa', 'dataPelanggaran', 'dataTahunAjaran', 'dataSanksiPelanggaran']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
        	'id_kelas' => 'required|numeric',
        	'id_siswa' => 'required|numeric',
            'id_pelanggaran' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'total_poin' => 'required|numeric',
            'subtotal_poin' => 'required|numeric',
            'id_sanksi_pelanggaran' => 'required|numeric'        
        ]);

        $data = datapelanggaran::create([
        	'id_kelas' => $request->id_kelas,
        	'id_siswa' => $request->id_siswa,
            'id_pelanggaran' => $request->id_pelanggaran,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'total_poin' => $request->total_poin,
            'subtotal_poin' => $request->subtotal_poin,
            'id_sanksi_pelanggaran' => $request->id_sanksi_pelanggaran
        ]);
        $data->save();

        return redirect()->route('kesiswaan_datapelanggaran_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = datapelanggaran::findByUuid($uuid);
        $dataKelas = kelas::all();
        $dataSiswa = siswa::all();
        $dataPelanggaran = pelanggaran::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSanksiPelanggaran = sanksipelanggaran::all();

        return view('Pages.kesiswaan.datapelanggaran.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKelas', 'dataSiswa', 'dataPelanggaran', 'dataTahunAjaran', 'dataSanksiPelanggaran']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = datapelanggaran::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('kesiswaan_datapelanggaran_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = datapelanggaran::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('kesiswaan_datapelanggaran_page')->with('success', 'data berhasil dihapus');
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

        $query = datapelanggaran::query();
        
        if($request->has('search'))
        {
            $query->whereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })
            
            ->orwhereHas('siswa', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%");
            })
           
            ->orwhereHas('pelanggaran', function($q) use ($request) {
                $q->where('jenis_pelanggaran', 'like', "%{$request->search}%");
            })
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            })
            ->orwhereHas('sanksipelanggaran', function($q) use ($request) {
                $q->where('bentuk_sanksi', 'like', "%{$request->search}%");
            });
        }

        $dataDataPelanggaran = $query->with(['kelas', 'siswa', 'pelanggaran', 'tahunajaran', 'sanksipelanggaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.kesiswaan.datapelanggaran.partials.table', compact('dataDataPelanggaran'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.guru.kesiswaan.datapelanggaran.datapelanggaran', compact(['adminSession', 'specAdmin', 'listMenu', 'dataDataPelanggaran', 'SectionType']));
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
        $dataSiswa = siswa::all();
        $dataPelanggaran = pelanggaran::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSanksiPelanggaran = sanksipelanggaran::all();

        return view('Pages.admin.guru.kesiswaan.datapelanggaran.add', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType', 'dataKelas', 'dataSiswa', 'dataPelanggaran', 'dataTahunAjaran', 'dataSanksiPelanggaran']));
    }
    public function store2(Request $request)
    {
        $validation = $request->validate([
        	'id_kelas' => 'required|numeric',
        	'id_siswa' => 'required|numeric',
            'id_pelanggaran' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'total_poin' => 'required|numeric',
            'subtotal_poin' => 'required|numeric',
            'id_sanksi_pelanggaran' => 'required|numeric'        
        ]);

        $data = datapelanggaran::create([
        	'id_kelas' => $request->id_kelas,
        	'id_siswa' => $request->id_siswa,
            'id_pelanggaran' => $request->id_pelanggaran,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'total_poin' => $request->total_poin,
            'subtotal_poin' => $request->subtotal_poin,
            'id_sanksi_pelanggaran' => $request->id_sanksi_pelanggaran
        ]);
        $data->save();

        return redirect()->route('guru_kesiswaan-datapelanggaran_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = datapelanggaran::findByUuid($uuid);
        $dataKelas = kelas::all();
        $dataSiswa = siswa::all();
        $dataPelanggaran = pelanggaran::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataSanksiPelanggaran = sanksipelanggaran::all();

        return view('Pages.admin.guru.kesiswaan.datapelanggaran.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'SectionType', 'dataEdit', 'dataKelas', 'dataSiswa', 'dataPelanggaran', 'dataTahunAjaran', 'dataSanksiPelanggaran']));
    }
    public function update2(Request $request, $uuid)
    {
        //
        $data = datapelanggaran::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('guru_kesiswaan-datapelanggaran_page')->with('success', 'data berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = datapelanggaran::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('guru_kesiswaan-datapelanggaran_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

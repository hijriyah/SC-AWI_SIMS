<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\jurnalkelas;
use App\Models\matapelajaran;
use App\Models\tahunajaran;
use App\Models\guru;
use PDF;

class JurnalKelasController extends Controller
{
    //
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = jurnalkelas::query();
        
        if($request->has('search'))
        {
            $query->whereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            });
        }

        $dataJurnalKelas = $query->with(['matapelajaran', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.jurnal.jurnalkelas.partials.table', compact('dataJurnalKelas'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.jurnal.jurnalkelas.jurnalkelas', compact(['adminSession', 'specAdmin', 'listMenu', 'dataJurnalKelas']));
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

        $dataMataPelajaran = matapelajaran::all();
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.jurnal.jurnalkelas.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataMataPelajaran', 'dataTahunAjaran']));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validation = $request->validate([
        	'tanggal' => 'required',
            'id_mata_pelajaran' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'materi_ajar' => 'required',
            'siswa_hadir' => 'required|numeric',
            'siswa_tidak_hadir' => 'required|numeric',
            'status' => 'required',
            'jam_ke' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ], [
            'tanggal.required' => 'tanggal tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'materi_ajar.required' => 'materi ajar tidak boleh kosong',
            'siswa_hadir.required' => 'siswa hadir tidak boleh kosong',
            'siswa_tidak_hadir.required' => 'siswa tidak hadir tidak boleh kosong',
            'status.required' => 'status tidak boleh kosong',
            'jam_ke.required' => 'jam tidak boleh kosong',
            'jam_mulai.required' => 'jam mulai tidak boleh kosong',
            'jam_selesaii.required' => 'jam selesai tidak boleh kosong'
        ]);

        $FilteringStatus = '';
        if($request->status == "hadir")
        {
            $FilteringStatus = 'badge text-bg-success';
        }
        else {
            $FilteringStatus = 'badge text-bg-danger';
        }

        $data = jurnalkelas::create([
            'jam' => $request->jam_ke,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tanggal' => $request->tanggal,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'materi_ajar' => $request->materi_ajar,
            'siswa_hadir' => $request->siswa_hadir,
            'siswa_tidak_hadir' => $request->siswa_tidak_hadir,
            'status' => $request->status,
            'class' => $FilteringStatus
        ]);
        $data->save();

        return redirect()->route('jurnal_jurnalkelas_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = jurnalkelas::findByUuid($uuid);
        $dataMataPelajaran = matapelajaran::all();
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.jurnal.jurnalkelas.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataMataPelajaran', 'dataTahunAjaran']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = jurnalkelas::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('jurnal_jurnalkelas_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = jurnalkelas::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('jurnal_jurnalkelas_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }

    public function DownloadReport($id)
    {
        $data = jurnalkelas::with(['matapelajaran.guru', 'tahunajaran'])->find($id);
        $pdf = PDF::loadView('Laporan.jurnalkelas.JurnalKelasReport', ['data' => $data]);

        return $pdf->download('Jurnal Kelas Report.pdf');


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

        $query = jurnalkelas::query();
        
        if($request->has('search'))
        {
            $query->whereHas('matapelajaran', function($q) use ($request) {
                $q->where('mata_pelajaran', 'like', "%{$request->search}%");
            });
        }

        $dataJurnalKelas = $query->with(['matapelajaran', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.jurnal.jurnalkelas.partials.table', compact('dataJurnalKelas'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.guru.jurnal.jurnalkelas.jurnalkelas', compact(['adminSession', 'specAdmin', 'listMenu', 'dataJurnalKelas', 'SectionType']));
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

        $dataMataPelajaran = matapelajaran::all();
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.admin.guru.jurnal.jurnalkelas.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMataPelajaran', 'dataTahunAjaran', 'SectionType']));
    }
    public function store2(Request $request)
    {
        // dd($request->all());
        $validation = $request->validate([
        	'tanggal' => 'required',
            'id_mata_pelajaran' => 'required|numeric',
            'id_tahun_ajaran' => 'required|numeric',
            'materi_ajar' => 'required',
            'siswa_hadir' => 'required|numeric',
            'siswa_tidak_hadir' => 'required|numeric',
            'status' => 'required',
            'jam_ke' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ], [
            'tanggal.required' => 'tanggal tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'materi_ajar.required' => 'materi ajar tidak boleh kosong',
            'siswa_hadir.required' => 'siswa hadir tidak boleh kosong',
            'siswa_tidak_hadir.required' => 'siswa tidak hadir tidak boleh kosong',
            'status.required' => 'status tidak boleh kosong',
            'jam_ke' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $FilteringStatus = '';
        if($request->status == "hadir")
        {
            $FilteringStatus = 'badge text-bg-success';
        }
        else {
            $FilteringStatus = 'badge text-bg-danger';
        }

        $data = jurnalkelas::create([
            'jam' => $request->jam_ke,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tanggal' => $request->tanggal,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'materi_ajar' => $request->materi_ajar,
            'siswa_hadir' => $request->siswa_hadir,
            'siswa_tidak_hadir' => $request->siswa_tidak_hadir,
            'status' => $request->status,
            'class' => $FilteringStatus
        ]);
        $data->save();

        return redirect()->route('guru_jurnal-jurnalkelas_page')->with('success', 'data berhasil disimpan');
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


        $dataEdit = jurnalkelas::findByUuid($uuid);
        $dataMataPelajaran = matapelajaran::all();
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.admin.guru..jurnal.jurnalkelas.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEdit', 'dataMataPelajaran', 'dataTahunAjaran', 'SectionType']));
    }
    public function update2(Request $request, $uuid)
    {
        //
        $data = jurnalkelas::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('guru_jurnal-jurnalkelas_page')->with('success', 'data berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = jurnalkelas::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('guru_jurnal-jurnalkelas_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
    public function DownloadReport2($id)
    {
        $data = jurnalkelas::with(['matapelajaran.guru', 'tahunajaran'])->find($id);
        $pdf = PDF::loadView('Laporan.jurnalkelas.JurnalKelasReport', ['data' => $data]);

        return $pdf->download('Jurnal Kelas Report.pdf');

    }

}

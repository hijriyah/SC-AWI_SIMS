<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;
use App\Models\mulaiujian;
use App\Models\kelas;
use App\Models\section;
use App\Models\matapelajaran;
use App\Models\intruksiujian;
use App\Models\tahunajaran;
use App\Models\guru;
use App\Models\banksoal;

class MulaiUjianController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = mulaiujian::query();
        
        if($request->has('search'))
        {
            $query->where('nama', 'like', "%{$request->search}%")
            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('section', function($q) use ($request) {
                $q->where('judul', 'like', "%{$request->search}%");
            })->orwhereHas('instruksiujian', function($q) use ($request) {
                $q->where('judul', 'like', "%{$request->search}%");
            })->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataMulaiUjian = $query->with(['kelas', 'section', 'intruksiujian', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.ujian.mulaiujian.partials.table', compact('dataMulaiUjian'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.ujian.mulaiujian.mulaiujian', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMulaiUjian']));
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
        $dataKelas = kelas::all();
        $dataSection = section::all();
        $dataMataPelajaran = matapelajaran::all();
        $dataInstruksiUjian = intruksiujian::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataGuru = guru::all();
        $dataBankSoal = banksoal::all();

        return view('Pages.ujian.mulaiujian.add', compact([
            'adminSession', 
            'specAdmin', 
            'listMenu', 
            'dataRole',
            'dataKelas',
            'dataSection',
            'dataMataPelajaran',
            'dataInstruksiUjian',
            'dataTahunAjaran',
            'dataGuru',
            'dataBankSoal'
        ]));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'nama' => 'required',
            'id_kelas' => 'required',
            'id_section' => 'required',
            'id_instruksi_ujian' => 'required',
            'id_tahun_ajaran' => 'required',
            'id_guru' => 'required',
            'id_bank_soal' => 'required',
            'publish' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong', 
            'id_section.required' => 'section tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',
            'id_instruksi_ujian.required' => 'instruksi ujian tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'id_guru.required' => 'guru tidak boleh kosong',
            'id_bank_soal.required' => 'bank soal tidak boleh kosong',
            'publish.required' => 'publish tidak boleh kosong'
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikTugasSiswa', 'public');
            }
        }

        $data = mulaiujian::create([
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'id_section' => $request->id_section,
            'id_instruksi_ujian' => $request->id_instruksi_ujian,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'no_tipe_ujian' => $request->no_tipe_ujian,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'durasi' => $request->durasi,
            'random' => $request->random,
            'public' => $request->public,
            'status' => $request->status,
            'id_guru' => $request->id_guru,
            'poin_benar' => $request->poin_benar,
            'total_poin' => $request->total_poin,
            'persentase' => $request->persentase,
            'id_bank_soal' => $request->id_bank_soal,
            'gambar' => $filePath,
            'nama' => $request->nama,
        ]);
        $data->save();

        return redirect()->route('ujian_mulaiujian_page')->with('success', 'data berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(kategoribarang $kategoribarang)
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
        $dataKelas = kelas::all();
        $dataSection = section::all();
        $dataMataPelajaran = matapelajaran::all();
        $dataInstruksiUjian = intruksiujian::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataGuru = guru::all();
        $dataBankSoal = banksoal::all();

        $dataEdit = mulaiujian::findByUuid($uuid);

        return view('Pages.ujian.mulaiujian.edit', compact([
            'adminSession', 
            'specAdmin', 
            'listMenu', 
            'dataRole', 
            'dataEdit',
            'dataKelas',
            'dataSection',
            'dataMataPelajaran',
            'dataInstruksiUjian',
            'dataTahunAjaran',
            'dataGuru',
            'dataBankSoal'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = mulaiujian::findbyUuid($uuid);

        $validation = $request->validate([
            'nama' => 'required',
            'id_kelas' => 'required',
            'id_section' => 'required',
            'id_instruksi_ujian' => 'required',
            'id_tahun_ajaran' => 'required',
            'id_guru' => 'required',
            'id_bank_soal' => 'required',
            'publish' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong', 
            'id_section.required' => 'section tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',
            'id_instruksi_ujian.required' => 'instruksi ujian tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'id_guru.required' => 'guru tidak boleh kosong',
            'id_bank_soal.required' => 'bank soal tidak boleh kosong',
            'publish.required' => 'publish tidak boleh kosong'
        ]);

        $filePath = $data->gambar;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikTugasSiswa', 'public');
            }
        }

        $DataUpdate = mulaiujian::create([
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'id_section' => $request->id_section,
            'id_instruksi_ujian' => $request->id_instruksi_ujian,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'no_tipe_ujian' => $request->no_tipe_ujian,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'durasi' => $request->durasi,
            'random' => $request->random,
            'public' => $request->public,
            'status' => $request->status,
            'id_guru' => $request->id_guru,
            'poin_benar' => $request->poin_benar,
            'total_poin' => $request->total_poin,
            'persentase' => $request->persentase,
            'id_bank_soal' => $request->id_bank_soal,
            'gambar' => $filePath,
            'nama' => $request->nama,
        ]);
        $DataUpdate->update();

        return redirect()->route('ujian_mulaiujian_page')->with('success', 'data kategori barang berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = mulaiujian::findByUuid($uuid);

        if($data)
        {
            $data->delete();

            if($data->gambar)
            {
                Storage::delete($data->gambar);
            }
            return redirect()->route('ujian_mulaiujian_page')->with('success', 'data kategori barang berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data kategori barang tidak ditemukan'
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

        $query = mulaiujian::query();
        
        if($request->has('search'))
        {
            $query->where('nama', 'like', "%{$request->search}%")
            ->orwhereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })->orwhereHas('section', function($q) use ($request) {
                $q->where('judul', 'like', "%{$request->search}%");
            })->orwhereHas('instruksiujian', function($q) use ($request) {
                $q->where('judul', 'like', "%{$request->search}%");
            })->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataMulaiUjian = $query->with(['kelas', 'section', 'intruksiujian', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.ujian.mulaiujian.partials.table', compact('dataMulaiUjian'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.admin.guru.ujian.mulaiujian.mulaiujian', compact(['adminSession', 'specAdmin', 'listMenu', 'dataMulaiUjian', 'SectionType']));
    }
    public function storePage2()
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

        $dataKelas = kelas::all();
        $dataSection = section::all();
        $dataMataPelajaran = matapelajaran::all();
        $dataInstruksiUjian = intruksiujian::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataBankSoal = banksoal::all();

        return view('Pages.admin.guru.ujian.mulaiujian.add', compact([
            'adminSession', 
            'specAdmin', 
            'listMenu', 
            'dataKelas',
            'dataSection',
            'dataMataPelajaran',
            'dataInstruksiUjian',
            'dataTahunAjaran',
            'dataBankSoal',
            'SectionType'
        ]));
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
        
        $dataKelas = kelas::all();
        $dataSection = section::all();
        $dataMataPelajaran = matapelajaran::all();
        $dataInstruksiUjian = intruksiujian::all();
        $dataTahunAjaran = tahunajaran::all();
        $dataBankSoal = banksoal::all();

        $dataEdit = mulaiujian::findByUuid($uuid);

        return view('Pages.admin.guru.ujian.mulaiujian.edit', compact([
            'adminSession', 
            'specAdmin', 
            'listMenu', 
            'dataRole', 
            'dataEdit',
            'dataKelas',
            'dataSection',
            'dataMataPelajaran',
            'dataInstruksiUjian',
            'dataTahunAjaran',
            'dataBankSoal',
            'SectionType'
        ]));
    }
    public function store2(Request $request)
    {
        //
        // dd($request->all());

        $validation = $request->validate([
            'nama' => 'required',
            'id_kelas' => 'required',
            'id_section' => 'required',
            'id_instruksi_ujian' => 'required',
            'id_tahun_ajaran' => 'required',
            'id_bank_soal' => 'required',
            'publish' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong', 
            'id_section.required' => 'section tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',
            'id_instruksi_ujian.required' => 'instruksi ujian tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'id_bank_soal.required' => 'bank soal tidak boleh kosong',
            'publish.required' => 'publish tidak boleh kosong'
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikTugasSiswa', 'public');
            }
        }

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();

        $data = mulaiujian::create([
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'id_section' => $request->id_section,
            'id_instruksi_ujian' => $request->id_instruksi_ujian,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'no_tipe_ujian' => $request->no_tipe_ujian,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'durasi' => $request->durasi,
            'random' => $request->random,
            'public' => $request->public,
            'status' => $request->status,
            'id_guru' => $roleGet->id,
            'poin_benar' => $request->poin_benar,
            'total_poin' => $request->total_poin,
            'persentase' => $request->persentase,
            'id_bank_soal' => $request->id_bank_soal,
            'gambar' => $filePath,
            'nama' => $request->nama,
        ]);
        $data->save();

        return redirect()->route('guru_ujian-mulaiujian_page')->with('success', 'data berhasil disimpan');
    }
    public function update2(Request $request, $uuid)
    {
        //
        $data = mulaiujian::findbyUuid($uuid);

        $validation = $request->validate([
            'nama' => 'required',
            'id_kelas' => 'required',
            'id_section' => 'required',
            'id_instruksi_ujian' => 'required',
            'id_tahun_ajaran' => 'required',
            'id_bank_soal' => 'required',
            'publish' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'id_kelas.required' => 'kelas tidak boleh kosong', 
            'id_section.required' => 'section tidak boleh kosong',
            'id_mata_pelajaran.required' => 'mata pelajaran tidak boleh kosong',
            'id_instruksi_ujian.required' => 'instruksi ujian tidak boleh kosong',
            'id_tahun_ajaran.required' => 'tahun ajaran tidak boleh kosong',
            'id_bank_soal.required' => 'bank soal tidak boleh kosong',
            'publish.required' => 'publish tidak boleh kosong'
        ]);

        $filePath = $data->gambar;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('AkademikTugasSiswa', 'public');
            }
        }

        // Guru
        $roleGet = guru::where('username', $adminSession)->first();

        $DataUpdate = mulaiujian::create([
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'id_section' => $request->id_section,
            'id_instruksi_ujian' => $request->id_instruksi_ujian,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'no_tipe_ujian' => $request->no_tipe_ujian,
            'id_mata_pelajaran' => $request->id_mata_pelajaran,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'durasi' => $request->durasi,
            'random' => $request->random,
            'public' => $request->public,
            'status' => $request->status,
            'id_guru' => $roleGet->id,
            'poin_benar' => $request->poin_benar,
            'total_poin' => $request->total_poin,
            'persentase' => $request->persentase,
            'id_bank_soal' => $request->id_bank_soal,
            'gambar' => $filePath,
            'nama' => $request->nama,
        ]);
        $DataUpdate->update();

        return redirect()->route('guru_ujian-mulaiujian_page')->with('success', 'data kategori barang berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = mulaiujian::findByUuid($uuid);

        if($data)
        {
            $data->delete();

            if($data->gambar)
            {
                Storage::delete($data->gambar);
            }
            return redirect()->route('guru_ujian-mulaiujian_page')->with('success', 'data kategori barang berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data kategori barang tidak ditemukan'
            ]);
        }

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banksoal;
use App\Models\Role;
use App\Models\kategorisoal;
use App\Models\orangtua;
use App\Models\matapelajaran;
use App\Models\guru;
use Illuminate\Support\Facades\Storage;


class BanksoalController extends Controller
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

        $query = banksoal::query();
        
        if($request->has('search'))
        {
            $query->where('tipe_soal', 'like', "%{$request->search}%")
            ->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('materi', 'like', "%{$request->search}%");
            })->orwhereHas('kategorisoal', function($q) use ($request) {
                $q->where('judul', 'like', "%{$request->search}%");
            });
        }

        $dataBanksoal = $query->with(['kategorisoal', 'orangtua', 'matapelajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.ujian.banksoal.partials.table', compact('dataBanksoal'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.ujian.banksoal.banksoal ', compact(['adminSession', 'specAdmin', 'listMenu', 'dataBanksoal']));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function storePage(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;

        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();
        $dataKategorisoal = kategorisoal::all();
        $dataOrangtua = orangtua::all();
        $dataMatapelajaran = matapelajaran::all();
        $RawObjects = [
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
        ];
        $JumlahInput = $request->selected;
        $FinalRaw = [];

        for($i = 0; $i < $JumlahInput; $i++)
        {   
            $FinalRaw[] = $RawObjects[$i];
            if($i == $JumlahInput)
            {
                break;
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'jumlah' => $JumlahInput,
                'finalRaw' => $FinalRaw,
            ]);
        }

        $data = $request->all();

        return view('Pages.ujian.banksoal.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKategorisoal', 'dataOrangtua', 'dataMatapelajaran', 'RawObjects', 'JumlahInput', 'FinalRaw']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $validation = $request->validate([
            'soal' => 'required',
            'level_soal' => 'required',
            'tipe_soal' => 'required',
            'id_orangtua' => 'required',
            'id_grup_soal' => 'required',
            'filepond' => 'required|mimes:pdf|size:2048',
            'filepond' => 'required:array',
            'id_mata_pelajaran' => 'required'
        ], [
            'soal.required' => 'soal tidak boleh kosong',
            'level_soal.required' => 'level soal tidak boleh kosong',
            'tipe_soal.required' => 'tipe soal tidak boleh kosong',
            'id_orangtua.required' => 'orang tua tidak boleh kosong',
            'id_grup_soal.required' => 'kategori soal tidak boleh kosong',

            // file validation 
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.size' => 'ukuran file maks 2mb',
            
            'id_mata_pelajaran' => 'mata pelajaran tidak boleh kosong'
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('UjianBankSoal', 'public');
            }
        }

        $data = banksoal::create([
            'soal' => $request->soal,
            'penjelasan' => $request->penjelasan,
            'level_soal' => $request->level_soal,
            'tipe_soal' => $request->tipe_soal,
            'id_grup_soal' => $request->id_grup_soal,
            'jumlah_soal' => $request->jumlah_soal,
            'jumlah_pilihan' => $request->jumlah_pilihan,
            'jawaban_benar' => $request->jawaban_benar,
            'id_orangtua' => $request->id_orangtua,
            'waktu' => $request->waktu,
            'mark' => $request->mark,
            'petunjuk' => $request->petunjuk,
            'file' => $filePath,
            'id_mata_pelajaran' => $request->id_mata_pelajaran
        ]);
        $data->save();

        return redirect()->route('ujian_banksoal_page')->with('success', 'data bank soal berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $uuid)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();

        $dataEdit = banksoal::findByUuid($uuid);
        $dataKategorisoal = kategorisoal::all();
        $dataOrangtua = orangtua::all();
        $dataMatapelajaran = matapelajaran::all();
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        $RawObjects = [
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
        ];
        $JumlahInput = null;
        $FinalRaw = [];

        if($request->selected == 0)
        {
            $JumlahInput = $dataEdit->jumlah_pilihan;
        }
        else {
            $JumlahInput = $request->selected;
        }

        for($i = 0; $i < $JumlahInput; $i++)
        {   
            $FinalRaw[] = $RawObjects[$i];
            if($i == $JumlahInput)
            {
                break;
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'finalRaw' => $FinalRaw,
            ]);
        }

        return view('Pages.ujian.banksoal.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKategorisoal', 'dataOrangtua', 'dataMatapelajaran', 'RawObjects', 'JumlahInput', 'FinalRaw', 'fileSize']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $dataUpdate = banksoal::findbyUuid($uuid);
        $validation = $request->validate([
            'soal' => 'required',
            'level_soal' => 'required',
            'tipe_soal' => 'required',
            'id_orangtua' => 'required',
            'id_grup_soal' => 'required',
            'filepond' => 'required|mimes:pdf|size:2048',
            'filepond' => 'required:array',
            'id_mata_pelajaran' => 'required'
        ], [
            'soal.required' => 'soal tidak boleh kosong',
            'level_soal.required' => 'level soal tidak boleh kosong',
            'tipe_soal.required' => 'tipe soal tidak boleh kosong',
            'id_orangtua.required' => 'orang tua tidak boleh kosong',
            'id_grup_soal.required' => 'kategori soal tidak boleh kosong',

            // file validation 
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.size' => 'ukuran file maks 2mb',
            
            'id_mata_pelajaran' => 'mata pelajaran tidak boleh kosong'
        ]);

        $filePath = $dataUpdate->file;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('UjianBankSoal', 'public');
            }
        }

        $data = $dataUpdate->update([
            'soal' => $request->soal,
            'penjelasan' => $request->penjelasan,
            'level_soal' => $request->level_soal,
            'tipe_soal' => $request->tipe_soal,
            'id_grup_soal' => $request->id_grup_soal,
            'jumlah_soal' => $request->jumlah_soal,
            'jumlah_pilihan' => $request->jumlah_pilihan,
            'jawaban_benar' => $request->jawaban_benar,
            'id_orangtua' => $request->id_orangtua,
            'waktu' => $request->waktu,
            'mark' => $request->mark,
            'petunjuk' => $request->petunjuk,
            'file' => $filePath,
            'id_mata_pelajaran' => $request->id_mata_pelajaran
        ]);

        return redirect()->route('ujian_banksoal_page')->with('success', 'data bank soal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = banksoal::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            Storage::delete($data->file);

            return redirect()->route('ujian_banksoal_page')->with('success', 'data bank soal berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data bank soal tidak ditemukan'
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

        // section type
        $SectionType = guru::with('section')->where('username', $adminSession)->first();

        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsId($roleGet->role_id);

        $query = banksoal::query();
        
        if($request->has('search'))
        {
            $query->where('tipe_soal', 'like', "%{$request->search}%")
            ->orwhereHas('matapelajaran', function($q) use ($request) {
                $q->where('materi', 'like', "%{$request->search}%");
            })->orwhereHas('kategorisoal', function($q) use ($request) {
                $q->where('judul', 'like', "%{$request->search}%");
            });
        }

        $dataBanksoal = $query->with(['kategorisoal', 'orangtua', 'matapelajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.admin.guru.ujian.banksoal.partials.table', compact('dataBanksoal'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.admin.guru.ujian.banksoal.banksoal ', compact(['adminSession', 'specAdmin', 'listMenu', 'dataBanksoal', 'SectionType']));
    }
    public function storePage2(Request $request)
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

        $dataKategorisoal = kategorisoal::all();
        $dataOrangtua = orangtua::all();
        $dataMatapelajaran = matapelajaran::all();
        $RawObjects = [
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
        ];
        $JumlahInput = $request->selected;
        $FinalRaw = [];

        for($i = 0; $i < $JumlahInput; $i++)
        {   
            $FinalRaw[] = $RawObjects[$i];
            if($i == $JumlahInput)
            {
                break;
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'jumlah' => $JumlahInput,
                'finalRaw' => $FinalRaw,
            ]);
        }

        $data = $request->all();

        return view('Pages.admin.guru.ujian.banksoal.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataKategorisoal', 'dataOrangtua', 'dataMatapelajaran', 'RawObjects', 'JumlahInput', 'FinalRaw', 'SectionType']));
    }
    public function edit2(Request $request, $uuid)
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

        $dataEdit = banksoal::findByUuid($uuid);
        $dataKategorisoal = kategorisoal::all();
        $dataOrangtua = orangtua::all();
        $dataMatapelajaran = matapelajaran::all();
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        $RawObjects = [
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
        ];
        $JumlahInput = null;
        $FinalRaw = [];

        if($request->selected == 0)
        {
            $JumlahInput = $dataEdit->jumlah_pilihan;
        }
        else {
            $JumlahInput = $request->selected;
        }

        for($i = 0; $i < $JumlahInput; $i++)
        {   
            $FinalRaw[] = $RawObjects[$i];
            if($i == $JumlahInput)
            {
                break;
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'finalRaw' => $FinalRaw,
            ]);
        }

        return view('Pages.admin.guru.ujian.banksoal.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEdit', 'dataKategorisoal', 'dataOrangtua', 'dataMatapelajaran', 'RawObjects', 'JumlahInput', 'FinalRaw', 'fileSize', 'SectionType']));
    }
    public function update2(Request $request, $uuid)
    {
        //
        $dataUpdate = banksoal::findbyUuid($uuid);
        $validation = $request->validate([
            'soal' => 'required',
            'level_soal' => 'required',
            'tipe_soal' => 'required',
            'id_orangtua' => 'required',
            'id_grup_soal' => 'required',
            'filepond' => 'required|mimes:pdf|size:2048',
            'filepond' => 'required:array',
            'id_mata_pelajaran' => 'required'
        ], [
            'soal.required' => 'soal tidak boleh kosong',
            'level_soal.required' => 'level soal tidak boleh kosong',
            'tipe_soal.required' => 'tipe soal tidak boleh kosong',
            'id_orangtua.required' => 'orang tua tidak boleh kosong',
            'id_grup_soal.required' => 'kategori soal tidak boleh kosong',

            // file validation 
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.size' => 'ukuran file maks 2mb',
            
            'id_mata_pelajaran' => 'mata pelajaran tidak boleh kosong'
        ]);

        $filePath = $dataUpdate->file;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('UjianBankSoal', 'public');
            }
        }

        $data = $dataUpdate->update([
            'soal' => $request->soal,
            'penjelasan' => $request->penjelasan,
            'level_soal' => $request->level_soal,
            'tipe_soal' => $request->tipe_soal,
            'id_grup_soal' => $request->id_grup_soal,
            'jumlah_soal' => $request->jumlah_soal,
            'jumlah_pilihan' => $request->jumlah_pilihan,
            'jawaban_benar' => $request->jawaban_benar,
            'id_orangtua' => $request->id_orangtua,
            'waktu' => $request->waktu,
            'mark' => $request->mark,
            'petunjuk' => $request->petunjuk,
            'file' => $filePath,
            'id_mata_pelajaran' => $request->id_mata_pelajaran
        ]);

        return redirect()->route('guru_ujian-banksoal_page')->with('success', 'data bank soal berhasil diupdate');
    }
    public function destroy2($uuid)
    {
        //
        $data = banksoal::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            Storage::delete($data->file);

            return redirect()->route('guru_ujian-banksoal_page')->with('success', 'data bank soal berhasil dihapus');
        }
        else {
            return response()->json([
                'error' => 'data bank soal tidak ditemukan'
            ]);
        }
    }

}

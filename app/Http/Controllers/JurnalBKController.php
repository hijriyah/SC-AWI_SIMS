<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jurnalbk;
use App\Models\tahunajaran;
use App\Models\kelas;
use App\Models\bimbingankonseling;
use App\Models\Role;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;

class JurnalBKController extends Controller
{
    public function index(Request $request)
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = jurnalbk::query();
        
        if($request->has('search'))
        {
            $query->whereHas('kelas', function($q) use ($request) {
                $q->where('nama_kelas', 'like', "%{$request->search}%");
            })
           
            ->orwhereHas('bimbingankonseling', function($q) use ($request) {
                $q->where('jenis_konseling', 'like', "%{$request->search}%");
            })
            ->orwhereHas('tahunajaran', function($q) use ($request) {
                $q->where('tahun_ajaran', 'like', "%{$request->search}%");
            });
        }

        $dataJurnalBK = $query->with(['kelas', 'bimbingankonseling', 'tahunajaran'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.jurnal.jurnalbk.partials.table', compact('dataJurnalBK'))->render();
            return response()->json([
                'html' => $html
            ]);

        }

        return view('Pages.jurnal.jurnalbk.jurnalbk', compact(['adminSession', 'specAdmin', 'listMenu', 'dataJurnalBK']));
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
        $dataBimbinganKonseling = bimbingankonseling::all();
        $dataTahunAjaran = tahunajaran::all();


        return view('Pages.jurnal.jurnalbk.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKelas', 'dataBimbinganKonseling', 'dataTahunAjaran']));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validation = $request->validate([
        	'id_tahun_ajaran' => 'required|numeric',
        	'semester' => 'required',
        	'bulan' => 'required',
        	'id_kelas' => 'required|numeric',
        	'tanggal_kegiatan' => 'required',
        	'sasaran_kegiatan' => 'required',
            'minggu_ke' => 'required',
            'id_bimbingan_konseling' => 'required|numeric',
            'hasil_capai' => 'required'
        ]);

        $data = jurnalbk::create([
        	'id_tahun_ajaran' => $request->id_tahun_ajaran,
        	'semester' => $request->semester,
        	'bulan' => $request->bulan,
        	'id_kelas' => $request->id_kelas,
            'minggu_ke' => $request->minggu_ke,
        	'tanggal_kegiatan' => $request->tanggal_kegiatan,
        	'sasaran_kegiatan' => $request->sasaran_kegiatan,
            'id_bimbingan_konseling' => $request->id_bimbingan_konseling,
            'hasil_capai' => $request->hasil_capai
        ]);
        $data->save();

        return redirect()->route('jurnal_jurnalbk_page')->with('success', 'data berhasil disimpan');
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

        $dataEdit = jurnalbk::findByUuid($uuid);
        $dataKelas = kelas::all();
        $dataBimbinganKonseling = bimbingankonseling::all();
        $dataTahunAjaran = tahunajaran::all();

        return view('Pages.jurnal.jurnalbk.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKelas', 'dataBimbinganKonseling', 'dataTahunAjaran']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = jurnalbk::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('jurnal_jurnalbk_page')->with('success', 'data berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = jurnalbk::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('jurnal_jurnalbk_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }

    public function DownloadReport($id)
    {
        $data = jurnalbk::with(['kelas', 'tahunajaran', 'bimbingankonseling'])->find($id);
        $pdf = PDF::loadView('Laporan.JurnalBK.JurnalBKReport', ['data' => $data]);

        return $pdf->download('Jurnal BK Report.pdf');


    }

}

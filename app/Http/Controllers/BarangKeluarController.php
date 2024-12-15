<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barangkeluar;
use App\Models\barangmasuk;
use App\Models\lokasibarang;
use App\Models\Role;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = barangkeluar::query();
        
        if($request->has('search'))
        {
            $query->whereHas('barangmasuk', function($q) use ($request) {
                $q->where('nama_barang_masuk', 'like', "%{$request->search}%");
            })
            ->orwhereHas('lokasibarang', function($q) use ($request) {
                $q->where('lokasi_barang', 'like', "%{$request->search}%");
            });
        }

        $dataBarangKeluar = $query->with(['barangmasuk', 'lokasibarang'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.inventaris.barangkeluar.partials.table', compact('dataBarangKeluar'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.inventaris.barangkeluar.barangkeluar', compact(['adminSession', 'specAdmin', 'listMenu', 'dataBarangKeluar']));
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

        $dataBarangMasuk = barangmasuk::all();
        $dataLokasiBarang = lokasibarang::all();

        return view('Pages.inventaris.barangkeluar.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataBarangMasuk', 'dataLokasiBarang']));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'id_barang_masuk' => 'required|numeric',
            'jatuh_tempo' => 'required',
            'catatan' => 'required',
        	'jumlah_keluar' => 'required|numeric',
            'status' => 'required',
            'kondisi_barang' => 'required',
            'id_lokasi_barang' => 'required|numeric',
            'tanggal_keluar' => 'required',
            'tanggal_masuk' => 'required'

        ]);

        $data = barangkeluar::create([
            'id_barang_masuk' => $request->id_barang_masuk,
            'jatuh_tempo' => $request->jatuh_tempo,
            'catatan' => $request->catatan,
            'jumlah_keluar' => $request->jumlah_keluar,
            'status' => $request->status,
            'kondisi_barang' => $request->kondisi_barang,
            'id_lokasi_barang' => $request->id_lokasi_barang,
            'tanggal_keluar' => $request->tanggal_keluar,
            'tanggal_masuk' => $request->tanggal_masuk
        ]);
        $data->save();

        return redirect()->route('inventaris_barangkeluar_page')->with('success', 'data barang keluar berhasil disimpan');
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

        $dataEdit = barangkeluar::findByUuid($uuid);
        $dataBarangMasuk = barangmasuk::all();
        $dataLokasiBarang = lokasibarang::all();

        return view('Pages.inventaris.barangkeluar.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataBarangMasuk', 'dataLokasiBarang']));
    }

    public function update(Request $request, $uuid)
    {
        //
        $data = barangkeluar::findbyUuid($uuid);
        $data->update($request->all());

        return redirect()->route('inventaris_barangkeluar_page')->with('success', 'data barang keluar berhasil diupdate');
    }

    public function destroy($uuid)
    {
        //
        $data = barangkeluar::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('inventaris_barangkeluar_page')->with('success', 'data barang keluar berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data tidak ditemukan'
            ]);
        }
    }
}

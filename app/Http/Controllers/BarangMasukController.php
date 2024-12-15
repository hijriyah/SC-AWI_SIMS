<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barangmasuk;
use App\Models\kategoribarang;
use App\Models\lokasibarang;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = barangmasuk::query();
        
        if($request->has('search'))
        {
            $query->where('nama_barang_masuk', 'like', "%{$request->search}%")
            
            ->orwhereHas('kategoribarang', function($q) use ($request) {
                $q->where('kategori_barang', 'like', "%{$request->search}%");
            })

            ->orwhereHas('lokasibarang', function($q) use ($request) {
                $q->where('lokasi_barang', 'like', "%{$request->search}%");
            });
        }

        $dataBarangMasuk = $query->with(['kategoribarang', 'lokasibarang'])->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.inventaris.barangmasuk.partials.table', compact('dataBarangMasuk'))->render();

            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.inventaris.barangmasuk.barangmasuk', compact(['adminSession', 'specAdmin', 'listMenu', 'dataBarangMasuk']));
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
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));
        $dataRole = Role::get();

        $dataKategoriBarang = kategoribarang::all();
        $dataLokasiBarang = lokasibarang::all();

        return view('Pages.inventaris.barangmasuk.add', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataKategoriBarang', 'dataLokasiBarang',]));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $validation = $request->validate([

            'nama_barang_masuk' => 'required',
            'serial' => 'required',
            'deskripsi' => 'required',
            'manufaktur' => 'required',
            'brand' => 'required',
            'nomor_barang' => 'required',
            'tanggal_masuk' => 'required',
            'jumlah_masuk' => 'required|numeric',
            'status' => 'required',
            'kondisi_barang' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array',
            'id_kategori_barang' => 'required',
            'id_lokasi_barang' => 'required'

        ], [

            'nama_barang_masuk.required' => 'nama_barang_masuk tidak boleh kosong',
            'serial.required' => 'serial tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'manufaktur.required' => 'manufaktur tidak boleh kosong',
            'brand.required' => 'brand tidak boleh kosong',
            'nomor_barang.required' => 'nomor_barang tidak boleh kosong',
            'tanggal_masuk.required' => 'tanggal_masuk tidak boleh kosong',
            'jumlah_masuk.required' => 'jumlah_masuk tidak boleh kosong',
            'status.required' => 'status tidak boleh kosong',
            'kondisi_barang.required' => 'kondisi_barang tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB',

            'id_kategori_barang.required' => 'kategori_barang tidak boleh kosong',
            'id_lokasi_barang.required' => 'lokasi_barang tidak boleh kosong'
            
        ]);

        $filePath = null;
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('InventarisBarangMasuk', 'public');
            }
        }

        $data = barangmasuk::create([
            'nama_barang_masuk' => $request->nama_barang_masuk,
            'serial' => $request->serial,
            'deskripsi' => $request->deskripsi,
            'manufaktur' => $request->manufaktur,
            'brand' => $request->brand,
            'nomor_barang' => $request->nomor_barang,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'status' => $request->status,
            'kondisi_barang' => $request->kondisi_barang,
            'file' => $filePath,
            'id_kategori_barang' => $request->id_kategori_barang,
            'id_lokasi_barang' => $request->id_lokasi_barang
        ]);
        $data->save();

        return redirect()->route('inventaris_barangmasuk_page')->with('success', 'data barang masuk berhasil disimpan');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(barangmasuk $barangmasuk)
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

        $dataEdit = barangmasuk::findByUuid($uuid);
        $dataKategoriBarang = kategoribarang::all();
        $dataLokasiBarang = lokasibarang::all();
        $fileSource = Storage::disk('public')->url($dataEdit->file);
        $fileSize = Storage::disk('public')->size($dataEdit->file);

        return view('Pages.inventaris.barangmasuk.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataRole', 'dataEdit', 'dataKategoriBarang', 'dataLokasiBarang', 'fileSize', 'fileSource']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        // dd($request->all());
        
        $validation = $request->validate([
            
            'nama_barang_masuk' => 'required',
            'serial' => 'required',
            'deskripsi' => 'required',
            'manufaktur' => 'required',
            'brand' => 'required',
            'nomor_barang' => 'required',
            'tanggal_masuk' => 'required',
            'jumlah_masuk' => 'required|numeric',
            'status' => 'required',
            'kondisi_barang' => 'required',
            'filepond' => 'required|mimes:pdf|max:2048',
            'filepond' => 'required|array',
            'id_kategori_barang' => 'required',
            'id_lokasi_barang' => 'required',

        ], [

            'nama_barang_masuk.required' => 'nama_barang_masuk tidak boleh kosong',
            'serial.required' => 'serial tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'manufaktur.required' => 'manufaktur tidak boleh kosong',
            'brand.required' => 'brand tidak boleh kosong',
            'nomor_barang.required' => 'nomor_barang tidak boleh kosong',
            'tanggal_masuk.required' => 'tanggal_masuk tidak boleh kosong',
            'jumlah_masuk.required' => 'jumlah_masuk tidak boleh kosong',
            'status.required' => 'status tidak boleh kosong',
            'kondisi_barang.required' => 'kondisi_barang tidak boleh kosong',

            // file validation
            'filepond.required' => 'file tidak boleh kosong',
            'filepond.mimes' => 'file harus berformat pdf',
            'filepond.max' => 'file tidak boleh lebih dari 2MB',

            'id_kategori_barang.required' => 'kategori_barang tidak boleh kosong',
            'id_lokasi_barang.required' => 'lokasi_barang tidak boleh kosong',
            
        ]);

        $data = barangmasuk::findbyUuid($uuid);

        $filePath = $data->file;
        // if($request->hasFile('filepond'))
        // {
        //     $updateFile = $request->file('filepond');
        //     $filePath = $updateFile->store('AkademikPenugasanSiswa', 'public');
        // }
        if ($request->hasFile('filepond')) {
            foreach ($request->file('filepond') as $file) {
                $filePath = $file->store('InventarisBarangMasuk', 'public');
            }
        }

        $data->update([
            'nama_barang_masuk' => $request->nama_barang_masuk,
            'serial' => $request->serial,
            'deskripsi' => $request->deskripsi,
            'manufaktur' => $request->manufaktur,
            'brand' => $request->brand,
            'nomor_barang' => $request->nomor_barang,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'status' => $request->status,
            'kondisi_barang' => $request->kondisi_barang,
            'file' => $filePath,
            'id_kategori_barang' => $request->id_kategori_barang,
            'id_lokasi_barang' => $request->id_lokasi_barang,
        ]);

        return redirect()->route('inventaris_barangmasuk_page')->with('success', 'data barang masuk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = barangmasuk::findByUuid($uuid);

        if($data)
        {
            
            $data->delete();
            
            if($data->file)
            {
                Storage::delete($data->file);
            }
            return redirect()->route('inventaris_barangmasuk_page')->with('success', 'data barang masuk berhasil dihapus');
        }
        else {
            return response()->json([
                'error' =>  'data barang masuk tidak ditemukan'
            ]);
        }
    }
}

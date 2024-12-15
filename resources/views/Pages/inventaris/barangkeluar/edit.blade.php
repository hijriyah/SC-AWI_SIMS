@extends('layouts.layout')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Dashboard</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Selamat Datang Di {{ $adminSession }} Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 0px; margin-bottom: 500px;">
   <div class="col-lg-12">
       <div class="card">
           <div class="card-body">
                <div class="position-custom">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-3"><b>Edit Barang Keluar</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('inventaris_barangkeluar_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">

                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Nama Barang</label>
                              <select class="form-select" placeholder="Pilih" name="id_barang_masuk">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataBarangMasuk as $barangmasuk)
                                  <option value="{{ $barangmasuk->id }}" {{ old('id_barang_masuk', $barangmasuk->id ) == $dataEdit->id_barang_masuk ? 'selected' : ''}}>{{ $barangmasuk->section }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Jatuh Tempo</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="jatuh_tempo"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="jatuh_tempo" value="{{ $dataEdit->jatuh_tempo }}" />
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Catatan</label>
                                <input class="form-control" name="catatan" value="{{ $dataEdit->catatan }}" />
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Jumlah Keluar</label>
                                <input class="form-control" name="jumlah_keluar" value="{{ $dataEdit->jumlah_keluar }}" />
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option selected disabled>Pilih</option>
                                <option value="snp" {{ old('status', $dataEdit->status) == "snp" ? 'selected' : ''}}>SNP</option>
                                <option value="non_snp" {{ old('status', $dataEdit->status) == "non_snp" ? 'selected' : ''}}>Non SNP</option>
                            </select>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <label class="form-label">Kondisi Barang</label>
                            <select class="form-select" name="kondisi_barang">
                                <option selected disabled>Pilih</option>
                                <option value="baik" {{ old('kondisi_barang', $dataEdit->kondisi_barang) == "baik" ? 'selected' : ''}}>Baik</option>
                                <option value="rusak" {{ old('kondisi_barang', $dataEdit->kondisi_barang) == "rusak" ? 'selected' : ''}}>Rusak</option>
                            </select>
                        </div>

                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Lokasi</label>
                              <select class="form-select" placeholder="Pilih" name="id_lokasi_barang">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataLokasiBarang as $lokasibarang)
                                  <option value="{{ $lokasibarang->id }}" {{ old('id_lokasi_barang', $lokasibarang->id ) == $dataEdit->id_lokasi_barang ? 'selected' : ''}}>{{ $lokasibarang->lokasi_barang }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tanggal Masuk</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="tanggal_masuk"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_masuk" value="{{ $dataEdit->tanggal_masuk }}" />
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tanggal Keluar</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="tanggal_keluar"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_keluar" value="{{ $dataEdit->tanggal_keluar }}" />
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                <!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('inventaris_barangkeluar_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
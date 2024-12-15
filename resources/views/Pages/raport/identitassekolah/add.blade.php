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
                        <h4 class="card-title mb-3"><b>Tambah Identitas Sekolah</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form id="tugasForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Sekolah</label>
                                <input class="form-control" name="nama_sekolah" />
                                @error('nama_sekolah')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Alamat</label>
                                <input class="form-control" name="alamat" />
                                @error('alamat')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Kabupaten</label>
                                <input class="form-control" name="kabupaten" />
                                @error('kabupaten')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Provinsi</label>
                                <input class="form-control" name="provinsi" />
                                @error('provinsi')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Logo Sekolah</label>
                            <div class="input-group">
                                <input type="file" class="form-control" placeholder="file" accept=".jpg, .jpeg, .png" name="file" />
                                <span class="input-group-text"><i class="mdi mdi-panorama"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Kepala Sekolah</label>
                                <input class="form-control" name="nama_kepala_sekolah" />
                                @error('nama_kepala_sekolah')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">NIP Kepala Sekolah</label>
                                <input class="form-control" name="nip_kepala_sekolah" />
                                @error('nip_kepala_sekolah')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('raport_identitassekolah_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
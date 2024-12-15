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
                        <h4 class="card-title mb-3"><b>Edit Rekap Kelengkapan Arsip</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('arsipguru_rekapkelengkapanarsip_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">

                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Guru</label>
                              <select class="form-select" placeholder="Pilih" name="id_guru">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataGuru as $guru)
                                  <option value="{{ $guru->id }}" {{ old('id_guru', $guru->id ) == $dataEdit->id_guru ? 'selected' : ''}}>{{ $guru->nama_lengkap}}</option>
                                  @endforeach
                              </select><br>

                              <label class="form-label">Mata Pelajaran</label>
                              <select class="form-select" placeholder="Pilih" name="id_mata_pelajaran">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataMataPelajaran as $matapelajaran)
                                  <option value="{{ $matapelajaran->id }}" {{ old('id_mata_pelajaran', $matapelajaran->id ) == $dataEdit->id_mata_pelajaran ? 'selected' : ''}}>{{ $matapelajaran->mata_pelajaran}}</option>
                                  @endforeach
                              </select><br>

                              <label class="form-label">Upload Arsip</label>
                              <select class="form-select" placeholder="Pilih" name="id_upload_arsip">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataUploadArsip as $uploadarsip)
                                  <option value="{{ $uploadarsip->id }}" {{ old('id_upload_arsip', $uploadarsip->id ) == $dataEdit->id_upload_arsip ? 'selected' : ''}}>{{ $uploadarsip->judul}}</option>
                                  @endforeach
                              </select><br>

                              <label class="form-label">Status Kelengkapan</label>
                            <select class="form-select" name="status_kelengkapan">
                                <option selected disabled>Pilih</option>
                                <option value="lengkap" {{ old('status_kelengkapan', $dataEdit->status_kelengkapan) == "lengkap" ? 'selected' : ''}}>Lengkap</option>
                                <option value="belum_lengkap" {{ old('status_kelengkapan', $dataEdit->status_kelengkapan) == "belum_lengkap" ? 'selected' : ''}}>Belum Lengkap</option>
                            </select>
                         </div>
                        </div>
                    </div>
                   
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('arsipguru_rekapkelengkapanarsip_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
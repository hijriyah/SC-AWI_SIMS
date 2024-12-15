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
                        <h4 class="card-title mb-3"><b>Edit Komplain</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('siswa_pengaturan_komplain_update', ['uuid' => $dataEdit->uuid]) }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Judul</label>
                                <input class="form-control" name="judul" value="{{ $dataEdit->judul }}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tahun Ajaran</label>
                                <div class="col-lg-12 mb-4">
                                    <select class="form-select" name="id_tahun_ajaran">
                                        <option selected disabled>Pilih</option>
                                        @foreach($dataTahunAjaran as $tahunajaran)
                                            <option value="{{ $tahunajaran->id }}" {{ old('id_tahun_ajaran', $tahunajaran->id)  == $dataEdit->id_tahun_ajaran ? 'selected' : '' }}>{{ $tahunajaran->tahun_ajaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- input-group -->
                            </div>
                        </div>
                    </div>
                       
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="form-label">Deksripsi</label>
                                <textarea class="form-control" name="deskripsi" style="height: 100px;">{{ $dataEdit->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>

                         
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="form-label">Lampiran</label>
                                <textarea class="form-control" name="lampiran" style="height: 100px;">{{ $dataEdit->lampiran }}</textarea>
                            </div>
                        </div>
                    </div>
                    

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('siswa_pengaturan_komplain_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
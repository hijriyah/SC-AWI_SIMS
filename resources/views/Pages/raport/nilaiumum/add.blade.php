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
                        <h4 class="card-title mb-3"><b>Tambah Penilaian Umum</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('raport_nilaiumum_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      
                      <div class="col-lg-6">
                            <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Siswa</label>
                              <select class="form-select" placeholder="Pilih" name="id_siswa">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataSiswa as $siswa)
                                     <option value="{{ $siswa->id }}">{{ $siswa->nama_lengkap }}</option>
                                  @endforeach
                              </select>
                            </div>

                            <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Mata Pelajaran</label>
                              <select class="form-select" placeholder="Pilih" name="id_mata_pelajaran">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataMataPelajaran as $matapelajaran)
                                     <option value="{{ $tahunajaran->id }}">{{ $matapelajaran->mata_pelajaran }}</option>
                                  @endforeach
                              </select>
                        </div>
                      </div>
                      
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nilai UAS</label>
                                <input class="form-control" type="number" name="nilai_uas" /><br>
                                <!-- input-group -->
                                <label class="form-label">Nilai Tugas</label>
                                <input class="form-control" type="number" name="nilai_tugas" /><br>

                                <label class="form-label">Nilai UH</label>
                                <input class="form-control" type="number" name="nilai_uh" />
                            </div>
                        </div>
                        
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('raport_nilaiumum_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
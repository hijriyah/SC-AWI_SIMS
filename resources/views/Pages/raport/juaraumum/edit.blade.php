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
                        <h4 class="card-title mb-3"><b>Edit Juara Umum</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('raport_juaraumum_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">

                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Siswa</label>
                              <select class="form-select" placeholder="Pilih" name="id_siswa">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataSiswa as $siswa)
                                  <option value="{{ $siswa->id }}" {{ old('id_siswa', $siswa->id ) == $dataEdit->id_siswa ? 'selected' : ''}}>{{ $siswa->nama_lengkap }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Tahun Ajaran</label>
                              <select class="form-select" placeholder="Pilih" name="id_tahun_ajaran">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataTahunAjaran as $tahunajaran)
                                  <option value="{{ $tahunajaran->id }}" {{ old('id_tahun_ajaran', $tahunajaran->id ) == $dataEdit->id_tahun_ajaran ? 'selected' : ''}}>{{ $tahunajaran->tahun_ajaran }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Semester</label>
                              <select class="form-select" placeholder="Pilih" name="id_semester">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataSemester as $semester)
                                  <option value="{{ $semester->id }}" {{ old('id_semester', $semester->id ) == $dataEdit->id_semester ? 'selected' : ''}}>{{ $semester->semester }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>
                      
                        
                      <div class="col-md-12">
                            <label class="form-label">Jumlah Nilai</label>
                            <input class="form-control" name="jumlah_nilai" value="{{ $dataEdit->jumlah_nilai }}" />
                      </div>

                      <div class="col-md-12">
                            <label class="form-label">Rata-rata Nilai</label>
                            <input class="form-control" name="rata_rata_nilai" value="{{ $dataEdit->rata_rata_nilai }}" />
                      </div>

                      <div class="col-md-12">
                            <label class="form-label">Juara</label>
                            <input class="form-control" name="juara" value="{{ $dataEdit->juara }}" />
                      </div>

                      <div class="col-lg-12 mb-4">
                            <label class="form-label">Tipe Juara</label>
                            <select class="form-select" name="tipe_juara">
                                <option selected disabled>Pilih</option>
                                <option value="semua" {{ old('tipe_juara', $dataEdit->tipe_juara) == "semua" ? 'selected' : ''}}>Semua</option>
                                <option value="perjenjang" {{ old('tipe_juara', $dataEdit->tipe_juara) == "perjenjang" ? 'selected' : ''}}>Perjenjang</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('raport_juaraumum_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
                       
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
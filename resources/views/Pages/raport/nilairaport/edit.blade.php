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
                        <h4 class="card-title mb-3"><b>Edit Nilai Raport</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('raport_nilairaport_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Mata Pelajaran</label>
                              <select class="form-select" placeholder="Pilih" name="id_mata_pelajaran">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataMataPelajaran as $matapelajaran)
                                  <option value="{{ $matapelajaran->id }}" {{ old('id_mata_pelajaran', $matapelajaran->id ) == $dataEdit->id_mata_pelajaran ? 'selected' : ''}}>{{ $matapelajaran->mata_pelajaran }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>
                      
                        
                      <div class="col-md-12">
                            <label class="form-label">KKM</label>
                            <input class="form-control" name="kkm" value="{{ $dataEdit->kkm }}" />
                      </div>

                      <!--<div class="col-md-12">
                            <label class="form-label">Nilai Akhir</label>
                            <input class="form-control" name="nilai_akhir" value="{{ $dataEdit->nilai_akhir }}" />
                      </div>

                      <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Predikat</label>
                              <select class="form-select" placeholder="Pilih" name="id_kkm">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataKkm as $kkm)
                                  <option value="{{ $kkm->id }}" {{ old('id_kkm', $kkm->id ) == $dataEdit->id_mata_pelajaran ? 'selected' : ''}}>{{ $kkm->predikat }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Rata-rata Per Mapel</label>
                            <input class="form-control" name="rata_rata_permapel" value="{{ $dataEdit->rata_rata_permapel }}" />
                      </div>

                      <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Catatan WaliKelas</label>
                              <select class="form-select" placeholder="Pilih" name="id_cataan_walikelas">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataCatatnWalikelas as $catatanwalikelas)
                                  <option value="{{ $catatanwalikelas->id }}" {{ old('id_catatan_walikelas', $catatanwalikelas->id ) == $dataEdit->id_catatan_walikelas ? 'selected' : ''}}>{{ $catatanwalikelas->catatan }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>-->
                      
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('raport_nilairaport_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
                       
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
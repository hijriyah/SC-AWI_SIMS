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
                        <h4 class="card-title mb-3"><b>Edit Jurnal Kegiatan</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('jurnal_jurnalbk_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">

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
                            <div class="mb-4">
                              <label class="form-label">Semester</label>
                              <input class="form-control" type="number" name="semester" value="{{ $dataEdit->semester}}" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                              <label class="form-label">Bulan</label>
                              <input class="form-control" type="number" name="bulan" value="{{ $dataEdit->bulan}}" />
                            </div>
                        </div>

                      <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Kelas</label>
                              <select class="form-select" placeholder="Pilih" name="id_guru">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataKelas as $kelas)
                                  <option value="{{ $kelas->id }}" {{ old('id_kelas', $kelas->id ) == $dataEdit->id_kelas ? 'selected' : ''}}>{{ $kelas->nama_kelas }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                              <label class="form-label">Minggu Ke-</label>
                              <input class="form-control" type="text" name="minggu_ke" value="{{ $dataEdit->minggu_ke}}" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tanggal Kegiatan</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="tanggal_kegiatan"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_kegiatan" value="{{ $dataEdit->tanggal_kegiatan }}" />
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Sasaran Kegiatan</label>
                            <input class="form-control" name="sasaran_kegiatan" value="{{ $dataEdit->sasaran_kegiatan}}" />
                        </div>

                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Bimbingan Konseling</label>
                              <select class="form-select" placeholder="Pilih" name="id_bimbingan_konseling">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataBimbinganKonseling as $bimbingankonseling)
                                  <option value="{{ $bimbingankonseling->id }}" {{ old('id_bimbingan_konseling', $bimbingankonseling->id ) == $dataEdit->id_bimbingan_konseling ? 'selected' : ''}}>{{ $bimbingankonseling->jenis_konseling }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>

                        

                      <div class="col-md-12">
                            <label class="form-label">Hasil Yang Di Capai</label>
                            <input class="form-control" name="hasil_capai" value="{{ $dataEdit->hasil_capai}}" />
                      </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('jurnal_jurnalbk_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
                       
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
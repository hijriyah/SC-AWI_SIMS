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
                        <h4 class="card-title mb-3"><b>Tambah Kehadiran Siswa Ujian</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('ujian_kehadiransiswaujian_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                           <div class="mb-4">
                              <label class="form-label">Rencana Ujian</label>
                              <select class="form-select" placeholder="Pilih" name="id_rencana_ujian">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataRencanaUjian as $rencanaujian)
                                      <option value="{{ $rencanaujian->id }}">{{ $rencanaujian->rencana_ujian }}</option>
                                  @endforeach
                              </select>
                              @error('id_rencana_ujian')
                                  <span class="text-sm text-danger">{{ $message }}</span>
                              @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Kelas</label>
                                <select class="form-select" placeholder="Pilih" name="id_kelas">
                                    <option selected disabled>Pilih</option>
                                    @foreach($dataKelas as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                              </div>

                              <div class="mb-4">
                                <label class="form-label">Tanggal</label>
                                <div class="input-group" id="datepicker3">
                                  {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                      data-date-container='#datepicker3' data-provide="datepicker"
                                      data-date-format="yyyy-mm-dd"
                                      data-date-multidate="true" name="tanggal"> --}}
                                  <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal" />
                                  {{-- <span class="input-group-text"><i
                                          class="mdi mdi-calendar"></i></span> --}}
                                </div>
                              <!-- input-group -->
                              </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('ujian_kehadiransiswaujian_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
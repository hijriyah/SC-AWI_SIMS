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
                        <h4 class="card-title mb-3"><b>Tambah Jadwal Ujian</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('ujian_jadwalujian_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-4 mt-lg-0 mb-3">
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
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-4 mt-lg-0 mb-3">
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
                        </div>
                    </div>
                       
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-4 mt-lg-0 mb-3">
                                <label class="form-label">Section</label>
                                <select class="form-select" placeholder="Pilih" name="id_section">
                                    <option selected disabled>Pilih</option>
                                    @foreach($dataSection as $section)
                                        <option value="{{ $tugasguru->id }}">{{ $section->section }}</option>
                                    @endforeach
                                </select>
                                @error('id_section')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-4 mt-lg-0 mb-3">
                                <label class="form-label">Mata Pelajaran</label>
                                <select class="form-select" placeholder="Pilih" name="id_mata_pelajaran">
                                    <option selected disabled>Pilih</option>
                                    @foreach($dataMataPelajaran as $matapelajaran)
                                        <option value="{{ $matapelajaran->id }}">{{ $matapelajaran->mata_pelajaran }}</option>
                                    @endforeach
                                </select>
                                @error('id_mata_pelajaran')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-4 mt-lg-0 mb-3">
                                <label class="form-label">Tahun Ajaran</label>
                                <select class="form-select" placeholder="Pilih" name="id_tahun_ajaran">
                                    <option selected disabled>Pilih</option>
                                    @foreach($dataTahunAjaran as $tahunajaran)
                                        <option value="{{ $tahunajaran->id }}">{{ $tahunajaran->tahun_ajaran }}</option>
                                    @endforeach
                                </select>
                                @error('id_tahun_ajaran')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tanggal Ujian</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="tanggal_ujian"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_ujian" />
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                <!-- input-group -->
                                @error('tanggal_ujian')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Ujian Dari</label>
                            <input type="text" class="form-control" name="ujian_dari" />
                            @error('ujian_dari')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Ujian Untuk</label>
                            <input type="text" class="form-control" name="ujian_untuk" />
                            @error('ujian_untuk')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Ruangan</label>
                            <input type="text" class="form-control" name="ruangan" />
                        </div>
                    </div>
                    

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('ujian_jadwalujian_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
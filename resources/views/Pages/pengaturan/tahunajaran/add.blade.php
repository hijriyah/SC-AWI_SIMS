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
                        <h4 class="card-title mb-3"><b>Tambah Tahun Ajaran</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('pengaturan_tahunajaran_store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tipe Sekolah</label>
                                <input class="form-control" name="tipe_sekolah" />
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tahun Ajaran</label>
                                <input class="form-control" name="tahun_ajaran" />
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Judul</label>
                                <input class="form-control" name="judul" />
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Semester</label>
                                <select class="form-select" name="semester">
                                    <option selected disabled>Pilih</option>
                                    <option value="ganjil">Ganjil</option>
                                    <option value="genap">Genap</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tanggal Mulai</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="tanggal_mulai"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_mulai" />
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tanggal Selesai</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="tanggal_selesai"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_selesai" />
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                <!-- input-group -->
                            </div>
                        </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                            <a href="{{ route('pengaturan_tahunajaran_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                        </div>
                    
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
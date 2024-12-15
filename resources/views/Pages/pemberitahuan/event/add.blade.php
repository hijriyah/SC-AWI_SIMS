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
                        <h4 class="card-title mb-3"><b>Tambah Event</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form id="tugasForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6 mb-4">
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
                        
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tanggal Mulai</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="tanggal_mulai"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_mulai">
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                    @error('tanggal_mulai')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
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
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_selesai">
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                    @error('tanggal_selesai')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                       
                    <div class="row">
                         <div class="col-lg-6">
                            <label class="form-label">Waktu Mulai</label>
                            <input class="form-control" name="waktu_mulai" id="start_time" placeholder="00:00" />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Waktu Selesai</label>
                            <input class="form-control" name="waktu_selesai" id="end_time" placeholder="00:00" />
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Judul</label>
                                <input class="form-control" name="judul" />
                                @error('judul')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Deskripsi</label>
                                <input class="form-control" name="deskripsi" />
                                @error('deskripsi')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Foto</label>
                            <div class="input-group">
                                <input type="file" class="form-control" placeholder="file" accept=".jpg, .jpeg, .png" name="file" />
                                <span class="input-group-text"><i class="mdi mdi-panorama"></i></span>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option selected disabled>Pilih</option>
                                <option value="akan_dilaksanakan">Akan Dilaksanakan</option>
                                <option value="sedang_dilaksanakan">Sedang Dilaksanakan</option>
                                <option value="berakhir">Event Berakhir</option>
                            </select>
                        </div>
                        
                       
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('pemberitahuan_event_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
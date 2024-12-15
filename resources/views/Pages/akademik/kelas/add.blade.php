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
                        <h4 class="card-title mb-3"><b>Tambah Kelas</b></h4>
                        <div></div>
                        <!--<a href="{{ route('akademik_kelas_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>-->
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('akademik_kelas_store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Kelas</label>
                                <input class="form-control" name="nama_kelas" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                                <label class="form-label">Kelas Angka</label>
                                <select class="form-select" placeholder="Pilih" name="kelas_angka">
                                    <option selected disabled>Pilih</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                           </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Wali Kelas</label>
                              <select class="form-select" placeholder="Pilih" name="id_guru">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataGuru as $guru)
                                     <option value="{{ $guru->id }}">{{ $guru->nama_lengkap }}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                              <label class="form-label">Jumlah Maksimal Siswa</label>
                              <input class="form-control" type="number" name="maksimal_siswa" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="mb-4">
                              <label class="form-label">Catatan</label>
                              <textarea class="form-control" name="catatan"></textarea>
                          </div>
                        </div>
                       
                        <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('akademik_kelas_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                        </div>
                    </div>
                  </form>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
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
                        <h4 class="card-title mb-3"><b>Tambah Sanksi Pelanggaran</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('kesiswaan_sanksipelanggaran_store') }}" method="POST">
                    @csrf
                    <div class="row">
                        
                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Jenis Pelanggaran</label>
                              <select class="form-select" placeholder="Pilih" name="id_pelanggaran">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataPelanggaran as $pelanggaran)
                                     <option value="{{ $pelanggaran->id }}">{{ $pelanggaran->jenis_pelanggaran }}</option>
                                  @endforeach
                              </select><br>

                              <label class="form-label">Bentuk Sanksi</label>
                                <select class="form-select" placeholder="Pilih" name="bentuk_sanksi">
                                    <option selected disabled>Pilih</option>
                                    <option value="tindakan_langsung">Tindakan Langsung</option>
                                    <option value="teguran">Teguran</option>
                                    <option value="surat_peringatan">Surat Peringatan</option>
                                    <option value="skorsing">Skorsing</option>
                                </select><br>

                                <label class="form-label">Maksimal Poin</label>
                                <input type="number" class="form-control" name="maksimal_poin" />
                                <!-- input-group -->
                        </div>
                      </div>
                    </div>

                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                            <a href="{{ route('kesiswaan_sanksipelanggaran_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                        </div>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
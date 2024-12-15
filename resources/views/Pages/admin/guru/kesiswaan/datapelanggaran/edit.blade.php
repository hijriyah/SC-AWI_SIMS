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
                        <h4 class="card-title mb-3"><b>Edit Data Pelanggaran</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('guru_kesiswaan-datapelanggaran_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                      <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Kelas</label>
                              <select class="form-select" placeholder="Pilih" name="id_kelas">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataKelas as $kelas)
                                  <option value="{{ $kelas->id }}" {{ old('id_kelas', $kelas->id ) == $dataEdit->id_kelas ? 'selected' : ''}}>{{ $kelas->nama_kelas }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>

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
                              <label class="form-label">Pelanggaran</label>
                              <select class="form-select" placeholder="Pilih" name="id_pelanggaran">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataPelanggaran as $pelanggaran)
                                  <option value="{{ $pelanggaran->id }}" {{ old('id_pelanggaran', $pelanggaran->id ) == $dataEdit->id_pelanggaran ? 'selected' : ''}}>{{ $pelanggaran->jenis_pelanggaran }}</option>
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

                      <div class="col-md-12">
                            <label class="form-label">Subtotal Poin</label>
                            <input type="number" class="form-control" name="subtotal_poin" value="{{ $dataEdit->subtotal_poin }}" />
                      </div>

                      <div class="col-md-12">
                            <label class="form-label">Total Poin</label>
                            <input type="number" class="form-control" name="total_poin" value="{{ $dataEdit->total_poin }}" />
                      </div>

                      <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Sanksi Pelanggaran</label>
                              <select class="form-select" placeholder="Pilih" name="id_sanksi_pelanggaran">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataSanksiPelanggaran as $sanksipelanggaran)
                                  <option value="{{ $sanksipelanggaran->id }}" {{ old('id_sanksi_pelanggaran', $sanksipelanggaran->id ) == $dataEdit->id_sanksi_pelanggaran ? 'selected' : ''}}>{{ $sanksipelanggaran->bentuk_sanksi }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>
                      
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('guru_kesiswaan-datapelanggaran_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
                       
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
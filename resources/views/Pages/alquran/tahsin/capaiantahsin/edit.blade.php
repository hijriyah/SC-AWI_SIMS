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
                        <h4 class="card-title mb-3"><b>Edit Capaian Tahsin</b></h4>
                        <div></div>
                        <!--<a href="{{ route('alquran_tahsin_capaiantahsin_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>-->
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('alquran_tahsin_capaiantahsin_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">

                      <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Pemetaan Tahsin</label>
                              <select class="form-select" placeholder="Pilih" name="id_guru">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataPemetaanTahsin as $pemetaantahsin)
                                  <option value="{{ $pemetaantahsin->id }}" {{ old('id_pemetaan_tahsin', $pemetaantahsin->id ) == $dataEdit->id_pemetaan_tahsin ? 'selected' : ''}}>{{ $pemetaantahsins->semeseter }}</option>
                                  @endforeach
                              </select>
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
                              <label class="form-label">Kategori Tahsin</label>
                              <select class="form-select" placeholder="Pilih" name="id_kategori_tahsin">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataKategoriTahsin as $kateg)
                                  <option value="{{ $guru->id }}" {{ old('id_guru', $guru->id ) == $dataEdit->id_guru ? 'selected' : ''}}>{{ $guru->nama_lengkap }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Guru</label>
                              <select class="form-select" placeholder="Pilih" name="id_guru">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataGuru as $guru)
                                  <option value="{{ $guru->id }}" {{ old('id_guru', $guru->id ) == $dataEdit->id_guru ? 'selected' : ''}}>{{ $guru->nama_lengkap }}</option>
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
                            <label class="form-label">Semester</label>
                            <input class="form-control" name="semester" value="{{ $dataEdit->semester }}" />
                      </div>

                      <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                                <label class="form-label">Materi</label>
                                <select class="form-select" placeholder="Pilih" name="materi">
                                    <option selected disabled>Pilih</option>
                                    <option value="tartil" {{ old('materi', $dataEdit->materi) == 'tartil' ? 'selected' : ''}}>Tartil</option>
                                    <option value="perempuan" {{ old('jenis_kelamin', $dataEdit->materi) == 'fashohah' ? 'selected' : ''}}>Fashohah</option>
                                </select>
                           </div>
                       </div>

                       <div class="col-md-12">
                            <label class="form-label">Hasil Perkembangan</label>
                            <input class="form-control" name="hasil_perkembangan" value="{{ $dataEdit->hasil_perkembangan }}" />
                      </div>

                       <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Kriteria Penialain Alquran</label>
                              <select class="form-select" placeholder="Pilih" name="id_penilaian_alquran">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataKriteriaPenilaianAlquran as $kriteriapenilaianalquran)
                                  <option value="{{ $kriteriapenilaianalquran->id }}" {{ old('id_kriteria_penilaian_alquran', $kriteriapenilaianalquran->id ) == $dataEdit->id_kriteria_penilaian_alquran ? 'selected' : ''}}>{{ $kriteriapenilaianalquran->range_nilai }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Kompetensi</label>
                            <input class="form-control" name="kompetensi" value="{{ $dataEdit->kompetensi }}" />
                      </div>

                      
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('alquran_tahsin_capaiantahsin_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
                       
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
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
                        <h4 class="card-title mb-3"><b>Edit Siswa</b></h4>
                        <div></div>
                        <!--<a href="{{ route('siswa_master_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>-->
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}
               <form action="{{ route('siswa_master_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Lengkap</label>
                                <input class="form-control" name="nama_lengkap" value="{{ $dataEdit->nama_lengkap}}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Panggilan</label>
                                <input class="form-control" name="nama_panggilan" value="{{ $dataEdit->nama_panggilan }}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tempat Lahir</label>
                                <input class="form-control" name="tempat_lahir" value="{{ $dataEdit->tempat_lahir }}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="tanggal_lahir"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_lahir" value="{{ $dataEdit->tanggal_lahir }}" />
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" placeholder="Pilih" name="jenis_kelamin">
                                    <option selected disabled>Pilih</option>
                                    <option value="laki-laki" {{ old('jenis_kelamin', $dataEdit->jenis_kelamin) == 'laki-laki' ? 'selected' : ''}}>Laki-laki</option>
                                    <option value="perempuan" {{ old('jenis_kelamin', $dataEdit->jenis_kelamin) == 'perempuan' ? 'selected' : ''}}>Perempuan</option>
                                </select>
                           </div>
                       </div>
                        
                    </div>
                       
                    <div class="row">
                       
                       <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Agama</label>
                                <select class="form-select" name="agama">
                                    <option selected disabled>Pilih</option>
                                    <option value="islam" {{ old('agama', $dataEdit->agama) == 'islam' ? 'selected' : ''}}>Islam</option>
                                    <option value="kristen" {{ old('agama', $dataEdit->agama) == 'kristen' ? 'selected' : ''}} >Kristen</option>
                                    <option value="katolik" {{ old('agama', $dataEdit->agama) == 'katolik' ? 'selected' : ''}}>Katolik</option>
                                    <option value="buddha"{{ old('agama', $dataEdit->agama) == 'buddha' ? 'selected' : ''}}>Buddha</option>
                                    <option value="hindu" {{ old('agama', $dataEdit->agama) == 'hindu' ? 'selected' : ''}}>Hindu</option>
                                    <option value="konghucu"{{ old('agama', $dataEdit->agama) == 'konghucu' ? 'selected' : ''}}>Konghucu</option>
                                </select>
                            </div>
                       </div>
                       <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Email</label>
                                <input class="form-control" name="email" value="{{ $dataEdit->email}}" />
                                <!-- input-group -->
                            </div>
                        </div>
                       <div class="col-lg-6 mb-4">
                            <label class="form-label">No Telepon</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="No telp" name="no_telp" value="{{ $dataEdit->no_telp }}" />
                                <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat">{{ $dataEdit->alamat }}</textarea>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <label class="form-label">Aktif</label>
                            <select class="form-select" name="aktif">
                                <option selected disabled>Pilih</option>
                                <option value="ya" {{ old('aktif', $dataEdit->aktif) == "ya" ? 'selected' : ''}}>Ya</option>
                                <option value="tidak" {{ old('aktif', $dataEdit->aktif) == "tidak" ? 'selected' : ''}}>Tidak</option>
                            </select>
                        </div>
                       
                    </div>

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
                              <label class="form-label">Section</label>
                              <select class="form-select" placeholder="Pilih" name="id_section">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataSection as $section)
                                  <option value="{{ $section->id }}" {{ old('id_section', $section->id ) == $dataEdit->id_section ? 'selected' : ''}}>{{ $section->section }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Orangtua</label>
                              <select class="form-select" placeholder="Pilih" name="id_orangtua">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataOrangtua as $orangtua)
                                  <option value="{{ $orangtua->id }}" {{ old('id_orangtua', $orangtua->id ) == $dataEdit->id_orangtua ? 'selected' : ''}}>{{ $orangtua->nama }}</option>
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
                                  <option value="{{ $lokasibarang->id }}" {{ old('id_tahun_ajaran', $tahunajaran->id ) == $dataEdit->id_tahun_ajaran ? 'selected' : ''}}>{{ $tahunajaran->tahun_ajaran }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Foto</label>
                            <div class="input-group">
                                <input type="file" class="form-control" accept=".jpg, .jpeg, .png" name="file" value="{{ $dataEdit->photo }}" />
                                <span class="input-group-text"><i class="mdi mdi-panorama"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Golongan Darah</label>
                                <select class="form-select" name="golongan_darah">
                                    <option selected disabled>Pilih</option>
                                    <option value="ab+" {{ old('golongan_darah', $dataEdit->golongan_darah) == 'ab+' ? 'selected' : ''}}>AB+</option>
                                    <option value="ab-" {{ old('golongan_darah', $dataEdit->golongan_darah) == 'ab-' ? 'selected' : ''}} >AB-</option>
                                    <option value="a+" {{ old('golongan_darah', $dataEdit->golongan_darah) == 'a+' ? 'selected' : ''}}>A+</option>
                                    <option value="a-"{{ old('golongan_darah', $dataEdit->golongan_darah) == 'a-' ? 'selected' : ''}}>A-</option>
                                    <option value="b+" {{ old('golongan_darah', $dataEdit->golongan_darah) == 'b+' ? 'selected' : ''}}>B+</option>
                                    <option value="b-"{{ old('golongan_darah', $dataEdit->golongan_darah) == 'b-' ? 'selected' : ''}}>B-</option>
                                    <option value="o+" {{ old('golongan_darah', $dataEdit->golongan_darah) == 'o-' ? 'selected' : ''}}>O+</option>
                                    <option value="o-"{{ old('golongan_darah', $dataEdit->golongan_darah) == 'o+' ? 'selected' : ''}}>O-</option>
                                </select>
                            </div>
                       </div>
                       <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Kebangsaan</label>
                                <select class="form-select" name="kebangsaan">
                                    <option selected disabled>Pilih</option>
                                    <option value="wni" {{ old('kebangsaan', $dataEdit->kebangsaan) == 'wni' ? 'selected' : ''}}>WNI</option>
                                    <option value="wni" {{ old('kebangsaan', $dataEdit->kebangsaan) == 'wna' ? 'selected' : ''}} >WNA</option>
                                </select>
                            </div>

                       </div>
                       <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Negara</label>
                                <input class="form-control" name="negara" value="{{ $dataEdit->negara}}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nomor Register</label>
                                <input class="form-control" name="nomor_register" value="{{ $dataEdit->negara}}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tanggal Masuk</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="tanggal_masuk"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_masuk" value="{{ $dataEdit->tanggal_masuk }}" />
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                <!-- input-group -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Username</label>
                            <input type="username" class="form-control" name="username" placeholder="username" name="username" value="{{ $dataEdit->username }}" />
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="password" name="password" value="{{ $dataEdit->password }}" />
                        </div>
                        {{-- <div class="col-lg-6 mb-4">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role"> 
                                <option selected>Pilih</option> 
                                @foreach ($dataRole as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('siswa_master_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
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
                        <h4 class="card-title mb-3"><b>Edit Staff</b></h4>
                        <div></div>
                        <!--<a href="{{ route('staff_master_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>-->
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}
               <form action="{{ route('staff_master_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Lengkap</label>
                                <input class="form-control" name="nama_lengkap" value="{{ $dataEdit->nama_lengkap }}" />
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
                                <label class="form-label">Tanggal Gabung</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="tanggal_bergabung"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_bergabung" value="{{ $dataEdit->tanggal_bergabung }}" />
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                <!-- input-group -->
                            </div>
                        </div>
                    </div>
                       
                    <div class="row">
                       <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" placeholder="Pilih" name="jenis_kelamin">
                                    <option selected disabled>Pilih</option>
                                    <option value="laki-laki" {{ old('jenis_kelamin', $dataEdit->jenis_kelamin) == 'laki-laki' ? 'selected' : ''}}>laki-laki</option>
                                    <option value="perempuan" {{ old('jenis_kelamin', $dataEdit->jenis_kelamin) == 'perempuan' ? 'selected' : ''}}>perempuan</option>
                                </select>
                           </div>
                       </div>
                       <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Agama</label>
                                <select class="form-select" name="agama">
                                    <option selected disabled>Pilih</option>
                                    <option value="islam" {{ old('agama', $dataEdit->agama) == 'islam' ? 'selected' : ''}}>islam</option>
                                    <option value="kristen" {{ old('agama', $dataEdit->agama) == 'kristen' ? 'selected' : ''}} >kristen</option>
                                    <option value="katolik" {{ old('agama', $dataEdit->agama) == 'katolik' ? 'selected' : ''}}>katolik</option>
                                    <option value="buddha"{{ old('agama', $dataEdit->agama) == 'buddha' ? 'selected' : ''}}>buddha</option>
                                    <option value="hindu" {{ old('agama', $dataEdit->agama) == 'hindu' ? 'selected' : ''}}>hindu</option>
                                    <option value="konghucu"{{ old('agama', $dataEdit->agama) == 'konghucu' ? 'selected' : ''}}>konghucu</option>
                                </select>
                            </div>
                       </div>
                       <div class="col-lg-6 mb-4">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" value="{{ $dataEdit->email }}" />
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">No telp</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="No telp" name="no_telp" value="{{ $dataEdit->no_telp }}" />
                                <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Alamat</label>
                            <div class="input-group">
                                <input type="textarea" class="form-control" name="alamat" value="{{ $dataEdit->alamat }}" />
                                
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
                    
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Username</label>
                            <input type="username" class="form-control" name="username" placeholder="username" name="username" value="{{ $dataEdit->username }}" />
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="password" name="password" value="{{ $dataEdit->password }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <label class="form-label">Aktif</label>
                            <select class="form-select" name="aktif">
                                <option selected disabled>Pilih</option>
                                <option value="ya" {{ old('aktif', $dataEdit->aktif) == "ya" ? 'selected' : ''}}>ya</option>
                                <option value="tidak" {{ old('aktif', $dataEdit->aktif) == "tidak" ? 'selected' : ''}}>tidak</option>
                            </select>
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
                        <a href="{{ route('staff_master_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
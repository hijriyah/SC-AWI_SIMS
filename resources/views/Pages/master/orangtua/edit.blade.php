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
                        <h4 class="card-title mb-3"><b>Edit Orangtua</b></h4>
                        <div></div>
                        <!--<a href="{{ route('orangtua_master_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>-->
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}
               <form action="{{ route('orangtua_master_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama</label>
                                <input class="form-control" placeholder="Nama" name="nama" value="{{ $dataEdit->nama }}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Ayah</label>
                                <input class="form-control" name="nama_ayah" value="{{ $dataEdit->nama_ayah }}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Ibu</label>
                                <input class="form-control" name="nama_ibu" value="{{ $dataEdit->nama_ibu }}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Pekerjaan Ayah</label>
                                <input class="form-control" name="pekerjaan_ayah" value="{{ $dataEdit->pekerjaan_ayah}}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Pekerjaan Ibu</label>
                                <input class="form-control" name="pekerjaan_ibu" value="{{ $dataEdit->pekerjaan_ibu }}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Email</label>
                                <input class="form-control" name="email" value="{{ $dataEdit->email }}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat">{{ $dataEdit->alamat }}</textarea>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Foto</label>
                            <div class="input-group">
                                <input type="file" class="form-control" placeholder="Foto" accept=".jpg, .jpeg, .png" name="file" value="{{ $dataEdit->photo }}" />
                                <span class="input-group-text"><i class="mdi mdi-panorama"></i></span>
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
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Username</label>
                            <input type="username" class="form-control" name="username" placeholder="username" value="{{ $dataEdit->username }}" />
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" name="new_password" placeholder="New Password"/>
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
                    </div>
                   
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('orangtua_master_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
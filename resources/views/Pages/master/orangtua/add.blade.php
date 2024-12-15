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
                        <h4 class="card-title mb-3"><b>Tambah Orangtua</b></h4>
                        <div></div>
                        <!--<a href="{{ route('orangtua_master_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>-->
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('orangtua_master_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!--<div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama</label>
                                <input class="form-control" name="nama" />
                                
                            </div>
                        </div>-->
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Ayah</label>
                                <input class="form-control" name="nama_ayah" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Ibu</label>
                                <input class="form-control" name="nama_ibu" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Pekerjaan Ayah</label>
                                <input class="form-control" name="pekerjaan_ayah" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Pekerjaan Ibu</label>
                                <input class="form-control" name="pekerjaan_ibu" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Email</label>
                                <input class="form-control" name="email" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">No Telepon</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="no_telp" />
                                <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat"></textarea>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Foto</label>
                            <div class="input-group">
                                <input type="file" class="form-control" placeholder="Foto" accept=".jpg, .jpeg, .png" name="file" />
                                <span class="input-group-text"><i class="mdi mdi-panorama"></i></span>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Username</label>
                            <input type="username" class="form-control" name="username" placeholder="username" name="username" />
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="password" name="password" />
                        </div>

                        <div class="col-lg-12 mb-4">
                            <label class="form-label">Aktif</label>
                            <select class="form-select" name="aktif">
                                <option selected disabled>Pilih</option>
                                <option value="ya">ya</option>
                                <option value="tidak">tidak</option>
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
                        <a href="{{ route('orangtua_master_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
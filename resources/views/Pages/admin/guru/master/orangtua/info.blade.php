@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Dashboard / Profile</h4>
          <div class="page-title-right">
              <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item active">Selamat Datang Di {{ $adminSession }} Dashboard</li>
              </ol>
          </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 0px; margin-bottom: 500px;">
    <!-- start page title -->
    <!-- end page title -->
    <!-- start row -->
    <div class="row">
        <div class="col-md-12 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="profile-widgets py-3">
                        <div class="text-center">
                            <div class="">
                                @if($dataInfo->photo != null)
                                    <img src="{{ '/storage/' . $dataInfo->photo }}" alt=""
                                    class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                    <div class="online-circle"><i class="fas fa-circle text-success"></i>
                                @else 
                                    <img src="data:image/jpeg;base64,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" alt=""
                                        class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                    @if($dataInfo->aktif == "ya")
                                        <div class="online-circle"><i class="fas fa-circle text-success"></i>
                                    @else
                                        <div class="online-circle"><i class="fas fa-circle text-danger"></i>
                                    @endif
                                @endif
                                </div>
                            </div>

                            <div class="mt-3 ">
                                <a href="#" class="text-reset fw-medium font-size-16">{{ $dataInfo->nama }}</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-9">
            <div class="row">
               
            </div>

            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-start mb-3">
                        <h4>Personal Information</h4>
                    </div>

                    <div class="d-flex-justify content-start" style="line-height: 0.6;">
                        <div class="row">
                            <div class="col-md-6">
                                <p>Nama: {{ $dataInfo->nama }}</p>
                                <p>Nama Ayah: {{ $dataInfo->nama_ayah }}</p>
                                <p>Nama Ibu: {{ $dataInfo->nama_ibu }}</p>
                                <p>Pekerjaan Ayah: {{ $dataInfo->pekerjaan_ayah }}</p>
                                <p>Pekerjaan Ibu: {{ $dataInfo->pekerjaan_ibu }}</p>
                            </div>
                            <div class="col-md-6">
                                <p>Email: {{ $dataInfo->email }}</p>
                                <p>No Telephone: {{ $dataInfo->no_telp }}</p>
                                <p>Alamat: {{ $dataInfo->alamat }}</p>
                                @if($dataInfo->aktif == "ya")
                                    <p>Aktif: <span class="badge bg-success">Ya</span></p> 
                                @else
                                    <p>Aktif: <span class="badge bg-danger">Tidak</span></p> 
                                @endif
                            </div>
                        </div>  
                    </div>

                </div>
            </div>

        </div>

    </div>

    <!-- end row -->

</div>

@endsection
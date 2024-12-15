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
                        <h4 class="card-title mb-3"><b>Tambah Sosial Link</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('pengaturan_sosiallink_store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Facebook</label>
                                <input class="form-control" name="facebook" type="url" placeholder="https://example.com" />
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Linkedin</label>
                                <input class="form-control" name="linkedin" type="url" placeholder="https://example.com" />
                                <!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-lg-6">
                           <div class="mb-4">
                               <label class="form-label">Twitter</label>
                               <input class="form-control" name="twitter" type="url" placeholder="https://example.com" />
                               <!-- input-group -->
                           </div>
                       </div>
                       <div class="col-lg-6">
                           <div class="mb-4">
                              <label class="form-label">Google</label>
                              <input class="form-control" name="google" type="url" placeholder="https://example.com" />
                              <!-- input-group -->
                           </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                            <a href="{{ route('pengaturan_sosiallink_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                        </div>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
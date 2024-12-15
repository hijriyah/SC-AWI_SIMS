@extends('layouts.layout')


@section('content')

<script>

    $(document).ready(function() {
        $('#Start_Date').flatpickr({
            dateFormat: 'Y-m-d'
        });
        $('#End_Date').flatpickr({
            dateFormat: 'Y-m-d'
        });
        $('#start_time').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i"
        });
        $('#end_time').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i"
        });
    });

</script>

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
                        <h4 class="card-title mb-3"><b>Tambah Rencana Ujian</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('pemberitahuan_kegiatan_rencanakegiatan_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="form-label">Tahun Ajaran</label>
                            <select class="form-select" placeholder="Pilih" name="id_tahun_ajaran">
                               <option selected disabled>Pilih</option>
                               @foreach($dataTahunAjaran as $tahunajaran)
                                  <option value="{{ $tahunajaran->id }}" {{ old('id_tahun_ajaran', $tahunajaran->id) == $dataEdit->id_tahun_ajaran ? 'selected' : '' }}>{{ $tahunajaran->tahun_ajaran }}</option>
                               @endforeach
                           </select>
                             @error('id_tahun_ajaran')
                                 <span class="text-sm text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                         <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Kegiatan</label>
                                <input class="form-control" name="nama_kegiatan" value="{{ $dataEdit->nama_kegiatan }}" />
                                @error('nama')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" style="height: 100px;">{{ $dataEdit->deskripsi }}</textarea>
                                @error('deskripsi')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Tanggal Mulai</label>
                            <input class="form-control" name="tanggal_mulai" id="Date" placeholder="Y-m-d" value="{{ $dataEdit->tanggal_mulai }}" />
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Tanggal Selesai</label>
                            <input class="form-control" name="tanggal_selesai" id="Date" placeholder="Y-m-d" value="{{ $dataEdit->tanggal_selesai }}" />
                        </div>
                         <div class="col-lg-6">
                            <label class="form-label">Waktu Mulai</label>
                            <input class="form-control" name="waktu_mulai" id="start_time" placeholder="00:00" value="{{ $dataEdit->waktu_mulai }}" />
                         </div>
                         <div class="col-lg-6 mb-4">
                            <label class="form-label">Waktu Selesai</label>
                            <input class="form-control" name="waktu_selesai" id="end_time" placeholder="00:00" value="{{ $dataEdit->waktu_selesai }}" />
                         </div>
                         <div class="row mb-4">
                            <div class="col-lg-12">
                                <label class="form-label">Lokasi Kegiatan</label>
                                <textarea class="form-control" name="lokasi_kegiatan" style="height: 100px;">{{ $dataEdit->lokasi_kegiatan }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Poster</label>
                            <div class="input-group">
                                <input type="file" class="form-control" accept=".jpg, .jpeg, .png" name="file" value="{{ $dataEdit->file }}" />
                                <span class="input-group-text"><i class="mdi mdi-panorama"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('pemberitahuan_kegiatan_rencanakegiatan_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection


@extends('layouts.layout')


@section('content')

<script>
    // flatpickr Setup 
    $(document).ready(function () {
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
                        <h4 class="card-title mb-3"><b>Edit Jadwal Pelajaran</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('penjadwalan_jadwalpelajaran_update', ['uuid' => $dataEdit->uuid]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">

                                <label class="form-label">Kelas</label>
                                 <select class="form-select" placeholder="Pilih" name="id_kelas">
                                     <option selected disabled>Pilih</option>
                                     @foreach($dataKelas as $kelas)
                                         <option value="{{ $kelas->id }}" {{ old('id_kelas', $kelas->id) == $dataEdit->id_kelas ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                     @endforeach
                                 </select>
                                @error('id_kelas')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror <br>

                                <label class="form-label">Guru</label>
                                <select class="form-select" placeholder="Pilih" name="id_guru">
                                    <option selected disabled>Pilih</option>
                                    @foreach($dataGuru as $guru)
                                        <option value="{{ $guru->id }}" {{ old('id_guru', $guru->id) == $dataEdit->id_guru ? 'selected' : ''}}>{{ $guru->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @error('id_guru')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror <br>

                                <label class="form-label">Mata Pelajaran</label>
                                <select class="form-select" placeholder="Pilih" name="id_mata_pelajaran">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataMataPelajaran as $matapelajaran)
                                     <option value="{{ $matapelajaran->id }}" {{ old('id_mata_pelajaran', $matapelajaran->id) == $dataEdit->id_mata_pelajaran ? 'selected' : ''}}>{{ $matapelajaran->mata_pelajaran }}</option>
                                  @endforeach
                                </select>
                                @error('id_mata_pelajaran')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror <br>

                                <label class="form-label">Waktu Mulai</label>
                                <input class="form-control" name="waktu_mulai" id="start_time" placeholder="00:00" value="{{ $dataEdit->waktu_mulai }}" />
                                @error('waktu_mulai')
                                  <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror <br>

                                <label class="form-label">Waktu Selesai</label>
                                <input class="form-control" name="waktu_selesai" id="end_time" placeholder="00:00" value="{{ $dataEdit->waktu_selesai }}" />
                                @error('waktu_selesai')
                                  <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror

                           </div>
                        </div>
                    </div>
                       
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('penjadwalan_jadwalpelajaran_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
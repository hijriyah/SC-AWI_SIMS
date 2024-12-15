@extends('layouts.layout')


@section('content')


<script>

    $(document).ready(function() {
        $('#Date').flatpickr({
            dateFormat: 'Y-m-d'
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
                        <h4 class="card-title mb-3"><b>Edit Jurnal Kelas</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('guru_jurnal-jurnalkelas_update', ['uuid' => $dataEdit->uuid]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" id="Date" name="tanggal" class="form-control" placeholder="Y/M/D" value="{{ $dataEdit->tanggal }}" />
                            @error("tanggal")
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-3">
                              <label class="form-label">Mata Pelajaran</label>
                              <select class="form-select" placeholder="Pilih" name="id_mata_pelajaran">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataMataPelajaran as $matapelajaran)
                                     <option value="{{ $matapelajaran->id }}" {{ old('id_mata_pelajaran', $matapelajaran->id) == $dataEdit->id_mata_pelajaran ? 'selected' : ''}}>{{ $matapelajaran->mata_pelajaran }}</option>
                                  @endforeach
                              </select>
                            @error("id_mata_pelajaran")
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-4 mt-lg-0 mb-3">
                               <label class="form-label">Materi Ajar</label>
                               <input type="text" class="form-control" name="materi_ajar" placeholder="Materi Ajar" value="{{ $dataEdit->materi_ajar }}" />
                                @error("materi_ajar")
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                         </div>
                       </div>
 
                       <div class="col-lg-6">
                            <div class="mt-4 mt-lg-0 mb-3">
                               <label class="form-label">Siswa Hadir</label>
                                <input type="number" class="form-control" name="siswa_hadir" placeholder="0" value="{{ $dataEdit->siswa_hadir }}" />
                                @error("siswa_hadir")
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                         </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Siswa Tidak hadir</label>
                                <input type="number" class="form-control" name="siswa_tidak_hadir" placeholder="0" value="{{ $dataEdit->siswa_tidak_hadir }}" />
                                @error("siswa_tidak_hadir")
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                <select class="form-select" placeholder="Pilih" name="status">
                                    <option selected disabled>Pilih</option>
                                    <option value="hadir" {{ old('status', $dataEdit->status) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="tidak hadir" {{ old('status', $dataEdit->status) == 'tidak hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                </select>
                                @error("status")
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jam Mulai</label>
                            <input type="" id="JamMulai" class="form-control" placeholder="00:00" name="jam_mulai" value="{{ $dataEdit->jam_mulai }}" />
                            @error("jam_mulai")
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror  
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jam Selesai</label>
                            <input type="" id="JamSelesai" class="form-control" placeholder="00:00" name="jam_selesai" value="{{ $dataEdit->jam_selesai }}" />
                            @error("jam_selesai")
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror  
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jam Ke</label>
                            <input type="number" class="form-control" placeholder="Jam Ke" name="jam_ke" value="{{ $datEdit->jam }}" />
                            @error("jam_ke")
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror  
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun Ajaran</label>
                            <select class="form-select" placeholder="Pilih" name="id_tahun_ajaran">
                                <option selected disabled>Pilih</option>
                                @foreach($dataTahunAjaran as $tahunajaran)
                                    <option value="{{ $tahunajaran->id }}" {{ old('id_tahun_ajaran', $tahunajaran->id) == $dataEdit->id_tahun_ajaran ? 'selected' : ''}}>{{ $tahunajaran->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                            @error("id_tahun_ajaran")
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror  
                        </div>
                    </div>


                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('guru_jurnal-jurnalkelas_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
                       
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
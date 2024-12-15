@extends('layouts.layout')

@section('content')

<script>

$(document).ready(function () {
    
    const inputElement = document.querySelector('#filepond');
    const pond = FilePond.create(inputElement);

    FilePond.setOptions({
        server: {
            process: {
                url: "{{ route('guru_akademik-tugassiswa_store') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                onload: (response) => {
                    console.log(response);
                },
                onerror: (response) => {
                    console.log(response);
                },
            },
        },
    });

    $('#tugasForm').on('submit', function (e) {
        e.preventDefault();  

        var formData = new FormData(this);

        pond.getFiles().forEach(function(file) {
            formData.append('filepond[]', file.file);
        });

        $.ajax({
            url: "{{ route('guru_akademik-tugassiswa_store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                toastr.success('data berhasil disimpan');
                setTimeout(() => {
                    window.location.href = "{{ route('guru_akademik-tugassiswa_page') }}"; 
                }, 2000);
            },
            error: function (response) {
                toastr.error('data gagal disimpan');
            }
        });
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
                        <h4 class="card-title mb-3"><b>Tambah Tugas Siswa</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form id="tugasForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Judul</label>
                                <input class="form-control" name="judul" />
                                @error('judul')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Deskripsi</label>
                                <input class="form-control" name="deskripsi" />
                                @error('deskripsi')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Deadline</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="tanggal"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="deadline">
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                    @error('deadline')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                       
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                            <label class="form-label">File</label>
                            <input type="file" 
                            id="filepond"
                            class="filepond"
                            name="filepond[]" 
                            data-allow-reorder="true"
                            data-max-file-size="2MB"
                            data-max-files="2" />

                            @error('file')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                       
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                           <label class="form-label">Kelas</label>
                           <select class="form-select" placeholder="Pilih" name="id_kelas">
                              <option selected disabled>Pilih</option>
                              @foreach($dataKelas as $kelas)
                                 <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                              @endforeach
                          </select>
                            @error('id_kelas')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                           <label class="form-label">Tahun Ajaran</label>
                           <select class="form-select" placeholder="Pilih" name="id_tahun_ajaran">
                              <option selected disabled>Pilih</option>
                              @foreach($dataTahunAjaran as $tahunajaran)
                                 <option value="{{ $tahunajaran->id }}">{{ $tahunajaran->tahun_ajaran }}</option>
                              @endforeach
                          </select>
                            @error('id_tahun_ajaran')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                     <div class="col-lg-6 mb-4">
                        <label class="form-label">Section</label>
                        <select class="form-select" placeholder="Pilih" name="id_section">
                           <option selected disabled>Pilih</option>
                           @foreach($dataSection as $section)
                              <option value="{{ $section->id }}">{{ $section->section }}</option>
                           @endforeach
                       </select>
                       @error('id_section')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                     </div>
                     <div class="col-lg-6 mb-4">
                        <label class="form-label">Mata Pelajaran</label>
                        <select class="form-select" placeholder="Pilih" name="id_mata_pelajaran">
                           <option selected disabled>Pilih</option>
                           @foreach($dataMataPelajaran as $matapelajaran)
                              <option value="{{ $matapelajaran->id }}">{{ $matapelajaran->matapelajaran }}</option>
                           @endforeach
                       </select>
                       @error('id_mata_pelajaran')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                     </div>
                 </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('guru_akademik-tugassiswa_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
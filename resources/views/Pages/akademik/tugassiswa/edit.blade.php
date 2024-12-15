@extends('layouts.layout')

@section('content')

<script>

$(document).ready(function () {

    const inputElement = document.querySelector('#filepond');
    // const pond = FilePond.create(inputElement);
    const pond = FilePond.create(inputElement, {
        allowFileSizeValidation: true,
        maxFileSize: '2MB'
    });

    FilePond.setOptions({
        storeAsFile: true,
        allowImagePreview: true,
        imagePreviewHeight: 170,
        server: {
            process: {
                url: "{{ route('akademik_tugassiswa_update', ['uuid' => $dataEdit->uuid]) }}",
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

    
    var fileData = null;
    $.ajax({
        url: '{{ url('storage/' . $dataEdit->file) }}',
        type: 'GET',
        xhrFields: {
            responseType: 'blob'
        },
        success: (response) => {
            fileData = new File([response], '{{ basename($dataEdit->file) }}', {
                type: 'application/pdf',
                size: '{{ $fileSize }}',
            });
            pond.addFiles(fileData);

            $('#tugasForm').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                
                pond.getFiles().forEach(function(file) {
                    formData.append('filepond[]', file.file);
                });

                $.ajax({
                    url: "{{ route('akademik_tugassiswa_update', ['uuid' => $dataEdit->uuid]) }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    success: function (response) {
                        toastr.success("data berhasil disimpan");
                        setTimeout(() => {
                            window.location.href = "{{ route('akademik_tugassiswa_page') }}";
                        }, 2000);
                    },
                    error: function (response) {
                        toastr.error('gagal mengupload data');
                    }
                });
            });
            

                
        }
        
    });

    

    // $('#tugasForm').on('submit', function (e) {
    //     e.preventDefault();  

    //     var formData = new FormData(this);
    //     // formData.append('_method', 'PUT');
        

    //     pond.getFiles().forEach(function(file) {
    //         formData.append('filepond', file);
    //     });


    //     $.ajax({
    //         url: "{{ route('akademik_tugassiswa_update', ['uuid' => $dataEdit->uuid]) }}",
    //         type: "POST",
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         headers: {
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         },
    //         success: function (response) {
    //             window.location.href = "{{ route('akademik_tugassiswa_page') }}";
    //             toastr.succes("data berhasil disimpan");
    //         },
    //         error: function (response) {
    //             console.log(response)
    //             toastr.error('gagal mengupload data');
    //         }
    //     });
    // });

 

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
                        <h4 class="card-title mb-3"><b>Edit Tugas Siswa</b></h4>
                        <div></div>
                        <!--<a href="{{ route('akademik_tugassiswa_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>-->
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form id="tugasForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Judul</label>
                                <input class="form-control" name="judul" value="{{ $dataEdit->judul }}" />
                                @error('judul')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Deskripsi</label>
                                <input class="form-control" name="deskripsi" value="{{ $dataEdit->deskripsi }}" />
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
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="deadline" value="{{ $dataEdit->deadline }}">
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
                            data-max-files="1"
                            />

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
                                 <option value="{{ $kelas->id }}" {{ old('id_kelas', $kelas->id) == $dataEdit->id_kelas ? 'selected' : ''}}>{{ $kelas->id }}</option>
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
                                 <option value="{{ $tahunajaran->id }}" {{ old('id_tahun_ajaran', $tahunajaran->id) == $dataEdit->id_tahun_ajaran ? 'selected' : ''}}>{{ $tahunajaran->tahun_ajaran }}</option>
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
                              <option value="{{ $section->id }}" {{ old('id_section', $section->id) == $dataEdit->id_section ? 'selected' : ''}}>{{ $section->section }}</option>
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
                              <option value="{{ $matapelajaran->id }}" {{ old('id_mata_pelajaran', $matapelajaran->id) == $dataEdit->id_mata_pelajaran ? 'selected' : ''}}>{{ $matapelajaran->mata_pelajaran }}</option>
                           @endforeach
                       </select>
                       @error('id_mata_pelajaran')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                     </div>
                 </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('akademik_tugassiswa_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
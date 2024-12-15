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
                url: "{{ route('siswa_akademik-tugassiswa_update', ['uuid' => $dataEdit->uuid]) }}",
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
        url: '{{ url('storage/' . $dataEdit->jawaban) }}',
        type: 'GET',
        xhrFields: {
            responseType: 'blob'
        },
        success: (response) => {
            fileData = new File([response], '{{ basename($dataEdit->jawaban) }}', {
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
                    url: "{{ route('siswa_akademik-tugassiswa_update', ['uuid' => $dataEdit->uuid]) }}",
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
                            window.location.href = "{{ route('siswa_akademik-tugassiswa_page') }}";
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
    //         url: "{{ route('siswa_akademik-tugassiswa_update', ['uuid' => $dataEdit->uuid]) }}",
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
                        <h4 class="card-title mb-3"><b>Edit Jawaban</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form id="tugasForm" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12">
                        <div class="mb-4">
                        <label class="form-label">Jawaban</label>
                        <input type="file" 
                        id="filepond"
                        class="filepond"
                        name="filepond" 
                        data-allow-reorder="true"
                        data-max-file-size="2MB"
                        data-max-files="2" />

                        @error('file')
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
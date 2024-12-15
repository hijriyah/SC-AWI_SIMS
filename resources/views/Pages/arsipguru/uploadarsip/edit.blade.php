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
                url: "{{ route('arsipguru_uploadarsip_update', ['uuid' => $dataEdit->uuid]) }}",
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
                    url: "{{ route('arsipguru_uploadarsip_update', ['uuid' => $dataEdit->uuid]) }}",
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
                            window.location.href = "{{ route('arsipguru_uploadarsip_page') }}";
                        }, 2000);
                    },
                    error: function (response) {
                        toastr.error('gagal mengupload data');
                    }
                });
            });
            

                
        }
        
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
                        <h4 class="card-title mb-3"><b>Edit Upload Arsip</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('arsipguru_uploadarsip_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">

                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                                <label class="form-label">Kategori Arsip</label>
                                <select class="form-select" placeholder="Pilih" name="id_kategori_arsip">
                                    <option selected disabled>Pilih</option>
                                    @foreach($dataKategoriArsip as $kategoriarsip)
                                    <option value="{{ $kategoriarsip->id }}" {{ old('id_kategori_arsip', $kategoriarsip->id ) == $dataEdit->id_kategori_arsip ? 'selected' : ''}}>{{ $kategoriarsip->kategori_arsip }}</option>
                                    @endforeach
                                </select><br>

                                <label class="form-label">Judul</label>
                                <input class="form-control" name="judul" value="{{ $dataEdit->judul }}" /><br>
                                <!-- input-group -->

                                <label class="form-label">File</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" accept=".pdf" name="file" value="{{ $dataEdit->file}}" />
                                    <span class="input-group-text"><i class="mdi mdi-panorama"></i></span>
                                </div><br>

                                <label class="form-label">Guru</label>
                                <select class="form-select" placeholder="Pilih" name="id_guru">
                                    <option selected disabled>Pilih</option>
                                    @foreach($dataGuru as $guru)
                                    <option value="{{ $guru->id }}" {{ old('id_guru', $guru->id ) == $dataEdit->id_guru ? 'selected' : ''}}>{{ $guru->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>
                       
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('arsipguru_uploadarsip_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
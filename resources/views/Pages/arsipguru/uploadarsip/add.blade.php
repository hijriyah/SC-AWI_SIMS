@extends('layouts.layout')


@section('content')

<script>

$(document).ready(function () {
    
    const inputElement = document.querySelector('#filepond');
    const pond = FilePond.create(inputElement);

    FilePond.setOptions({
        server: {
            process: {
                url: "{{ route('arsipguru_uploadarsip_store') }}",
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
            url: "{{ route('arsipguru_uploadarsip_store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                toastr.success('data berhasil disimpan');
                setTimeout(() => {
                    window.location.href = "{{ route('arsipguru_uploadarsip_page') }}"; 
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
                        <h4 class="card-title mb-3"><b>Tambah Upload Arsip</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('arsipguru_uploadarsip_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                      <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Kategori Arsip</label>
                              <select class="form-select" placeholder="Pilih" name="id_kategori_arsip">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataKategoriArsip as $kategoriarsip)
                                     <option value="{{ $kategoriarsip->id }}">{{ $kategoriarsip->kategori_arsip }}</option>
                                  @endforeach
                              </select><br>

                              <label class="form-label">Judul</label>
                                <input class="form-control" name="judul" /><br>
                                <!-- input-group -->

                                <label class="form-label">File</label>
                                <div class="input-group">
                                <input type="file" 
                                id="filepond"
                                class="filepond"
                                name="filepond[]" 
                                data-allow-reorder="true"
                                data-max-file-size="2MB"
                                data-max-files="2" />

                                @error('file')
                                    <span class="text-sm text-danger">{{ $message }}</span><br>
                                @enderror
                                </div><br>

                                <label class="form-label">Guru</label>
                                <select class="form-select" placeholder="Pilih" name="id_guru">
                                    <option selected disabled>Pilih</option>
                                    @foreach($dataGuru as $guru)
                                       <option value="{{ $guru->id }}">{{ $guru->nama_lengkap }}</option>
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
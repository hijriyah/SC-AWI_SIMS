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
                url: "{{ route('inventaris_barangmasuk_update', ['uuid' => $dataEdit->uuid]) }}",
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
                    url: "{{ route('inventaris_barangmasuk_update', ['uuid' => $dataEdit->uuid]) }}",
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
                            window.location.href = "{{ route('inventaris_barangmasuk_page') }}";
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
                        <h4 class="card-title mb-3"><b>Edit Barang Masuk</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('inventaris_barangmasuk_update', ['uuid' => $dataEdit->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Barang</label>
                                <input class="form-control" name="nama_barang_masuk" value="{{ $dataEdit->nama_barang_masuk }}" />
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Serial</label>
                                <input class="form-control" name="serial" value="{{ $dataEdit->serial }}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Deskripsi</label>
                                <input class="form-control" name="deskripsi" value="{{ $dataEdit->deskripsi }}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Manufaktur</label>
                                <input class="form-control" name="manufaktur" value="{{ $dataEdit->manufaktur }}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Brand</label>
                                <input class="form-control" name="brand" value="{{ $dataEdit->brand }}" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nomor Barang</label>
                                <input class="form-control" name="nomor_barang" value="{{ $dataEdit->nomor_barang }}" />
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Tanggal Masuk</label>
                                <div class="input-group" id="datepicker3">
                                    {{-- <input type="text" class="form-control" placeholder="yyyy/mm/dd"
                                        data-date-container='#datepicker3' data-provide="datepicker"
                                        data-date-format="yyyy-mm-dd"
                                        data-date-multidate="true" name="tanggal_masuk"> --}}
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_masuk" value="{{ $dataEdit->tanggal_masuk }}" />
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Jumlah Masuk</label>
                                <input class="form-control" name="jumlah_masuk" value="{{ $dataEdit->jumlah_masuk }}" />
                                <!-- input-group -->
                            </div>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option selected disabled>Pilih</option>
                                <option value="snp" {{ old('status', $dataEdit->status) == "snp" ? 'selected' : ''}}>SNP</option>
                                <option value="non_snp" {{ old('status', $dataEdit->status) == "non_snp" ? 'selected' : ''}}>Non SNP</option>
                            </select>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <label class="form-label">Kondisi Barang</label>
                            <select class="form-select" name="kondisi_barang">
                                <option selected disabled>Pilih</option>
                                <option value="baik" {{ old('kondisi_barang', $dataEdit->kondisi_barang) == "baik" ? 'selected' : ''}}>Baik</option>
                                <option value="rusak" {{ old('kondisi_barang', $dataEdit->kondisi_barang) == "rusak" ? 'selected' : ''}}>Rusak</option>
                            </select>
                        </div>

                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Kategori</label>
                              <select class="form-select" placeholder="Pilih" name="id_kategori_barang">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataKategoriBarang as $kategoribarang)
                                  <option value="{{ $kategoribarang->id }}" {{ old('id_kategori_barang', $kategoribarang->id ) == $dataEdit->id_kategori_barang ? 'selected' : ''}}>{{ $kategoribarang->kategori_barang }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Lokasi</label>
                              <select class="form-select" placeholder="Pilih" name="id_lokasi_barang">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataLokasiBarang as $lokasibarang)
                                  <option value="{{ $lokasibarang->id }}" {{ old('id_lokasi_barang', $lokasibarang->id ) == $dataEdit->id_lokasi_barang ? 'selected' : ''}}>{{ $lokasibarang->lokasi_barang }}</option>
                                  @endforeach
                              </select>
                         </div>
                        </div>
                        
                        <div class="col-lg-12 mb-4">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option selected disabled>Pilih</option>
                                <option value="digunakan" {{ old('status', $dataEdit->status) == "digunakan" ? 'selected' : ''}}>Digunakan</option>
                                <option value="tidakdigunakan" {{ old('status', $dataEdit->status) == "tidakdigunakan" ? 'selected' : ''}}>Tidak DIgunakan</option>
                            </select>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <label class="form-label">Kondisi Barang</label>
                            <select class="form-select" name="kondisi_barang">
                                <option selected disabled>Pilih</option>
                                <option value="rusak" {{ old('kondisi_barang', $dataEdit->kondisi_barang) == "rusak" ? 'selected' : ''}}>Rusak</option>
                                <option value="baik" {{ old('kondisi_barang', $dataEdit->kondisi_barang) == "baik" ? 'selected' : ''}}>Baik</option>
                            </select>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Lampiran</label>
                            <div class="input-group">
                                <input type="file" class="form-control" accept=".pdf" name="file" value="{{ $dataEdit->file}}" />
                                <span class="input-group-text"><i class="mdi mdi-panorama"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('inventaris_barangmasuk_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
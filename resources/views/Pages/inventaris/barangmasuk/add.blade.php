@extends('layouts.layout')


@section('content')

<script>

$(document).ready(function () {
    
    const inputElement = document.querySelector('#filepond');
    const pond = FilePond.create(inputElement);

    FilePond.setOptions({
        server: {
            process: {
                url: "{{ route('inventaris_barangmasuk_store') }}",
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
            url: "{{ route('inventaris_barangmasuk_store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                toastr.success('data berhasil disimpan');
                setTimeout(() => {
                    window.location.href = "{{ route('inventaris_barangmasuk_page') }}"; 
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
                        <h4 class="card-title mb-3"><b>Tambah Barang Masuk</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form action="{{ route('inventaris_barangmasuk_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                      <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nama Barang</label>
                                <input class="form-control" name="nama_barang_masuk" />
                                <!-- input-group -->
                            </div>
                      </div>
                      <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Serial</label>
                                <input class="form-control" name="serial" />
                                <!-- input-group -->
                            </div>
                      </div>
                      <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Deskripsi</label>
                                <input class="form-control" name="deskripsi" />
                                <!-- input-group -->
                            </div>
                      </div>
                      <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Manufaktur</label>
                                <input class="form-control" name="manufaktur" />
                                <!-- input-group -->
                            </div>
                      </div>
                      <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Brand</label>
                                <input class="form-control" name="brand" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Nomor Barang</label>
                                <input class="form-control" name="nomor_barang" />
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
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_masuk" />
                                    {{-- <span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span> --}}
                                </div>
                            </div>
                      </div>
                      <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Jumlah Masuk</label>
                                <input class="form-control" type="number" name="jumlah_masuk" />
                                <!-- input-group -->
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option selected disabled>Pilih</option>
                                <option value="digunakan">Digunakan</option>
                                <option value="tidakdigunakan">Tidak Digunakan</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Kondisi Barang</label>
                            <select class="form-select" name="kondisi_barang">
                                <option selected disabled>Pilih</option>
                                <option value="rusak">Rusak</option>
                                <option value="baik">Baik</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                            <label class="form-label">Lampiran</label>
                            <div class="input-group">
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
                      <div class="col-lg-6">
                           <div class="mt-4 mt-lg-0 mb-3">
                              <label class="form-label">Kategori Barang</label>
                              <select class="form-select" placeholder="Pilih" name="id_kategori_barang">
                                  <option selected disabled>Pilih</option>
                                  @foreach($dataKategoriBarang as $kategoribarang)
                                     <option value="{{ $kategoribarang->id }}">{{ $kategoribarang->kategori_barang }}</option>
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
                                     <option value="{{ $lokasibarang->id }}">{{ $lokasibarang->lokasi_barang }}</option>
                                  @endforeach
                              </select>
                         </div>
                      </div>
                        
                        
                    </div>
                       
                    <div class="row">
                       
                        
                        
                        <!--<div class="col-lg-6 mb-4">
                            <label class="form-label">Lampiran</label>
                            <div class="input-group">
                                <input type="file" class="form-control" accept=".pdf" name="file" />
                                <span class="input-group-text"><i class="mdi mdi-panorama"></i></span>
                            </div>
                        </div>-->
                    
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
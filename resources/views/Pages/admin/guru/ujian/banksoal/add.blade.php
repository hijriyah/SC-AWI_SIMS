@extends('layouts.layout')


@section('content')

<script>

    $(document).ready(function () {
        
        const inputElement = document.querySelector('#filepond');
        const pond = FilePond.create(inputElement);
    
        FilePond.setOptions({
            server: {
                process: {
                    url: "{{ route('guru_ujian-banksoal_store') }}",
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
    
        $('#BankSoalForm').on('submit', function (e) {
            e.preventDefault();  
    
            var formData = new FormData(this);
    
            pond.getFiles().forEach(function(file) {
                formData.append('filepond[]', file.file);
            });

            console.log(formData);
    
            $.ajax({
                url: "{{ route('guru_ujian-banksoal_store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    toastr.success('data berhasil disimpan');
                    setTimeout(() => {
                        window.location.href = "{{ route('guru_ujian-banksoal_page') }}"; 
                    }, 2000);
                },
                error: function (response) {
                    toastr.error('data gagal disimpan');
                }
            });
        });
        
        var Dtype = null;
        var Jpilihan = null;
        
        $('#jawabanView').hide();
        $('#JumlahPilihan').on('change', function() {
            Jpilihan = $(this).find('option:selected').val();

            if(Jpilihan != 0)
            {
                $('#TipeSoal').off('change').on('change', function() {
                    Dtype = $(this).find('option:selected').val();
                    if(Dtype == 'pilihan ganda')
                    {
                        $('#jawabanView').show();
                    }
                    else {
                        $('#jawabanView').hide();
                        Jpilihan = null;
                    }
                });
            }
            
            $.ajax({
                url: "{{ route('guru_ujian-banksoal_add') }}",
                type: 'GET',
                data: {
                    selected: Jpilihan
                },
                success: (response) => {
                    response.finalRaw.forEach((jawaban, index) => {
                        $('#Form-Group').append(`
                                <div class="form-check form-check-inline" style="margin-left: 5px;">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="${jawaban}" name="jawaban_benar">
                                    <label class="form-check-label" for="inlineRadio1">${jawaban}</label>
                                </div>
                            </div>
                        `);
                    });
                },
                error: (error) => {
                    console.log(error)
                }
            })
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
                        <h4 class="card-title mb-3"><b>Tambah Bank Soal</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form enctype="multipart/form-data" id="BankSoalForm">
                    @csrf
                    <div class="row mb-4 mt-4">
                        <div class="col-md-12">
                            <label class="form-label">Soal</label>
                            <textarea class="form-control" id="editor" name="soal"></textarea>
                        </div>
                        @error("soal")
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="">
                                <label class="form-label">Penjelasan</label>
                                <textarea class="form-control" name="penjelasan" style="height: 100px;" placeholder="Penjelasan"></textarea>
                            </div>
                            @error("penjelasan")
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="">
                                <label class="form-label">Kategori Soal</label>
                                <select class="form-select" name="id_grup_soal">
                                    <option selected disabled>Pilih</option>
                                    @foreach($dataKategorisoal as $kategorisoal)
                                        <option value="{{ $kategorisoal->id }}">{{ $kategorisoal->judul }}</option>
                                    @endforeach
                                </select>
                                @error("id_grup_soal")
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Jumlah Soal</label>
                            <input type="number" class="form-control" name="jumlah_soal" placeholder="Jumlah Soal">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jumlah Pilihan</label>
                            {{-- <input type="number" class="form-control" name="jumlah_pilihan" placeholder="Jumlah Pilihan"> --}}
                            <select class="form-select" name="jumlah_pilihan" id="JumlahPilihan">
                                <option selected disabled>Pilih</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>
                        </div>
                    </div>
                       
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="" class="form-label">Level Soal</label>
                            <select class="form-select" name="level_soal">
                                <option selected disabled>Pilih</option>
                                <option value="easy">Easy</option>
                                <option value="medium">Medium</option>
                                <option value="hard">Hard</option>
                            </select>
                            @error("level_soal")
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Tipe Soal</label>
                            <select class="form-select" name="tipe_soal" id="TipeSoal">
                                <option selected disabled>Pilih</option>
                                <option value="pilihan ganda" >Pilihan Ganda</option>
                                <option value="akm">Akm</option>
                                <option value="esai">Esai</option>
                            </select>
                            @error("tipe_soal")
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3" id="jawabanView">
                        <div class="col-md-12">
                            <label class="form-label">Jawaban</label>
                            <div class="form-group" id="Form-Group">
                                {{-- Content --}}
                            </div> 
                        </div>
                    </div>
                    

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="" class="form-label">Mata Pelajaran</label>
                            <select class="form-select" name="id_mata_pelajaran">
                                <option selected disabled>Pilih</option>
                                @foreach($dataMatapelajaran as $matapelajaran)
                                    <option value="{{ $matapelajaran->id }}">{{ $matapelajaran->mata_pelajaran }}</option>
                                @endforeach
                            </select>
                            @error("id_mata_pelajaran")
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Orang Tua</label>
                            <select class="form-select" name="id_orangtua">
                                <option selected disabled>Pilih</option>
                                @foreach($dataOrangtua as $orangtua)
                                    <option value="{{ $orangtua->id }}">{{ $orangtua->nama }}</option>
                                @endforeach
                            </select>
                            @error("id_orangtua")
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Waktu</label>
                            <input type="number" class="form-control" name="waktu" placeholder="Waktu">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mark</label>
                            <input type="number" class="form-control" name="mark" placeholder="Mark">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="mb-4">
                            <label class="form-label">File</label>
                            <input type="file" 
                            id="filepond"
                            class="filepond"
                            name="filepond[]" 
                            data-allow-reorder="true"
                            data-max-file-size="2MB"
                            data-max-files="1" />

                            @error('filepond')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Petunjuk</label>
                            <textarea class="form-control" name="petunjuk" placeholder="Petunjuk" style="height: 100px;"></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('guru_ujian-banksoal_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
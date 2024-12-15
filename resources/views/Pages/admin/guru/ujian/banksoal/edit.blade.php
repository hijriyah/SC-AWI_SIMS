@extends('layouts.layout')


@section('content')

<script>

    $(document).ready(function () {
        
        const inputElement = document.querySelector('#filepond');
        const pond = FilePond.create(inputElement, {
            allowFileSizeValidation: true,
            maxFileSize: '2MB'
        });
    
        FilePond.setOptions({
            server: {
                process: {
                    url: "{{ route('guru_ujian-banksoal_update', ['uuid' => $dataEdit->uuid]) }}",
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

            $('#BankSoalForm').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                
                pond.getFiles().forEach(function(file) {
                    formData.append('filepond[]', file.file);
                });

                $.ajax({
                    url: "{{ route('guru_ujian-banksoal_update', ['uuid' => $dataEdit->uuid]) }}",
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
                            window.location.href = "{{ route('guru_ujian-banksoal_page') }}";
                        }, 2000);
                    },
                    error: function (response) {
                        toastr.error('gagal mengupload data');
                    }
                });
            });
            

                
        }
        
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
                url: "{{ route('guru_ujian-banksoal_edit', ['uuid' => $dataEdit->uuid]) }}",
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
                        <h4 class="card-title mb-3"><b>Edit Bank Soal</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form enctype="multipart/form-data" id="BankSoalForm">
                    @csrf
                    <div class="row mb-4 mt-4">
                        <div class="col-md-12">
                            <label class="form-label">Soal</label>
                            <textarea class="form-control" id="editor" name="soal">{{ $dataEdit->soal }}</textarea>
                        </div>
                        @error("soal")
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="">
                                <label class="form-label">Penjelasan</label>
                                <textarea class="form-control" name="penjelasan" style="height: 100px;" placeholder="Penjelasan">{{ $dataEdit->penjelasan }}</textarea>
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
                                        <option value="{{ $kategorisoal->id }}" {{ old('id_grup_soal', $kategorisoal->id) == $dataEdit->id_grup_soal ? 'selected' : ''}}>{{ $kategorisoal->judul }}</option>
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
                            <input type="number" class="form-control" name="jumlah_soal" placeholder="Jumlah Soal" value="{{ $dataEdit->jumlah_soal }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jumlah Pilihan</label>
                            {{-- <input type="number" class="form-control" name="jumlah_pilihan" placeholder="Jumlah Pilihan"> --}}
                            <select class="form-select" name="jumlah_pilihan" id="JumlahPilihan">
                                <option selected disabled>Pilih</option>
                                <option value="1" {{ $dataEdit->jumlah_pilihan == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $dataEdit->jumlah_pilihan == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $dataEdit->jumlah_pilihan == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $dataEdit->jumlah_pilihan == 4 ? 'selected' : '' }}>4</option>
                                <option value="5" {{ $dataEdit->jumlah_pilihan == 5 ? 'selected' : '' }}>5</option>
                                <option value="6" {{ $dataEdit->jumlah_pilihan == 6 ? 'selected' : '' }}>6</option>
                                <option value="7" {{ $dataEdit->jumlah_pilihan == 7 ? 'selected' : '' }}>7</option>
                            </select>
                        </div>
                    </div>
                       
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="" class="form-label">Level Soal</label>
                            <select class="form-select" name="level_soal">
                                <option selected disabled>Pilih</option>
                                <option value="easy" {{ $dataEdit->level_soal == 'easy' ? 'selected' : ''}}>Easy</option>
                                <option value="medium" {{ $dataEdit->level_soal == 'medium' ? 'selected' : ''}}>Medium</option>
                                <option value="hard" {{ $dataEdit->level_soal == 'hard' ? 'selected' : ''}}>Hard</option>
                            </select>
                            @error("level_soal")
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Tipe Soal</label>
                            <select class="form-select" name="tipe_soal" id="TipeSoal">
                                <option selected disabled>Pilih</option>
                                <option value="pilihan ganda" {{ $dataEdit->tipe_soal == 'pilihan ganda' ? 'selected' : ''}}>Pilihan Ganda</option>
                                <option value="akm" {{ $dataEdit->tipe_soal == 'akm' ? 'selected' : ''}}>Akm</option>
                                <option value="esai" {{ $dataEdit->tipe_soal == 'esai' ? 'selected' : ''}}>Esai</option>
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
                                    <option value="{{ $matapelajaran->id }}" {{ old('id_mata_pelajaran', $matapelajaran->id) == $dataEdit->id_mata_pelajaran ? 'selected' : ''}}>{{ $matapelajaran->mata_pelajaran }}</option>
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
                                    <option value="{{ $orangtua->id }}" {{ old('id_orangtua', $orangtua->id) == $dataEdit->id_orangtua ? 'selected' : ''}}>{{ $orangtua->nama }}</option>
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
                            <input type="number" class="form-control" name="waktu" placeholder="Waktu" value="{{ $dataEdit->waktu }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mark</label>
                            <input type="number" class="form-control" name="mark" placeholder="Mark" value="{{ $dataEdit->mark }}">
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
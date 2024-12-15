@extends('layouts.layout')

@section('content')

<script>

$(document).ready(function () {
    
    const inputElement = document.querySelector('#filepond');
    const pond = FilePond.create(inputElement);

    FilePond.setOptions({
        server: {
            process: {
                url: "{{ route('ujian_mulaiujian_store') }}",
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

    $('#mulaiUjianForm').on('submit', function (e) {
        e.preventDefault();  

        var formData = new FormData(this);

        pond.getFiles().forEach(function(file) {
            formData.append('filepond[]', file.file);
        });

        $.ajax({
            url: "{{ route('ujian_mulaiujian_store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                toastr.success('data berhasil disimpan');
                setTimeout(() => {
                    window.location.href = "{{ route('ujian_mulaiujian_page') }}"; 
                }, 2000);
            },
            error: function (response) {
                toastr.error('data gagal disimpan');
            }
        });
    });

    // flatpickr Setup 
    $('#start_time').flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i"
    });
    $('#end_time').flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i"
    });
    $('#Date').flatpickr({
        dateFormat: 'Y-m-d'
    })
    

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
                        <h4 class="card-title mb-3"><b>Tambah Mulai Ujian</b></h4>
                        <div></div>
                        
                    </div>
                </div>

               {{-- <p class="card-title-desc">Examples of twitter bootstrap datepicker.</p> --}}

               <form id="mulaiUjianForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                                <label class="form-label">Nama</label>
                                <input class="form-control" name="nama" />
                                @error('nama')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                            <label class="form-label">Gambar</label>
                            <input type="file" 
                            id="filepond"
                            class="filepond"
                            name="filepond[]" 
                            data-allow-reorder="true"
                            data-max-file-size="2MB"
                            data-max-files="2" />
                            </div>
                            <p class="fst-italic" style="transform: translateY(-20px);">.png, .jpg, .jpeg</p>
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
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="form-select" placeholder="Pilih" name="id_mata_pelajaran">
                               <option selected disabled>Pilih</option>
                               @foreach($dataMataPelajaran as $matapelajaran)
                                  <option value="{{ $matapelajaran->id }}">{{ $matapelajaran->mata_pelajaran }}</option>
                               @endforeach
                           </select>
                             @error('id_mata_pelajaran')
                                 <span class="text-sm text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                         <div class="col-lg-6 mb-4">
                            <label class="form-label">Instruksi Ujian</label>
                            <select class="form-select" placeholder="Pilih" name="id_instruksi_ujian">
                               <option selected disabled>Pilih</option>
                               @foreach($dataInstruksiUjian as $instruksiujian)
                                  <option value="{{ $instruksiujian->id }}">{{ $instruksiujian->judul }}</option>
                               @endforeach
                           </select>
                             @error('id_instruksi_ujian')
                                 <span class="text-sm text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
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
                        <div class="col-lg-6">
                            <label class="form-label">No Tipe ujian</label>
                            <input type="number" class="form-control" name="no_tipe_ujian" />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <label class="form-label">Hari</label>
                            <select class="form-select" name="hari">
                                <option selected>Pilih</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Tanggal</label>
                            <input class="form-control" name="tanggal" id="Date" placeholder="Y-m-d" />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <label class="form-label">Waktu Mulai</label>
                            <input class="form-control" name="waktu_mulai" id="start_time" placeholder="00:00" />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Waktu Selesai</label>
                            <input class="form-control" name="waktu_selesai" id="end_time" placeholder="00:00" />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <label class="form-label">Durasi</label>
                            <input type="number" class="form-control" name="durasi" />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Random</label>
                            <input type="number" class="form-control" name="random" />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Public</label>
                            <input type="number" class="form-control" name="public" />
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option selected disabled>Pilih</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak_aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <label class="form-label">Guru</label>
                            <select class="form-select" name="id_guru">
                                <option selected disabled>Pilih</option>
                                @foreach($dataGuru as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama_panggilan }}</option>
                                @endforeach
                            </select>
                            @error('id_guru')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Poin Benar</label>
                            <input type="number" class="form-control" name="poin_benar" />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <label class="form-label">Persentase</label>
                            <input type="number" class="form-control" name="persentase" />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Bank Soal</label>
                            <select class="form-select" name="id_bank_soal">
                                <option selected disabled>Pilih</option>
                                @foreach($dataBankSoal as $banksoal)
                                    <option value="{{ $banksoal->id }}">{{ $banksoal->soal }}</option>
                                @endforeach
                            </select>
                            @error('id_bank_soal')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                       
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" style="height: 100px;"></textarea>
                                @error('deskripsi')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Publish</label>
                            <select class="form-select" name="publish">
                                <option selected disabled>Pilih</option>
                                <option value="ya">Ya</option>
                                <option value="tidak">Tidak</option>
                            </select>
                            @error('publish')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                  
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success" style="height: 29px; margin-right: 10px;"><i class="mdi mdi-telegram"></i> Kirim</button>
                        <a href="{{ route('ujian_mulaiujian_page') }}" class="btn btn-sm btn-danger" style="height: 29px;"><i class="mdi mdi-keyboard-backspace"></i> Kembali</a>
                    </div>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- end row -->

@endsection
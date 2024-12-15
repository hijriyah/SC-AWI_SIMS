@extends('layouts.layout')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Dashboard
            </h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Selamat Datang Di {{ $adminSession }} Dashboard</li>
            </ol>
        </div>
        </div>
    </div>
</div>

<div class="page-content" style="transform: translateY(-100px);" >
    <div class="row" >  
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="avatar-sm font-size-20 me-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                <i class="mdi mdi-account-multiple-outline"></i>
                            </span>
                        </div>
                        <div class="flex-1">
                            <div class="font-size-16 mt-2">Guru</div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <p class="mb-0"><span class="badge badge-soft-success me-2" style="font-size: 12px;">Total </span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="">{{ $amountGuru }}</p>
                        </div>
                        {{-- <div class="col-5 align-self-center">
                            <div class="progress progress-sm">
                                 <div class="progress-bar bg-primary" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="avatar-sm font-size-20 me-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded"><i class="mdi mdi-account-multiple-outline"></i></span>
                        </div>
                        <div class="flex-1">
                            <div class="font-size-16 mt-2">Siswa</div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <p class="mb-0"><span class="badge badge-soft-success me-2" style="font-size: 12px;">Total </span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="">{{ $amountSiswa }}</p>
                        </div>
                        {{-- <div class="col-5 align-self-center">
                            <div class="progress progress-sm">
                                 <div class="progress-bar bg-primary" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Keaktifan Guru Per Bulan</h4>
                    <div id="line-chart" class="apex-charts"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Keaktifan Guru</h4>
                    <div id="column-chart" class="apex-charts"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="avatar-sm font-size-20 me-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded"><i class="mdi mdi-book-information-variant"></i></span>
                        </div>
                        <div class="flex-1">
                            <div class="font-size-16 mt-2">Mata Pelajaran</div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <p class="mb-0"><span class="badge badge-soft-success me-2" style="font-size: 12px;">Total </span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="">{{ $amountMataPelajaran }}</p>
                        </div>
                        {{-- <div class="col-5 align-self-center">
                            <div class="progress progress-sm">
                                 <div class="progress-bar bg-primary" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="avatar-sm font-size-20 me-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded"><i class="mdi mdi-google-classroom"></i></span>
                        </div>
                        <div class="flex-1">
                            <div class="font-size-16 mt-2">Kelas</div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <p class="mb-0"><span class="badge badge-soft-success me-2" style="font-size: 12px;">Total </span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="">{{ $amountKelas }}</p>
                        </div>
                        {{-- <div class="col-5 align-self-center">
                            <div class="progress progress-sm">
                                 <div class="progress-bar bg-primary" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Kotak Masuk</h4>
                    <ul class="inbox-wid list-unstyled">
                        <li class="inbox-list-item">
                            <a href="#">
                            <div class="d-flex align-items-start">
                                <div class="me-3 align-self-center">
                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-sm rounded-circle">
                                </div>
                                <div class="flex-1 overflow-hidden">
                                    <h5 class="font-size-16 mb-1">Walmur Zaki</h5>
                                    <p class="text-truncate mb-0">Assalamualaikum warahmatullahi....</p>
                                </div>
                                <div class="font-size-12 ms-auto">5 menit 
                                </div>
                            </div>
                            </a>
                        </li>
                        <li class="inbox-list-item">
                            <a href="#">
                            <div class="d-flex align-items-start">
                                <div class="me-3 align-self-center">
                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-sm rounded-circle"> 
                                </div>
                                <div class="flex-1 overflow-hidden">
                                    <h5 class="font-size-16 mb-1">Walmur Tio</h5>
                                    <p class="text-truncate mb-0">Assalamualaikum warahmatullahi....</p>
                                </div>
                                <div class="font-size-12 ms-auto"> 12 menit  
                                </div>
                            </div>
                            </a>
                        </li>
                        <li class="inbox-list-item">
                            <a href="#">
                                <div class="d-flex align-items-start">
                                    <div class="me-3 align-self-center">
                                        <img src="assets/images/users/avatar-5.jpg" alt=""  class="avatar-sm rounded-circle">
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Kepala</h5>
                                        <p class="text-truncate mb-0">Assalamualaikum warahmatullahi....</p>
                                    </div>
                                    <div class="font-size-12 ms-auto">18 menit
                                    </div>
                                </div>
                            </a>
                        </li><br>
                        <div class="text-center">
                            <a href="#" class="btn btn-primary btn-sm">Tampilkan Lebih Banyak</a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="text-white-45">
                        <h5 class="text-white">SIMSUBA</h5>
                        <p>Sistem Informasi Manajemen Sekolah UTSMAN BIN AFFAN yang memiliki beberapa modul terintegrasi yang dapat diakses oleh semua anggota sekolah, antara lain guru, wali kelas, pegawai sekolah, siswa dan orang tua / wali siswa. </p>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-8">
                            <div class="mt-4">
                                <img src="assets/images/widget-img.png" alt="" class="img-fluid mx-auto d-block">
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Reminder Kegiatan Terdekat</h4>
                    <div class="table-responsive">
                        <table class="table table-centered">
                            <thead>
                                <tr>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col">NAMA KEGIATAN</th>
                                    <th scope="col">DESKRIPSI</th>
                                    <th scope="col">JAM</th>
                                    <th scope="col">TUJUAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach($amountRencanaKegiatan as $rencanakegiatan)
                                        <td>{{ $rencanakegiatan->tanggal_mulai }} - {{ $rencanakegiatan->tanggal_selesai }}</td>
                                        <td>{{ $rencanakegiatan->nama_kegiatan }}</td>
                                        <td>{{ $rencanakegiatan->deskripsi }}</td>
                                        <td><span class="badge badge-soft-danger font-size-12">{{ $rencanakegiatan->waktu_mulai }} - {{ $rencanakegiatan->waktu_selesai }}</span></td>
                                        <td>{{ $rencanakegiatan->lokasi_kegiatan }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn btn-primary btn-sm">Tampilkan Lebih Banyak</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Reminder Jam Mengajar</h4>
                    <div class="table-responsive">
                        <table class="table table-centered">
                            <thead>
                                <tr>
                                    <th scope="col">KELAS</th>
                                    <th scope="col">MAPEL</th>
                                    <th scope="col">JAM </th>
                                    <th scope="col">GURU</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($amountJadwalPelajaran as $jadwalpelajaran)
                                    <tr>
                                        <td>{{ $jadwalpelajaran->kelas->nama_kelas }}</td>
                                        <td>{{ $jadwalpelajaran->matapelajaran->mata_pelajaran }}</td>
                                        <td><span class="badge badge-soft-danger font-size-12">{{ $jadwalpelajaran->waktu_mulai }} - {{ $jadwalpelajaran->waktu_selesai }}</span></td>
                                        <td>{{ $jadwalpelajaran->guru->nama_lengkap }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn btn-primary btn-sm">Tampilkan Lebih Banyak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Reminder Tugas / Ujian</h4>
                    <div class="table-responsive">
                        <table class="table table-centered">
                            <thead>
                                <tr>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col">MATA PELAJARAN</th>
                                    <th scope="col">MATERI</th>
                                    <th scope="col">GURU</th>
                                    <th scope="col">TUGAS</th>
                                    <th scope="col">KELAS</th>
                                    <th scope="col" colspan="2">PROSENTASE KEAKTIFAN</th>
                                 </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>15/09/2025</td>
                                    <td>Bahasa Indonesia</td>
                                    <td>Narasi</td>
                                    <td>Rina, S.Pd</td>
                                    <td>Membaca</td>
                                    <td>VIII Putra</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-5 align-self-center">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <p class="mb-0"><span class="text-success me-2"> 62% </span></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>15/09/2025</td>
                                    <td>Matematika</td>
                                    <td>Narasi</td>
                                    <td>Rita, S.Pd</td>
                                    <td>Berhitung</td>
                                    <td>VIII Putri</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-5 align-self-center">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <p class="mb-0"><span class="text-success me-2"> 62% </span></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>15/09/2025</td>
                                    <td>Bahasa Indonesia</td>
                                    <td>Narasi</td>
                                    <td>Hilda, S.Pd</td>
                                    <td>Membaca</td>
                                    <td>IX Putri</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-5 align-self-center">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 82%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <p class="mb-0"><span class="text-success me-2"> 82% </span></p>
                                            </div>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>15/09/2025</td>
                                        <td>Bahasa Inggris</td>
                                        <td>Narasi</td>
                                        <td>Guru</td>
                                        <td>Membaca</td>
                                        <td>VII Putri</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-5 align-self-center">
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <p class="mb-0"><span class="text-success me-2"> 70% </span></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <div class="mt-3">
                        <ul class="pagination pagination-rounded justify-content-center mb-0">
                            <li class="page-item"><a class="page-link" href="#">Sebelumnya</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Laporan Jam Kosong</h4>
                    <div class="table-responsive">
                        <table class="table table-centered">
                            <thead>
                                <tr>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col">JAM MENGAJAR</th>
                                    <th scope="col">KELAS</th>
                                    <th scope="col">MATA PELAJARAN</th>
                                    <th scope="col">GURU</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">PENUGASAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>15/01/2025</td>
                                    <td><span class="badge badge-soft-danger font-size-12">07.00 - 09.00</span></td>
                                    <td>VII Putri</td>
                                    <td>Matematika</td>
                                    <td>Rita, S.Mat</td>
                                    <td><span class="badge badge-soft-success font-size-12">Sakit</span></td>
                                    <td><span class="badge badge-soft-warning font-size-12">LKS Halaman 15</span></td>
                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                </tr>
                                <tr>
                                   <td>15/01/2025</td>
                                   <td><span class="badge badge-soft-danger font-size-12">07.00 - 09.00</span></td>
                                   <td>VII Putri</td>
                                   <td>Matematika</td>
                                   <td>Rita, S.Mat</td>
                                   <td><span class="badge badge-soft-danger font-size-12">Tanpa Keterangan</span></td>
                                   <td><span class="badge badge-soft-warning font-size-12">LKS Halaman 15</span></td>
                                   <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                </tr>
                                <tr>
                                   <td>15/01/2025</td>
                                   <td><span class="badge badge-soft-danger font-size-12">07.00 - 09.00</span></td>
                                   <td>VII Putri</td>
                                   <td>Matematika</td>
                                   <td>Rita, S.Mat</td>
                                   <td><span class="badge badge-soft-warning font-size-12">Izin</span></td>
                                   <td><span class="badge badge-soft-warning font-size-12">LKS Halaman 15</span></td>
                                   <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                   </tr>
                                <tr>
                                    <td>15/01/2025</td>
                                    <td><span class="badge badge-soft-danger font-size-12">07.00 - 09.00</span></td>
                                    <td>VII Putri</td>
                                    <td>Matematika</td>
                                    <td>Rita, S.Mat</td>
                                    <td><span class="badge badge-soft-success font-size-12">Sakit</span></td>
                                    <td><span class="badge badge-soft-warning font-size-12">LKS Halaman 15</span></td>
                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                </tr>                                                         
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <ul class="pagination pagination-rounded justify-content-center mb-0">
                           <li class="page-item"> <a class="page-link" href="#">Sebelumnya</a> </li>
                           <li class="page-item"><a class="page-link" href="#">1</a></li>
                           <li class="page-item active"><a class="page-link" href="#">2</a></li>
                           <li class="page-item"><a class="page-link" href="#">3</a></li>
                           <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>
<!--<div class="page-content">

   <!-- start page title -->
   <!--<div class="row" style="margin-top: 40px; margin-bottom: 1550px;">-->
      
   <!--<div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    <!-- <div class="input-group input-group-sm">
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Jan</option>
                            <option value="1">Dec</option>
                            <option value="2">Nov</option>
                            <option value="3">Oct</option>
                        </select>
                        <label class="input-group-text">Month</label>
                    </div> -->
                <!--</div> -->
                <!-- <h4 class="card-title mb-4">jumlah Master</h4> -->

                <!--<div class="d-flex align-items-start">
                    <div class="flex-1">
                        <p class="mb-2">Total keseluruhan master</p>
                        <h4><span>0</span></h4>
                        <p class="mb-0"><span class="badge badge-soft-success me-2"> 0.6% <i
                                    class="mdi mdi-arrow-up"></i> </span> From previous period</p>
                    </div>
                </div>-->

                <!--<div class="mt-3 social-source">
                    <div class="d-flex align-items-center social-source-list">
                        <div class="avatar-xs me-4">
                            <span class="avatar-title rounded-circle">
                                <i class="mdi mdi-account-box"></i>
                            </span>
                        </div>
                        <div class="flex-1">
                            <p class="mb-1">Staff</p>
                            <h5 class="mb-0"><span>0</span></h5>
                        </div>
                        <div class="ms-auto">
                            2.06 % <i class="mdi mdi-arrow-up text-success ms-1"></i>
                        </div>
                    </div>

                    <div class="media  d-flex align-items-center social-source-list">
                        <div class="avatar-xs me-4">
                            <span class="avatar-title rounded-circle bg-info">
                                <i class="mdi mdi-account-box"></i>
                            </span>
                        </div>
                        <div class="flex-1">
                            <p class="mb-1">Guru</p>
                            <h5 class="mb-0"><span>0</span></h5>
                        </div>
                        <div class="ms-auto">
                            1.28 % <i class="mdi mdi-arrow-up text-success ms-1"></i>
                        </div>
                    </div>

                    <div class="d-flex align-items-center social-source-list">
                        <div class="avatar-xs me-4">
                            <span class="avatar-title rounded-circle bg-pink">
                                <i class="mdi mdi-account-box"></i>
                            </span>
                        </div>
                        <div class="flex-1">
                            <p class="mb-1">Siswa</p>
                            <h5 class="mb-0"><span>0</span></h5>
                        </div>
                        <div class="ms-auto">
                            1.04 % <i class="mdi mdi-arrow-up text-success ms-1"></i>
                        </div>
                    </div>
                </div>-->

                <!--<div class="d-flex align-items-center social-source-list">
                    <div class="avatar-xs me-4">
                        <span class="avatar-title rounded-circle bg-success">
                            <i class="mdi mdi-account-box"></i>
                        </span>
                    </div>
                    <div class="flex-1">
                        <p class="mb-1">Orang tua</p>
                        <h5 class="mb-0"><span>0</span></h5>
                    </div>
                    <div class="ms-auto">
                        1.04 % <i class="mdi mdi-arrow-up text-success ms-1"></i>
                    </div>
                </div>-->
            <!--</div>

            </div>-->
   <!--</div>-->
   <!-- end page title -->
<!--</div>-->
<!-- End Page-content -->

@endsection
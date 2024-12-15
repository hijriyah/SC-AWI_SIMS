@extends('layouts.layout')


@section('content')

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
    
<div class="page-content" style="margin-bottom: 1300px;">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Selamat Datang Di Siswa Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
     <!-- end page title -->

    <div class="row">
        <div class="col-xl-3">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="avatar-sm font-size-20 me-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded"><i class="mdi mdi-account-multiple-outline"></i></span>
                        </div>
                        
                        <div class="flex-1">
                            <div class="font-size-16 mt-2">Guru</div>
                         </div>
                    </div>
                    <h4 class="mt-4">80</h4>
                    <div class="row">
                        <div class="col-7">
                            <p class="mb-0"><span class="text-success me-2"> 0.28% <i class="mdi mdi-arrow-up"></i> </span></p>
                        </div>
                         <div class="col-5 align-self-center">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="avatar-sm font-size-20 me-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded"> <i class="mdi mdi-account-multiple-outline"></i></span>
                        </div>
                        <div class="flex-1">
                            <div class="font-size-16 mt-2">Siswa</div>
                        </div>
                    </div>
                    <h4 class="mt-4">110</h4>
                    <div class="row">
                                        <div class="col-7">
                                            <p class="mb-0"><span class="text-success me-2"> 0.16% <i
                                                        class="mdi mdi-arrow-up"></i> </span></p>
                                        </div>
                                        <div class="col-5 align-self-center">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 62%"
                                                    aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Kehadiran Siswa</h4>

                                    <div id="column-chart" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>

                         <div class="col-xl-3">
                            <div class="card bg-primary">
                                <div class="card-body">
                                    <div class="text-white-45">
                                        <h5 class="text-white">SIMSUBA</h5>
                                        <p>Sistem Informasi Manajemen Sekolah UTSMAN BIN AFFAN yang memiliki beberapa modul terintegrasi yang dapat diakses oleh semua anggota sekolah, antara lain guru, wali kelas, pegawai sekolah, siswa dan orang tua / wali siswa. 
                                        <!--<div>
                                            <a href="#" class="btn btn-outline-success btn-sm">View more</a>
                                        </div>-->
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-8">
                                            <div class="mt-4">
                                                <img src="assets/images/widget-img.png" alt=""
                                                    class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                    </div>
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
                                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                                <i class="mdi mdi-tag-plus-outline"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-size-16 mt-2">Materi</div>
                                        </div>
                                    </div>
                                    <h4 class="mt-4">50</h4>
                                    <div class="row">
                                        <div class="col-7">
                                            <p class="mb-0"><span class="text-success me-2"> 0.28% <i
                                                        class="mdi mdi-arrow-up"></i> </span></p>
                                        </div>
                                        <div class="col-5 align-self-center">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 62%"
                                                    aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar-sm font-size-20 me-3">
                                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                                <i class="mdi mdi-tag-plus-outline"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-size-16 mt-2">Kelas</div>

                                        </div>
                                    </div>
                                    <h4 class="mt-4">4</h4>
                                    <div class="row">
                                        <div class="col-7">
                                            <p class="mb-0"><span class="text-success me-2"> 0.16% <i
                                                        class="mdi mdi-arrow-up"></i> </span></p>
                                        </div>
                                        <div class="col-5 align-self-center">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 62%"
                                                    aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-9">
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
                                                    <th scope="col" colspan="2">STATUS</th>
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
                                                    <td><span class="badge badge-soft-success font-size-12">Berakhir</span>
                                                    </td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                    
                                                </tr>
                                                <tr>
                                                    <td>15/09/2025</td>
                                                    <td>Matematika</td>
                                                    <td>Narasi</td>
                                                    <td>Rita, S.Pd</td>
                                                    <td>Berhitung</td>
                                                    <td>VIII Putri</td>
                                                    <td><span class="badge badge-soft-warning font-size-12">Segera Kumpulkan</span>
                                                    </td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                    
                                                </tr>
                                                <tr>
                                                    <td>15/09/2025</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>Narasi</td>
                                                    <td>Hilda, S.Pd</td>
                                                    <td>Membaca</td>
                                                    <td>IX Putri</td>
                                                    <td><span class="badge badge-soft-success font-size-12">Berakhir</span>
                                                    </td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                    
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-3">
                                        <ul class="pagination pagination-rounded justify-content-center mb-0">
                                            <li class="page-item">
                                                <a class="page-link" href="#">Sebelumnya</a>
                                            </li>
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
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Data Tahsin</h4>

                                    <div class="table-responsive">
                                        <table class="table table-centered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">TANGGAL</th>
                                                    <th scope="col">JILID</th>
                                                    <th scope="col">CAPAIAN</th>
                                                    <th scope="col">PREDIKAT</th>
                                                    <!--<th scope="col" colspan="2">Payment Status</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>01/09/2024</td>
                                                    <!--<td>
                                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                                    </td>-->
                                                    <td>Jilid 3</td>
                                                    <td>Halaman 5</td>
                                                    <td>B</td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>30/08/2024</td>
                                                    <!--<td>
                                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                                    </td>-->
                                                    <td>Jilid 3</td>
                                                    <td>Halaman 4</td>
                                                    <td>B</td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>29/08/2024</td>
                                                    <!--<td>
                                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                                    </td>-->
                                                    <td>Jilid 3</td>
                                                    <td>Halaman 3</td>
                                                    <td>A</td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="text-center">
                                        <a href="#" class="btn btn-primary btn-sm">Tampilkan Lebih Banyak</a>
                                    </div>

                                    <!--<div class="mt-3">
                                        <ul class="pagination pagination-rounded justify-content-center mb-0">
                                            <li class="page-item">
                                                <a class="page-link" href="#">Previous</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </div>-->
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Data Tahfidz</h4>

                                   <div class="table-responsive">
                                        <table class="table table-centered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">TANGGAL</th>
                                                    <th scope="col">JILID</th>
                                                    <th scope="col">CAPAIAN</th>
                                                    <th scope="col">PREDIKAT</th>
                                                    <!--<th scope="col">Amount</th>
                                                    <th scope="col" colspan="2">Payment Status</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>01/09/2024</td>
                                                    <!--<td>
                                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                                    </td>-->
                                                    <td>30</td>
                                                    <td>QS. Al-Lail</td>
                                                    <td>B</td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>30/08/2024</td>
                                                    <!--<td>
                                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                                    </td>-->
                                                    <td>30</td>
                                                    <td>QS. As-Syams</td>
                                                    <td>A</td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>29/08/2024</td>
                                                    <!--<td>
                                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                                    </td>-->
                                                    <td>30</td>
                                                    <td>QS. As-Syams</td>
                                                    <td>C</td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="text-center">
                                        <a href="#" class="btn btn-primary btn-sm">Tampilkan Lebih Banyak</a>
                                    </div>

                                    <!--<div class="mt-3">
                                        <ul class="pagination pagination-rounded justify-content-center mb-0">
                                            <li class="page-item">
                                                <a class="page-link" href="#">Previous</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Reminder Kegiatan </h4>

                                    <div class="table-responsive">
                                        <table class="table table-centered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">TANGGAL</th>
                                                    <th scope="col">NAMA KEGIATAN</th>
                                                    <th scope="col">JAM</th>
                                                    <th scope="col">TUJUAN</th>
                                                    <th scope="col">KELAS</th>
                                                    <!--<th scope="col" colspan="2">Payment Status</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>15/09/2025</td>
                                                    <!--<td>
                                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                                    </td>-->
                                                    <td>Study Tour</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">11.00</span></td>
                                                    <td>Pocari Pasuruan</td>
                                                    <td>VII</td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>-->
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <td>15/09/2025</td>
                                                    <!--<td>
                                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                                    </td>-->
                                                    <td>Camp</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">11.00</span></td>
                                                    <td>Sekolah</td>
                                                    <td>VII</td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>-->
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <td>15/09/2025</td>
                                                    <!--<td>
                                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                                    </td>-->
                                                    <td>Al-Quran Day</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">11.00</span></td>
                                                    <td>Sekolah</td>
                                                    <td>VII</td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>-->
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="text-center">
                                        <a href="#" class="btn btn-primary btn-sm">Tampilkan Lebih Banyak</a>
                                    </div>

                                    <!--<div class="mt-3">
                                        <ul class="pagination pagination-rounded justify-content-center mb-0">
                                            <li class="page-item">
                                                <a class="page-link" href="#">Previous</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </div>-->
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Data Pelanggaran</h4>

                                   <div class="table-responsive">
                                        <table class="table table-centered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">TANGGAL</th>
                                                    <th scope="col">NAMA</th>
                                                    <th scope="col">KELAS</th>
                                                    <th scope="col">PELANGGARAN</th>
                                                    <th scope="col">POINT </th>
                                                    <th scope="col">TOTAL POIN</th>
                                                    <!--<th scope="col">Amount</th>
                                                    <th scope="col" colspan="2">Payment Status</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>15/09/2025</td>
                                                    <!--<td>
                                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                                    </td>-->
                                                    <td>Roby</td>
                                                    <td>VII Putra</td>
                                                    <td>Tidur saat jam pelajaran</td>
                                                    <td>5</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">10</span></td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>-->
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>15/09/2025</td>
                                                    <!--<td>
                                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                                    </td>-->
                                                    <td>Roby</td>
                                                    <td>VII Putra</td>
                                                    <td>Kabur</td>
                                                    <td>5</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">10</span></td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>-->
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>15/09/2025</td>
                                                    <!--<td>
                                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                                    </td>-->
                                                    <td>Roby</td>
                                                    <td>VII Putra</td>
                                                    <td>Kabur</td>
                                                    <td>5</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">10</span></td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>-->
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="text-center">
                                        <a href="#" class="btn btn-primary btn-sm">Tampilkan Lebih Banyak</a>
                                    </div>

                                    <!--<div class="mt-3">
                                        <ul class="pagination pagination-rounded justify-content-center mb-0">
                                            <li class="page-item">
                                                <a class="page-link" href="#">Previous</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Laporan Pengumpulan Tugas</h4>

                                    <div class="table-responsive">
                                        <table class="table table-centered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">NAMA</th>
                                                    <th scope="col">KELAS</th>
                                                    <th scope="col">JENIS TUGAS</th>
                                                    <th scope="col">MATA PELAJARAN</th>
                                                    <th scope="col">GURU</th>
                                                    <th scope="col">TANGGAL PENGUMPULAN</th>
                                                    <th scope="col">NILAI</th>
                                                    <th scope="col">STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Robby</td>
                                                    <td>VII Putra</td>
                                                    <td>UHB</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>RIna, S.Pd</td>
                                                    <td>15/01/2025</td>
                                                    <td>80</td>
                                                    <td><span class="badge badge-soft-success font-size-12">Tuntas</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>Robby</td>
                                                    <td>VII Putra</td>
                                                    <td>UHB</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>RIna, S.Pd</td>
                                                    <td>15/01/2025</td>
                                                    <td>70</td>
                                                    <td><span class="badge badge-soft-warning font-size-12">Remidi</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>Robby</td>
                                                    <td>VII Putra</td>
                                                    <td>UHB</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>RIna, S.Pd</td>
                                                    <td>15/01/2025</td>
                                                    <td>0</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">Tidak Mengumpulkan</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>Robby</td>
                                                    <td>VII Putra</td>
                                                    <td>UHB</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>RIna, S.Pd</td>
                                                    <td>15/01/2025</td>
                                                    <td>85</td>
                                                    <td><span class="badge badge-soft-success font-size-12">Tuntas</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-3">
                                        <ul class="pagination pagination-rounded justify-content-center mb-0">
                                            <li class="page-item">
                                                <a class="page-link" href="#">Sebelumnya</a>
                                            </li>
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

@endsection
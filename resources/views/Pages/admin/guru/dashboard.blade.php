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
                                        <li class="breadcrumb-item active">Selamat Datang Di Guru Dashboard</li>
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
                                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                                <i class="mdi mdi-account-multiple-outline"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-size-16 mt-2">Materi</div>
                                        </div>
                                    </div>
                                    <h4 class="mt-4">80</h4>
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
                                                <i class="mdi mdi-account-multiple-outline"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-size-16 mt-2">Kelas</div>

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
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Kehadiran Siswa Kelas</h4>

                                    <div class="table-responsive">
                                        <table class="table table-centered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">TANGGAL </th>
                                                    <th scope="col">NAMA</th>
                                                    <th scope="col">STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>15/01/2025</td>
                                                    <td>Robby</td>
                                                    <td><span class="badge badge-soft-success font-size-12">Hadir</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>15/01/2025</td>
                                                    <td>Robby</td>
                                                    <td><span class="badge badge-soft-warning font-size-12">izin</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>15/01/2025</td>
                                                    <td>Robby</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">Alfa</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>15/01/2025</td>
                                                    <td>Robby</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">Alfa</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
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
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Masuk Aktif Pembelajaran</h4>

                                    <div class="table-responsive">
                                        <table class="table table-centered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">TANGGAL</th>
                                                    <th scope="col">NAMA</th>
                                                    <th scope="col">KELAS</th>
                                                    <th scope="col">MATA PELAJARAN</th>
                                                    <th scope="col">GURU</th>
                                                    <th scope="col">STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>15/01/2025</td>
                                                    <td>Robby</td>
                                                    <td>VII Putra</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>Rina, S.Pd</td>
                                                    <td><span class="badge badge-soft-success font-size-12">Masuk</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>15/01/2025</td>
                                                    <td>Rio</td>
                                                    <td>VII Putra</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>Rina, S.Pd</td>
                                                    <td><span class="badge badge-soft-success font-size-12">Masuk</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>15/01/2025</td>
                                                    <td>Rama</td>
                                                    <td>VII Putra</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>Rina, S.Pd</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">Keluar</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                <tr>
                                                    <td>15/01/2025</td>
                                                    <td>Riko</td>
                                                    <td>VII Putra</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>Rina, S.Pd</td>
                                                    <td><span class="badge badge-soft-success font-size-12">Masuk</span></td>
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
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                    <td><div class="row">
                                                        <div class="col-5 align-self-center">
                                                            <div class="progress progress-sm">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%"
                                                    aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <p class="mb-0"><span class="text-success me-2"> 62% </span></p>
                                                        </div>
                                                    </div></td>
                                                </tr>
                                                <tr>
                                                    <td>15/09/2025</td>
                                                    <td>Matematika</td>
                                                    <td>Narasi</td>
                                                    <td>Rita, S.Pd</td>
                                                    <td>Berhitung</td>
                                                    <td>VIII Putri</td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                    <td><div class="row">
                                                        <div class="col-5 align-self-center">
                                                            <div class="progress progress-sm">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%"
                                                    aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <p class="mb-0"><span class="text-success me-2"> 62% </span></p>
                                                        </div>
                                                    </div></td>
                                                </tr>
                                                <tr>
                                                    <td>15/09/2025</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>Narasi</td>
                                                    <td>Hilda, S.Pd</td>
                                                    <td>Membaca</td>
                                                    <td>IX Putri</td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                    <td><div class="row">
                                                        <div class="col-5 align-self-center">
                                                            <div class="progress progress-sm">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 82%"
                                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <p class="mb-0"><span class="text-success me-2"> 82% </span></p>
                                                        </div>
                                                    </div></td>
                                                </tr>
                                                <tr>
                                                    <td>15/09/2025</td>
                                                    <td>Bahasa Inggris</td>
                                                    <td>Narasi</td>
                                                    <td>Guru</td>
                                                    <td>Membaca</td>
                                                    <td>VII Putri</td>
                                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                                    </td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                    <td><div class="row">
                                                        <div class="col-5 align-self-center">
                                                            <div class="progress progress-sm">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 70%"
                                                    aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <p class="mb-0"><span class="text-success me-2"> 70% </span></p>
                                                        </div>
                                                    </div></td>
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
                                                    <td>Bahasa Indonesia</td>
                                                    <td>Rina, S.Pd.</td>
                                                    <td><span class="badge badge-soft-success font-size-12">Sakit</span></td>
                                                    <td><span class="badge badge-soft-warning font-size-12">LKS Halaman 15</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                 <tr>
                                                    <td>15/01/2025</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">07.00 - 09.00</span></td>
                                                    <td>VII Putri</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>Rina, S.Pd.</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">Tanpa Keterangan</span></td>
                                                    <td><span class="badge badge-soft-warning font-size-12">LKS Halaman 15</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                 <tr>
                                                    <td>15/01/2025</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">07.00 - 09.00</span></td>
                                                    <td>VII Putri</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>Rina, S.Pd.</td>
                                                    <td><span class="badge badge-soft-warning font-size-12">Izin</span></td>
                                                    <td><span class="badge badge-soft-warning font-size-12">LKS Halaman 15</span></td>
                                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                                </tr>
                                                 <tr>
                                                    <td>15/01/2025</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">07.00 - 09.00</span></td>
                                                    <td>VII Putri</td>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>Rina, S.Pd.</td>
                                                    <td><span class="badge badge-soft-success font-size-12">Sakit</span></td>
                                                    <td><span class="badge badge-soft-warning font-size-12">LKS Halaman 15</span></td>
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
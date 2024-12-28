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

    {{-- BK Dashboard --}}
    @if ($SectionType->section->section == 'BK' || $SectionType->section->section == 'bk')
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
                            <p>Sistem Informasi Manajemen Sekolah UTSMAN BIN AFFAN yang memiliki beberapa modul terintegrasi
                                yang dapat diakses oleh semua anggota sekolah, antara lain guru, wali kelas, pegawai
                                sekolah, siswa dan orang tua / wali siswa.
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
                        <div class="row mt-4">
                            <div class="col-6">
                                <p class="mb-0"><span class="badge badge-soft-success me-2" style="font-size: 12px;">Total </span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="">{{ $amountKelas }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Kehadiran Siswa Kelas</h4>

                        <div class="table-responsive">
                            <table class="table table-centered">
                                <thead>
                                    <tr>
                                        <th scope="col">TANGGAL </th>
                                        <th scope="col">NAMA</th>
                                        <th scope="col">KELAS</th>
                                        <th scope="col">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>15/01/2025</td>
                                        <td>Robby</td>
                                        <td>VII Putra</td>
                                        <td><span class="badge badge-soft-success font-size-12">Hadir</span></td>
                                        <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                    </tr>
                                    <tr>
                                        <td>15/01/2025</td>
                                        <td>Robby</td>
                                        <td>VII Putra</td>
                                        <td><span class="badge badge-soft-warning font-size-12">izin</span></td>
                                        <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                    </tr>
                                    <tr>
                                        <td>15/01/2025</td>
                                        <td>Robby</td>
                                        <td>VII Putra</td>
                                        <td><span class="badge badge-soft-danger font-size-12">Alfa</span></td>
                                        <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                    </tr>
                                    <tr>
                                        <td>15/01/2025</td>
                                        <td>Robby</td>
                                        <td>VII Putra</td>
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

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Data Bimbingan Konseling</h4>

                        <div class="table-responsive">
                            <table class="table table-centered">
                                <thead>
                                    <tr>
                                        <th scope="col">TANGGAL</th>
                                        <th scope="col">NAMA</th>
                                        <th scope="col">KELAS</th>
                                        <th scope="col">JENIS KONSELING</th>
                                        <th scope="col">SARAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($amountDataBimbinganKonseling as $DataKonseling)
                                    <tr>
                                        <td>{{ $DataKonseling->tahunajaran->tahun_ajaran }}</td>
                                        <td>{{ $DataKonseling->siswa->nama_lengkap }}</td>
                                        <td>{{ $DataKonseling->kelas->nama_kelas }}</td>
                                        <td>{{ $DataKonseling->bimbingankoseling->jenis_konseling }}</td>
                                        <td>{{ $DataKonseling->saran }}.</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            <div class="d-flex justify-content-start">
                                {{ $amountDataBimbinganKonseling->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    {{-- end BK Dashboard --}}
    {{-- kesiswaan Dasboard --}}
    @elseif($SectionType->section->section == "Kesiswaan" || $SectionType->section->section == "kesiswaan")
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
                    <div class="row mt-4">
                        <div class="col-6">
                            <p class="mb-0"><span class="badge badge-soft-success me-2" style="font-size: 12px;">Total </span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="">{{ $amountKelas }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Kehadiran Siswa Kelas</h4>

                    <div class="table-responsive">
                        <table class="table table-centered">
                            <thead>
                                <tr>
                                    <th scope="col">TANGGAL </th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">KELAS</th>
                                    <th scope="col">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>15/01/2025</td>
                                    <td>Robby</td>
                                    <td>VII Putra</td>
                                    <td><span class="badge badge-soft-success font-size-12">Hadir</span></td>
                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                </tr>
                                <tr>
                                    <td>15/01/2025</td>
                                    <td>Robby</td>
                                    <td>VII Putra</td>
                                    <td><span class="badge badge-soft-warning font-size-12">izin</span></td>
                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                </tr>
                                <tr>
                                    <td>15/01/2025</td>
                                    <td>Robby</td>
                                    <td>VII Putra</td>
                                    <td><span class="badge badge-soft-danger font-size-12">Alfa</span></td>
                                    <!--<td><a href="#" class="btn btn-primary btn-sm">View</a></td>-->
                                </tr>
                                <tr>
                                    <td>15/01/2025</td>
                                    <td>Robby</td>
                                    <td>VII Putra</td>
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

    <div class="row">
        <div class="col-xl-6">
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
                    <div class="d-flex justify-content-center">
                        {{ $amountRencanaKegiatan->links() }}
                    </div>
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
                                    <th scope="col">TAHUN AJARAN</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">KELAS</th>
                                    <th scope="col">PELANGGARAN</th>
                                    <th scope="col">SANKSI PELANGGARAN</th>
                                    <th scope="col">SUB TOTAL POINT</th>
                                    <th scope="col">TOTAL POIN</th>
                                    <!--<th scope="col">Amount</th>
                                    <th scope="col" colspan="2">Payment Status</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach($amountDataPelanggaran as $DataPelanggaran)
                                        <td>{{ $DataPelanggaran->tahunajaran->tahun_ajaran }}</td>
                                        <td>{{ $DataPelanggaran->siswa->nama_lengkap }}</td>
                                        <td>{{ $DataPelanggaran->kelas->nama_kelas }}</td>
                                        <td>{{ $DataPelanggaran->sanksipelanggaran->bentuK_sanksi }}</td>
                                        <td>{{ $DataPelanggaran->subtotal_poin }}</td>
                                        <td>{{ $DataPelanggaran->total_poin }}</td>
                                        <td><span class="badge badge-soft-danger font-size-12">10</span></td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $amountDataPelanggaran->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end kesiswaaan menu --}}
    
    {{-- walikelas Dahsboard  --}}
    @elseif($SectionType->section->section == "Wali Kelas" || $SectionType->section->section == "wali Kelas")
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
                    </div>
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

        <div class="col-xl-3">
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
                    <div class="row mt-4">
                        <div class="col-6">
                            <p class="mb-0"><span class="badge badge-soft-success me-2" style="font-size: 12px;">Total </span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="">{{ $amountKelas }}</p>
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
                                    <td>VII Putra</td>
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
                                    <td>VII Putri</td>
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
                                    <td>VII Putra</td>
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
                                    <th scope="col">NAMA SISWA</th>
                                    <th scope="col">KELAS</th>
                                    <th scope="col">JILID</th>
                                    <th scope="col">CAPAIAN</th>
                                    <!--<th scope="col" colspan="2">Payment Status</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Roby</td>
                                    <!--<td>
                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                    </td>-->
                                    <td>VII Putra</td>
                                    <td>Jilid 3</td>
                                    <td>Halaman 2</td>
                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                    </td>-->
                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                                <tr>
                                    <td>Rani</td>
                                    <!--<td>
                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                    </td>-->
                                    <td>VII Putra</td>
                                    <td>Jilid 3</td>
                                    <td>Halaman 12</td>
                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                    </td>-->
                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                                <tr>
                                    <td>Riko</td>
                                    <!--<td>
                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                    </td>-->
                                    <td>VII Putra</td>
                                    <td>Jilid 3</td>
                                    <td>Halaman 2</td>
                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                    </td>-->
                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
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
                                    <th scope="col">NAMA SISWA</th>
                                    <th scope="col">KELAS</th>
                                    <th scope="col">JUZ</th>
                                    <th scope="col">CAPAIAN</th>
                                    <!--<th scope="col">Amount</th>
                                    <th scope="col" colspan="2">Payment Status</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tio</td>
                                    <!--<td>
                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                    </td>-->
                                    <td>VII Putra</td>
                                    <td>29</td>
                                    <td>QS. Al-Mulk</td>
                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                    </td>-->
                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                                <tr>
                                    <td>Leo</td>
                                    <!--<td>
                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                    </td>-->
                                    <td>VII Putra</td>
                                    <td>30</td>
                                    <td>QS. An-Naba'</td>
                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                    </td>-->
                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                                <tr>
                                    <td>Linda</td>
                                    <!--<td>
                                        <a href="#" class="text-body fw-medium">#SK1235</a>
                                    </td>-->
                                    <td>VII Putra</td>
                                    <td>30</td>
                                    <td>QS. As-Syams</td>
                                    <!--<td><span class="badge badge-soft-success font-size-12">Paid</span>
                                    </td>-->
                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
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
                                    <td>Rina, S.Pd</td>
                                    <td>15/01/2025</td>
                                    <td>80</td>
                                    <td><span class="badge badge-soft-success font-size-12">Tuntas</span></td>
                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                                <tr>
                                    <td>Robby</td>
                                    <td>VII Putra</td>
                                    <td>UHB</td>
                                    <td>Bahasa Indonesia</td>
                                    <td>Rina, S.Pd</td>
                                    <td>15/01/2025</td>
                                    <td>70</td>
                                    <td><span class="badge badge-soft-warning font-size-12">Remidi</span></td>
                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                                <tr>
                                    <td>Robby</td>
                                    <td>VII Putra</td>
                                    <td>UHB</td>
                                    <td>Bahasa Indonesia</td>
                                    <td>Rina, S.Pd</td>
                                    <td>15/01/2025</td>
                                    <td>0</td>
                                    <td><span class="badge badge-soft-danger font-size-12">Tidak Mengumpulkan</span></td>
                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                                <tr>
                                    <td>Robby</td>
                                    <td>VII Putra</td>
                                    <td>UHB</td>
                                    <td>Bahasa Indonesia</td>
                                    <td>Rina, S.Pd</td>
                                    <td>15/01/2025</td>
                                    <td>85</td>
                                    <td><span class="badge badge-soft-success font-size-12">Tuntas</span></td>
                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
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
    {{-- end walikelas Dashboard --}}

    {{-- Default guru Dashboard --}}
    @else 
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
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Keaktifan Guru Per Bulan</h4>

                    <div id="line-chart" class="apex-charts"></div>
                </div>
            </div>
        </div>-->

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
                    <div class="row mt-4">
                        <div class="col-6">
                            <p class="mb-0"><span class="badge badge-soft-success me-2" style="font-size: 12px;">Total </span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="">{{ $amountKelas }}</p>
                        </div>
                    </div>
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
    {{-- end Default guru Dashboard --}}
    @endif
    </div>
@endsection

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
                                    {{-- <th scope="col">NAMA</th>
                                    <th scope="col">KELAS</th> --}}
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
                                        {{-- <td>{{ $DataPelanggaran->siswa->nama_lengkap }}</td> --}}
                                        {{-- <td>{{ $DataPelanggaran->kelas->nama_kelas }}</td> --}}
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
                                    <th>JUDUL</th>
                                    <th>DESKRIPSI</th>
                                    <th>DEADLINE</th>
                                    <td>SISWA</td>
                                    <th>KELAS</th>
                                    <th>TAHUN AJARAN</th>
                                    <th>MATA PELAJARAN</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($amountTugasSiswa as $item)
                                <tr>
                                    <td>{{ $item->judul }} </td>
                                    <td>{{ $item->deskripsi }} </td>
                                    <td>{{ $item->deadline }} </td>
                                    <td>{{ $item->kelas->nama_kelas }} </td>
                                    <td>{{ $item->tahunajaran->tahun_ajaran }} </td>
                                    <td>{{ $item->matapelajaran->mata_pelajaran }} </td>
                                    @if($item->jawaban == null)
                                        <td><span class="badge badge-soft-danger">Tidak Ada</span></td>
                                    @else
                                        <td><span class="badge badge-soft-danger">Selesai</span></td>
                                    @endif
                                    <td style="width: 150px">
                                        @if($item->jawaban != null)
                                            <a class="btn btn-outline-success btn-sm edit" title="preview" href="{{ '/storage/' . $item->jawaban }} " target="_blank">
                                                <i class="fas fa-comment"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $amountTugasSiswa->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    
</div>

@endsection
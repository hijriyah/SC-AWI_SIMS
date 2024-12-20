@extends('layouts.layout')

<div class="vertical-menu">

   <div class="h-100" style="overflow-y: auto;">
       <div class="user-wid text-center py-4">
           <div class="user-img">
                @if($specAdmin == "Administrator")
                    <img class="rounded-circle header-profile-user" style="width: 80px; height: 80px;" src="data:image/jpeg;base64,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" 
                        alt="Header Avatar">
                @elseif($specAdmin == "Guru")
                    @if(session("GuruPhotoProfile") != null)
                        <img class="rounded-circle header-profile-user" style="width: 80px; height: 80px;" src="{{ '/storage/' . session('GuruPhotoProfile') }}" />
                    @else 
                        <img class="rounded-circle header-profile-user" style="width: 80px; height: 80px;" src="data:image/jpeg;base64,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" 
                    alt="Header Avatar">
                    @endif
                @elseif($specAdmin == "Siswa")
                    @if(session("SiswaPhotoProfile") != null)
                        <img class="rounded-circle header-profile-user" style="width: 80px; height: 80px;" src="{{ '/storage/' . session('SiswaPhotoProfile') }}" />
                    @else 
                        <img class="rounded-circle header-profile-user" style="width: 80px; height: 80px;" src="data:image/jpeg;base64,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" 
                    alt="Header Avatar">
                    @endif
                @elseif($specAdmin == "Orang tua")
                    @if(session("OrangtuaPhotoProfile") != null)
                        <img class="rounded-circle header-profile-user" style="width: 80px; height: 80px;" src="{{ '/storage/' . session('OrangtuaPhotoProfile') }}" />
                    @else 
                        <img class="rounded-circle header-profile-user" style="width: 80px; height: 80px;" src="data:image/jpeg;base64,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" 
                    alt="Header Avatar">
                    @endif
                @endif
           </div>

           <div class="mt-3">
               <a href="#" class="text-body fw-medium font-size-16"> {{ $adminSession }}</a>
               {{-- <p class="text-muted mt-1 mb-0 font-size-13">UI/UX Designer</p> --}}
           </div>
       </div>

       <!--- Sidemenu -->
       <div id="sidebar-menu" >
           <!-- Left Menu Start -->
           {{-- start Administrator Role --}}
            <ul class="metismenu list-unstyled" id="side-menu">
                @if($adminSession == "Administrator")
                    {{-- start Dashboard Menu --}}
                    <li class="menu-title">Main Menu</li>
                    
                    {{-- start Master Menu --}}
                    <li>
                        <a href="{{ route('admin_dashboard') }}">
                            <i class="mdi mdi-home"></i>
                            <span>{{ $listMenu['Dashboard'] }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-crown"></i>
                            <span>{{ $listMenu['Master'] }}</span>
                                
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('staff_master_page') }}">{{ $listMenu['Staff'] }}</a></li>    
                                <li><a href="{{ route('guru_master_page') }}">{{ $listMenu['Guru'] }}</a></li>
                                <li><a href="{{ route('siswa_master_page') }}">{{ $listMenu['Siswa'] }}</a></li>
                                <li><a href="{{ route('orangtua_master_page') }}">{{ $listMenu['Orang Tua'] }}</a></li>
                            </ul>
                        </li>
                    
                    {{-- end Master Menu --}}
                    {{-- start Akademik Menu --}}
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-school-outline"></i>
                            <span>{{ $listMenu['Akademik'] }}</span>
                        </a>
                            
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('akademik_kelas_page') }}">{{ $listMenu['Kelas'] }}</a></li>    
                            <li><a href="{{ route('akademik_section_page') }}">{{ $listMenu['Section'] }}</a></li>
                            <li><a href="{{ route('akademik_tugassiswa_page') }}">{{ $listMenu['Tugas Siswa'] }}</a></li>   
                            <li><a href="{{ route('akademik_matapelajaran_page') }}">{{ $listMenu['Mata Pelajaran'] }}</a></li>   
                            <li><a href="{{ route('akademik_materimatapelajaran_page') }}">{{ $listMenu['Materi'] }}</a></li>
                                
                                {{-- @if( isset($listMenu['Jurnal Harian']
                                    <li><a href="index-2.html">{{ $listMenu['Jurnal Harian'] }}</a></li>
                                 --}}
                            </ul>
                    </li>
                    {{-- end Akademik Menu --}}
                    {{-- start Kehadiran Menu --}}
                        <li>
                            <a href="calendar.html" class="waves-effect">
                                <i class="mdi mdi-calendar-text"></i>
                                <span>{{ $listMenu['Kehadiran'] }}</span>
                            </a>
                        </li>
                    
                    {{-- end Kehadiran Menu --}}
                    {{-- start Al-Quran Menu --}}
                       <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-book-open-page-variant"></i>
                                <span>{{ $listMenu['Al-Quran'] }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('alquran_kriteriapenilaianalquran_page') }}" class="">{{ $listMenu['Kriteria Penilaian Alquran']}}</a></li>
                                <li><a href="javascript: void(0);" class="has-arrow waves-effect">{{ $listMenu['Tahsin'] }}</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="{{ route('alquran_tahsin_kategoritahsin_page') }}">{{ $listMenu['Kategori Tahsin'] }}</a></li>
                                        <li><a href="{{ route('alquran_tahsin_pemetaantahsin_page') }}">{{ $listMenu['Pemetaan Tahsin'] }}</a></li>
                                        <li><a href="{{ route('alquran_tahsin_capaiantahsin_page') }}">{{ $listMenu['Capaian Tahsin'] }}</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('alquran_tahfidz_page') }}" class="">{{ $listMenu['Tahfiz'] }}</a></li>
                            </ul>
                       </li>

                    {{-- end Al-Quran Menu --}}
                    {{-- start QA Menu --}}
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-comment-question-outline"></i>
                                <span>{{ $listMenu['QA'] }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('qa_materiqa_page') }}" class="">{{ $listMenu['Materi QA'] }}</a></li>
                                
                                    <li><a href="{{ route('qa_capaianqa_page') }}" class="">{{ $listMenu['Capaian QA'] }}</a></li>
                                
                                {{-- <li><a href="javascript: void(0);" class="">{{ isset($listMenu[15] }}</a></li> --}}
                            </ul>
                        </li>
                    
                    {{-- end QA menu --}}
                    {{-- start Ujian Menu --}}
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="mdi mdi-book-minus"></i>
                             <span>{{ $listMenu['Ujian'] }}</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                                 <li><a href="{{ route('ujian_rencanaujian_page') }}" class="">{{ $listMenu['Rencana Ujian'] }}</a></li>
                             
                                 <li><a href="{{ route('ujian_jadwalujian_page') }}" class="">{{ $listMenu['Jadwal Ujian'] }}</a></li>
                             
                                 <li><a href="{{ route('ujian_kehadiransiswaujian_page') }}" class="">{{ $listMenu['Kehadiran Siswa Ujian'] }}</a></li>
                             
                                <li><a href="javascript: void(0);" class="has-arrow">{{ $listMenu['Input Soal'] }}</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="{{ route('ujian_kategorisoal_page') }}">{{ $listMenu['Kategori Soal'] }}</a></li>
                                        
                                            <li><a href="{{ route('ujian_banksoal_page')}}" class="">{{ $listMenu['Bank Soal'] }}</a></li>
                                        
                                    </ul>
                                </li>
                            
                                <li><a href="javascript: void(0);" class="has-arrow">{{ $listMenu['Ambil Ujian'] }}</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="{{ route('ujian_intruksiujian_page')}}">{{ $listMenu['Intruksi Ujian'] }}</a></li>
                                        
                                            <li><a href="{{ route('ujian_mulaiujian_page') }}" class="">{{ $listMenu['Mulai Ujian'] }}</a></li>
                                        
                                    </ul>
                                </li>
                            
                         </ul>
                    </li>
                    
                    {{-- end Ujian Menu --}}
                    {{-- start Penilaian Menu --}}
                        <!--<li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-star-half"></i>
                                <span>{{ $listMenu['Jenis Penilaian'] }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Tipe Penilaian'] }}</a></li>
                                
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['ATP'] }}</a></li>
                                
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Predikat'] }}</a></li>
                                
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Aspek Penilaian Sikap'] }}</a></li>
                                
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Penilaian Umum'] }}</a></li>
                                
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Penilaian Sikap'] }}</a></li>
                                
                                {{-- <li><a href="javascript: void(0);" class="">{{ isset($listMenu[20] }}</a></li> --}}
                            </ul>
                        </li>-->
                    
                    {{-- end Penilaian Menu --}}
                    {{-- start Jurnal Menu --}}
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-book-multiple"></i>
                                <span>{{ $listMenu['Jurnal'] }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('jurnal_jurnalkelas_page')}}" class="">{{ $listMenu['Jurnal Kelas'] }}</a></li>
                                
                                    <li><a href="{{ route('jurnal_jurnalbk_page')}}" class="">{{ $listMenu['Jurnal BK'] }}</a></li>
                                
                                    <li><a href="{{ route('jurnal_jurnalkesiswaan_page')}}" class="">{{ $listMenu['Jurnal Kesiswaan'] }}</a></li>
                                
                            </ul>
                        </li>
                    
                    {{-- end Jurnal Menu --}}
                    {{-- start Raport Menu --}}
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-book-open"></i>
                            <span>{{ $listMenu['Raport'] }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('raport_nilairaport_page')}}" class="">{{ $listMenu['Nilai Raport'] }}</a></li>
                                <li><a href="{{ route('raport_nilaiumum_page')}}" class="">{{ $listMenu['Nilai Umum'] }}</a></li>
                                <li><a href="{{ route('raport_nilaisikap_page')}}" class="">{{ $listMenu['Nilai Sikap'] }}</a></li>
                                <li><a href="{{ route('raport_nilaiekstrakurikuler_page')}}" class="">{{ $listMenu['Nilai Ekstrakurikuler'] }}</a></li>
                                <li><a href="{{ route('raport_kkm_page')}}" class="">{{ $listMenu['Kkm'] }}</a></li>
                                <li><a href="{{ route('raport_kategoripenilaiansikap_page')}}" class="">{{ $listMenu['Kategori Penilaian Siswa'] }}</a></li>
                                <li><a href="{{ route('raport_jumlahketidakhadiran_page')}}" class="">{{ $listMenu['Jumlah Ketidakhadiran'] }}</a></li>
                                <li><a href="{{ route('raport_juaraumum_page')}}" class="">{{ $listMenu['Juara Umum'] }}</a></li>
                                <li><a href="{{ route('raport_juarakelas_page')}}" class="">{{ $listMenu['Juara Kelas'] }}</a></li>
                                <li><a href="{{ route('raport_identitassekolah_page')}}" class="">{{ $listMenu['Identitas Sekolah'] }}</a></li>
                                <li><a href="{{ route('raport_catatanwalikelas_page')}}" class="">{{ $listMenu['Catatan Wali Kelas'] }}</a></li>
                        </ul>
                    </li>
                    {{-- end Raport Menu --}}
                    {{-- end Dashboard Menu --}}

                    {{-- start Kesiswaan & BK Menu --}}
                    {{-- start Kesiswaan Menu --}}
                        <li class="menu-title"><span> {{ $listMenu['Kesiswaan & BK'] }}</span></li>
                        <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-face"></i>
                                    <span>{{ $listMenu['Kesiswaan'] }}</span>
                                </a>
                            
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('kesiswaan_tatatertib_page') }}" class="">{{ $listMenu['Tata Tertib'] }}</a></li>
                                    <li><a href="{{ route('kesiswaan_pelanggaran_page') }}" class="">{{ $listMenu['Pelanggaran'] }}</a></li>
                                    <li><a href="{{ route('kesiswaan_sanksipelanggaran_page') }}" class="">{{ $listMenu['Sanksi Pelanggaran'] }}</a></li>
                                    <li><a href="{{ route('kesiswaan_datapelanggaran_page') }}" class="">{{ $listMenu['Data Pelanggaran'] }}</a></li>
                                
                            </ul>
                        </li>
                        <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-clipboard-outline"></i>
                                    <span>{{ $listMenu['Bimbingan Konseling'] }}</span>
                                </a>
                            
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('bk_bimbingankonseling_page') }}" class="">{{ $listMenu['Bimbingan Konseling'] }}</a></li>
                                <li><a href="{{ route('bk_databimbingankonseling_page') }}" class="">{{ $listMenu['Data Bimbingan Konseling'] }}</a></li>
                                {{-- <li><a href="javascript: void(0);" class="">{{ isset($listMenu[49] }}</a></li> --}}
                            </ul>
                        </li>
                    
                    {{-- end Kesiswaan Menu --}}
                    {{-- start BK --}}
                    <!--<li class="menu-title"><span> {{ $listMenu['Bimbingan Konseling (BK)'] }}</span></li>
                        <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-clipboard-outline"></i>
                                    <span>{{ $listMenu['Bimbingan Konseling (BK)'] }}</span>
                                </a>
                            
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('bk_bimbingankonseling_page') }}" class="">{{ $listMenu['Bimbingan Konseling'] }}</a></li>
                                <li><a href="{{ route('bk_databimbingankonseling_page') }}" class="">{{ $listMenu['Data Bimbingan Konseling'] }}</a></li>
                                {{-- <li><a href="javascript: void(0);" class="">{{ isset($listMenu[49] }}</a></li> --}}
                            </ul>
                        </li>-->
                    
                    {{-- end BK --}}
                    {{-- end Kesiswaan & BK Menu --}}

                    {{-- start Buku & Media --}}
                    <li class="menu-title"><span>{{ $listMenu['Buku & Media'] }}</span></li>
                        <li>
                            <li>
                                <a href="{{ route('bukumedia_ebooks_page') }}" class="">
                                    <i class="mdi mdi-book"></i>
                                    <span>{{ $listMenu['E-Books'] }}</span>
                                </a>
                            </li>
                            {{-- $listMenu['Buku Induk Siswa']
                                <a href="javascript: void(0);" class="">
                                    <i class="mdi mdi-book-open"></i>
                                    <span>{{ $listMenu['Buku Induk Siswa'] }}</span>
                                </a>
                             --}}
                            <li>
                                <a href="{{ route('bukumedia_mediaparent_page') }}" class="">
                                    <i class="mdi mdi-bulletin-board"></i>
                                    <span>{{ $listMenu['Media Pembelajaran'] }}</span>
                                </a>
                             </li>
                            
                        </li>
                    
                    {{-- end Buku & Media --}}
                    {{-- start Aset Sekolah --}}
                        <li class="menu-title"><span>{{ $listMenu['Aset Sekolah'] }}</span></li>
                        <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-folder"></i>
                                    <span>{{ $listMenu['Arsip Guru'] }}</span>
                                </a>
                            
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('arsipguru_kategoriarsip_page') }}" class="">{{ $listMenu['Kategori Arsip'] }}</a></li>
                                    <li><a href="{{ route('arsipguru_uploadarsip_page') }}" class="">{{ $listMenu['Upload Arsip'] }}</a></li>
                                    <li><a href="{{ route('arsipguru_rekapkelengkapanarsip_page') }}" class="">{{ $listMenu['Rekap Kelengkapan Arsip'] }}</a></li>
                                
                            </ul>
                        </li>
                        <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-archive"></i>
                                    <span>{{ $listMenu['Inventaris'] }}</span>
                                </a>
                            
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('inventaris_kategoribarang_page') }}" class="">{{ $listMenu['Kategori Barang'] }}</a></li>
                                    <li><a href="{{ route('inventaris_lokasibarang_page') }}" class="">{{ $listMenu['Lokasi Barang'] }}</a></li>
                                    <li><a href="{{ route('inventaris_barangmasuk_page') }}" class="">{{ $listMenu['Barang Masuk'] }}</a></li>
                                    <li><a href="{{ route('inventaris_barangkeluar_page') }}" class="">{{ $listMenu['Barang Keluar'] }}</a></li>
                                
                            </ul>
                        </li>
                        {{-- <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-account-box"></i>
                                    <span>{{ $listMenu['Alumni'] }}</span>
                                </a>
                            
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Data Alumni'] }}</a></li>
                                
                            </ul>
                        </li> --}}
                    
                    {{-- end Aset Sekolah --}}

                    {{-- start Penjadwalan --}}
                        <li class="menu-title"><span>{{ $listMenu['Penjadwalan'] }}</span></li>
                        <li>
                                <li>
                                    <a href="{{ route('penjadwalan_kalenderakademik_page') }}" class="">
                                        <i class="mdi mdi-calendar-clock"></i>
                                        <span>{{ $listMenu['Kalender Akademik'] }}</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="{{ route('penjadwalan_jadwalpelajaran_page') }}" class="">
                                        <i class="mdi mdi-calendar-multiple"></i>
                                        <span>{{ $listMenu['Jadwal Pelajaran'] }}</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="{{ route('penjadwalan_jadwalpertemuan_page') }}" class="">
                                        <i class="mdi mdi-calendar-multiple-check"></i>
                                        <span>{{ $listMenu['Jadwal Pertemuan'] }}</span>
                                    </a>
                                </li>
                            
                        </li>
                    
                    {{-- end Penjadwalan --}}
                    {{-- start Pemberitahuan --}}
                        <li class="menu-title"><span>{{ $listMenu['Pemberitahuan'] }}</span></li>
                            
                            <li>
                                <a href="{{ route('pemberitahuan_event_page') }}" class="">
                                    <i class="mdi mdi-flag-outline"></i>
                                    <span>{{ $listMenu['Event'] }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pemberitahuan_liburan_page') }}" class="">
                                    <i class="mdi mdi-ticket-confirmation"></i>
                                    <span>{{ $listMenu['Liburan'] }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="">
                                    <i class="mdi mdi-message"></i>
                                    <span>{{ $listMenu['Pesan'] }}</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="javascript: void(0);" class="">
                                    <i class="mdi mdi-email-outline"></i>
                                    <span>{{ $listMenu['Email'] }}</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('pemberitahuan_rencanakegiatan_page') }}" class="">
                                    <i class="mdi mdi-briefcase-check"></i>
                                    <span>{{ $listMenu['Rencana Kegiatan'] }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pemberitahuan_gkmediaparent_page') }}" class="">
                                    <i class="mdi mdi-briefcase-check"></i>
                                    <span>{{ $listMenu['Galeri Kegiatan'] }}</span>
                                </a>
                            </li>

                            <li>
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Kategori Kegiatan'] }}</a></li>
                                
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Nama Kegiatan'] }}</a></li>
                                
                            </ul>
                            </li>
                        </li>
                    
                    {{-- end Pemberitahuan --}}

                    {{-- start Pengaturan --}}
                    <li class="menu-title"><span>{{ $listMenu['Pengaturan'] }}</span></li>
                        <li>
                            <li>
                                <a href="{{ route('pengaturan_tahunajaran_page')}}" class="">
                                    <i class="mdi mdi-calendar"></i>
                                    <span>{{ $listMenu['Tahun Ajaran']}}</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('pengaturan_semester_page')}}" class="">
                                    <i class="mdi mdi-calendar"></i>
                                    <span>{{ $listMenu['Semester']}}</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('pengaturan_role_page') }}" class="">
                                    <i class="mdi mdi-account-multiple"></i>
                                    <span>{{ $listMenu['Roles']}}</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('pengaturan_pengaturansistem_page') }}" class="">
                                    <i class="mdi mdi-settings"></i>
                                    <span>{{ $listMenu['Pengaturan Sistem']}}</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('pengaturan_importfile_page') }}" class="">
                                    <i class="mdi mdi-file-import"></i>
                                    <span>{{ $listMenu['Import File']}}</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="javascript: void(0);" class="">
                                    <i class="mdi mdi-message-alert"></i>
                                    <span>{{ $listMenu['Komplain']}}</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('pengaturan_sosiallink_page') }}" class="">
                                    <i class="mdi mdi-link-variant"></i>
                                    <span>{{ $listMenu['Social Link']}}</span>
                                </a>
                            </li>
                            
                     </li>
                    
                    {{-- end Pengaturan --}}
                @endif
                {{-- end Adminsitrator Role --}}
                
                {{-- start Guru Role --}}
                @if($specAdmin == 'Guru')
                    <li class="menu-title">Main Menu</li>
                        
                    {{-- start Master Menu --}}
                    <li>
                        <a href="{{ route('Guru_Dashboard') }}">
                            <i class="mdi mdi-home"></i>
                            <span>{{ $listMenu['Dashboard'] }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-crown"></i>
                            <span>{{ $listMenu['Master'] }}</span>
                                
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('guru_gurumaster_page') }}">{{ $listMenu['Guru'] }}</a></li>
                                <li><a href="{{ route('guru_siswamaster_page') }}">{{ $listMenu['Siswa'] }}</a></li>
                                <li><a href="{{ route('guru_orangtuamaster_page') }}">{{ $listMenu['Orang Tua'] }}</a></li>
                            </ul>
                        </li>
                    
                    {{-- end Master Menu --}}
                    {{-- start Akademik Menu --}}
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-school-outline"></i>
                            <span>{{ $listMenu['Akademik'] }}</span>
                        </a>
                            
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('guru_akademik-tugassiswa_page') }}">{{ $listMenu['Tugas Siswa'] }}</a></li>   
                            <li><a href="{{ route('guru_akademik_matapelajaran_page') }}">{{ $listMenu['Mata Pelajaran'] }}</a></li>   
                            <li><a href="{{ route('guru_akademik-materi_page') }}">{{ $listMenu['Materi'] }}</a></li>
                                
                                {{-- @if( isset($listMenu['Jurnal Harian']
                                    <li><a href="index-2.html">{{ $listMenu['Jurnal Harian'] }}</a></li>
                                --}}
                            </ul>
                    </li>
                    {{-- end Akademik Menu --}}
                    {{-- start Kehadiran Menu --}}
                        <li>
                            <a href="calendar.html" class="waves-effect">
                                <i class="mdi mdi-calendar-text"></i>
                                <span>{{ $listMenu['Kehadiran'] }}</span>
                            </a>
                        </li>
                    
                    {{-- end Kehadiran Menu --}}
                    {{-- start Al-Quran Menu --}}
                    <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-book-open-page-variant"></i>
                                <span>{{ $listMenu['Al-Quran'] }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('alquran_kriteriapenilaianalquran_page') }}" class="">{{ $listMenu['Kriteria Penilaian Alquran']}}</a></li>
                                <li><a href="javascript: void(0);" class="has-arrow waves-effect">{{ $listMenu['Tahsin'] }}</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="{{ route('alquran_tahsin_kategoritahsin_page') }}">{{ $listMenu['Kategori Tahsin'] }}</a></li>
                                        <li><a href="{{ route('alquran_tahsin_pemetaantahsin_page') }}">{{ $listMenu['Pemetaan Tahsin'] }}</a></li>
                                        <li><a href="{{ route('alquran_tahsin_capaiantahsin_page') }}">{{ $listMenu['Capaian Tahsin'] }}</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('alquran_tahfidz_page') }}" class="">{{ $listMenu['Tahfiz'] }}</a></li>
                            </ul>
                    </li>

                    {{-- end Al-Quran Menu --}}
                    {{-- start QA Menu --}}
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-comment-question-outline"></i>
                                <span>{{ $listMenu['QA'] }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('qa_materiqa_page') }}" class="">{{ $listMenu['Materi QA'] }}</a></li>
                                
                                    <li><a href="{{ route('qa_capaianqa_page') }}" class="">{{ $listMenu['Capaian QA'] }}</a></li>
                                
                                {{-- <li><a href="javascript: void(0);" class="">{{ isset($listMenu[15] }}</a></li> --}}
                            </ul>
                        </li>
                    
                    {{-- end QA menu --}}
                    {{-- start Ujian Menu --}}
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-book-minus"></i>
                            <span>{{ $listMenu['Ujian'] }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                                {{-- <li><a href="{{ route('ujian_rencanaujian_page') }}" class="">{{ $listMenu['Rencana Ujian'] }}</a></li> --}}
                            
                                <li><a href="{{ route('guru_ujian-jadwalujian_page') }}" class="">{{ $listMenu['Jadwal Ujian'] }}</a></li>
                            
                                <li><a href="{{ route('ujian_kehadiransiswaujian_page') }}" class="">{{ $listMenu['Kehadiran Siswa Ujian'] }}</a></li>
                            
                                <li><a href="javascript: void(0);" class="has-arrow">{{ $listMenu['Input Soal'] }}</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="{{ route('guru_ujian-kategorisoal_page') }}">{{ $listMenu['Kategori Soal'] }}</a></li>
                                        
                                            <li><a href="{{ route('guru_ujian-banksoal_page')}}" class="">{{ $listMenu['Bank Soal'] }}</a></li>
                                        
                                    </ul>
                                </li>
                            
                                <li><a href="javascript: void(0);" class="has-arrow">{{ $listMenu['Ambil Ujian'] }}</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="{{ route('guru_ujian-intruksiujian_page')}}">{{ $listMenu['Intruksi Ujian'] }}</a></li>
                                        
                                            <li><a href="{{ route('guru_ujian-mulaiujian_page') }}" class="">{{ $listMenu['Mulai Ujian'] }}</a></li>
                                        
                                    </ul>
                                </li>
                            
                        </ul>
                    </li>
                    
                    {{-- end Ujian Menu --}}
                    {{-- start Penilaian Menu --}}
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-star-half"></i>
                                <span>{{ $listMenu['Jenis Penilaian'] }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Tipe Penilaian'] }}</a></li>
                                
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['ATP'] }}</a></li>
                                
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Predikat'] }}</a></li>
                                
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Aspek Penilaian Sikap'] }}</a></li>
                                
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Penilaian Umum'] }}</a></li>
                                
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Penilaian Sikap'] }}</a></li>
                                
                                {{-- <li><a href="javascript: void(0);" class="">{{ isset($listMenu[20] }}</a></li> --}}
                            </ul>
                        </li>
                    
                    {{-- end Penilaian Menu --}}
                    {{-- start Jurnal Menu --}}
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-book-multiple"></i>
                                <span>{{ $listMenu['Jurnal'] }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('guru_jurnal-jurnalkelas_page')}}" class="">{{ $listMenu['Jurnal Kelas'] }}</a></li>
                                
                                    {{-- <li><a href="{{ route('jurnal_jurnalbk_page')}}" class="">{{ $listMenu['Jurnal BK'] }}</a></li>
                                
                                    <li><a href="{{ route('jurnal_jurnalkesiswaan_page')}}" class="">{{ $listMenu['Jurnal Kesiswaan'] }}</a></li> --}}
                                
                            </ul>
                        </li>
                    
                    {{-- end Jurnal Menu --}}
                    {{-- end Dashboard Menu --}}

                    @if($SectionType->section->section == "Kesiswaan" || $SectionType->section->section == "kesiswaan")
                    {{-- start Kesiswaan & BK Menu --}}
                    {{-- start Kesiswaan Menu --}}
                        <li class="menu-title"><span> {{ $listMenu['Kesiswaan & BK'] }}</span></li>
                        <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-face"></i>
                                    <span>{{ $listMenu['Kesiswaan'] }}</span>
                                </a>
                            
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('guru_kesiswaan-tatatertib_page') }}" class="">{{ $listMenu['Tata Tertib'] }}</a></li>
                                    <li><a href="{{ route('guru_kesiswaan-pelanggaran_page') }}" class="">{{ $listMenu['Pelanggaran'] }}</a></li>
                                    <li><a href="{{ route('guru_kesiswaan-sanksipelanggaran_page') }}" class="">{{ $listMenu['Sanksi Pelanggaran'] }}</a></li>
                                    <li><a href="{{ route('guru_kesiswaan-datapelanggaran_page') }}" class="">{{ $listMenu['Data Pelanggaran'] }}</a></li>
                                
                            </ul>
                        </li>
                    
                    {{-- end Kesiswaan Menu --}}
                    @endif

                    @if($SectionType->section->section == "BK" || $SectionType->section->section == "bk")
                    {{-- start BK --}}
                    <li class="menu-title"><span> {{ $listMenu['Bimbingan Konseling (BK)'] }}</span></li>
                        <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-clipboard-outline"></i>
                                    <span>{{ $listMenu['Bimbingan Konseling'] }}</span>
                                </a>
                            
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('guru_bk-bimbingankonseling_page') }}" class="">{{ $listMenu['Bimbingan Konseling'] }}</a></li>
                                <li><a href="{{ route('guru_bk-databimbingankonseling_page') }}" class="">{{ $listMenu['Data Bimbingan Konseling'] }}</a></li>
                            </ul>
                        </li>
                    
                    {{-- end BK --}}
                    @endif
                    {{-- end Kesiswaan & BK Menu --}}

                    {{-- start Buku & Media --}}
                    <li class="menu-title"><span>{{ $listMenu['Buku & Media'] }}</span></li>
                        <li>
                                <a href="{{ route('guru_bukumedia-ebooks_page') }}" class="">
                                    <i class="mdi mdi-book"></i>
                                    <span>{{ $listMenu['E-Books'] }}</span>
                                </a>
                            
                            {{-- $listMenu['Buku Induk Siswa']
                                <a href="javascript: void(0);" class="">
                                    <i class="mdi mdi-book-open"></i>
                                    <span>{{ $listMenu['Buku Induk Siswa'] }}</span>
                                </a>
                            --}}
                                <a href="{{ route('guru_bukumedia_mediaparent_page') }}" class="">
                                    <i class="mdi mdi-bulletin-board"></i>
                                    <span>{{ $listMenu['Media Pembelajaran'] }}</span>
                                </a>            
                        </li>
                    
                    {{-- end Buku & Media --}}
                    {{-- start Aset Sekolah --}}
                        <li class="menu-title"><span>{{ $listMenu['Aset Sekolah'] }}</span></li>
                        <li>
                                <a href="{{ route('guru_arsipguru_uploadarsip_page')}}" class="has-arrow waves-effect">
                                    <i class="mdi mdi-folder"></i>
                                    <span>{{ $listMenu['Arsip Guru'] }}</span>
                                </a>
                            
                            {{-- <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('arsipguru_kategoriarsip_page') }}" class="">{{ $listMenu['Kategori Arsip'] }}</a></li>
                                    <li><a href="{{ route('arsipguru_uploadarsip_page') }}" class="">{{ $listMenu['Upload Arsip'] }}</a></li>
                                    <li><a href="{{ route('arsipguru_rekapkelengkapanarsip_page') }}" class="">{{ $listMenu['Rekap Kelengkapan Arsip'] }}</a></li>
                                
                            </ul> --}}
                        </li>
                        {{-- <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-archive"></i>
                                    <span>{{ $listMenu['Inventaris'] }}</span>
                                </a>
                            
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('inventaris_kategoribarang_page') }}" class="">{{ $listMenu['Kategori Barang'] }}</a></li>
                                    <li><a href="{{ route('inventaris_lokasibarang_page') }}" class="">{{ $listMenu['Lokasi Barang'] }}</a></li>
                                    <li><a href="{{ route('inventaris_barangmasuk_page') }}" class="">{{ $listMenu['Barang Masuk'] }}</a></li>
                                    <li><a href="{{ route('inventaris_barangkeluar_page') }}" class="">{{ $listMenu['Barang Keluar'] }}</a></li>
                                
                            </ul>
                        </li> --}}
                        {{-- <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-account-box"></i>
                                    <span>{{ $listMenu['Alumni'] }}</span>
                                </a>
                            
                            <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Data Alumni'] }}</a></li>
                                
                            </ul>
                        </li> --}}
                    
                    {{-- end Aset Sekolah --}}

                    {{-- start Penjadwalan --}}
                        <li class="menu-title"><span>{{ $listMenu['Penjadwalan'] }}</span></li>
                        <li>
                                <li>
                                    <a href="{{ route('guru_penjadwalan_kalenderakademik_page') }}" class="">
                                        <i class="mdi mdi-calendar-clock"></i>
                                        <span>{{ $listMenu['Kalender Akademik'] }}</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="{{ route('guru_penjadwalan_jadwalpelajaran_page') }}" class="">
                                        <i class="mdi mdi-calendar-multiple"></i>
                                        <span>{{ $listMenu['Jadwal Pelajaran'] }}</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="{{ route('guru_penjadwalan_jadwalpertemuan_page') }}" class="">
                                        <i class="mdi mdi-calendar-multiple-check"></i>
                                        <span>{{ $listMenu['Jadwal Pertemuan'] }}</span>
                                    </a>
                                </li>
                            
                        </li>
                    
                    {{-- end Penjadwalan --}}
                    {{-- start Pemberitahuan --}}
                        <li class="menu-title"><span>{{ $listMenu['Pemberitahuan'] }}</span></li>
                        <li>
                                <a href="{{ route('guru_pemberitahuan_event_page') }}" class="">
                                    <i class="mdi mdi-flag-outline"></i>
                                    <span>{{ $listMenu['Event'] }}</span>
                                </a>
                            
                                <a href="{{ route('guru_pemberitahuan_liburan_page') }}" class="">
                                    <i class="mdi mdi-ticket-confirmation"></i>
                                    <span>{{ $listMenu['Liburan'] }}</span>
                                </a>
                            
                                <a href="javascript: void(0);" class="">
                                    <i class="mdi mdi-message"></i>
                                    <span>{{ $listMenu['Pesan'] }}</span>
                                </a>
                            
                                <a href="javascript: void(0);" class="">
                                    <i class="mdi mdi-email-outline"></i>
                                    <span>{{ $listMenu['Email'] }}</span>
                                </a>
                                
                                <a href="{{ route('guru_pemberitahuan_rencanakegiatan_page') }}" class="">
                                    <i class="mdi mdi-briefcase-check"></i>
                                    <span>{{ $listMenu['Rencana Kegiatan'] }}</span>
                                </a>
                                
                                {{--<a href="{{ route('pemberitahuan_gkmediaparent_page') }}" class="">
                                    <i class="mdi mdi-briefcase-check"></i>
                                    <span>{{ $listMenu['Galeri Kegiatan'] }}</span>
                                </a> --}}
                                
                                {{-- <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Kategori Kegiatan'] }}</a></li>
                                    <li><a href="javascript: void(0);" class="">{{ $listMenu['Nama Kegiatan'] }}</a></li>
                                </ul> --}}
                        </li>
                    
                    {{-- end Pemberitahuan --}}

                    {{-- start Pengaturan --}}
                    {{-- <li class="menu-title"><span>{{ $listMenu['Pengaturan'] }}</span></li>
                        <li>
                            <li>
                                <a href="javascript: void(0);" class="">
                                    <i class="mdi mdi-message-alert"></i>
                                    <span>{{ $listMenu['Komplain']}}</span>
                                </a>
                            </li>
                        </li>
                    </li> --}}
                @endif
                {{-- end Guru Role --}}

                {{-- Siswa Role --}}
                @if($specAdmin == 'Siswa')
                    <li class="menu-title">Main Menu</li>
                    <li>
                        <a href="{{ route('Siswa_Dashboard') }}">
                            <i class="mdi mdi-home"></i>
                            <span>{{ $listMenu['Dashboard'] }}</span>
                        </a>
                    </li>
                    {{-- start akademik menu --}}
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-school-outline"></i>
                            <span>{{ $listMenu['Akademik'] }}</span>
                        </a>
                            
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('siswa_akademik-tugassiswa_page') }}">{{ $listMenu['Tugas Siswa'] }}</a></li>   
                            <li><a href="{{ route('siswa_akademik_matapelajaran_page') }}">{{ $listMenu['Mata Pelajaran'] }}</a></li>   
                        </ul>
                    </li>
                    {{-- end akademik menu --}}
                    {{-- start ebook & media menu  --}}
                        <li class="menu-title"><span>{{ $listMenu['Buku & Media'] }}</span></li>
                        <li>
                            <li>
                                <a href="{{ route('siswa_bukumedia-ebooks_page') }}" class="">
                                    <i class="mdi mdi-book"></i>
                                    <span>{{ $listMenu['E-Books'] }}</span>
                                </a>
                            </li>
                            {{-- $listMenu['Buku Induk Siswa']
                                <a href="javascript: void(0);" class="">
                                    <i class="mdi mdi-book-open"></i>
                                    <span>{{ $listMenu['Buku Induk Siswa'] }}</span>
                                </a>
                            --}}
                            <li>
                                <a href="{{ route('siswa_bukumedia_mediaparent_page') }}" class="">
                                    <i class="mdi mdi-bulletin-board"></i>
                                    <span>{{ $listMenu['Media Pembelajaran'] }}</span>
                                </a>
                            </li>            
                        </li>
                    {{-- end ebook & media menu --}}

                     {{-- start Penjadwalan --}}
                     <li class="menu-title"><span>{{ $listMenu['Penjadwalan'] }}</span></li>
                     <li>
                             
                             <li>
                                 <a href="{{ route('siswa_penjadwalan_jadwalpelajaran_page') }}" class="">
                                     <i class="mdi mdi-calendar-multiple"></i>
                                     <span>{{ $listMenu['Jadwal Pelajaran'] }}</span>
                                 </a>
                             </li>
                             
                             <li>
                                 <a href="{{ route('siswa_penjadwalan_jadwalpertemuan_page') }}" class="">
                                     <i class="mdi mdi-calendar-multiple-check"></i>
                                     <span>{{ $listMenu['Jadwal Pertemuan'] }}</span>
                                 </a>
                             </li>
                         
                     </li>
                 {{-- end Penjadwalan --}}
                 {{-- start Pemberitahuan --}}
                 <li class="menu-title"><span>{{ $listMenu['Pemberitahuan'] }}</span></li>
                 <li>
                    <li>
                        <a href="{{ route('siswa_pemberitahuan_ekstrakurikuler_page') }}" class="">
                            <i class="mdi mdi-clipboard-list-outline"></i>
                            <span>{{ $listMenu['Ekstrakurikuler'] }}</span>
                        </a>
                    <li>
                    <li>
                        <a href="{{ route('siswa_pemberitahuan_event_page') }}" class="">
                             <i class="mdi mdi-flag-outline"></i>
                             <span>{{ $listMenu['Event'] }}</span>
                         </a>
                    </li>
                    <li>
                         <a href="{{ route('siswa_pemberitahuan_liburan_page') }}" class="">
                             <i class="mdi mdi-ticket-confirmation"></i>
                             <span>{{ $listMenu['Liburan'] }}</span>
                         </a>
                    </li>
                     {{-- <li>
                         <a href="javascript: void(0);" class="">
                             <i class="mdi mdi-email-outline"></i>
                             <span>{{ $listMenu['Email'] }}</span>
                         </a>
                    </li> --}}
                    <li>
                         <a href="{{ route('siswa_pemberitahuan_rencanakegiatan_page') }}" class="">
                             <i class="mdi mdi-briefcase-check"></i>
                             <span>{{ $listMenu['Rencana Kegiatan'] }}</span>
                         </a>
                    </li>
                 </li>
                {{-- end Pemberitahuan --}}
                {{-- start pengaturan --}}
                <li class="menu-title"><span>{{ $listMenu['Pengaturan'] }}</span></li>
                <li>
                    <a href="{{ route('siswa_pengaturan_komplain_page') }}" class="">
                        <i class="mdi mdi-message-alert"></i>
                        <span>{{ $listMenu['Komplain']}}</span>
                    </a>
                </li>
                <li style="margin-bottom: 100px;">
                    <a href="{{ route('siswa_pengaturan_profile_page') }}" class="">
                        <i class="mdi mdi-account-box"></i>
                        <span>{{ $listMenu['Profile'] }}</span>
                    </a>
                </li>
                {{-- end pengaturan --}}
                @endif
                {{-- end Siswa Role --}}

                {{-- start Orangtua Role --}}
                @if($specAdmin == "Orang tua")
                <li class="menu-title">Main Menu</li>
                <li>
                    <a href="{{ route('Orangtua_Dashboard') }}">
                        <i class="mdi mdi-home"></i>
                        <span>{{ $listMenu['Dashboard'] }}</span>
                    </a>
                </li>
                {{-- start akademik --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-school-outline"></i>
                        <span>{{ $listMenu['Akademik'] }}</span>
                    </a>
                        
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('orangtua_akademik-tugassiswa_page') }}">{{ $listMenu['Tugas Siswa'] }}</a></li>   
                        <li><a href="{{ route('orangtua_akademik-materimatapelajaran_page') }}">{{ $listMenu['Materi'] }}</a></li>   
                    </ul>
                </li>
                {{-- end akademik --}}

                {{-- start Buku & Media --}}
                <li class="menu-title"><span>{{ $listMenu['Buku & Media'] }}</span></li>
                <li>
                    <li>
                        <a href="{{ route('orangtua_bukumedia-ebooks_page') }}" class="">
                            <i class="mdi mdi-book"></i>
                            <span>{{ $listMenu['E-Books'] }}</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('orangtua_bukumedia-mediaparent_page') }}" class="">
                            <i class="mdi mdi-bulletin-board"></i>
                            <span>{{ $listMenu['Media Pembelajaran'] }}</span>
                        </a>
                    </li>            
                </li>
                {{-- end Buku & Media --}}

                {{-- start Penjadwalan --}}
                <li class="menu-title"><span>{{ $listMenu['Penjadwalan'] }}</span></li>
                <li>
                        
                        <li>
                            <a href="{{ route('orangtua_penjadwalan-jadwalpelajaran_page') }}" class="">
                                <i class="mdi mdi-calendar-multiple"></i>
                                <span>{{ $listMenu['Jadwal Pelajaran'] }}</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route('orangtua_penjadwalan-jadwalpertemuan_page') }}" class="">
                                <i class="mdi mdi-calendar-multiple-check"></i>
                                <span>{{ $listMenu['Jadwal Pertemuan'] }}</span>
                            </a>
                        </li>
                    
                </li>

                @endif
                {{-- end Orangtua Role --}}

            </ul>
       </div>
       <!-- Sidebar -->
   </div>
</div>

<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\GuruController;
//use App\Http\Controllers\JabatanGuruController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StaffController;

use App\Http\Controllers\KelasController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\MateriMataPelajaranController;
use App\Http\Controllers\TugasSiswaController;

use App\Http\Controllers\KriteriaPenilaianAlquranController;
use App\Http\Controllers\KategoriTahsinController;
use App\Http\Controllers\PemetaanTahsinController;
use App\Http\Controllers\CapaianTahsinController;
use App\Http\Controllers\TahfidzController;

use App\Http\Controllers\MateriQaController;
use App\Http\Controllers\CapaianQaController;

use App\Http\Controllers\RencanaUjianController;
use App\Http\Controllers\JadwalujianController;
use App\Http\Controllers\KehadiranSiswaUjianController;
use App\Http\Controllers\KategorisoalController;
use App\Http\Controllers\BanksoalController;
use App\Http\Controllers\IntruksiUjianController;
use App\Http\Controllers\MulaiUjianController;

use App\Http\Controllers\TataTertibController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\SanksiPelanggaranController;
use App\Http\Controllers\DataPelanggaranController;

use App\Http\Controllers\BimbinganKonselingController;
use App\Http\Controllers\DataBimbinganKonselingController;

use App\Http\Controllers\KategoriArsipController;
use App\Http\Controllers\UploadArsipController;
use App\Http\Controllers\RekapKelengkapanArsipController;

use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\LokasiBarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\SosialLinkController;
use App\Http\Controllers\ImportFileController;
use App\Http\Controllers\KomplainController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\EbooksController;
use App\Http\Controllers\MediaParentController;
use App\Http\Controllers\mediaSubF1Controller;
use App\Http\Controllers\mediaSubF2Controller;
use App\Http\Controllers\mediaFileController;

use App\Http\Controllers\KalenderAkademikController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\JadwalPertemuanController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\LiburanController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\RencanaKegiatanController;
use App\Http\Controllers\GKMediaParentController;
use App\Http\Controllers\GKMediaSubF1Controller;
use App\Http\Controllers\GKMediaSubF2Controller;
use App\Http\Controllers\GKMediaFileController;

use App\Http\Controllers\JurnalBKController;
use App\Http\Controllers\JurnalKesiswaanController;
use App\Http\Controllers\JurnalKelasController;

use App\Http\Controllers\CatatanWaliKelasController;
use App\Http\Controllers\NilaiEkstrakurikulerController;
use App\Http\Controllers\IdentitasSekolahController;
use App\Http\Controllers\IzinKenaikanKelasController;
use App\Http\Controllers\JuaraKelasController;
use App\Http\Controllers\JuaraUmumController;
use App\Http\Controllers\JumlahKetidakhadiranController;
use App\Http\Controllers\KategoriPenilaianSikapController;
use App\Http\Controllers\KkmController;
use App\Http\Controllers\NilaiRaportController;
use App\Http\Controllers\NilaiSikapController;
use App\Http\Controllers\NilaiUmumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
   return redirect('/login');
});


Route::get('/login', [AuthController::class, 'login_page'])->name('login');
Route::post('/process', [AuthController::class, 'login_process'])->name('login-process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('administrator')->middleware('auth')->group(function() {
   
   Route::prefix('dashboard')->group(function () {
      Route::get('/', [PageController::class, 'AdminDashboard'])->name('admin_dashboard');
      
      // master route
      Route::prefix('master')->group(function () {
         Route::get('staff', [StaffController::class, 'index'])->name('staff_master_page');
         Route::get('staff/add', [StaffController::class, 'storePage'])->name('staff_master_add');
         Route::post('staff/store', [StaffController::class, 'store'])->name('staff_master_store');
         Route::get('staff/edit/{uuid}', [StaffController::class, 'edit'])->name('staff_master_edit');
         Route::put('staff/update/{uuid}', [StaffController::class, 'update'])->name('staff_master_update');
         Route::delete('staff/delete/{uuid}', [StaffController::class, 'destroy'])->name('staff_master_delete');

         Route::get('guru/add', [GuruController::class, 'storePage'])->name('guru_master_add');
         Route::post('guru/store', [GuruController::class, 'store'])->name('guru_master_store');
         Route::get('guru/edit/{uuid}', [GuruController::class, 'edit'])->name('guru_master_edit');
         Route::put('guru/update/{uuid}', [GuruController::class, 'update'])->name('guru_master_update');
         Route::delete('guru/delete/{uuid}', [GuruController::class, 'destroy'])->name('guru_master_delete');
   
         Route::get('guru', [GuruController::class, 'index'])->name('guru_master_page');
         Route::get('guru/add', [GuruController::class, 'storePage'])->name('guru_master_add');
         Route::post('guru/store', [GuruController::class, 'store'])->name('guru_master_store');
         Route::get('guru/edit/{uuid}', [GuruController::class, 'edit'])->name('guru_master_edit');
         Route::put('guru/update/{uuid}', [GuruController::class, 'update'])->name('guru_master_update');
         Route::delete('guru/delete/{uuid}', [GuruController::class, 'destroy'])->name('guru_master_delete');

         Route::get('siswa', [SiswaController::class, 'index'])->name('siswa_master_page');
         Route::get('siswa/add', [SiswaController::class, 'storePage'])->name('siswa_master_add');
         Route::post('siswa/store', [SiswaController::class, 'store'])->name('siswa_master_store');
         Route::get('siswa/edit/{uuid}', [SiswaController::class, 'edit'])->name('siswa_master_edit');
         Route::put('siswa/update/{uuid}', [SiswaController::class, 'update'])->name('siswa_master_update');
         Route::delete('siswa/delete/{uuid}', [SiswaController::class, 'destroy'])->name('siswa_master_delete');

         Route::get('orangtua', [OrangtuaController::class, 'index'])->name('orangtua_master_page');
         Route::get('orangtua/add', [orangtuaController::class, 'storePage'])->name('orangtua_master_add');
         Route::post('orangtua/store', [orangtuaController::class, 'store'])->name('orangtua_master_store');
         Route::get('orangtua/edit/{uuid}', [orangtuaController::class, 'edit'])->name('orangtua_master_edit');
         Route::put('orangtua/update/{uuid}', [orangtuaController::class, 'update'])->name('orangtua_master_update');
         Route::delete('orangtua/delete/{uuid}', [orangtuaController::class, 'destroy'])->name('orangtua_master_delete');
   
         

      });

      // akademik route
      Route::prefix('akademik')->group(function () {
         // akademik ruang kelas
         //Route::get('/ruang-kelas', [KelasRuangController::class, 'index'])->name('akademik_ruangkelas_page');
         //Route::get('/ruang-kelas/add', [KelasRuangController::class, 'storePage'])->name('akademik_ruangkelas_add');
         //Route::post('/ruang-kelas/store', [KelasRuangController::class, 'store'])->name('akademik_ruangkelas_store');
         //Route::get('/ruang-kelas/edit/{uuid}', [KelasRuangController::class, 'edit'])->name('akademik_ruangkelas_edit');
         //Route::put('/ruang-kelas/update/{uuid}', [KelasRuangController::class, 'update'])->name('akademik_ruangkelas_update');
         //Route::delete('/ruang-kelas/delete/{uuid}', [KelasRuangController::class, 'destroy'])->name('akademik_ruangkelas_delete');


         //akademik kelas
         Route::get('/kelas', [KelasController::class, 'index'])->name('akademik_kelas_page');
         Route::get('/kelas/add', [KelasController::class, 'storePage'])->name('akademik_kelas_add');
         Route::post('/kelas/store', [KelasController::class, 'store'])->name('akademik_kelas_store');
         Route::get('/kelas/edit/{uuid}', [KelasController::class, 'edit'])->name('akademik_kelas_edit');
         Route::put('/kelas/update/{uuid}', [KelasController::class, 'update'])->name('akademik_kelas_update');
         Route::delete('/kelas/delete/{uuid}', [KelasController::class, 'destroy'])->name('akademik_kelas_delete');

         // akademik section
         Route::get('/section', [SectionController::class, 'index'])->name('akademik_section_page');
         Route::get('/section/add', [SectionController::class, 'storePage'])->name('akademik_section_add');
         Route::post('/section/store', [SectionController::class, 'store'])->name('akademik_section_store');
         Route::get('/section/edit/{uuid}', [SectionController::class, 'edit'])->name('akademik_section_edit');
         Route::put('/section/update/{uuid}', [SectionController::class, 'update'])->name('akademik_section_update');
         Route::delete('/section/delete/{uuid}', [SectionController::class, 'destroy'])->name('akademik_section_delete');

         // akademik tugas siswa
         Route::get('/tugassiswa', [TugasSiswaController::class, 'index'])->name('akademik_tugassiswa_page');
         Route::get('/tugassiswa/add', [TugasSiswaController::class, 'storePage'])->name('akademik_tugassiswa_add');
         Route::post('/tugassiswa/store', [TugasSiswaController::class, 'store'])->name('akademik_tugassiswa_store');
         Route::get('/tugassiswa/edit/{uuid}', [TugasSiswaController::class, 'edit'])->name('akademik_tugassiswa_edit');
         Route::post('/tugassiswa/update/{uuid}', [TugasSiswaController::class, 'update'])->name('akademik_tugassiswa_update');
         Route::delete('/tugassiswa/delete/{uuid}', [TugasSiswaController::class, 'destroy'])->name('akademik_tugassiswa_delete');

         // akademik Mata Pelajaran
         Route::get('/matapelajaran', [MataPelajaranController::class, 'index'])->name('akademik_matapelajaran_page');
         Route::get('/matapelajaran/add', [MataPelajaranController::class, 'storePage'])->name('akademik_matapelajaran_add');
         Route::post('/matapelajaran/store', [MataPelajaranController::class, 'store'])->name('akademik_matapelajaran_store');
         Route::get('/matapelajaran/edit/{uuid}', [MataPelajaranController::class, 'edit'])->name('akademik_matapelajaran_edit');
         Route::put('/matapelajaran/update/{uuid}', [MataPelajaranController::class, 'update'])->name('akademik_matapelajaran_update');
         Route::delete('/matapelajaran/delete/{uuid}', [MataPelajaranController::class, 'destroy'])->name('akademik_matapelajaran_delete');

         // akademik Materi
         Route::get('/materimatapelajaran', [MateriMataPelajaranController::class, 'index'])->name('akademik_materimatapelajaran_page');
         Route::get('/materimatapelajaran/add', [MateriMataPelajaranController::class, 'storePage'])->name('akademik_materimatapelajaran_add');
         Route::post('/materimatapelajaran/store', [MateriMataPelajaranController::class, 'store'])->name('akademik_materimatapelajaran_store');
         Route::get('/materimatapelajaran/edit/{uuid}', [MateriMataPelajaranController::class, 'edit'])->name('akademik_materimatapelajaran_edit');
         Route::post('/materimatapelajaran/update/{uuid}', [MateriMataPelajaranController::class, 'update'])->name('akademik_materimatapelajaran_update');
         Route::delete('/materimatapelajaran/delete/{uuid}', [MateriMataPelajaranController::class, 'destroy'])->name('akademik_materimatapelajaran_delete');

      });

      // Al-Quran route
      Route::prefix('alquran')->group(function () {
         // alquran - kriteria penilaian alquran
         Route::get('/kriteriapenilaianalquran', [KriteriaPenilaianAlquranController::class, 'index'])->name('alquran_kriteriapenilaianalquran_page');
         Route::get('/kriteriapenilaianalquran/add', [KriteriaPenilaianAlquranController::class, 'storePage'])->name('alquran_kriteriapenilaianalquran_add');
         Route::post('/kriteriapenilaianalquran/store', [KriteriaPenilaianAlquranController::class, 'store'])->name('alquran_kriteriapenilaianalquran_store');
         Route::get('/kriteriapenilaianalquran/edit/{uuid}', [KriteriaPenilaianAlquranController::class, 'edit'])->name('alquran_kriteriapenilaianalquran_edit');
         Route::put('/kriteriapenilaianalquran/update/{uuid}', [KriteriaPenilaianAlquranController::class, 'update'])->name('alquran_kriteriapenilaianalquran_update');
         Route::delete('/kriteriapenilaianalquran/delete/{uuid}', [KriteriaPenilaianAlquranController::class, 'destroy'])->name('alquran_kriteriapenilaianalquran_delete');

         // alquran - tahsin - kategori tahsin
         Route::get('/tahsin/kategoritahsin', [KategoriTahsinController::class, 'index'])->name('alquran_tahsin_kategoritahsin_page');
         Route::get('/tahsin/kategoritahsin/add', [KategoriTahsinController::class, 'storePage'])->name('alquran_tahsin_kategoritahsin_add');
         Route::post('/tahsin/kategoritahsin/store', [KategoriTahsinController::class, 'store'])->name('alquran_tahsin_kategoritahsin_store');
         Route::get('/tahsin/kategoritahsin/edit/{uuid}', [KategoriTahsinController::class, 'edit'])->name('alquran_tahsin_kategoritahsin_edit');
         Route::put('/tahsin/kategoritahsin/update/{uuid}', [KategoriTahsinController::class, 'update'])->name('alquran_tahsin_kategoritahsin_update');
         Route::delete('/tahsin/kategoritahsin/delete/{uuid}', [KategoriTahsinController::class, 'destroy'])->name('alquran_tahsin_kategoritahsin_delete');

         // alquran - tahsin - pemetaan tahsin
         Route::get('/tahsin/pemetaantahsin', [PemetaanTahsinController::class, 'index'])->name('alquran_tahsin_pemetaantahsin_page');
         Route::get('/tahsin/pemetaantahsin/add', [PemetaanTahsinController::class, 'storePage'])->name('alquran_tahsin_pemetaantahsin_add');
         Route::post('/tahsin/pemetaantahsin/store', [PemetaanTahsinController::class, 'store'])->name('alquran_tahsin_pemetaantahsin_store');
         Route::get('/tahsin/pemetaantahsin/edit/{uuid}', [PemetaanTahsinController::class, 'edit'])->name('alquran_tahsin_pemetaantahsin_edit');
         Route::put('/tahsin/pemetaantahsin/update/{uuid}', [PemetaanTahsinController::class, 'update'])->name('alquran_tahsin_pemetaantahsin_update');
         Route::delete('/tahsin/pemetaantahsin/delete/{uuid}', [PemetaanTahsinController::class, 'destroy'])->name('alquran_tahsin_pemetaantahsin_delete');

         // alquran - tahsin - capaian tahsin
         Route::get('/tahsin/capaiantahsin', [CapaianTahsinController::class, 'index'])->name('alquran_tahsin_capaiantahsin_page');
         Route::get('/tahsin/capaiantahsin/add', [CapaianTahsinController::class, 'storePage'])->name('alquran_tahsin_capaiantahsin_add');
         Route::post('/tahsin/capaiantahsin/store', [CapaianTahsinController::class, 'store'])->name('alquran_tahsin_capaiantahsin_store');
         Route::get('/tahsin/capaiantahsin/edit/{uuid}', [CapaianTahsinController::class, 'edit'])->name('alquran_tahsin_capaiantahsin_edit');
         Route::put('/tahsin/capaiantahsin/update/{uuid}', [CapaianTahsinController::class, 'update'])->name('alquran_tahsin_capaiantahsin_update');
         Route::delete('/tahsin/capaiantahsin/delete/{uuid}', [CapaianTahsinController::class, 'destroy'])->name('alquran_tahsin_capaiantahsin_delete');

          // alquran - tahfidz
         Route::get('/tahfidz', [TahfidzController::class, 'index'])->name('alquran_tahfidz_page');
         Route::get('/tahfidz/add', [TahfidzController::class, 'storePage'])->name('alquran_tahfidz_add');
         Route::post('/tahfidz/store', [TahfidzController::class, 'store'])->name('alquran_tahfidz_store');
         Route::get('/tahfidz/edit/{uuid}', [TahfidzController::class, 'edit'])->name('alquran_tahfidz_edit');
         Route::put('/tahfidz/update/{uuid}', [TahfidzController::class, 'update'])->name('alquran_tahfidz_update');
         Route::delete('/tahfidz/delete/{uuid}', [TahfidzController::class, 'destroy'])->name('alquran_tahfidz_delete');

      });

      // QA route
      Route::prefix('qa')->group(function () {
         // qa - materi qa
         Route::get('/materiqa', [MateriQaController::class, 'index'])->name('qa_materiqa_page');
         Route::get('/materiqa/add', [MateriQaController::class, 'storePage'])->name('qa_materiqa_add');
         Route::post('/materiqa/store', [MateriQaController::class, 'store'])->name('qa_materiqa_store');
         Route::get('/materiqa/edit/{uuid}', [MateriQaController::class, 'edit'])->name('qa_materiqa_edit');
         Route::put('/materiqa/update/{uuid}', [MateriQaController::class, 'update'])->name('qa_materiqa_update');
         Route::delete('/materiqa/delete/{uuid}', [MateriQaController::class, 'destroy'])->name('qa_materiqa_delete');

          // qa - capaian qa
         Route::get('/capaianqa', [CapaianQaController::class, 'index'])->name('qa_capaianqa_page');
         Route::get('/capaianqa/add', [CapaianQaController::class, 'storePage'])->name('qa_capaianqa_add');
         Route::post('/capaianqa/store', [CapaianQaController::class, 'store'])->name('qa_capaianqa_store');
         Route::get('/capaianqa/edit/{uuid}', [CapaianQaController::class, 'edit'])->name('qa_capaianqa_edit');
         Route::put('/capaianqa/update/{uuid}', [CapaianQaController::class, 'update'])->name('qa_capaianqa_update');
         Route::delete('/capaianqa/delete/{uuid}', [CapaianQaController::class, 'destroy'])->name('qa_capaianqa_delete');

      });

      // ujian route
      Route::prefix('ujian')->group(function () {
         // ujian kategori-ujian
         Route::get('/rencanaujian', [RencanaUjianController::class, 'index'])->name('ujian_rencanaujian_page');
         Route::get('/rencanaujian/add', [RencanaUjianController::class, 'storePage'])->name('ujian_rencanaujian_add');
         Route::post('/rencanaujian/store', [RencanaUjianController::class, 'store'])->name('ujian_rencanaujian_store');
         Route::get('/rencanaujian/edit/{uuid}', [RencanaUjianController::class, 'edit'])->name('ujian_rencanaujian_edit');
         Route::put('/rencanaujian/update/{uuid}', [RencanaUjianController::class, 'update'])->name('ujian_rencanaujian_update');
         Route::delete('/rencanaujian/delete/{uuid}', [RencanaUjianController::class, 'destroy'])->name('ujian_rencanaujian_delete');

         // ujian jadwal-ujian
         Route::get('/jadwalujian', [JadwalujianController::class, 'index'])->name('ujian_jadwalujian_page');
         Route::get('/jadwalujian/add', [JadwalujianController::class, 'storePage'])->name('ujian_jadwalujian_add');
         Route::post('/jadwalujian/store', [JadwalujianController::class, 'store'])->name('ujian_jadwalujian_store');
         Route::get('/jadwalujian/edit/{uuid}', [JadwalujianController::class, 'edit'])->name('ujian_jadwalujian_edit');
         Route::put('/jadwalujian/update/{uuid}', [JadwalujianController::class, 'update'])->name('ujian_jadwalujian_update');
         Route::delete('/jadwalujian/delete/{uuid}', [JadwalujianController::class, 'destroy'])->name('ujian_jadwalujian_delete');

          // ujian kehadiran siswa ujian
         Route::get('/kehadiransiswaujian', [KehadiranSiswaUjianController::class, 'index'])->name('ujian_kehadiransiswaujian_page');
         Route::get('/kehadiransiswaujian/add', [KehadiranSiswaUjianController::class, 'storePage'])->name('ujian_kehadiransiswaujian_add');
         Route::post('/kehadiransiswaujian/store', [KehadiranSiswaUjianController::class, 'store'])->name('ujian_kehadiransiswaujian_store');
         Route::get('/kehadiransiswaujian/edit/{uuid}', [KehadiranSiswaUjianController::class, 'edit'])->name('ujian_kehadiransiswaujian_edit');
         Route::put('/kehadiransiswaujian/update/{uuid}', [KehadiranSiswaUjianController::class, 'update'])->name('ujian_kehadiransiswaujian_update');
         Route::delete('/kehadiransiswaujian/delete/{uuid}', [KehadiranSiswaUjianController::class, 'destroy'])->name('ujian_kehadiransiswaujian_delete');

         // ujian kategori soal
         Route::get('/kategorisoal', [KategorisoalController::class, 'index'])->name('ujian_kategorisoal_page');
         Route::get('/kategorisoal/add', [KategorisoalController::class, 'storePage'])->name('ujian_kategorisoal_add');
         Route::post('/kategorisoal/store', [KategorisoalController::class, 'store'])->name('ujian_kategorisoal_store');
         Route::get('/kategorisoal/edit/{uuid}', [KategorisoalController::class, 'edit'])->name('ujian_kategorisoal_edit');
         Route::put('/kategorisoal/update/{uuid}', [KategorisoalController::class, 'update'])->name('ujian_kategorisoal_update');
         Route::delete('/kategorisoal/delete/{uuid}', [KategorisoalController::class, 'destroy'])->name('ujian_kategorisoal_delete');

         // ujian bank soal 
         Route::get('/banksoal', [BanksoalController::class, 'index'])->name('ujian_banksoal_page');
         Route::get('/banksoal/add', [BanksoalController::class, 'storePage'])->name('ujian_banksoal_add');
         Route::post('/banksoal/store', [BanksoalController::class, 'store'])->name('ujian_banksoal_store');
         Route::get('/banksoal/edit/{uuid}', [BanksoalController::class, 'edit'])->name('ujian_banksoal_edit');
         Route::post('/banksoal/update/{uuid}', [BanksoalController::class, 'update'])->name('ujian_banksoal_update');
         Route::delete('/banksoal/delete/{uuid}', [BanksoalController::class, 'destroy'])->name('ujian_banksoal_delete');

         // ujian intruksi ujian
         Route::get('/intruksiujian', [IntruksiUjianController::class, 'index'])->name('ujian_intruksiujian_page');
         Route::get('/intruksiujian/add', [IntruksiUjianController::class, 'storePage'])->name('ujian_intruksiujian_add');
         Route::post('/intruksiujian/store', [IntruksiUjianController::class, 'store'])->name('ujian_intruksiujian_store');
         Route::get('/intruksiujian/edit/{uuid}', [IntruksiUjianController::class, 'edit'])->name('ujian_intruksiujian_edit');
         Route::put('/intruksiujian/update/{uuid}', [IntruksiUjianController::class, 'update'])->name('ujian_intruksiujian_update');
         Route::delete('/intruksiujian/delete/{uuid}', [IntruksiUjianController::class, 'destroy'])->name('ujian_intruksiujian_delete');

         Route::get('/mulaiujian', [MulaiUjianController::class, 'index'])->name('ujian_mulaiujian_page');
         Route::get('/mulaiujian/add', [MulaiUjianController::class, 'storePage'])->name('ujian_mulaiujian_add');
         Route::post('/mulaiujian/store', [MulaiUjianController::class, 'store'])->name('ujian_mulaiujian_store');
         Route::get('/mulaiujian/edit/{uuid}', [MulaiUjianController::class, 'edit'])->name('ujian_mulaiujian_edit');
         Route::post('/mulaiujian/update/{uuid}', [MulaiUjianController::class, 'update'])->name('ujian_mulaiujian_update');
         Route::delete('/mulaiujian/delete/{uuid}', [MulaiUjianController::class, 'destroy'])->name('ujian_mulaiujian_delete');

      });

      // kesiswaan route
      Route::prefix('kesiswaan')->group(function () {
         // kesiswaan - tata tertib
         Route::get('/tatatertib', [TataTertibController::class, 'index'])->name('kesiswaan_tatatertib_page');
         Route::get('/tatatertib/add', [TataTertibController::class, 'storePage'])->name('kesiswaan_tatatertib_add');
         Route::post('/tatatertib/store', [TataTertibController::class, 'store'])->name('kesiswaan_tatatertib_store');
         Route::get('/tatatertib/edit/{uuid}', [TataTertibController::class, 'edit'])->name('kesiswaan_tatatertib_edit');
         Route::put('/tatatertib/update/{uuid}', [TataTertibController::class, 'update'])->name('kesiswaan_tatatertib_update');
         Route::delete('/tatatertib/delete/{uuid}', [TataTertibController::class, 'destroy'])->name('kesiswaan_tatatertib_delete');

         // kesiswaan - pelanggaran
         Route::get('/pelanggaran', [PelanggaranController::class, 'index'])->name('kesiswaan_pelanggaran_page');
         Route::get('/pelanggaran/add', [PelanggaranController::class, 'storePage'])->name('kesiswaan_pelanggaran_add');
         Route::post('/pelanggaran/store', [PelanggaranController::class, 'store'])->name('kesiswaan_pelanggaran_store');
         Route::get('/pelanggaran/edit/{uuid}', [PelanggaranController::class, 'edit'])->name('kesiswaan_pelanggaran_edit');
         Route::put('/pelanggaran/update/{uuid}', [PelanggaranController::class, 'update'])->name('kesiswaan_pelanggaran_update');
         Route::delete('/pelanggaran/delete/{uuid}', [PelanggaranController::class, 'destroy'])->name('kesiswaan_pelanggaran_delete');

         // kesiswaan - sanksi pelanggaran
         Route::get('/sanksipelanggaran', [SanksiPelanggaranController::class, 'index'])->name('kesiswaan_sanksipelanggaran_page');
         Route::get('/sanksipelanggaran/add', [SanksiPelanggaranController::class, 'storePage'])->name('kesiswaan_sanksipelanggaran_add');
         Route::post('/sanksipelanggaran/store', [SanksiPelanggaranController::class, 'store'])->name('kesiswaan_sanksipelanggaran_store');
         Route::get('/sanksipelanggaran/edit/{uuid}', [SanksiPelanggaranController::class, 'edit'])->name('kesiswaan_sanksipelanggaran_edit');
         Route::put('/sanksipelanggaran/update/{uuid}', [SanksiPelanggaranController::class, 'update'])->name('kesiswaan_sanksipelanggaran_update');
         Route::delete('/sanksipelanggaran/delete/{uuid}', [SanksiPelanggaranController::class, 'destroy'])->name('kesiswaan_sanksipelanggaran_delete');

         // kesiswaan - data pelanggaran
         Route::get('/datapelanggaran', [DataPelanggaranController::class, 'index'])->name('kesiswaan_datapelanggaran_page');
         Route::get('/datapelanggaran/add', [DataPelanggaranController::class, 'storePage'])->name('kesiswaan_datapelanggaran_add');
         Route::post('/datapelanggaran/store', [DataPelanggaranController::class, 'store'])->name('kesiswaan_datapelanggaran_store');
         Route::get('/datapelanggaran/edit/{uuid}', [DataPelanggaranController::class, 'edit'])->name('kesiswaan_datapelanggaran_edit');
         Route::put('/datapelanggaran/update/{uuid}', [DataPelanggaranController::class, 'update'])->name('kesiswaan_datapelanggaran_update');
         Route::delete('/datapelanggaran/delete/{uuid}', [DataPelanggaranController::class, 'destroy'])->name('kesiswaan_datapelanggaran_delete');

      });

      // bk route
      Route::prefix('bk')->group(function () {
         // bk - bimbingan konseling
         Route::get('/bimbingankonseling', [BimbinganKonselingController::class, 'index'])->name('bk_bimbingankonseling_page');
         Route::get('/bimbingankonseling/add', [BimbinganKonselingController::class, 'storePage'])->name('bk_bimbingankonseling_add');
         Route::post('/bimbingankonseling/store', [BimbinganKonselingController::class, 'store'])->name('bk_bimbingankonseling_store');
         Route::get('/bimbingankonseling/edit/{uuid}', [BimbinganKonselingController::class, 'edit'])->name('bk_bimbingankonseling_edit');
         Route::put('/bimbingankonseling/update/{uuid}', [BimbinganKonselingController::class, 'update'])->name('bk_bimbingankonseling_update');
         Route::delete('/bimbingankonseling/delete/{uuid}', [BimbinganKonselingController::class, 'destroy'])->name('bk_bimbingankonseling_delete');

         // bk - data bimbingan konseling
         Route::get('/databimbingankonseling', [DataBimbinganKonselingController::class, 'index'])->name('bk_databimbingankonseling_page');
         Route::get('/databimbingankonseling/add', [DataBimbinganKonselingController::class, 'storePage'])->name('bk_databimbingankonseling_add');
         Route::post('/databimbingankonseling/store', [DataBimbinganKonselingController::class, 'store'])->name('bk_databimbingankonseling_store');
         Route::get('/databimbingankonseling/edit/{uuid}', [DataBimbinganKonselingController::class, 'edit'])->name('bk_databimbingankonseling_edit');
         Route::put('/databimbingankonseling/update/{uuid}', [DataBimbinganKonselingController::class, 'update'])->name('bk_databimbingankonseling_update');
         Route::delete('/databimbingankonseling/delete/{uuid}', [DataBimbinganKonselingController::class, 'destroy'])->name('bk_databimbingankonseling_delete');

      });

      // arsip guru route
      Route::prefix('arsipguru')->group(function () {
         // arsip guru - kategori arsip
         Route::get('/kategoriarsip', [KategoriArsipController::class, 'index'])->name('arsipguru_kategoriarsip_page');
         Route::get('/kategoriarsip/add', [KategoriArsipController::class, 'storePage'])->name('arsipguru_kategoriarsip_add');
         Route::post('/kategoriarsip/store', [KategoriArsipController::class, 'store'])->name('arsipguru_kategoriarsip_store');
         Route::get('/kategoriarsip/edit/{uuid}', [KategoriArsipController::class, 'edit'])->name('arsipguru_kategoriarsip_edit');
         Route::put('/kategoriarsip/update/{uuid}', [KategoriArsipController::class, 'update'])->name('arsipguru_kategoriarsip_update');
         Route::delete('/kategoriarsip/delete/{uuid}', [KategoriArsipController::class, 'destroy'])->name('arsipguru_kategoriarsip_delete');

         // arsip guru - upload arsip
         Route::get('/uploadarsip', [UploadArsipController::class, 'index'])->name('arsipguru_uploadarsip_page');
         Route::get('/uploadarsip/add', [UploadArsipController::class, 'storePage'])->name('arsipguru_uploadarsip_add');
         Route::post('/uploadarsip/store', [UploadArsipController::class, 'store'])->name('arsipguru_uploadarsip_store');
         Route::get('/uploadarsip/edit/{uuid}', [UploadArsipController::class, 'edit'])->name('arsipguru_uploadarsip_edit');
         Route::put('/uploadarsip/update/{uuid}', [UploadArsipController::class, 'update'])->name('arsipguru_uploadarsip_update');
         Route::delete('/uploadarsip/delete/{uuid}', [UploadArsipController::class, 'destroy'])->name('arsipguru_uploadarsip_delete');

         // arsip guru - rekap kelengkapan arsip
         Route::get('/rekapkelengkapanarsip', [RekapKelengkapanArsipController::class, 'index'])->name('arsipguru_rekapkelengkapanarsip_page');
         Route::get('/rekapkelengkapanarsip/add', [RekapKelengkapanArsipController::class, 'storePage'])->name('arsipguru_rekapkelengkapanarsip_add');
         Route::post('/rekapkelengkapanarsip/store', [RekapKelengkapanArsipController::class, 'store'])->name('arsipguru_rekapkelengkapanarsip_store');
         Route::get('/rekapkelengkapanarsip/edit/{uuid}', [RekapKelengkapanArsipController::class, 'edit'])->name('arsipguru_rekapkelengkapanarsip_edit');
         Route::put('/rekapkelengkapanarsip/update/{uuid}', [RekapKelengkapanArsipController::class, 'update'])->name('arsipguru_rekapkelengkapanarsip_update');
         Route::delete('/rekapkelengkapanarsip/delete/{uuid}', [RekapKelengkapanArsipController::class, 'destroy'])->name('arsipguru_rekapkelengkapanarsip_delete');

      });

      // jurnal route
      Route::prefix('jurnal')->group(function () {
         // jurnal bk
         Route::get('/jurnalbk', [JurnalBKController::class, 'index'])->name('jurnal_jurnalbk_page');
         Route::get('/jurnalbk/add', [JurnalBKController::class, 'storePage'])->name('jurnal_jurnalbk_add');
         Route::post('/jurnalbk/store', [JurnalBKController::class, 'store'])->name('jurnal_jurnalbk_store');
         Route::get('/jurnalbk/edit/{uuid}', [JurnalBKController::class, 'edit'])->name('jurnal_jurnalbk_edit');
         Route::put('/jurnalbk/update/{uuid}', [JurnalBKController::class, 'update'])->name('jurnal_jurnalbk_update');
         Route::delete('/jurnalbk/delete/{uuid}', [JurnalBKController::class, 'destroy'])->name('jurnal_jurnalbk_delete');
         Route::get('/jurnalbk/generatePDF/{id}', [JurnalBKController::class, 'DownloadReport'])->name('jurnal_jurnalbk_download');

         // jurnal kesiswaan
         Route::get('/jurnalkesiswaan', [JurnalKesiswaanController::class, 'index'])->name('jurnal_jurnalkesiswaan_page');
         Route::get('/jurnalkesiswaan/add', [JurnalKesiswaanController::class, 'storePage'])->name('jurnal_jurnalkesiswaan_add');
         Route::post('/jurnalkesiswaan/store', [JurnalKesiswaanController::class, 'store'])->name('jurnal_jurnalkesiswaan_store');
         Route::get('/jurnalkesiswaan/edit/{uuid}', [JurnalKesiswaanController::class, 'edit'])->name('jurnal_jurnalkesiswaan_edit');
         Route::put('/jurnalkesiswaan/update/{uuid}', [JurnalKesiswaanController::class, 'update'])->name('jurnal_jurnalkesiswaan_update');
         Route::delete('/jurnalkesiswaan/delete/{uuid}', [JurnalKesiswaanController::class, 'destroy'])->name('jurnal_jurnalkesiswaan_delete');
         Route::get('/jurnalkesiswaan/generatePDF/{id}', [JurnalKesiswaanController::class, 'DownloadReport'])->name('jurnal_jurnalkesiswaan_download');

         // jurnal kelas
         Route::get('/jurnalkelas', [JurnalKelasController::class, 'index'])->name('jurnal_jurnalkelas_page');
         Route::get('/jurnalkelas/add', [JurnalKelasController::class, 'storePage'])->name('jurnal_jurnalkelas_add');
         Route::post('/jurnalkelas/store', [JurnalKelasController::class, 'store'])->name('jurnal_jurnalkelas_store');
         Route::get('/jurnalkelas/edit/{uuid}', [JurnalKelasController::class, 'edit'])->name('jurnal_jurnalkelas_edit');
         Route::put('/jurnalkelas/update/{uuid}', [JurnalKelasController::class, 'update'])->name('jurnal_jurnalkelas_update');
         Route::delete('/jurnalkelas/delete/{uuid}', [JurnalKelasController::class, 'destroy'])->name('jurnal_jurnalkelas_delete');
         Route::get('/jurnalkelas/generatePDF/{id}', [JurnalKelasController::class, 'DownloadReport'])->name('jurnal_jurnalkelas_download');

      });

      // Raport route
      Route::prefix('raport')->group(function () {
         // raport - catatan walikelas
         Route::get('/catatanwalikelas', [CatatanWaliKelasController::class, 'index'])->name('raport_catatanwalikelas_page');
         Route::get('/catatanwalikelas/add', [CatatanWaliKelasController::class, 'storePage'])->name('raport_catatanwalikelas_add');
         Route::post('/catatanwalikelas/store', [CatatanWaliKelasController::class, 'store'])->name('raport_catatanwalikelas_store');
         Route::get('/catatanwalikelas/edit/{uuid}', [CatatanWaliKelasController::class, 'edit'])->name('raport_catatanwalikelas_edit');
         Route::put('/catatanwalikelas/update/{uuid}', [CatatanWaliKelasController::class, 'update'])->name('raport_catatanwalikelas_update');
         Route::delete('catatanwalikelas/delete/{uuid}', [CatatanWaliKelasController::class, 'destroy'])->name('raport_catatanwalikelas_delete');

         // raport - nilai ekstrakurikuler
         Route::get('/nilaiekstrakurikuler', [NilaiEkstrakurikulerController::class, 'index'])->name('raport_nilaiekstrakurikuler_page');
         Route::get('/nilaiekstrakurikuler/add', [NilaiEkstrakurikulerController::class, 'storePage'])->name('raport_nilaiekstrakurikuler_add');
         Route::post('/nilaiekstrakurikuler/store', [NilaiEkstrakurikulerController::class, 'store'])->name('raport_nilaiekstrakurikuler_store');
         Route::get('/nilaiekstrakurikuler/edit/{uuid}', [NilaiEkstrakurikulerController::class, 'edit'])->name('raport_nilaiekstrakurikuler_edit');
         Route::put('/nilaiekstrakurikuler/update/{uuid}', [NilaiEkstrakurikulerController::class, 'update'])->name('raport_nilaiekstrakurikuler_update');
         Route::delete('nilaiekstrakurikuler/delete/{uuid}', [NilaiEkstrakurikulerController::class, 'destroy'])->name('raport_nilaiekstrakurikuler_delete');

         // raport - identitas sekolah
         Route::get('/identitassekolah', [IdentitasSekolahController::class, 'index'])->name('raport_identitassekolah_page');
         Route::get('/identitassekolah/add', [IdentitasSekolahController::class, 'storePage'])->name('raport_identitassekolah_add');
         Route::post('/identitassekolah/store', [IdentitasSekolahController::class, 'store'])->name('raport_identitassekolah_store');
         Route::get('/identitassekolah/edit/{uuid}', [IdentitasSekolahController::class, 'edit'])->name('raport_identitassekolah_edit');
         Route::put('/identitassekolah/update/{uuid}', [IdentitasSekolahController::class, 'update'])->name('raport_identitassekolah_update');
         Route::delete('identitassekolah/delete/{uuid}', [IdentitasSekolahController::class, 'destroy'])->name('raport_identitassekolah_delete');

         // raport - izin kenaikan kelas
         Route::get('/izinkenaikankelas', [IzinKenaikanKelasController::class, 'index'])->name('raport_izinkenaikankelas_page');
         Route::get('/izinkenaikankelas/add', [IzinKenaikanKelasController::class, 'storePage'])->name('raport_izinkenaikankelas_add');
         Route::post('/izinkenaikankelas/store', [IzinKenaikanKelasController::class, 'store'])->name('raport_izinkenaikankelas_store');
         Route::get('/izinkenaikankelas/edit/{uuid}', [IzinKenaikanKelasController::class, 'edit'])->name('raport_izinkenaikankelas_edit');
         Route::put('/izinkenaikankelas/update/{uuid}', [IzinKenaikanKelasController::class, 'update'])->name('raport_izinkenaikankelas_update');
         Route::delete('izinkenaikankelas/delete/{uuid}', [IzinKenaikanKelasController::class, 'destroy'])->name('raport_izinkenaikankelas_delete');

         // raport - juara kelas
         Route::get('/juarakelas', [JuaraKelasController::class, 'index'])->name('raport_juarakelas_page');
         Route::get('/juarakelas/add', [JuaraKelasController::class, 'storePage'])->name('raport_juarakelas_add');
         Route::post('/juarakelas/store', [JuaraKelasController::class, 'store'])->name('raport_juarakelas_store');
         Route::get('/juarakelas/edit/{uuid}', [JuaraKelasController::class, 'edit'])->name('raport_juarakelas_edit');
         Route::put('/juarakelas/update/{uuid}', [JuaraKelasController::class, 'update'])->name('raport_juarakelas_update');
         Route::delete('juarakelas/delete/{uuid}', [JuaraKelasController::class, 'destroy'])->name('raport_juarakelas_delete');

         // raport - juara umum
         Route::get('/juaraumum', [JuaraUmumController::class, 'index'])->name('raport_juaraumum_page');
         Route::get('/juaraumum/add', [JuaraUmumController::class, 'storePage'])->name('raport_juaraumum_add');
         Route::post('/juaraumum/store', [JuaraUmumController::class, 'store'])->name('raport_juaraumum_store');
         Route::get('/juaraumum/edit/{uuid}', [JuaraUmumController::class, 'edit'])->name('raport_juaraumum_edit');
         Route::put('/juaraumum/update/{uuid}', [JuaraUmumController::class, 'update'])->name('raport_juaraumum_update');
         Route::delete('juaraumum/delete/{uuid}', [JuaraUmumController::class, 'destroy'])->name('raport_juaraumum_delete');

         // raport - jumlah ketidakhadiran
         Route::get('/jumlahketidakhadiran', [JumlahKetidakhadiranController::class, 'index'])->name('raport_jumlahketidakhadiran_page');
         Route::get('/jumlahketidakhadiran/add', [JumlahKetidakhadiranController::class, 'storePage'])->name('raport_jumlahketidakhadiran_add');
         Route::post('/jumlahketidakhadiran/store', [JumlahKetidakhadiranController::class, 'store'])->name('raport_jumlahketidakhadiran_store');
         Route::get('/jumlahketidakhadiran/edit/{uuid}', [JumlahKetidakhadiranController::class, 'edit'])->name('raport_jumlahketidakhadiran_edit');
         Route::put('/jumlahketidakhadiran/update/{uuid}', [JumlahKetidakhadiranController::class, 'update'])->name('raport_jumlahketidakhadiran_update');
         Route::delete('jumlahketidakhadiran/delete/{uuid}', [JumlahKetidakhadiranController::class, 'destroy'])->name('raport_jumlahketidakhadiran_delete');

         // raport - kategori penilaian sikap
         Route::get('/kategoripenilaiansikap', [KategoriPenilaianSikapController::class, 'index'])->name('raport_kategoripenilaiansikap_page');
         Route::get('/kategoripenilaiansikap/add', [KategoriPenilaianSikapController::class, 'storePage'])->name('raport_kategoripenilaiansikap_add');
         Route::post('/kategoripenilaiansikap/store', [KategoriPenilaianSikapController::class, 'store'])->name('raport_kategoripenilaiansikap_store');
         Route::get('/kategoripenilaiansikap/edit/{uuid}', [KategoriPenilaianSikapController::class, 'edit'])->name('raport_kategoripenilaiansikap_edit');
         Route::put('/kategoripenilaiansikap/update/{uuid}', [KategoriPenilaianSikapController::class, 'update'])->name('raport_kategoripenilaiansikap_update');
         Route::delete('kategoripenilaiansikap/delete/{uuid}', [KategoriPenilaianSikapController::class, 'destroy'])->name('raport_kategoripenilaiansikap_delete');

         // raport - kkm
         Route::get('/kkm', [KkmController::class, 'index'])->name('raport_kkm_page');
         Route::get('/kkm/add', [KkmController::class, 'storePage'])->name('raport_kkm_add');
         Route::post('/kkm/store', [KkmController::class, 'store'])->name('raport_kkm_store');
         Route::get('/kkm/edit/{uuid}', [KkmController::class, 'edit'])->name('raport_kkm_edit');
         Route::put('/kkm/update/{uuid}', [KkmController::class, 'update'])->name('raport_kkm_update');
         Route::delete('kkm/delete/{uuid}', [KkmController::class, 'destroy'])->name('raport_kkm_delete');

         // raport - nilai raport
         Route::get('/nilairaport', [NilaiRaportController::class, 'index'])->name('raport_nilairaport_page');
         Route::get('/nilairaport/add', [NilaiRaportController::class, 'storePage'])->name('raport_nilairaport_add');
         Route::post('/nilairaport/store', [NilaiRaportController::class, 'store'])->name('raport_nilairaport_store');
         Route::get('/nilairaport/edit/{uuid}', [NilaiRaportController::class, 'edit'])->name('raport_nilairaport_edit');
         Route::put('/nilairaport/update/{uuid}', [NilaiRaportController::class, 'update'])->name('raport_nilairaport_update');
         Route::delete('nilairaport/delete/{uuid}', [NilaiRaportController::class, 'destroy'])->name('raport_nilairaport_delete');

         // raport - nilai sikap
         Route::get('/nilaisikap', [NilaiSikapController::class, 'index'])->name('raport_nilaisikap_page');
         Route::get('/nilaisikap/add', [NilaiSikapController::class, 'storePage'])->name('raport_nilaisikap_add');
         Route::post('/nilaisikap/store', [NilaiSikapController::class, 'store'])->name('raport_nilaisikap_store');
         Route::get('/nilaisikap/edit/{uuid}', [NilaiSikapController::class, 'edit'])->name('raport_nilaisikap_edit');
         Route::put('/nilaisikap/update/{uuid}', [NilaiSikapController::class, 'update'])->name('raport_nilaisikap_update');
         Route::delete('nilaisikap/delete/{uuid}', [NilaiSikapController::class, 'destroy'])->name('raport_nilaisikap_delete');

         // raport - nilai umum
         Route::get('/nilaiumum', [NilaiUmumController::class, 'index'])->name('raport_nilaiumum_page');
         Route::get('/nilaiumum/add', [NilaiUmumController::class, 'storePage'])->name('raport_nilaiumum_add');
         Route::post('/nilaiumum/store', [NilaiUmumController::class, 'store'])->name('raport_nilaiumum_store');
         Route::get('/nilaiumum/edit/{uuid}', [NilaiUmumController::class, 'edit'])->name('raport_nilaiumum_edit');
         Route::put('/nilaiumum/update/{uuid}', [NilaiUmumController::class, 'update'])->name('raport_nilaiumum_update');
         Route::delete('nilaiumum/delete/{uuid}', [NilaiUmumController::class, 'destroy'])->name('raport_nilaiumum_delete');

      });

      // inventaris route
      Route::prefix('inventaris')->group(function () {
         // inventaris kategori barang
         Route::get('/kategoribarang', [KategoriBarangController::class, 'index'])->name('inventaris_kategoribarang_page');
         Route::get('/kategoribarang/add', [KategoriBarangController::class, 'storePage'])->name('inventaris_kategoribarang_add');
         Route::post('/kategoribarang/store', [KategoriBarangController::class, 'store'])->name('inventaris_kategoribarang_store');
         Route::get('/kategoribarang/edit/{uuid}', [KategoriBarangController::class, 'edit'])->name('inventaris_kategoribarang_edit');
         Route::put('/kategoribarang/update/{uuid}', [KategoriBarangController::class, 'update'])->name('inventaris_kategoribarang_update');
         Route::delete('/kategoribarang/delete/{uuid}', [KategoriBarangController::class, 'destroy'])->name('inventaris_kategoribarang_delete');

         // inventaris lokasi barang
         Route::get('/lokasibarang', [LokasiBarangController::class, 'index'])->name('inventaris_lokasibarang_page');
         Route::get('/lokasibarang/add', [LokasiBarangController::class, 'storePage'])->name('inventaris_lokasibarang_add');
         Route::post('/lokasibarang/store', [LokasiBarangController::class, 'store'])->name('inventaris_lokasibarang_store');
         Route::get('/lokasibarang/edit/{uuid}', [LokasiBarangController::class, 'edit'])->name('inventaris_lokasibarang_edit');
         Route::put('/lokasibarang/update/{uuid}', [LokasiBarangController::class, 'update'])->name('inventaris_lokasibarang_update');
         Route::delete('/lokasibarang/delete/{uuid}', [LokasiBarangController::class, 'destroy'])->name('inventaris_lokasibarang_delete');

         // inventaris barang masuk
         Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('inventaris_barangmasuk_page');
         Route::get('/barangmasuk/add', [BarangMasukController::class, 'storePage'])->name('inventaris_barangmasuk_add');
         Route::post('/barangmasuk/store', [BarangMasukController::class, 'store'])->name('inventaris_barangmasuk_store');
         Route::get('/barangmasuk/edit/{uuid}', [BarangMasukController::class, 'edit'])->name('inventaris_barangmasuk_edit');
         Route::put('/barangmasuk/update/{uuid}', [BarangMasukController::class, 'update'])->name('inventaris_barangmasuk_update');
         Route::delete('/barangmasuk/delete/{uuid}', [BarangMasukController::class, 'destroy'])->name('inventaris_barangmasuk_delete');

         // inventaris barang keluar
         Route::get('/barangakeluar', [BarangKeluarController::class, 'index'])->name('inventaris_barangkeluar_page');
         Route::get('/barangkeluar/add', [BarangKeluarController::class, 'storePage'])->name('inventaris_barangkeluar_add');
         Route::post('/barangkeluar/store', [BarangKeluarController::class, 'store'])->name('inventaris_barangkeluar_store');
         Route::get('/barangkeluar/edit/{uuid}', [BarangKeluarController::class, 'edit'])->name('inventaris_barangkeluar_edit');
         Route::put('/barangkeluar/update/{uuid}', [BarangKeluarController::class, 'update'])->name('inventaris_barangkeluar_update');
         Route::delete('/barangkeluar/delete/{uuid}', [BarangKeluarController::class, 'destroy'])->name('inventaris_barangkeluar_delete');
      });

      // bukumedia route
      Route::prefix('bukumedia')->group(function () {
         // bukumedia ebooks
         Route::get('/ebooks', [EbooksController::class, 'index'])->name('bukumedia_ebooks_page');
         Route::get('/ebooks/add', [EbooksController::class, 'storePage'])->name('bukumedia_ebooks_add');
         Route::post('/ebooks/store', [EbooksController::class, 'store'])->name('bukumedia_ebooks_store');
         Route::get('/ebooks/edit/{uuid}', [EbooksController::class, 'edit'])->name('bukumedia_ebooks_edit');
         Route::put('/ebooks/update/{uuid}', [EbooksController::class, 'update'])->name('bukumedia_ebooks_update');
         Route::delete('/ebooks/delete/{uuid}', [EbooksController::class, 'destroy'])->name('bukumedia_ebooks_delete');

         // bukumedia media pembelajaran 
         Route::get('/mediaparent', [MediaParentController::class, 'index'])->name('bukumedia_mediaparent_page');
         // Route::get('/mediaparent/add', [MediaParentController::class, 'storePage'])->name('bukumedia_mediaparent_add');
         Route::post('/mediaparent/store', [MediaParentController::class, 'store'])->name('bukumedia_mediaparent_store');
         Route::get('/mediaparent/edit/{uuid}', [MediaParentController::class, 'edit'])->name('bukumedia_mediaparent_edit');
         Route::put('/mediaparent/update/{uuid}', [MediaParentController::class, 'update'])->name('bukumedia_mediaparent_update');
         Route::delete('/mediaparent/delete/{uuid}', [MediaParentController::class, 'destroy'])->name('bukumedia_mediaparent_delete');
         // 
         Route::post('/mediasubf1/store/{id_mediaParent}', [mediaSubF1Controller::class, 'store'])->name('bukumedia_mediasubf1_store');
         Route::get('/mediasubf1/edit/{uuid}', [mediaSubF1Controller::class, 'edit'])->name('bukumedia_mediasubf1_edit');
         Route::put('/mediasubf1/update/{uuid}/{idMediaParent}', [mediaSubF1Controller::class, 'update'])->name('bukumedia_mediasubf1_update');
         Route::delete('/mediasubf1/delete/{uuid}', [mediaSubF1Controller::class, 'destroy'])->name('bukumedia_mediasubf1_delete');
         // 
         Route::post('/mediasubf2/store/{mediaSubF1Id}', [mediaSubF2Controller::class, 'store'])->name('bukumedia_mediasubf2_store');
         Route::get('/mediasubf2/edit/{uuid}', [mediaSubF2Controller::class, 'edit'])->name('bukumedia_mediasubf2_edit');
         Route::put('/mediasubf2/update/{uuid}/{mediaSubF1Id}', [mediaSubF2Controller::class, 'update'])->name('bukumedia_mediasubf2_update');
         Route::delete('/mediasubf2/delete/{uuid}', [mediaSubF2Controller::class, 'destroy'])->name('bukumedia_mediasubf1_delete');
         // 
         Route::post('/mediafile/store/{id_mediaSubF2}', [mediaFileController::class, 'store'])->name('bukumedia_mediafile_store');
         Route::get('/mediafile/edit/{uuid}', [mediaFileController::class, 'edit'])->name('bukumedia_mediafile_edit');
         Route::post('mediafile/update/{uuid}/{id_mediaSubF2}', [mediaFileController::class, 'update'])->name('bukumedia_mediafile_update');
         Route::delete('/mediafile/delete/{uuid}', [mediaFileController::class, 'destroy'])->name('bukumedia_mediafile_delete');
         
         
      });


      // penjadwalan route
      Route::prefix('penjadwalan')->group(function () {
         // penjadwalan kalender akademik
         Route::get('/kalenderakademik', [KalenderAkademikController::class, 'index'])->name('penjadwalan_kalenderakademik_page');
         // Get Events
         Route::get('/kalenderakademik/events', [KalenderAkademikController::class, 'GetEvents'])->name('penjadwalan_kalenderakademik_events');
         Route::post('/kalenderakademik/store', [KalenderAkademikController::class, 'store'])->name('penjadwalan_kalenderakademik_store');
         Route::get('/kalenderakademik/edit/{id}', [KalenderAkademikController::class, 'edit'])->name('penjadwalan_kalenderakademik_edit');
         Route::post('/kalenderakademik/update/{id}', [KalenderAkademikController::class, 'update'])->name('penjadwalan_kalenderakademik_update');

         // penjadwalan jadwal pelajaran
         Route::get('/jadwalpelajaran', [JadwalPelajaranController::class, 'index'])->name('penjadwalan_jadwalpelajaran_page');
         Route::get('/jadwalpelajaran/add', [JadwalPelajaranController::class, 'storePage'])->name('penjadwalan_jadwalpelajaran_add');
         Route::post('/jadwalpelajaran/store', [JadwalPelajaranController::class, 'store'])->name('penjadwalan_jadwalpelajaran_store');
         Route::get('/jadwalpelajaran/edit/{uuid}', [JadwalPelajaranController::class, 'edit'])->name('penjadwalan_jadwalpelajaran_edit');
         Route::put('/jadwalpelajaran/update/{uuid}', [JadwalPelajaranController::class, 'update'])->name('penjadwalan_jadwalpelajaran_update');
         Route::delete('/jadwalpelajaran/delete/{uuid}', [JadwalPelajaranController::class, 'destroy'])->name('penjadwalan_jadwalpelajaran_delete');

          // penjadwalan jadwal pertemuan
          Route::get('/jadwalpertemuan', [JadwalPertemuanController::class, 'index'])->name('penjadwalan_jadwalpertemuan_page');
          // Get Events
          Route::get('/jadwalpertemuan/events', [JadwalPertemuanController::class, 'GetEvents'])->name('penjadwalan_jadwalpertemuan_events');
          Route::post('/jadwalpertemuan/store', [JadwalPertemuanController::class, 'store'])->name('penjadwalan_jadwalpertemuan_store');
          Route::get('/jadwalpertemuan/edit/{id}', [JadwalPertemuanController::class, 'edit'])->name('penjadwalan_jadwalpertemuan_edit');
          Route::post('/jadwalpertemuan/update/{id}', [JadwalPertemuanController::class, 'update'])->name('penjadwalan_jadwalpertemuan_update');
      });


      // pemberitahuan route
      Route::prefix('pemberitahuan')->group(function () {
         // pemberitahuan event
         Route::get('/event', [EventController::class, 'index'])->name('pemberitahuan_event_page');
         Route::get('/event/add', [EventController::class, 'storePage'])->name('pemberitahuan_event_add');
         Route::post('/event/store', [EventController::class, 'store'])->name('pemberitahuan_event_store');
         Route::get('/event/edit/{uuid}', [EventController::class, 'edit'])->name('pemberitahuan_event_edit');
         Route::put('/event/update/{uuid}', [EventController::class, 'update'])->name('pemberitahuan_event_update');
         Route::delete('/event/delete/{uuid}', [EventController::class, 'destroy'])->name('pemberitahuan_event_delete');

         // pemberitahuan liburan
         Route::get('/liburan', [LiburanController::class, 'index'])->name('pemberitahuan_liburan_page');
         Route::get('/liburan/add', [LiburanController::class, 'storePage'])->name('pemberitahuan_liburan_add');
         Route::post('/liburan/store', [LiburanController::class, 'store'])->name('pemberitahuan_liburan_store');
         Route::get('/liburan/edit/{uuid}', [LiburanController::class, 'edit'])->name('pemberitahuan_liburan_edit');
         Route::put('/liburan/update/{uuid}', [LiburanController::class, 'update'])->name('pemberitahuan_liburan_update');
         Route::delete('/liburan/delete/{uuid}', [LiburanController::class, 'destroy'])->name('pemberitahuan_liburan_delete');

          // pemberitahuan ekstrakurikuler
         Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('pemberitahuan_ekstrakurikuler_page');
         Route::get('/ekstrakurikuler/add', [EkstrakurikulerController::class, 'storePage'])->name('pemberitahuan_ekstrakurikuler_add');
         Route::post('/ekstrakurikuler/store', [EkstrakurikulerController::class, 'store'])->name('pemberitahuan_ekstrakurikuler_store');
         Route::get('/ekstrakurikuler/edit/{uuid}', [EkstrakurikulerController::class, 'edit'])->name('pemberitahuan_ekstrakurikuler_edit');
         Route::put('/ekstrakurikuler/update/{uuid}', [EkstrakurikulerController::class, 'update'])->name('pemberitahuan_ekstrakurikuler_update');
         Route::delete('/ekstrakurikuler/delete/{uuid}', [EkstrakurikulerController::class, 'destroy'])->name('pemberitahuan_ekstrakurikuler_delete');

         // pemberitahuan rencana kegiatan
         Route::get('/rencanakegiatan', [RencanaKegiatanController::class, 'index'])->name('pemberitahuan_rencanakegiatan_page');
         Route::get('/rencanakegiatan/add', [RencanaKegiatanController::class, 'storePage'])->name('pemberitahuan_rencanakegiatan_add');
         Route::post('/rencanakegiatan/store', [RencanaKegiatanController::class, 'store'])->name('pemberitahuan_rencanakegiatan_store');
         Route::get('/rencanakegiatan/edit/{uuid}', [RencanaKegiatanController::class, 'edit'])->name('pemberitahuan_rencanakegiatan_edit');
         Route::put('/rencanakegiatan/update/{uuid}', [RencanaKegiatanController::class, 'update'])->name('pemberitahuan_rencanakegiatan_update');
         Route::delete('/rencanakegiatan/delete/{uuid}', [RencanaKegiatanController::class, 'destroy'])->name('pemberitahuan_rencanakegiatan_delete');

         // pemberitahuan galeri kegiatan media  
         Route::get('/gkmediaparent', [GKMediaParentController::class, 'index'])->name('pemberitahuan_gkmediaparent_page');
         // Route::get('/GKMediaparent/add', [MediaParentController::class, 'storePage'])->name('pemberitahuan_mediaparent_add');
         Route::post('/gkmediaparent/store', [GKMediaParentController::class, 'store'])->name('pemberitahuan_gkmediaparent_store');
         Route::get('/gkmediaparent/edit/{uuid}', [GKMediaParentController::class, 'edit'])->name('pemberitahuan_gkmediaparent_edit');
         Route::put('/gkmediaparent/update/{uuid}', [GKMediaParentController::class, 'update'])->name('pemberitahuan_gkmediaparent_update');
         Route::delete('/gkmediaparent/delete/{uuid}', [GKMediaParentController::class, 'destroy'])->name('pemberitahuan_gkmediaparent_delete');
         // 
         Route::post('/gkmediasubf1/store/{id_mediaParent}', [GKMediaSubF1Controller::class, 'store'])->name('pemberitahuan_gkmediasubf1_store');
         Route::get('/gkmediasubf1/edit/{uuid}', [GKMediaSubF1Controller::class, 'edit'])->name('pemberitahuan_gkmediasubf1_edit');
         Route::put('/gkmediasubf1/update/{uuid}/{idMediaParent}', [GKMediaSubF1Controller::class, 'update'])->name('pemberitahuan_gkmediasubf1_update');
         Route::delete('/gkmediasubf1/delete/{uuid}', [GKMediaSubF1Controller::class, 'destroy'])->name('pemberitahuan_gkmediasubf1_delete');
         // 
         Route::post('/gkmediasubf2/store/{mediaSubF1Id}', [GKMediaSubF2Controller::class, 'store'])->name('pemberitahuan_gkmediasubf2_store');
         Route::get('/gkmediasubf2/edit/{uuid}', [GKMediaSubF2Controller::class, 'edit'])->name('pemberitahuan_gkmediasubf2_edit');
         Route::put('/gkmediasubf2/update/{uuid}/{mediaSubF1Id}', [GKMediaSubF2Controller::class, 'update'])->name('pemberitahuan_gkmediasubf2_update');
         Route::delete('/gkmediasubf2/delete/{uuid}', [GKMediaSubF2Controller::class, 'destroy'])->name('pemberitahuan_gkmediasubf1_delete');
         // 
         Route::post('/gkmediafile/store/{id_mediaSubF2}', [GKMediaFileController::class, 'store'])->name('pemberitahuan_gkmediafile_store');
         Route::get('/gkmediafile/edit/{uuid}', [GKMediaFileController::class, 'edit'])->name('pemberitahuan_gkmediafile_edit');
         Route::post('gkmediafile/update/{uuid}/{id_mediaSubF2}', [GKMediaFileController::class, 'update'])->name('pemberitahuan_gkmediafile_update');
         Route::delete('/gkmediafile/delete/{uuid}', [GKMediaFileController::class, 'destroy'])->name('pemberitahuan_gkmediafile_delete');

         // -------------------------------------------------------------------------------------------------

      // pemberitahuan rencana kegiatan
         Route::get('kegiatan/rencanakegiatan', [RencanaKegiatanController::class, 'index'])->name('pemberitahuan_kegiatan_rencanakegiatan_page');
         Route::get('kegiatan/rencanakegiatan/add', [RencanaKegiatanController::class, 'storePage'])->name('pemberitahuan_kegiatan_rencanakegiatan_add');
         Route::post('kegiatan/rencanakegiatan/store', [RencanaKegiatanController::class, 'store'])->name('pemberitahuan_kegiatan_rencanakegiatan_store');
         Route::get('kegiatan/rencanakegiatan/edit/{uuid}', [RencanaKegiatanController::class, 'edit'])->name('pemberitahuan_kegiatan_rencanakegiatan_edit');
         Route::put('kegiatan/rencanakegiatan/update/{uuid}', [RencanaKegiatanController::class, 'update'])->name('pemberitahuan_kegiatan_rencanakegiatan_update');
         Route::delete('kegiatan/rencanakegiatan/delete/{uuid}', [RencanaKegiatanController::class, 'destroy'])->name('pemberitahuan_kegiatan_rencanakegiatan_delete');

         // pemberitahuan galeri kegiatan media  
         Route::get('kegiatan/gkmediaparent', [GKMediaParentController::class, 'index'])->name('pemberitahuan_kegiatan_gkmediaparent_page');
         // Route::get('/GKMediaparent/add', [MediaParentController::class, 'storePage'])->name('pemberitahuan_mediaparent_add');
         Route::post('kegiatan/gkmediaparent/store', [GKMediaParentController::class, 'store'])->name('pemberitahuan_kegiatan_gkmediaparent_store');
         Route::get('kegiatan/gkmediaparent/edit/{uuid}', [GKMediaParentController::class, 'edit'])->name('pemberitahuan_kegiatan_gkmediaparent_edit');
         Route::put('kegiatan/gkmediaparent/update/{uuid}', [GKMediaParentController::class, 'update'])->name('pemberitahuan_kegiatan_gkmediaparent_update');
         Route::delete('kegiatan/gkmediaparent/delete/{uuid}', [GKMediaParentController::class, 'destroy'])->name('pemberitahuan_kegiatan_gkmediaparent_delete');
         // 
         Route::post('kegiatan/gkmediasubf1/store/{id_mediaParent}', [GKMediaSubF1Controller::class, 'store'])->name('pemberitahuan_kegiatan_gkmediasubf1_store');
         Route::get('kegiatan/gkmediasubf1/edit/{uuid}', [GKMediaSubF1Controller::class, 'edit'])->name('pemberitahuan_kegiatan_gkmediasubf1_edit');
         Route::put('kegiatan/gkmediasubf1/update/{uuid}/{idMediaParent}', [GKMediaSubF1Controller::class, 'update'])->name('pemberitahuan_kegiatan_gkmediasubf1_update');
         Route::delete('kegiatan/gkmediasubf1/delete/{uuid}', [GKMediaSubF1Controller::class, 'destroy'])->name('pemberitahuan_kegiatan_gkmediasubf1_delete');
         // 
         Route::post('kegiatan/gkmediasubf2/store/{mediaSubF1Id}', [GKMediaSubF2Controller::class, 'store'])->name('pemberitahuan_kegiatan_gkmediasubf2_store');
         Route::get('kegiatan/gkmediasubf2/edit/{uuid}', [GKMediaSubF2Controller::class, 'edit'])->name('pemberitahuan_kegiatan_gkmediasubf2_edit');
         Route::put('kegiatan/gkmediasubf2/update/{uuid}/{mediaSubF1Id}', [GKMediaSubF2Controller::class, 'update'])->name('pemberitahuan_kegiatan_gkmediasubf2_update');
         Route::delete('kegiatan/gkmediasubf2/delete/{uuid}', [GKMediaSubF2Controller::class, 'destroy'])->name('pemberitahuan_kegiatan_gkmediasubf1_delete');
         // 
         Route::post('kegiatan/gkmediafile/store/{id_mediaSubF2}', [GKMediaFileController::class, 'store'])->name('pemberitahuan_kegiatan_gkmediafile_store');
         Route::get('kegiatan/gkmediafile/edit/{uuid}', [GKMediaFileController::class, 'edit'])->name('pemberitahuan_kegiatan_gkmediafile_edit');
         Route::post('kegiatan/gkmediafile/update/{uuid}/{id_mediaSubF2}', [GKMediaFileController::class, 'update'])->name('pemberitahuan_kegiatan_gkmediafile_update');
         Route::delete('kegiatan/gkmediafile/delete/{uuid}', [GKMediaFileController::class, 'destroy'])->name('pemberitahuan_kegiatan_gkmediafile_delete');
         // ---------------------------------------------------------------------------------------------------
      });

      // pengaturan route
      Route::prefix('pengaturan')->group(function () {
         Route::get('/tahunajaran', [TahunAjaranController::class, 'index'])->name('pengaturan_tahunajaran_page');
         Route::get('/tahunajaran/add', [TahunAjaranController::class, 'storePage'])->name('pengaturan_tahunajaran_add');
         Route::post('/tahunajaran/store', [TahunAjaranController::class, 'store'])->name('pengaturan_tahunajaran_store');
         Route::get('/tahunajaran/edit/{uuid}', [TahunAjaranController::class, 'edit'])->name('pengaturan_tahunajaran_edit');
         Route::put('/tahunajaran/update/{uuid}', [TahunAjaranController::class, 'update'])->name('pengaturan_tahunajaran_update');
         Route::delete('/tahunajaran/delete/{uuid}', [TahunAjaranController::class, 'destroy'])->name('pengaturan_tahunajaran_delete');

         Route::get('/semester', [SemesterController::class, 'index'])->name('pengaturan_semester_page');
         Route::get('/semester/add', [SemesterController::class, 'storePage'])->name('pengaturan_semester_add');
         Route::post('/semester/store', [SemesterController::class, 'store'])->name('pengaturan_semester_store');
         Route::get('/semester/edit/{uuid}', [SemesterController::class, 'edit'])->name('pengaturan_semester_edit');
         Route::put('/semester/update/{uuid}', [SemesterController::class, 'update'])->name('pengaturan_semester_update');
         Route::delete('/semester/delete/{uuid}', [SemesterController::class, 'destroy'])->name('pengaturan_semester_delete');

         // roles pengaturan
         Route::get('/role', [RolesController::class, 'index'])->name('pengaturan_role_page');
         Route::get('/role/add', [RolesController::class, 'storePage'])->name('pengaturan_role_add');
         Route::post('/role/store', [RolesController::class, 'store'])->name('pengaturan_role_store');
         Route::get('/role/edit/{id}', [RolesController::class, 'edit'])->name('pengaturan_role_edit');
         Route::put('/role/update/{id}', [RolesController::class, 'update'])->name('pengaturan_role_update');
         Route::delete('/role/delete/{id}', [RolesController::class, 'destroy'])->name('pengaturan_role_delete');

         // pengaturan pengaturan-sistem
         Route::get('/pengaturansistem', [UserSettingController::class, 'index'])->name('pengaturan_pengaturansistem_page');
         Route::post('/pengaturansistem/modify', [UserSettingController::class, 'ModifyUserSetting'])->name('pengaturan_pengaturansistem_modify');

         // pengaturan sosial-link
         Route::get('/sosiallink', [SosialLinkController::class, 'index'])->name('pengaturan_sosiallink_page');
         Route::get('/sosiallink/add', [SosialLinkController::class, 'storePage'])->name('pengaturan_sosiallink_add');
         Route::post('/sosiallink/store', [SosialLinkController::class, 'store'])->name('pengaturan_sosiallink_store');
         Route::get('/sosiallink/edit/{uuid}', [SosialLinkController::class, 'edit'])->name('pengaturan_sosiallink_edit');
         Route::put('/sosiallink/update/{uuid}', [SosialLinkController::class, 'update'])->name('pengaturan_sosiallink_update');
         Route::delete('/sosiallink/delete/{uuid}', [SosialLinkController::class, 'destroy'])->name('pengaturan_sosiallink_delete');

         // pengaturan import-file
         Route::get('/importfile', [ImportFileController::class, 'index'])->name('pengaturan_importfile_page');
         Route::get('/importfile/add', [ImportFileController::class, 'storePage'])->name('pengaturan_importfile_add');
         Route::post('/importfile/store', [ImportFileController::class, 'store'])->name('pengaturan_importfile_store');
         Route::get('/importfile/edit/{uuid}', [ImportFileController::class, 'edit'])->name('pengaturan_importfile_edit');
         Route::post('/importfile/update/{uuid}', [ImportFileController::class, 'update'])->name('pengaturan_importfile_update');
         Route::delete('/importfile/delete/{uuid}', [ImportFileController::class, 'destroy'])->name('pengaturan_importfile_delete');
      });
   });  
});

Route::prefix('guru')->middleware('auth:guru')->group(function() {
   Route::get('/dashboard', [PageController::class, 'GuruDashboard'])->name('Guru_Dashboard');

   Route::prefix('master')->group(function () {
      // only read siswa master
      Route::get('/siswa', [SiswaController::class, 'index2'])->name('guru_siswamaster_page');
      Route::get('/siswa/info/{uuid}', [SiswaController::class, 'SiswaInfo'])->name('guru_siswamaster_info');

      // only read guru master
      Route::get('/guru', [GuruController::class, 'index2'])->name('guru_gurumaster_page');
      Route::get('/guru/info/{uuid}', [GuruController::class, 'GuruInfo'])->name('guru_gurumaster_info');

      // only read guru master
      Route::get('/orangtua', [OrangtuaController::class, 'index2'])->name('guru_orangtuamaster_page');
      Route::get('/orangtua/info/{uuid}', [OrangtuaController::class, 'OrangTuaInfo'])->name('guru_orangtuamaster_info');

   });

   Route::prefix('akademik')->group(function () {
        // akademik tugas siswa for Admin Guru
        Route::get('/tugassiswa', [TugasSiswaController::class, 'index2'])->name('guru_akademik-tugassiswa_page');
        Route::get('/tugassiswa/add', [TugasSiswaController::class, 'storePage2'])->name('guru_akademik-tugassiswa_add');
        Route::post('/tugassiswa/store', [TugasSiswaController::class, 'store2'])->name('guru_akademik-tugassiswa_store');
        Route::get('/tugassiswa/edit/{uuid}', [TugasSiswaController::class, 'edit2'])->name('guru_akademik-tugassiswa_edit');
        Route::post('/tugassiswa/update/{uuid}', [TugasSiswaController::class, 'update2'])->name('guru_akademik-tugassiswa_update');
        Route::delete('/tugassiswa/delete/{uuid}', [TugasSiswaController::class, 'destroy2'])->name('guru_akademik-tugassiswa_delete');

        // akademik mata pelajaran for admin guru
        Route::get('/matapelajaran', [MataPelajaranController::class, 'index2'])->name('guru_akademik_matapelajaran_page');
        Route::get('/matapelajaran/add', [MataPelajaranController::class, 'storePage2'])->name('guru_akademik_matapelajaran_add');
        Route::post('/matapelajaran/store', [MataPelajaranController::class, 'store2'])->name('guru_akademik_matapelajaran_store');
        Route::get('/matapelajaran/edit/{uuid}', [MataPelajaranController::class, 'edi2t'])->name('guru_akademik_matapelajaran_edit');
        Route::put('/matapelajaran/update/{uuid}', [MataPelajaranController::class, 'update2'])->name('guru_akademik_matapelajaran_update');
        Route::delete('/matapelajaran/delete/{uuid}', [MataPelajaranController::class, 'destroy2'])->name('guru_akademik_matapelajaran_delete');

        // akademik materi for Admin Guru
        Route::get('/materi', [MateriMataPelajaranController::class, 'index2'])->name('guru_akademik-materi_page');
        Route::get('/materi/add', [MateriMataPelajaranController::class, 'storePage2'])->name('guru_akademik-materi_add');
        Route::post('/materi/store', [MateriMataPelajaranController::class, 'store2'])->name('guru_akademik-materi_store');
        Route::get('/materi/edit/{uuid}', [MateriMataPelajaranController::class, 'edit2'])->name('guru_akademik-materi_edit');
        Route::post('/materi/update/{uuid}', [MateriMataPelajaranController::class, 'update2'])->name('guru_akademik-materi_update');
        Route::delete('/materi/delete/{uuid}', [MateriMataPelajaranController::class, 'destroy2'])->name('guru_akademik-materi_delete');

   });

      // Ujian Menu For Admin Guru
      Route::prefix('ujian')->group(function () {
         // jadwal ujian For Guru Admin
         Route::get('/jadwalujian', [JadwalujianController::class, 'index2'])->name('guru_ujian-jadwalujian_page');
         Route::get('/jadwalujian/add', [JadwalujianController::class, 'storePage2'])->name('guru_ujian-jadwalujian_add');
         Route::post('/jadwalujian/store', [JadwalujianController::class, 'store2'])->name('guru_ujian-jadwalujian_store');
         Route::get('/jadwalujian/edit/{uuid}', [JadwalujianController::class, 'edit2'])->name('guru_ujian-jadwalujian_edit');
         Route::put('/jadwalujian/update/{uuid}', [JadwalujianController::class, 'update2'])->name('guru_ujian-jadwalujian_update');
         Route::delete('/jadwalujian/delete/{uuid}', [JadwalujianController::class, 'destroy2'])->name('guru_ujian-jadwalujian_delete');

         // kategori soal For Admin Guru
          Route::get('/kategorisoal', [KategorisoalController::class, 'index2'])->name('guru_ujian-kategorisoal_page');
          Route::get('/kategorisoal/add', [KategorisoalController::class, 'storePage2'])->name('guru_ujian-kategorisoal_add');
          Route::post('/kategorisoal/store', [KategorisoalController::class, 'store2'])->name('guru_ujian-kategorisoal_store');
          Route::get('/kategorisoal/edit/{uuid}', [KategorisoalController::class, 'edit2'])->name('guru_ujian-kategorisoal_edit');
          Route::put('/kategorisoal/update/{uuid}', [KategorisoalController::class, 'update2'])->name('guru_ujian-kategorisoal_update');
          Route::delete('/kategorisoal/delete/{uuid}', [KategorisoalController::class, 'destroy2'])->name('guru_ujian-kategorisoal_delete');
   
           // bank soal for admin guru
           Route::get('/banksoal', [BanksoalController::class, 'index2'])->name('guru_ujian-banksoal_page');
           Route::get('/banksoal/add', [BanksoalController::class, 'storePage2'])->name('guru_ujian-banksoal_add');
           Route::post('/banksoal/store', [BanksoalController::class, 'store2'])->name('guru_ujian-banksoal_store');
           Route::get('/banksoal/edit/{uuid}', [BanksoalController::class, 'edit2'])->name('guru_ujian-banksoal_edit');
           Route::post('/banksoal/update/{uuid}', [BanksoalController::class, 'update2'])->name('guru_ujian-banksoal_update');
           Route::delete('/banksoal/delete/{uuid}', [BanksoalController::class, 'destroy2'])->name('guru_ujian-banksoal_delete');   
   
           // intruksi ujian for admin guru
           Route::get('/intruksiujian', [IntruksiUjianController::class, 'index2'])->name('guru_ujian-intruksiujian_page');
           Route::get('/intruksiujian/add', [IntruksiUjianController::class, 'storePage2'])->name('guru_ujian-intruksiujian_add');
           Route::post('/intruksiujian/store', [IntruksiUjianController::class, 'store2'])->name('guru_ujian-intruksiujian_store');
           Route::get('/intruksiujian/edit/{uuid}', [IntruksiUjianController::class, 'edit2'])->name('guru_ujian-intruksiujian_edit');
           Route::put('/intruksiujian/update/{uuid}', [IntruksiUjianController::class, 'update2'])->name('guru_ujian-intruksiujian_update');
           Route::delete('/intruksiujian/delete/{uuid}', [IntruksiUjianController::class, 'destroy2'])->name('guru_ujian-intruksiujian_delete');
   
           // mulai ujian for admin guru
           Route::get('/mulaiujian', [MulaiUjianController::class, 'index2'])->name('guru_ujian-mulaiujian_page');
           Route::get('/mulaiujian/add', [MulaiUjianController::class, 'storePage2'])->name('guru_ujian-mulaiujian_add');
           Route::post('/mulaiujian/store', [MulaiUjianController::class, 'store2'])->name('guru_ujian-mulaiujian_store');
           Route::get('/mulaiujian/edit/{uuid}', [MulaiUjianController::class, 'edit2'])->name('guru_ujian-mulaiujian_edit');
           Route::post('/mulaiujian/update/{uuid}', [MulaiUjianController::class, 'update2'])->name('guru_ujian-mulaiujian_update');
           Route::delete('/mulaiujian/delete/{uuid}', [MulaiUjianController::class, 'destroy2'])->name('guru_ujian-mulaiujian_delete');
      });

      Route::prefix('jurnal')->group(function () {
         // jurnal kelas for admin guru
         Route::get('/jurnalkelas', [JurnalKelasController::class, 'index2'])->name('guru_jurnal-jurnalkelas_page');
         Route::get('/jurnalkelas/add', [JurnalKelasController::class, 'storePage2'])->name('guru_jurnal-jurnalkelas_add');
         Route::post('/jurnalkelas/store', [JurnalKelasController::class, 'store2'])->name('guru_jurnal-jurnalkelas_store');
         Route::get('/jurnalkelas/edit/{uuid}', [JurnalKelasController::class, 'edit2'])->name('guru_jurnal-jurnalkelas_edit');
         Route::put('/jurnalkelas/update/{uuid}', [JurnalKelasController::class, 'update2'])->name('guru_jurnal-jurnalkelas_update');
         Route::delete('/jurnalkelas/delete/{uuid}', [JurnalKelasController::class, 'destroy2'])->name('guru_jurnal-jurnalkelas_delete');
         Route::get('/jurnalkelas/generatePDF/{id}', [JurnalKelasController::class, 'DownloadReport2'])->name('guru_jurnal-jurnalkelas_download');
      });

      Route::prefix('kesiswaan')->group(function () {

         // kesiswaan - tata tertib
         Route::get('/tatatertib', [TataTertibController::class, 'index2'])->name('guru_kesiswaan-tatatertib_page');
         Route::get('/tatatertib/add', [TataTertibController::class, 'storePage2'])->name('guru_kesiswaan-tatatertib_add');
         Route::post('/tatatertib/store', [TataTertibController::class, 'store2'])->name('guru_kesiswaan-tatatertib_store');
         Route::get('/tatatertib/edit/{uuid}', [TataTertibController::class, 'edit2'])->name('guru_kesiswaan-tatatertib_edit');
         Route::put('/tatatertib/update/{uuid}', [TataTertibController::class, 'update2'])->name('guru_kesiswaan-tatatertib_update');
         Route::delete('/tatatertib/delete/{uuid}', [TataTertibController::class, 'destroy2'])->name('guru_kesiswaan-tatatertib_delete');

         // kesiswaan - pelanggaran
         Route::get('/pelanggaran', [PelanggaranController::class, 'index2'])->name('guru_kesiswaan-pelanggaran_page');
         Route::get('/pelanggaran/add', [PelanggaranController::class, 'storePage2'])->name('guru_kesiswaan-pelanggaran_add');
         Route::post('/pelanggaran/store', [PelanggaranController::class, 'store2'])->name('guru_kesiswaan-pelanggaran_store');
         Route::get('/pelanggaran/edit/{uuid}', [PelanggaranController::class, 'edit2'])->name('guru_kesiswaan-pelanggaran_edit');
         Route::put('/pelanggaran/update/{uuid}', [PelanggaranController::class, 'update2'])->name('guru_kesiswaan-pelanggaran_update');
         Route::delete('/pelanggaran/delete/{uuid}', [PelanggaranController::class, 'destroy2'])->name('guru_kesiswaan-pelanggaran_delete');
 
         // kesiswaan - sanksi pelanggaran
         Route::get('/sanksipelanggaran', [SanksiPelanggaranController::class, 'index2'])->name('guru_kesiswaan-sanksipelanggaran_page');
         Route::get('/sanksipelanggaran/add', [SanksiPelanggaranController::class, 'storePage2'])->name('guru_kesiswaan-sanksipelanggaran_add');
         Route::post('/sanksipelanggaran/store', [SanksiPelanggaranController::class, 'store2'])->name('guru_kesiswaan-sanksipelanggaran_store');
         Route::get('/sanksipelanggaran/edit/{uuid}', [SanksiPelanggaranController::class, 'edit2'])->name('guru_kesiswaan-sanksipelanggaran_edit');
         Route::put('/sanksipelanggaran/update/{uuid}', [SanksiPelanggaranController::class, 'update2'])->name('guru_kesiswaan-sanksipelanggaran_update');
         Route::delete('/sanksipelanggaran/delete/{uuid}', [SanksiPelanggaranController::class, 'destroy2'])->name('guru_kesiswaan-sanksipelanggaran_delete');

          // kesiswaan - data pelanggaran
         Route::get('/datapelanggaran', [DataPelanggaranController::class, 'index2'])->name('guru_kesiswaan-datapelanggaran_page');
         Route::get('/datapelanggaran/add', [DataPelanggaranController::class, 'storePage2'])->name('guru_kesiswaan-datapelanggaran_add');
         Route::post('/datapelanggaran/store', [DataPelanggaranController::class, 'store2'])->name('guru_kesiswaan-datapelanggaran_store');
         Route::get('/datapelanggaran/edit/{uuid}', [DataPelanggaranController::class, 'edit2'])->name('guru_kesiswaan-datapelanggaran_edit');
         Route::put('/datapelanggaran/update/{uuid}', [DataPelanggaranController::class, 'update2'])->name('guru_kesiswaan-datapelanggaran_update');
         Route::delete('/datapelanggaran/delete/{uuid}', [DataPelanggaranController::class, 'destroy2'])->name('guru_kesiswaan-datapelanggaran_delete');
      });

      Route::prefix('bk')->group(function () {
         // bk - bimbingan konseling
         Route::get('/bimbingankonseling', [BimbinganKonselingController::class, 'index2'])->name('guru_bk-bimbingankonseling_page');
         Route::get('/bimbingankonseling/add', [BimbinganKonselingController::class, 'storePage2'])->name('guru_bk-bimbingankonseling_add');
         Route::post('/bimbingankonseling/store', [BimbinganKonselingController::class, 'store2'])->name('guru_bk-bimbingankonseling_store');
         Route::get('/bimbingankonseling/edit/{uuid}', [BimbinganKonselingController::class, 'edit2'])->name('guru_bk-bimbingankonseling_edit');
         Route::put('/bimbingankonseling/update/{uuid}', [BimbinganKonselingController::class, 'update2'])->name('guru_bk-bimbingankonseling_update');
         Route::delete('/bimbingankonseling/delete/{uuid}', [BimbinganKonselingController::class, 'destroy2'])->name('guru_bk-bimbingankonseling_delete');

         // bk - data bimbingan konseling
         Route::get('/databimbingankonseling', [DataBimbinganKonselingController::class, 'index2'])->name('guru_bk-databimbingankonseling_page');
         Route::get('/databimbingankonseling/add', [DataBimbinganKonselingController::class, 'storePage2'])->name('guru_bk-databimbingankonseling_add');
         Route::post('/databimbingankonseling/store', [DataBimbinganKonselingController::class, 'store2'])->name('guru_bk-databimbingankonseling_store');
         Route::get('/databimbingankonseling/edit/{uuid}', [DataBimbinganKonselingController::class, 'edit2'])->name('guru_bk-databimbingankonseling_edit');
         Route::put('/databimbingankonseling/update/{uuid}', [DataBimbinganKonselingController::class, 'update2'])->name('guru_bk-databimbingankonseling_update');
         Route::delete('/databimbingankonseling/delete/{uuid}', [DataBimbinganKonselingController::class, 'destroy2'])->name('guru_bk-databimbingankonseling_delete');

      });

      Route::prefix('bukumedia')->group(function () {

         // bukumedia ebooks for admin guru
         Route::get('/ebooks', [EbooksController::class, 'index2'])->name('guru_bukumedia-ebooks_page');
         Route::get('/ebooks/add', [EbooksController::class, 'storePage2'])->name('guru_bukumedia-ebooks_add');
         Route::post('/ebooks/store', [EbooksController::class, 'store2'])->name('guru_bukumedia-ebooks_store');
         Route::get('/ebooks/edit/{uuid}', [EbooksController::class, 'edit2'])->name('guru_bukumedia-ebooks_edit');
         Route::put('/ebooks/update/{uuid}', [EbooksController::class, 'update2'])->name('guru_bukumedia-ebooks_update');
         Route::delete('/ebooks/delete/{uuid}', [EbooksController::class, 'destroy2'])->name('guru_bukumedia-ebooks_delete');

         // bukumedia media pembelajaran 
         Route::get('/mediaparent', [MediaParentController::class, 'index2'])->name('guru_bukumedia_mediaparent_page');
         // Route::get('/mediaparent/add', [MediaParentController::class, 'storePage'])->name('guru_bukumedia_mediaparent_add');
         Route::post('/mediaparent/store', [MediaParentController::class, 'store2'])->name('guru_bukumedia_mediaparent_store');
         Route::get('/mediaparent/edit/{uuid}', [MediaParentController::class, 'edit2'])->name('guru_bukumedia_mediaparent_edit');
         Route::put('/mediaparent/update/{uuid}', [MediaParentController::class, 'update2'])->name('guru_bukumedia_mediaparent_update');
         Route::delete('/mediaparent/delete/{uuid}', [MediaParentController::class, 'destro2'])->name('guru_bukumedia_mediaparent_delete');
         // 
         Route::post('/mediasubf1/store/{id_mediaParent}', [mediaSubF1Controller::class, 'store2'])->name('guru_bukumedia_mediasubf1_store');
         Route::get('/mediasubf1/edit/{uuid}', [mediaSubF1Controller::class, 'edit2'])->name('guru_bukumedia_mediasubf1_edit');
         Route::put('/mediasubf1/update/{uuid}/{idMediaParent}', [mediaSubF1Controller::class, 'update2'])->name('guru_bukumedia_mediasubf1_update');
         Route::delete('/mediasubf1/delete/{uuid}', [mediaSubF1Controller::class, 'destroy2'])->name('guru_bukumedia_mediasubf1_delete');
         // 
         Route::post('/mediasubf2/store/{mediaSubF1Id}', [mediaSubF2Controller::class, 'store2'])->name('bukumedia_mediasubf2_store');
         Route::get('/mediasubf2/edit/{uuid}', [mediaSubF2Controller::class, 'edit2'])->name('bukumedia_mediasubf2_edit');
         Route::put('/mediasubf2/update/{uuid}/{mediaSubF1Id}', [mediaSubF2Controller::class, 'update2'])->name('bukumedia_mediasubf2_update');
         Route::delete('/mediasubf2/delete/{uuid}', [mediaSubF2Controller::class, 'destroy2'])->name('bukumedia_mediasubf2_delete');
         // 
         Route::post('/mediafile/store/{id_mediaSubF2}', [mediaFileController::class, 'store2'])->name('guru_bukumedia_mediafile_store');
         Route::get('/mediafile/edit/{uuid}', [mediaFileController::class, 'edit2'])->name('guru_bukumedia_mediafile_edit');
         Route::post('mediafile/update/{uuid}/{id_mediaSubF2}', [mediaFileController::class, 'update2'])->name('guru_bukumedia_mediafile_update');
         Route::delete('/mediafile/delete/{uuid}', [mediaFileController::class, 'destroy2'])->name('guru_bukumedia_mediafile_delete');
      });

      Route::prefix('asetsekolah')->group(function () {
         // arsip guru - upload arsip
         Route::get('/uploadarsip', [UploadArsipController::class, 'index2'])->name('guru_arsipguru_uploadarsip_page');
         Route::get('/uploadarsip/add', [UploadArsipController::class, 'storePage2'])->name('guru_arsipguru_uploadarsip_add');
         Route::post('/uploadarsip/store', [UploadArsipController::class, 'store2'])->name('guru_arsipguru_uploadarsip_store');
         Route::get('/uploadarsip/edit/{uuid}', [UploadArsipController::class, 'edit2'])->name('guru_arsipguru_uploadarsip_edit');
         Route::put('/uploadarsip/update/{uuid}', [UploadArsipController::class, 'update2'])->name('guru_arsipguru_uploadarsip_update');
         Route::delete('/uploadarsip/delete/{uuid}', [UploadArsipController::class, 'destroy2'])->name('guru_arsipguru_uploadarsip_delete');
      });

      Route::prefix('pemeberitahuan')->group(function () {

         // penjadwalan jadwal pelajaran for admin guru
         Route::get('/jadwalpelajaran', [JadwalPelajaranController::class, 'index2'])->name('guru_penjadwalan_jadwalpelajaran_page');
         
         // penjadwalan jadwal pertemuan for admin guru
         Route::get('/jadwalpertemuan', [JadwalPertemuanController::class, 'index2'])->name('guru_penjadwalan_jadwalpertemuan_page');
         // Get Events
         Route::get('/jadwalpertemuan/events', [JadwalPertemuanController::class, 'GetEvents2'])->name('guru_penjadwalan_jadwalpertemuan_events');
   
         // penjadwalan kalender akademik
         Route::get('/kalenderakademik', [KalenderAkademikController::class, 'index2'])->name('guru_penjadwalan_kalenderakademik_page');
         // Get Events
         Route::get('/kalenderakademik/events', [KalenderAkademikController::class, 'GetEvents2'])->name('guru_penjadwalan_kalenderakademik_events');
   
         // pemberitahun event for admin guru
         Route::get('/event', [EventController::class, 'index2'])->name('guru_pemberitahuan_event_page');
   
         // pemberitahuan liburan for admin guru
         Route::get('/liburan', [LiburanController::class, 'index2'])->name('guru_pemberitahuan_liburan_page');
   
         // pemberitahuan rencana kegiatan
         Route::get('/rencanakegiatan', [RencanaKegiatanController::class, 'index2'])->name('guru_pemberitahuan_rencanakegiatan_page');
      });

  

});

Route::prefix('siswa')->middleware('auth:siswa')->group(function () {
   
   Route::prefix('dashboard')->group(function () {
      Route::get('/', [PageController::class, 'SiswaDashboard'])->name('Siswa_Dashboard');

      Route::prefix('akademik')->group(function () {
         // akademik tugas siswa for admin siswa
         Route::get('/tugassiswa', [TugasSiswaController::class, 'index3'])->name('siswa_akademik-tugassiswa_page');
         Route::get('/tugassiswa/store', [TugasSiswaController::class, 'storePage3'])->name('siswa_akademik-tugassiswa_add');
         Route::post('/tugassiswa/add', [TugasSiswaController::class, 'store3'])->name('siswa_akademik-tugassiswa_store');
         Route::get('/tugassiswa/edit', [TugasSiswaController::class, 'edit3'])->name('siswa_akademik-tugassiswa_edit');
         Route::post('/tugassiswa/update', [TugasSiswaController::class, 'update3'])->name('siswa_akademik-tugassiswa_update');

         // akademik mata pelajaran for admin siswa
         Route::get('/matapelajaran', [MataPelajaranController::class, 'index3'])->name('siswa_akademik_matapelajaran_page');
      });

      Route::prefix('bukumedia')->group(function () {
         // bukumedia ebooks for admin siswa
         Route::get('/ebooks', [EbooksController::class, 'index3'])->name('siswa_bukumedia-ebooks_page');

         // bukumedia media pembelajaran for admin siswa
         Route::get('/mediaparent', [MediaParentController::class, 'index3'])->name('siswa_bukumedia_mediaparent_page');
      });

      Route::prefix('penjadwalan')->group(function () {
         // penjadwalan jadwal pelajaran for admin siswa
         Route::get('/jadwalpelajaran', [JadwalPelajaranController::class, 'index3'])->name('siswa_penjadwalan_jadwalpelajaran_page');

         // penjadwalan jadwal pertemuan for admin guru
         Route::get('/jadwalpertemuan', [JadwalPertemuanController::class, 'index3'])->name('siswa_penjadwalan_jadwalpertemuan_page');
         // Get Events
         Route::get('/jadwalpertemuan/events', [JadwalPertemuanController::class, 'GetEvents3'])->name('siswa_penjadwalan_jadwalpertemuan_events');
      });

      Route::prefix('pemberitahuan')->group(function () {
         // pemberitahuan ekstrakurikuler for admin siswa
         Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index3'])->name('siswa_pemberitahuan_ekstrakurikuler_page');

         // pemberitahuan event
         Route::get('/event', [EventController::class, 'index3'])->name('siswa_pemberitahuan_event_page');

         // pemberitahuan liburan for admin siswa
         Route::get('/liburan', [LiburanController::class, 'index3'])->name('siswa_pemberitahuan_liburan_page');

         // pemberitahuan rencana kegiatan
         Route::get('/rencanakegiatan', [RencanaKegiatanController::class, 'index3'])->name('siswa_pemberitahuan_rencanakegiatan_page');
      });

      Route::prefix('pengaturan')->group(function () {
         // pengaturan komplain
         Route::get('/komplain', [KomplainController::class, 'index3'])->name('siswa_pengaturan_komplain_page');
         Route::get('/komplain/add', [KomplainController::class, 'storePage3'])->name('siswa_pengaturan_komplain_add');
         Route::post('/komplain/store', [KomplainController::class, 'store3'])->name('siswa_pengaturan_komplain_store');
         Route::get('/komplain/edit/{uuid}', [KomplainController::class, 'edit3'])->name('siswa_pengaturan_komplain_edit');
         Route::put('/komplain/update/{uuid}', [KomplainController::class, 'update3'])->name('siswa_pengaturan_komplain_update');
         Route::delete('/komplain/delete/{uuid}', [KomplainController::class, 'destroy3'])->name('siswa_pengaturan_komplain_delete');

         // pengaturan profile 
         Route::get('/profile', [ProfileController::class, 'SiswaProfile'])->name('siswa_pengaturan_profile_page');
      });

   });

});

Route::prefix('orangtua')->middleware('auth:orangtua')->group(function () {
   Route::get('/dashboard', [PageController::class, 'OrangtuaDashboard'])->name('Orangtua_Dashboard');

   Route::prefix('akademik')->group(function () {
      // akademik materimatapelajaran 
      Route::get('/materimatapelajaran', [MateriMataPelajaranController::class, 'index4'])->name('orangtua_akademik-materimatapelajaran_page');

      // akademik tugassiswa
      Route::get('/tugassiwa', [TugasSiswaController::class, 'index4'])->name('orangtua_akademik-tugassiswa_page');
   });

   Route::prefix('bukumedia')->group(function () {
      // bukumedia ebooks for admin siswa
      Route::get('/ebooks', [EbooksController::class, 'index4'])->name('orangtua_bukumedia-ebooks_page');

      // bukumedia media pembelajaran for admin siswa
      Route::get('/mediaparent', [MediaParentController::class, 'index4'])->name('orangtua_bukumedia-mediaparent_page');
   });

   Route::prefix('penjadwalan')->group(function () {
      // penjadwalan jadwal pelajaran for admin siswa
      Route::get('/jadwalpelajaran', [JadwalPelajaranController::class, 'index4'])->name('orangtua_penjadwalan-jadwalpelajaran_page');

      // penjadwalan jadwal pertemuan for admin guru
      Route::get('/jadwalpertemuan', [JadwalPertemuanController::class, 'index4'])->name('orangtua_penjadwalan-jadwalpertemuan_page');
      // Get Events
      Route::get('/jadwalpertemuan/events', [JadwalPertemuanController::class, 'GetEvents4'])->name('orangtua_penjadwalan-jadwalpertemuan_events');
   });

   
   Route::prefix('pemberitahuan')->group(function () {
      // pemberitahuan ekstrakurikuler for admin siswa
      Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index4'])->name('orangtua_pemberitahuan-ekstrakurikuler_page');

      // pemberitahuan event
      Route::get('/event', [EventController::class, 'index4'])->name('orangtua_pemberitahuan-event_page');

      // pemberitahuan liburan for admin siswa
      Route::get('/liburan', [LiburanController::class, 'index4'])->name('orangtua_pemberitahuan-liburan_page');

      // pemberitahuan rencana kegiatan
      Route::get('/rencanakegiatan', [RencanaKegiatanController::class, 'index4'])->name('orangtua_pemberitahuan-rencanakegiatan_page');
   });

   Route::prefix('pengaturan')->group(function () {
      // pengaturan komplain
      Route::get('/komplain', [KomplainController::class, 'index4'])->name('orangtua_pengaturan-komplain_page');
      Route::get('/komplain/add', [KomplainController::class, 'storePage4'])->name('orangtua_pengaturan-komplain_add');
      Route::post('/komplain/store', [KomplainController::class, 'store4'])->name('orangtua_pengaturan-komplain_store');
      Route::get('/komplain/edit/{uuid}', [KomplainController::class, 'edit4'])->name('orangtua_pengaturan-komplain_edit');
      Route::put('/komplain/update/{uuid}', [KomplainController::class, 'update4'])->name('orangtua_pengaturan-komplain_update');
      Route::delete('/komplain/delete/{uuid}', [KomplainController::class, 'destroy4'])->name('orangtua_pengaturan-komplain_delete');

      // pengaturan profile 
      Route::get('/profile', [ProfileController::class, 'OrangtuaProfile'])->name('orangtua_pengaturan-profile_page');
   });
   

});
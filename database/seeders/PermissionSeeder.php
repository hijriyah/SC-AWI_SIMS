<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //
        
        $menuMaster = ['Master', 'Staff', 'Guru', 'Siswa', 'Orang Tua'];
        $menuAkademik = ['Akademik', 'Kelas', 'Mata Pelajaran', 'Materi', 'Section', 'Tugas Siswa', /*'Jurnal Harian'*/];
        $menuKehadiran = ['Kehadiran'];
        $menuAlQuran = collect(['Al-Quran', 'Kriteria Penilaian Alquran', 'Tahsin', 'Kategori Tahsin', 'Pemetaan Tahsin', 'Capaian Tahsin', 'Tahfiz'])->unique();
        $menuQA = collect(['QA', 'Materi QA', 'Capaian QA'])->unique();
        $menuUjian = ['Ujian', 'Rencana Ujian', 'Jadwal Ujian', 'Kehadiran Siswa Ujian', 'Input Soal', 'Kategori Soal', 'Bank Soal', 'Ambil Ujian', 'Intruksi Ujian', 'Mulai Ujian'];
        $menuPenilaian = collect(['Penilaian', 'Jenis Penilaian', 'Tipe Penilaian', 'ATP', 'Predikat', 'Aspek Penilaian Sikap', 'Penilaian Umum', 'Penilaian Sikap'])->unique();
        $menuJurnal = ['Jurnal', 'Jurnal BK', 'Jurnal Kesiswaan', 'Jurnal Kelas'];
        $menuLaporan = ['Laporan', 'Laporan Kelas', 'Laporan Siswa', 'Laporan Jadwal Ujian', 'Laporan Kehadiran Siswa', 'Laporan Penilaian', 'Laporan Jurnal', 'Jurnal Guru', 'Jurnal Kesiswaan', 'Jurnal BK'];
        $menuKesiswaanBK = ['Kesiswaan & BK', 'Kesiswaan', 'Tata Tertib', 'Pelanggaran', 'Sanksi Pelanggaran', 'Data Pelanggaran', 'Bimbingan Konseling (BK)', 'Bimbingan Konseling', 'Data Bimbingan Konseling'];
        $menuBukuMedia = ['Buku & Media', 'Buku', 'E-Books', 'Media Pembelajaran'];
        $menuAsetSekolah = ['Aset Sekolah', 'Arsip Guru', 'Kategori Arsip', 'Upload Arsip', 'Rekap Kelengkapan Arsip', 'Inventaris', 'Kategori Barang', 'Lokasi Barang', 'Barang Masuk', 'Barang Keluar',];
        $menuPenjadwalan = ['Penjadwalan', 'Kalender Akademik', 'Jadwal Pelajaran', 'Jadwal Pertemuan'];
        $menuPemberitahuan = ['Pemberitahuan', 'Kegiatan', 'Event', 'Liburan', 'Pesan', 'Email', 'Kegiatan', 'Rencana Kegiatan', 'Galeri Kegiatan', 'Kategori Kegiatan', 'Nama Kegiatan'];
        $menuSettingAdministrator = ['Pengaturan', 'Tahun Ajaran', 'Semester', 'Roles', 'Pengaturan Sistem', 'Import File', 'Komplain', 'Social Link', 'Semester'];
        $menuRaport = ['Raport', 'Nilai Raport', 'Nilai Umum', 'Nilai Sikap', 'Nilai Ekstrakurikuler', 'Kkm', 'Kategori Penilaian Siswa', 'Jumlah Ketidakhadiran', 'Juara Umum', 'Juara Kelas', 'Identitas Sekolah', 'Catatan Wali Kelas'];


        $PermissionRole = [
            'Administrator' => collect([
                'Dashboard',
                ...$menuMaster,
                ...$menuAkademik,
                ...$menuKehadiran,
                ...$menuAlQuran,
                ...$menuQA,
                ...$menuUjian,
                ...$menuPenilaian,
                ...$menuPemberitahuan,
                ...$menuLaporan,
                ...$menuJurnal,
                ...$menuKesiswaanBK,
                ...$menuBukuMedia,
                ...$menuAsetSekolah,
                ...$menuPenjadwalan,
                ...$menuSettingAdministrator,
                ...$menuRaport
            ]),

            'Guru' => [
                'Dashboard',
                'Master',
                'Guru',
                'Siswa',
                'Orang Tua',
                'Akademik',
                'Tugas Siswa',
                'Mata Pelajaran',
                'Materi',
                ...$menuKehadiran,
                ...$menuAlQuran,
                ...$menuQA,
                ...$menuUjian,
                ...$menuKesiswaanBK,
                ...$menuPenilaian,
                'Jurnal',
                'Jurnal Kelas',
                'Buku & Media',
                'E-Books',
                'Media Pembelajaran',
                'Aset Sekolah',
                'Arsip Guru',
                'Upload Arsip',
                ...$menuPenjadwalan,
                'Pemberitahuan',
                'Event',
                'Liburan',
                'Pesan',
                'Email',
                'Rencana Kegiatan',
            ],

            'Siswa' => [
                'Dashboard',
                ...$menuAkademik,
                ...$menuKehadiran,
                ...$menuAlQuran,
                'QA',
                'Capaian',
                'Ujian',
                'Jadwal Ujian',
                'Ambil Ujian',
                'Mulai Ujian',
                'Penilaian',
                'Penilaian Umum',
                'Penilaian Sikap',
                'Buku & Media',
                'E-Books',
                'Media Pembelajaran',
                'Penjadwalan',
                'Jadwal Pelajaran',
                'Jadwal Pertemuan',
                'Pemberitahuan',
                'Event',
                'Ekstrakurikuler',
                'Liburan',
                'Pesan',
                'Email',
                'Rencana Kegiatan',
                'Pengaturan',
                'Komplain',
                'Profile'
            ],

            'Orang tua' => [
                'Dashboard',
                ...$menuAkademik,
                ...$menuKehadiran,
                ...$menuAlQuran,
                'QA',
                'Capaian',
                'Buku & Media',
                'E-Books',
                'Media Pembelajaran',
                'Penjadwalan',
                'Jadwal Pelajaran',
                'Jadwal Pertemuan',
                'Pemberitahuan',
                'Event',
                'Liburan',
                'Pesan',
                'Email',
                'Rencana Kegiatan',
                'Pengaturan',
                'Komplain',
                'Profile'
            ]

        ];


        $createOrGetPermission = function ($name) {
            $permission = Permission::where('name', $name)->first();

            if (!$permission) {
                $permission = Permission::create([
                    'name' => $name,
                    'guard_name' => 'web',
                ]);
            }

            return $permission;
        };


        foreach ($PermissionRole as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();

            if (!$role) {
                $role = Role::create([
                    'name' => $roleName,
                    'guard_name' => 'web',
                ]);
            }

            // $permissionsAsAssociative = collect($permissions)->mapWithKeys(function ($item) {
            //     return [$item => $item];
            // });

            // foreach ($permissionsAsAssociative as $permissionName => $value) {
            //     $permission = $createOrGetPermission($permissionName);
            //     $role->givePermissionTo($permission);
            // }

            foreach ($permissions as $permissionName) {
                $permission = $createOrGetPermission($permissionName);
                $role->givePermissionTo($permission);
            }


        }

    }
}

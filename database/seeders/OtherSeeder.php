<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\staff;
use App\Models\guru;
use App\Models\siswa;
use App\Models\orangtua;
use App\Models\Role;
use Carbon\Carbon;


class OtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // others role

        // $tanggal = Carbon::createFromFormat('d/m/Y', '12/06/2022')->format('Y-m-d');

        // // staff
        // $staffRole = Role::where('name', 'Administrator')->first();
        // staff::create([
        //     'nama_lengkap' => 'Jasmine Bolire',
        //     'nama_panggilan' => 'Jasmine',
        //     //'deskripsi' => '-',
        //     'tanggal_bergabung' => $tanggal,
        //     'jenis_kelamin' => 'perempuan',
        //     'agama' => 'islam',
        //     'email' => 'jasmineStaff67@gmail.com',
        //     'no_telp' => '083237263237',
        //     'alamat' => '-',
        //     //'photo' => '-',
        //     'username' => 'JasmineStaff67',
        //     'password' => '12345678',
        //     'aktif' => 'ya',
        //     'role_id' => $staffRole->id

        // ]);


        // // guru
        // $guruRole =  Role::where('name', 'Guru')->first();
        // guru::create([
        //     'nama_lengkap' => 'joseph yusuf',
        //     'nama_panggilan' => 'joseph',
        //     'tanggal_bergabung' => $tanggal,
        //     'jenis_kelamin' => 'laki-laki',
        //     'agama' => 'kristen',
        //     'email' => 'josephyusuf@gmail.com',
        //     'no_telp' => '0853763233',
        //     'alamat' => '-',
        //     //'photo' => '-',
        //     'username' => 'joseph123',
        //     'password' => 'q1w2e3r4',
        //     'aktif' => 'ya',
        //     'role_id' => $guruRole->id
            
        // ]);

        // // siswa
        // $siswaRole =  Role::where('name', 'Siswa')->first();
        // siswa::create([
        //     'nama_lengkap' => 'gaile gailola',
        //     'nama_panggilan' => 'gaile',
        //     'tempat_lahir' => 'gresik',
        //     'tanggal_lahir' => $tanggal,
        //     'jenis_kelamin' => 'laki-laki',
        //     'agama' => 'hindu',
        //     'email' => 'gailegailola@gmail.com',
        //     'no_telp' => '08394938343',
        //     'alamat' => '-',
        //     'id_kelas' => '1',
        //     'id_section' => '1',
        //     'golongan_darah' => 'ab+',
        //     'kebangsaan' => 'wni',
        //     'negara' => 'indonesia',
        //     'nomor_register' => 'A6124084',
        //     'tanggal_masuk' => $tanggal,
        //     'id_orangtua' => '0',
        //     //'photo'=> '-',
        //     'id_tahun_ajaran' => '0',
        //     'username' => 'gaile123',
        //     'password' => 'q1w2e3r4',
        //     'aktif' => 'ya',
        //     'role_id' => $siswaRole->id
        // ]);


        // $orangtuaRole = Role::where('name', 'Orang tua')->first();
        // orangtua::create([
        //     'nama' => 'daice',
        //     'nama_ayah' => 'daice',
        //     'nama_ibu' => 'louise',
        //     'pekerjaan_ayah' => 'property agent',
        //     'pekerjaan_ibu' => 'irt',
        //     'email' => 'daice@gmail.com',
        //     'no_telp' => '0853763233',
        //     'alamat' => '-',
        //     'photo' => '-',
        //     'aktif' => 'ya',
        //     'username' => 'daice123',
        //     'password' => 'q1w2e3r4',
        //     'role_id' => $orangtuaRole->id
            
        // ]);

    }
}

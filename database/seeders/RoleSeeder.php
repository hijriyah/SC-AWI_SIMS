<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::firstOrCreate([
            'name' => 'Administrator',
        ]);

        Role::firstOrCreate([
            'name' => 'Guru',
        ]);

        Role::firstOrCreate([
            'name' => 'Siswa',
        ]);

        Role::firstOrCreate([
            'name' => 'Orang Tua',
        ]);

    }
}

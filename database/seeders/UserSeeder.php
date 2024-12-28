<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $role = Role::where('name', 'Administrator')->first();

        $admin = User::create([
            'username' => 'Administrator',
            'email' => 'admin123@gmail.com',
            'password' => bcrypt('12345678'),
            'DefaultHash' => hash('sha256', '12345678')
        ]);

        $admin->assignRole($role->name);
    }
}

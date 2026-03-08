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
    
    // Buat akun admin
    public function run(): void
    {
        // Buat role dulu 
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        //Buat akun admin
        $admin = User::create([
            'name' => 'Admin E-Canteen',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'saldo' => 0
        ]);
        $admin->assignRole($adminRole);

        //Buat akun user contoh
        $user = User::create([
            'name' => 'Siswa Satu',
            'email' => 'qihf463@gmail.com',
            'password' => bcrypt('siswa123'),
            'role' => 'user',
            'saldo' => 50000
        ]);
        $user->assignRole($userRole);
    }
}

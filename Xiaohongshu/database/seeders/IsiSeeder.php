<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'nama_lengkap' => 'adminGanteng',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12341234'),
            'alamat' => 'Kp admin',
        ]);
        $admin->assignRole('admin');

        $pengguna = User::create([
            'name' => 'pengguna',
            'nama_lengkap' => 'penggunaGanteng',
            'email' => 'pengguna@gmail.com',
            'password' => bcrypt('12341234'),
            'alamat' => 'Kp pengguna',
        ]);
        $pengguna->assignRole('pengguna');
    }
}

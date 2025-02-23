<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12341234'),
            'nama_lengkap' => 'super-admin',
            'alamat' => 'KP BARU',
        ]);
        $admin->assignRole('admin');

        $peminjam = User::create([
            'name' => 'peminjam',
            'email' => 'peminjam@gmail.com',
            'password' => bcrypt('12341234'),
            'nama_lengkap' => 'Peminjam1',
            'alamat' => 'KP BARU',
        ]);
        $peminjam->assignRole('peminjam');
    }
}

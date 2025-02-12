<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::create(['name' => 'admin']);
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        $admin->assignRole('admin');

        Role::create(['name' => 'petugas']);
        $petugas = User::create([
            'name' => 'petugas',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        $petugas->assignRole('petugas');


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

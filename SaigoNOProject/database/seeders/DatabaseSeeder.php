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
            'jenis_kelamin' => 'Male',
            'no_hp' => '081232123210',
            'alamat' => 'Bojong',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        $admin->assignRole('admin');

        Role::create(['name'=>'pelanggan']);
        $admin = User::create([
            'name' => 'pelanggan',
            'jenis_kelamin' => 'Female',
            'no_hp' => '081232123210',
            'alamat' => 'Bojong',
            'email' => 'pelanggan@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        $admin->assignRole('pelanggan');

        Role::create(['name' => 'waiter']);
        $admin = User::create([
            'name' => 'waiter',
            'jenis_kelamin' => 'Female',
            'no_hp' => '081232123210',
            'alamat' => 'Bojong',
            'email' => 'waiter@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        $admin->assignRole('waiter');

        Role::create(['name' => 'kasir']);
        $admin = User::create([
            'name' => 'kasir',
            'jenis_kelamin' => 'Female',
            'no_hp' => '081232123210',
            'alamat' => 'Bojong',
            'email' => 'kasir@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        $admin->assignRole('kasir');

        Role::create(['name'=>'owner']); $admin = User::create([
            'name' => 'owner',
            'jenis_kelamin' => 'Female',
            'no_hp' => '081232123210',
            'alamat' => 'Bojong',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        $admin->assignRole('owner');

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

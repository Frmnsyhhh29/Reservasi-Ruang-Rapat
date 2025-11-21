<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. Matikan Foreign Key Check (Aman untuk truncate)
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Buat Akun Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // 3. Buat Akun User Biasa
        User::create([
            'name' => 'Budi Karyawan',
            'email' => 'budi@kantor.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // 4. Buat Akun Tambahan (Opsional: 5 User Dummy Acak)
        User::factory(5)->create(['is_admin' => false]);
    }
}
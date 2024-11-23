<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role_id' => 1,
                'token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Karyawan',
                'email' => 'karyawan@gmail.com',
                'password' => Hash::make('karyawan'),
                'role_id' => 2,
                'token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

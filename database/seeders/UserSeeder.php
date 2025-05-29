<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'role' => 0,
                'active' => 1,
                'profile' => '',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin'),
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User One',
                'username' => 'user1',
                'role' => 1,
                'active' => 1,
                'profile' => '',
                'email' => 'user1@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengunjung User',
                'username' => 'pengunjung',
                'role' => 2,
                'active' => 1,
                'profile' => '',
                'email' => 'pengunjung@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

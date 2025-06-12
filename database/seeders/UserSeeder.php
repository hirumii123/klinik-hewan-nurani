<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin Nurani',
            'email' => 'nuraniadmin@gmail.com',
            'password' => Hash::make('nuraniadmin2025'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

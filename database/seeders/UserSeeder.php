<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@gmail.com',
            'phone_number' => '+998939999999',
            'address' => 'Admin Address',
            'city' => 'Admin City',
            'image' => null,
            'role' => 'admin',
            'password' => Hash::make('password'), 
        ]);
    }
}

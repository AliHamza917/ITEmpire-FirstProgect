<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::create([
            'fullname' => 'Admin',
            'email' => 'admin@123',
            'password' => Hash::make('1234'), // Hash the password for security
            'status' => 1,
            'user_role' => 'admin',
        ]);


    }
}

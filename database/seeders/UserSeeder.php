<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an employee
        User::create([
            'name' => 'Ajcoder2k15',
            'email' => 'pregoner@user.com',
            'password' => Hash::make('user12345678'),
            'role' => 'employee', // Employee role
        ]);
        User::create([
            'name' => 'Ajcodex2k15 2',
            'email' => 'artjavar@user.com',
            'password' => Hash::make('user12345678'),
            'role' => 'employee', // Employee role
        ]);


        // Create an HR user (HR2)
        User::create([
            'name' => 'Ate Gay HR',
            'email' => 'hrmanager@user.com',
            'password' => Hash::make('user12345678'),
            'role' => 'hr', // HR role
        ]);

        // Create an Admin user
        User::create([
            'name' => 'Amil Admin',
            'email' => 'bcp@admin.com',
            'password' => Hash::make('admin12345678'),
            'role' => 'admin', // Admin role
        ]);
    }
}

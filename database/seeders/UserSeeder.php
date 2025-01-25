<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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
            'name' => 'Employee: John Doe',
            'email' => 'employee@example.com',
            'password' => Hash::make('password'), // Use a secure password
            'role' => 'employee', // Employee role
        ]);

        // Create an HR user (HR2)
        User::create([
            'name' => 'HR: Jane Smith',
            'email' => 'hr@example.com',
            'password' => Hash::make('password'),
            'role' => 'hr', // HR role
        ]);

        // Create an Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin', // Admin role
        ]);
    }
}

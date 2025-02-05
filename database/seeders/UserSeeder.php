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
        User::factory()->create([
            'name' => 'Art Javar Pogi',
            'email' => 'pregoner@user.com',
            'password' => Hash::make('user12345678'),
            'role' => 'employee', // Employee role
        ]);
        User::factory()->create([
            'name' => 'POGI Art User 2',
            'email' => 'artjavar@user.com',
            'password' => Hash::make('user12345678'),
            'role' => 'employee', // Employee role
        ]);


        // Create an HR user (HR2)
        User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'hrmanager@user.com',
            'password' => Hash::make('user12345678'),
            'role' => 'hr', // HR role
        ]);

        // Create an Admin user
        User::factory()->create([
            'name' => 'Malupweton Juwil',
            'email' => 'bcp@admin.com',
            'password' => Hash::make('admin12345678'),
            'role' => 'admin', // Admin role
        ]);
    }
}

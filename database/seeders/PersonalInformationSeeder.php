<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonalInformation;
use App\Models\User;

class PersonalInformationSeeder extends Seeder
{
    public function run(): void
    {
        // Employee 1
        PersonalInformation::create([
            'user_id' => User::where('email', 'pregoner@user.com')->first()->id,
            'first_name' => 'Art',
            'middle_name' => 'J',
            'last_name' => 'Pogi',
            'date_of_birth' => '1990-05-15',
            'gender' => 'Male',
            'marital_status' => 'Single',
            'blood_group' => 'O+',
            'nationality' => 'Filipino',
            'address' => '123 Main Street',
            'city' => 'Manila',
            'state' => 'Metro Manila',
            'country' => 'Philippines',
            'postal_code' => '1000',
            'phone_number' => '09123456789',
            'emergency_contact_name' => 'Emergency Contact 1',
            'emergency_contact_number' => '09987654321',
            'emergency_relationship' => 'Parent',
        ]);

        // Employee 2
        PersonalInformation::create([
            'user_id' => User::where('email', 'artjavar@user.com')->first()->id,
            'first_name' => 'POGI',
            'middle_name' => 'A',
            'last_name' => 'User',
            'date_of_birth' => '1992-08-20',
            'gender' => 'Male',
            'marital_status' => 'Single',
            'blood_group' => 'A+',
            'nationality' => 'Filipino',
            'address' => '456 Side Street',
            'city' => 'Makati',
            'state' => 'Metro Manila',
            'country' => 'Philippines',
            'postal_code' => '1200',
            'phone_number' => '09234567890',
            'emergency_contact_name' => 'Emergency Contact 2',
            'emergency_contact_number' => '09876543210',
            'emergency_relationship' => 'Spouse',
        ]);

        // HR Manager
        PersonalInformation::create([
            'user_id' => User::where('email', 'hrmanager@user.com')->first()->id,
            'first_name' => 'Jane',
            'middle_name' => 'D',
            'last_name' => 'Smith',
            'date_of_birth' => '1988-03-10',
            'gender' => 'Female',
            'marital_status' => 'Married',
            'blood_group' => 'B+',
            'nationality' => 'Filipino',
            'address' => '789 HR Avenue',
            'city' => 'Pasig',
            'state' => 'Metro Manila',
            'country' => 'Philippines',
            'postal_code' => '1600',
            'phone_number' => '09345678901',
            'emergency_contact_name' => 'Emergency Contact 3',
            'emergency_contact_number' => '09765432109',
            'emergency_relationship' => 'Spouse',
        ]);

        // Admin
        PersonalInformation::create([
            'user_id' => User::where('email', 'bcp@admin.com')->first()->id,
            'first_name' => 'Idol',
            'middle_name' => 'D',
            'last_name' => 'Admin',
            'date_of_birth' => '1988-03-10',
            'gender' => 'Male',
            'marital_status' => 'Single',
            'blood_group' => 'B+',
            'nationality' => 'Filipino',
            'address' => '23 3rd Avenue',
            'city' => 'Malabon',
            'state' => 'Metro Manila',
            'country' => 'Philippines',
            'postal_code' => '1600',
            'phone_number' => '09345678901',
            'emergency_contact_name' => 'Emergency Contact 3',
            'emergency_contact_number' => '09765432109',
            'emergency_relationship' => 'Spouse',
        ]);
    }
}

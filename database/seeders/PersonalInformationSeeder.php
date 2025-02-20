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
            'first_name' => 'Art Javar',
            'middle_name' => 'Tuling',
            'last_name' => 'Pregoner',
            'date_of_birth' => '2002-06-29',
            'gender' => 'Male',
            'marital_status' => 'Single',
            'blood_group' => 'O+',
            'nationality' => 'Filipino',
            'address' => 'Phase 6 Sanana Street',
            'city' => 'Caloocan',
            'state' => 'Metro Manila',
            'country' => 'Philippines',
            'postal_code' => '4000',
            'phone_number' => '090000000000',
            'emergency_contact_name' => 'Ivana Alawi',
            'emergency_contact_number' => '09987654321',
            'emergency_relationship' => 'Jowa',
        ]);

        // Employee 2
        PersonalInformation::create([
            'user_id' => User::where('email', 'artjavar@user.com')->first()->id,
            'first_name' => 'Art Pogi',
            'middle_name' => 'Raval',
            'last_name' => 'Cute',
            'date_of_birth' => '2002-06-29',
            'gender' => 'Badeng',
            'marital_status' => 'Single',
            'blood_group' => 'A+',
            'nationality' => 'Filipino',
            'address' => '456 Side Street',
            'city' => 'Makati',
            'state' => 'Metro Manila',
            'country' => 'Philippines',
            'postal_code' => '1200',
            'phone_number' => '09234567890',
            'emergency_contact_name' => 'Ghost Wrecker',
            'emergency_contact_number' => '09876543210',
            'emergency_relationship' => 'Kuya lang',
        ]);

        // HR Manager
        PersonalInformation::create([
            'user_id' => User::where('email', 'hrmanager@user.com')->first()->id,
            'first_name' => 'Jane',
            'middle_name' => 'D',
            'last_name' => 'Smith',
            'date_of_birth' => '2000-02-14',
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
            'emergency_contact_name' => 'Ate Tari',
            'emergency_contact_number' => '09765432109',
            'emergency_relationship' => 'Mother',
        ]);

        // Admin
        PersonalInformation::create([
            'user_id' => User::where('email', 'bcp@admin.com')->first()->id,
            'first_name' => 'Flow-G',
            'middle_name' => 'Donato',
            'last_name' => 'Admin',
            'date_of_birth' => '1999-01-01',
            'gender' => 'Male',
            'marital_status' => 'Single',
            'blood_group' => 'B+',
            'nationality' => 'Filipino',
            'address' => '23 3rd Avenue',
            'city' => 'Malabon',
            'state' => 'Metro Manila',
            'country' => 'Philippines',
            'postal_code' => '1500',
            'phone_number' => '09022002211',
            'emergency_contact_name' => 'Donalyn Reyes',
            'emergency_contact_number' => '09765432109',
            'emergency_relationship' => 'Spouse',
        ]);
    }
}

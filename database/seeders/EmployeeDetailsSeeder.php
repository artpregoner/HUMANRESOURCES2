<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeDetails;
use App\Models\User;
use App\Models\Department;

class EmployeeDetailsSeeder extends Seeder
{
    public function run(): void
    {
        // Get the departments
        $adminDepartment = Department::where('name', 'Admin')->first();
        $hr2Department = Department::where('name', 'Human Resources 2')->first();

        if (!$adminDepartment || !$hr2Department) {
            throw new \Exception('Required departments not found. Please check department names.');
        }

        EmployeeDetails::create([
            'user_id' => User::where('email', 'bcp@admin.com')->first()->id,
            'department_id' => $adminDepartment->id,
            'designation' => 'HR Manager',
            'joining_date' => '2022-12-01',
            'employee_code' => 'EMP001',
            'employment_status' => 'Full-time',
            'work_location' => 'Main Office',
            'salary' => 70000.00,
            'bank_account_number' => '1122334455',
            'bank_name' => 'Metrobank',
            'tax_id' => 'TAX001',
        ]);

        // Employee 1
        EmployeeDetails::create([
            'user_id' => User::where('email', 'pregoner@user.com')->first()->id,
            'department_id' => $adminDepartment->id,
            'designation' => 'Software Developer',
            'joining_date' => '2023-01-15',
            'employee_code' => 'EMP002',
            'employment_status' => 'Full-time',
            'work_location' => 'Main Office',
            'salary' => 50000.00,
            'bank_account_number' => '1234567885',
            'bank_name' => 'BPI',
            'tax_id' => 'TAX002',
        ]);

        // Employee 2
        EmployeeDetails::create([
            'user_id' => User::where('email', 'artjavar@user.com')->first()->id,
            'department_id' => $hr2Department->id,
            'designation' => 'Senior Developer',
            'joining_date' => '2023-02-01',
            'employee_code' => 'EMP003',
            'employment_status' => 'Full-time',
            'work_location' => 'Main Office',
            'salary' => 60000.00,
            'bank_account_number' => '0987654321',
            'bank_name' => 'BPI',
            'tax_id' => 'TAX003',
        ]);

        // HR Manager
        EmployeeDetails::create([
            'user_id' => User::where('email', 'hrmanager@user.com')->first()->id,
            'department_id' => $hr2Department->id,
            'designation' => 'HR Manager',
            'joining_date' => '2022-12-01',
            'employee_code' => 'EMP004',
            'employment_status' => 'Full-time',
            'work_location' => 'Main Office',
            'salary' => 70000.00,
            'bank_account_number' => '1122334455',
            'bank_name' => 'Metrobank',
            'tax_id' => 'TAX004',
        ]);

    }
}

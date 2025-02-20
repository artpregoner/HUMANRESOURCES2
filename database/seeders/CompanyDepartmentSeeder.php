<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class CompanyDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Admin', // Overall IT and system management
                'description' => 'Responsible for IT infrastructure, software development, and overall system administration.',
            ],
            [
                'name' => 'Human Resources 1', // Hiring, employee performance
                'description' => 'Handles employee recruitment, hiring processes, and performance management.',
            ],
            [
                'name' => 'Human Resources 2', // Claims, helpdesk, workforce management
                'description' => 'Manages employee claims, workforce operations, and helpdesk support.',
            ],
            [
                'name' => 'Human Resources 3', // Attendance, payroll
                'description' => 'Oversees employee attendance, payroll processing, and timekeeping management.',
            ],
            [
                'name' => 'Finance', // Handling company finances
                'description' => 'Manages financial planning, accounting, payroll processing, and company expenditures.',
            ],
            [
                'name' => 'Logistic 1', // Logistic management
                'description' => 'Handles supply chain, inventory management, and transportation logistics.',
            ],
            [
                'name' => 'Logistic 2', // Rider operations and delivery
                'description' => 'Manages rider operations, delivery coordination, and fleet management.',
            ],
            [
                'name' => 'Core 1', // Vendor-side operations
                'description' => 'Oversees vendor management, supplier coordination, and procurement processes.',
            ],
            [
                'name' => 'Core 2', // Client-side operations
                'description' => 'Handles customer relations, order management, and client service operations.',
            ],
            [
                'name' => 'Core 3', // Vendor and subscription planning
                'description' => 'Manages vendor partnerships, subscription-based services, and business strategy planning.',
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}

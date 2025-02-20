<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TicketCategory;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketCategory::create(['category_name' => 'IT & System Access Requests', 'description' => 'For requests related to new user accounts, password resets, or system permissions.	', 'is_active' => true],);
        TicketCategory::create(['category_name' => 'Technical Support', 'description' => 'For issues related to hardware, software, network, or system access problems.', 'is_active' => true]);
        TicketCategory::create(['category_name' => 'HR & Employee Services', 'description' => 'For inquiries about payroll, benefits, leaves, or employee concerns.', 'is_active' => true]);
        TicketCategory::create(['category_name' => 'Facility & Maintenance Requests', 'description' => 'For reporting workplace issues such as equipment malfunctions, office repairs, or facility-related concerns.	', 'is_active' => true]);
        TicketCategory::create(['category_name' => 'Others...', 'description' => 'For any concerns, requests, or issues that do not fall under the predefined categories.', 'is_active' => true]);
    }
}

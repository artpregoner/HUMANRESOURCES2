<?php

namespace Database\Seeders;

use App\Models\ClaimsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClaimCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClaimsCategory::create(['name' => 'Medical Expenses', 'description' => 'Claims related to medical and healthcare expenses.', 'is_active' => true],);
        ClaimsCategory::create(['name' => 'Travel Reimbursement', 'description' => 'Claims for official travel expenses.', 'is_active' => true]);
        ClaimsCategory::create(['name' => 'Food Allowance', 'description' => 'Reimbursement for business meals and allowances.', 'is_active' => true]);
        ClaimsCategory::create(['name' => 'Office Supplies', 'description' => 'Claims for office-related expenses like stationery.', 'is_active' => true]);
        ClaimsCategory::create(['name' => 'Training & Development', 'description' => 'Expenses for work-related training programs.', 'is_active' => true]);
    }
}

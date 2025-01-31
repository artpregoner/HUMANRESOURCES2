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
        TicketCategory::create(['category_name' => 'Account']);
        TicketCategory::create(['category_name' => 'Information']);
        TicketCategory::create(['category_name' => 'Others...']);
    }
}

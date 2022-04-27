<?php

namespace Database\Seeders;

use App\Models\CategoryType;
use Illuminate\Database\Seeder;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryType::factory()->count(5)->create();
    }
}

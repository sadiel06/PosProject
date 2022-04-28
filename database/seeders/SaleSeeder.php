<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{

    public function run()
    {
        Sale::factory()->count(1000)->create();

    }
}

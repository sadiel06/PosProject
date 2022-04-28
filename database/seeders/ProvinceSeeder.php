<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{

    public function run()
    {
        Province::factory()->count(5)->create();
    }
}

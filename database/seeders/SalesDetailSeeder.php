<?php

namespace Database\Seeders;

use App\Models\SalesDetail;
use Illuminate\Database\Seeder;

class SalesDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalesDetail::factory()->count(5)->create();
    }
}

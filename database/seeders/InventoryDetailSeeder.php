<?php

namespace Database\Seeders;

use App\Models\InventoryDetail;
use Illuminate\Database\Seeder;

class InventoryDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryDetail::factory()->count(5)->create();
    }
}

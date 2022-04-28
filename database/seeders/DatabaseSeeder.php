<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
//         \App\Models\User::factory(10)->create();
        $this->call(CategoryTypeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(SaleSeeder::class);
        $this->call(SalesDetailSeeder::class);





    }
}

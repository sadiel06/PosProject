<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Size::factory()->count(5)->create();
        $sizes = ['XS','2X','L','2XL','3XL','M','S','XL'];
        foreach ($sizes as $size){
            Size::create(['description'=>$size]);
        }

    }
}

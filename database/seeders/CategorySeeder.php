<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categoryType = new Category();
        $categoryType->description = 'Vestidos';
        $categoryType->category_type_id = 1;
        $categoryType->name = 'vestido lanna';
        $categoryType->save();

        $categoryType1 = new Category();
        $categoryType1->description = 'Tops';
        $categoryType1->category_type_id = 2;
        $categoryType1->name = 'blusa lanna';
        $categoryType1->save();

        $categoryType2 = new Category();
        $categoryType2->description = 'Bottoms';
        $categoryType2->category_type_id = 3;
        $categoryType2->name = 'pantalon lanna';
        $categoryType2->save();

        $categoryType3 = new Category();
        $categoryType3->description = 'Accesorios';
        $categoryType3->category_type_id = 4;
        $categoryType3->name = 'reloj lanna';
        $categoryType3->save();

    }
}

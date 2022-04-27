<?php

namespace Database\Seeders;

use App\Models\CategoryType;
use Illuminate\Database\Seeder;

class CategoryTypeSeeder extends Seeder
{

    public function run()
    {
        $categoryType = new CategoryType();
        $categoryType->description = 'Hombres';
        $categoryType->save();

        $categoryType1 = new CategoryType();
        $categoryType1->description = 'Mujeres';
        $categoryType1->save();

        $categoryType2 = new CategoryType();
        $categoryType2->description = 'Niños';
        $categoryType2->save();

        $categoryType3 = new CategoryType();
        $categoryType3->description = 'Verano';
        $categoryType3->save();

        $categoryType2 = new CategoryType();
        $categoryType2->description = 'invierno';
        $categoryType2->save();    }
}

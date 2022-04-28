<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Size;

class SizeFactory extends Factory
{

    protected $model = Size::class;

    public function definition()
    {
        $sizes=['XS','2X','L','2XL','3XL','M','S','XL'];
        return [
            'description' => $this->faker->unique()->randomElement($sizes),
//            'softdeletes' => $this->faker->word,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SalesDetail;

class SalesDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sale_id' => Sale::factory(),
            'date_created' => $this->faker->date(),
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'softdeletes' => $this->faker->word,
        ];
    }
}

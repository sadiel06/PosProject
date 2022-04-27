<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\InventoryDetail;
use App\Models\Product;

class InventoryDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pruduct_id' => Product::factory(),
            'min_stock' => $this->faker->numberBetween(-10000, 10000),
            'current_stock' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}

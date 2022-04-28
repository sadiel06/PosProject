<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Producto;
use App\Models\Size;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'name' => $this->faker->word(),
            'status_id' => $this->faker->randomElement([1,2]),
            'size_id' => Size::factory(),
            'register_date' => $this->faker->date(),
            'cost' => $this->faker->randomFloat(2, 600, 1300),
            'price' => $this->faker->randomFloat(2, 1550, 9999.99),
        ];
    }
}

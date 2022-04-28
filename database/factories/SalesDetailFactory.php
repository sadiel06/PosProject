<?php

namespace Database\Factories;

use App\Models\Producto;
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
//        dd($val);
            $val =Producto::factory();
        return [
            'sale_id' => Sale::factory(),
            'date_created' => $this->faker->date(),
            'producto_id' => $val,
            'producto_price' => Producto::find( $this->faker->numberBetween(0, Producto::all()->count()))->price,
            'quantity' => $this->faker->numberBetween(0, 5),
//            'softdeletes' => $this->faker->word,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\PointOfSale;
use App\Models\Sale;
use App\Models\Status;
use App\Models\User;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date_created' => $this->faker->date(),
            'user_id' => User::factory(),
            'total' => $this->faker->randomFloat(2, 0, 99999999.99),
            'status_id' => Status::factory(),
            'point_of_sales_id' => PointOfSale::factory(),
            'client_id' => Client::factory(),
            'softdeletes' => $this->faker->word,
        ];
    }
}

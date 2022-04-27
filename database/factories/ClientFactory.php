<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Entity;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'entity_id' => Entity::factory(),
            'name' => $this->faker->name,
            'apellido' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'cedula' => $this->faker->regexify('[A-Za-z0-9]{18}'),
            'softdeletes' => $this->faker->word,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Phone;

class PhoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Phone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phonable_id' => $this->faker->randomNumber(),
            'phonable_type' => $this->faker->word,
            'number_phone' => $this->faker->word,
            'softdeletes' => $this->faker->word,
        ];
    }
}

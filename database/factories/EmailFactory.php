<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Email;

class EmailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Email::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'emailable_id' => $this->faker->randomNumber(),
            'emailable_type' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'softdeletes' => $this->faker->word,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Skin;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkinFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Skin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->firstName,
            'rating' => $this->faker->randomDigit,
            'skin' => $this->faker->text(25),
        ];
    }
}

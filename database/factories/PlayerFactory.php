<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nickname' => $this->faker->unique()->firstName,
            'mail' => $this->faker->unique()->safeEmail,
            'password' => Hash::make($this->faker->password),
            'skin_id' => $this->faker->randomDigitNotNull,
//            'push_enabled' => $this->faker->randomElement([true, false]),
            'push_token' => $this->faker->randomDigit,
        ];
    }
}

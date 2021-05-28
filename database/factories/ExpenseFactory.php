<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $player = Player::factory()->create();
        $category = Category::factory()->create();

        return [
            'name' => $this->faker->unique()->firstName,
            'description' => $this->faker->text,
            'player_id' => $player->id,
            'category_id' => $category->id,
            'repeat_at' => $this->faker->randomElement(array_keys(Expense::getExpensesRepeatTypeList())),
            'sum' => $this->faker->randomDigit,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodEntry>
 */
class FoodEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->streetName,
            'date_time' => $this->faker->dateTime,
            'calories' => $this->faker->randomFloat(null, 0, 1500),
            'price' => $this->faker->numberBetween(1, 1000),
        ];
    }
}

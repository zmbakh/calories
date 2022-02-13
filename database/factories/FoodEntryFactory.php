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
            'name' => $this->foodName(),
            'date_time' => $this->faker->dateTime,
            'calories' => $this->faker->randomFloat(null, 0, 1500),
            'price' => $this->faker->numberBetween(1, 1000),
        ];
    }

    /**
     * @return string
     */
    public function foodName(): string
    {
        $foodNames = [
            "BBQ Chicken Flatbread",
            "Chicken Flatbread",
            "Tomato Mozzarella Flatbread",
            "Roasted Turkey Cranberry Flatbread",
            "Turkey Cranberry Flatbread",
            "Half Size Italian on Hoagie Roll",
            "Half Italian",
            "Italian",
            "Italian on Hoagie Roll",
            "Steak and White Cheddar Panini",
            "Steak and Cheddar Panini",
            "Steak Panini",
            "Steak & White Cheddar Panini on Hoagie Roll",
            "Half Steak Panini",
            "Half Size Steak & White Cheddar Panini on Hoagie Roll",
            "Chicken Panini",
            "Half Chicken Panini",
            "Half Size Chicken Panini",
            "Frontega Chicken Panini on Focaccia",
            "Half Turkey Sandwich",
            "Half Size Turkey Breast Sandwich",
            "Turkey Sandwich",
            "Turkey Breast Sandwich",
            "Grilled Cheese",
            "Classic Grilled Cheese",
            "Half Size Classic Grilled Cheese",
            "Half Grilled Cheese",
            "Chicken Salad Sandwich",
            "Veggie Sandwich",
            "Mediterranean Veggie Sandwich",
            "Mediterranean Sandwich",
            "Ancient Grain Greek Salad",
            "Modern Greek Salad with Quinoa",
            "Greek Salad",
            "Seasonal Greens Salad",
            "Chicken Tortellini Alfredo",
            "Macaroni and Cheese",
            "Mac and Cheese",
            "Mac & Cheese",
            "Small Mac and Cheese",
            "Kids Mac and Cheese",
            "Large Mac and Cheese",
            "Mac and Cheese Breadbowl",
            "Apple",
            "Roll",
            "Baguette",
            "French Baguette",
            "Chips",
            "Kettle Chips",
            "Vegetarian Autumn Squash Soup",
            "Autumn Squash Soup",
            "Bowl of Vegetarian Autumn Squash Soup",
            "Cup of Vegetarian Autumn Squash Soup",
            "Turkey Chili",
            "Bowl of Turkey Chili",
            "Cup of Turkey Chili",
            "Cream of Chicken & Wild Rice Soup",
            "Bowl of Cream of Chicken & Wild Rice Soup",
            "Cup of Cream of Chicken & Wild Rice Soup",
            "Chicken Noodle Soup",
            "Bowl of Chicken Noodle Soup",
            "Cup of Chicken Noodle Soup",
            "Baked Potato Soup",
            "Potato Soup",
            "New England Clam Chowder",
            "Broccoli Cheddar Soup",
            "Vegetarian Creamy Tomato Soup",
            "Creamy Tomato Soup",
            "Tomato Soup",
            "French Onion Soup",
            "Bowl of French Onion Soup",
            "Cup of French Onion Soup",
            "Pecan Braid",
            "Cheese Pastry",
            "Chocolate Pastry",
            "Cherry Pastry",
            "Bear Claw",
            "Cinnamon Roll",
            "Pecan Roll",
            "Cobblestone",
            "Blueberry Muffin",
            "Cranberry Orange Muffin",
            "Apple Crunch Muffin",
            "Pumpkin Muffin",
            "Chocolate Chip Muffie",
            "Pumpkin Muffie",
            "Steak and Egg Sandwich",
            "Ham Egg and Cheese Sandwich",
            "Sausage Egg and Cheese Sandwich",
            "Bacon Egg and Cheese Sandwich",
            "Asiago Bacon Egg and Cheese Sandwich",
            "Egg and Cheese Sandwich",
            "Avocado Egg White and Spinach Sandwich",
            "Mediterranean Egg White Sandwich",
            "Turkey Sausage Egg White and Spinach Sandwich",
            "Oatmeal",
            "Oatmeal with Apple",
            "Oatmeal with Strawberries",
            "Oatmeal with Almonds",
            "Greek Yogurt",
            "Fruit Cup"
        ];

        return $foodNames[array_rand($foodNames)];
    }
}

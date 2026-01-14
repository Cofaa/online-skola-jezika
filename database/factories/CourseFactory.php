<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->text(),
            'level' => fake()->randomElement(["A1","A2","B1","B2","C1","C2"]),
            'price' => fake()->randomFloat(2, 0, 999999.99),
            'is_active' => fake()->boolean(),
        ];
    }
}

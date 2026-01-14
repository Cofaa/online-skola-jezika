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
            'title' => fake()->randomElement([
                'Srpski jezik – početni kurs',
                'Srpski jezik – srednji nivo',
                'Srpski jezik – napredni nivo',
            ]),
            'description' => fake()->randomElement([
                'Osnovni kurs srpskog jezika za početnike.',
                'Kurs za unapređenje postojećeg znanja srpskog jezika.',
                'Napredni kurs sa fokusom na konverzaciju i gramatiku.',
            ]),
            'level' => fake()->randomElement(['A1', 'A2', 'B1', 'B2']),
            'price' => fake()->randomFloat(2, 100, 300),
            'active' => true,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'teacher_id' => User::factory(),
            'starts_at' => fake()->dateTime(),
            'duration_minutes' => fake()->randomNumber(),
            'status' => fake()->randomElement(["scheduled","cancelled","completed"]),
        ];
    }
}

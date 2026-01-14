<?php

namespace Database\Factories;

use App\Models\LessonSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'lesson_session_id' => LessonSession::factory(),
            'student_id' => User::factory(),
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
            'note' => fake()->word(),
        ];
    }
}

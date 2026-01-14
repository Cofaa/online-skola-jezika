<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Course;
use App\Models\LessonSession;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->admin()->create([
            'email' => 'admin@test.com',
        ]);

        $teachers = User::factory()->count(2)->teacher()->create();
        $students = User::factory()->count(3)->student()->create();

        $courses = Course::factory()->count(3)->create();

        foreach ($courses as $course) {
            foreach ($teachers as $teacher) {
                $session = LessonSession::create([
                    'course_id' => $course->id,
                    'teacher_id' => $teacher->id,
                    'starts_at' => Carbon::now()->addDays(rand(1, 10)),
                    'duration_minutes' => 60,
                    'status' => 'scheduled',
                ]);

                Booking::create([
                    'lesson_session_id' => $session->id,
                    'student_id' => $students->random()->id,
                    'status' => 'confirmed',
                ]);
            }
        }
    }
}

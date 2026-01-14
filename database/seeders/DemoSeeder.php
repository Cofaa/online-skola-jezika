<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Course;
use App\Models\LessonSession;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // --- USERS ---
        $admin = User::updateOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin User',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]
        );

        $teacher1 = User::updateOrCreate(
            ['email' => 'teacher1@test.com'],
            [
                'name' => 'Ana Petrović',
                'role' => 'teacher',
                'password' => Hash::make('password'),
            ]
        );

        $teacher2 = User::updateOrCreate(
            ['email' => 'teacher2@test.com'],
            [
                'name' => 'Marko Jovanović',
                'role' => 'teacher',
                'password' => Hash::make('password'),
            ]
        );

        $student1 = User::updateOrCreate(
            ['email' => 'student1@test.com'],
            [
                'name' => 'Ivan Ilić',
                'role' => 'student',
                'password' => Hash::make('password'),
            ]
        );

        $student2 = User::updateOrCreate(
            ['email' => 'student2@test.com'],
            [
                'name' => 'Jelena Nikolić',
                'role' => 'student',
                'password' => Hash::make('password'),
            ]
        );

        $student3 = User::updateOrCreate(
            ['email' => 'student3@test.com'],
            [
                'name' => 'Nikola Simić',
                'role' => 'student',
                'password' => Hash::make('password'),
            ]
        );

        $teachers = collect([$teacher1, $teacher2]);
        $students = collect([$student1, $student2, $student3]);

        // --- COURSES (real data, no lorem) ---
        $courses = collect([
            Course::updateOrCreate(
                ['title' => 'Srpski jezik – početni kurs'],
                [
                    'description' => 'Osnovni kurs srpskog jezika za početnike. Pismo, osnove gramatike i svakodnevni izrazi.',
                    'level' => 'A1',
                    'price' => 120.00,
                    'active' => true,
                ]
            ),
            Course::updateOrCreate(
                ['title' => 'Srpski jezik – srednji nivo'],
                [
                    'description' => 'Kurs za polaznike sa osnovnim znanjem. Fokus na komunikaciju i proširenu gramatiku.',
                    'level' => 'B1',
                    'price' => 180.00,
                    'active' => true,
                ]
            ),
            Course::updateOrCreate(
                ['title' => 'Srpski jezik – napredni nivo'],
                [
                    'description' => 'Napredni kurs sa fokusom na tečnu konverzaciju, idiome i profesionalnu komunikaciju.',
                    'level' => 'B2',
                    'price' => 250.00,
                    'active' => true,
                ]
            ),
        ]);

        // --- SESSIONS + BOOKINGS ---
        // Fiksni (stabilni) datumi za demo
        $base = Carbon::now()->startOfDay()->addDays(2)->setTime(15, 0);

        foreach ($courses as $courseIndex => $course) {
            foreach ($teachers as $teacherIndex => $teacher) {
                $startsAt = $base->copy()->addDays(($courseIndex * 3) + $teacherIndex);

                $session = LessonSession::create([
                    'course_id' => $course->id,
                    'teacher_id' => $teacher->id,
                    'starts_at' => $startsAt,
                    'duration_minutes' => 60,
                    'status' => 'scheduled',
                ]);

                // 1 booking po sesiji (demo), status confirmed
                Booking::create([
                    'lesson_session_id' => $session->id,
                    'student_id' => $students->random()->id,
                    'status' => 'confirmed',
                    'note' => null,
                ]);
            }
        }
    }
}

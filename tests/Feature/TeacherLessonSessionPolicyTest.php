<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\LessonSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherLessonSessionPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_sees_only_his_sessions_on_index(): void
    {
        $teacher1 = User::factory()->create(['role' => 'teacher']);
        $teacher2 = User::factory()->create(['role' => 'teacher']);

        $course = Course::factory()->create();

        $s1 = LessonSession::create([
            'course_id' => $course->id,
            'teacher_id' => $teacher1->id,
            'starts_at' => now()->addDay()->setTime(10, 11),
            'duration_minutes' => 60,
            'status' => 'scheduled',
        ]);

        $s2 = LessonSession::create([
            'course_id' => $course->id,
            'teacher_id' => $teacher2->id,
            'starts_at' => now()->addDays(2)->setTime(12, 13),
            'duration_minutes' => 60,
            'status' => 'scheduled',
        ]);

        $resp = $this->actingAs($teacher1)
            ->get(route('teacher.lesson-sessions.index'))
            ->assertOk();

        // index prikazuje starts_at formatirano kao "Y-m-d H:i"
        $resp->assertSee($s1->starts_at->format('Y-m-d H:i'));
        $resp->assertDontSee($s2->starts_at->format('Y-m-d H:i'));

        // i proveri da link za tuđu sesiju ne postoji
        $resp->assertDontSee(route('teacher.lesson-sessions.show', $s2), false);
    }

    public function test_teacher_cannot_view_other_teachers_session(): void
    {
        $teacher1 = User::factory()->create(['role' => 'teacher']);
        $teacher2 = User::factory()->create(['role' => 'teacher']);
        $course = Course::factory()->create();

        $othersSession = LessonSession::create([
            'course_id' => $course->id,
            'teacher_id' => $teacher2->id,
            'starts_at' => now()->addDay(),
            'duration_minutes' => 60,
            'status' => 'scheduled',
        ]);

        $this->actingAs($teacher1)
            ->get(route('teacher.lesson-sessions.show', $othersSession))
            ->assertForbidden();
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentCannotAccessTeacherRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_cannot_access_teacher_sessions_index(): void
    {
        $student = User::factory()->create(['role' => 'student']);

        $this->actingAs($student)
            ->get(route('teacher.lesson-sessions.index'))
            ->assertForbidden();
    }

    public function test_guest_is_redirected_from_teacher_sessions_index(): void
    {
        $this->get(route('teacher.lesson-sessions.index'))
            ->assertRedirect(); // na /login
    }
}

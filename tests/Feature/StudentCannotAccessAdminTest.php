<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentCannotAccessAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_cannot_access_admin_courses_index(): void
    {
        $student = User::factory()->create(['role' => 'student']);

        $this->actingAs($student)
            ->get(route('admin.courses.index'))
            ->assertForbidden();
    }
}

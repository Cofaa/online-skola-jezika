<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCoursesAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_courses_index(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.courses.index'))
            ->assertOk();
    }
}

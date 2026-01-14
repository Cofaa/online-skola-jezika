<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Course;
use App\Models\LessonSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentBookingFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_book_scheduled_session(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $teacher = User::factory()->create(['role' => 'teacher']);
        $course = Course::factory()->create();

        $session = LessonSession::create([
            'course_id' => $course->id,
            'teacher_id' => $teacher->id,
            'starts_at' => now()->addDay(),
            'duration_minutes' => 60,
            'status' => 'scheduled',
        ]);

        $this->actingAs($student)
            ->post(route('student.sessions.book', $session))
            ->assertRedirect(route('student.bookings.index'));

        $this->assertDatabaseHas('bookings', [
            'lesson_session_id' => $session->id,
            'student_id' => $student->id,
            'status' => 'pending',
        ]);
    }

    public function test_student_cannot_book_same_session_twice(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $teacher = User::factory()->create(['role' => 'teacher']);
        $course = Course::factory()->create();

        $session = LessonSession::create([
            'course_id' => $course->id,
            'teacher_id' => $teacher->id,
            'starts_at' => now()->addDay(),
            'duration_minutes' => 60,
            'status' => 'scheduled',
        ]);

        Booking::create([
            'lesson_session_id' => $session->id,
            'student_id' => $student->id,
            'status' => 'pending',
        ]);

        $this->actingAs($student)
            ->post(route('student.sessions.book', $session))
            ->assertRedirect(); // vraća back()

        $this->assertEquals(1, Booking::where('lesson_session_id', $session->id)
            ->where('student_id', $student->id)->count());
    }

    public function test_student_can_cancel_own_booking(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $teacher = User::factory()->create(['role' => 'teacher']);
        $course = Course::factory()->create();

        $session = LessonSession::create([
            'course_id' => $course->id,
            'teacher_id' => $teacher->id,
            'starts_at' => now()->addDay(),
            'duration_minutes' => 60,
            'status' => 'scheduled',
        ]);

        $booking = Booking::create([
            'lesson_session_id' => $session->id,
            'student_id' => $student->id,
            'status' => 'pending',
        ]);

        $this->actingAs($student)
            ->delete(route('student.bookings.destroy', $booking))
            ->assertRedirect(route('student.bookings.index'));

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled',
        ]);
    }
}

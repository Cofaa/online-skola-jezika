<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\LessonSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function sessions()
    {
        $sessions = LessonSession::query()
            ->where('status', 'scheduled')
            ->with(['course', 'teacher'])
            ->orderBy('starts_at')
            ->paginate(10);

        return view('student.sessions.index', compact('sessions'));
    }

    public function store(Request $request, LessonSession $lesson_session)
    {
        // ne može se bookovati ako nije scheduled
        if ($lesson_session->status !== 'scheduled') {
            return back()->with('error', 'This session cannot be booked.');
        }

        // spreči dupli booking istog termina za istog studenta
        $exists = Booking::query()
            ->where('lesson_session_id', $lesson_session->id)
            ->where('student_id', Auth::id())
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already booked this session.');
        }

        Booking::create([
            'lesson_session_id' => $lesson_session->id,
            'student_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('student.bookings.index')
            ->with('success', 'Booking created (pending).');
    }

    public function index()
    {
        $bookings = Booking::query()
            ->where('student_id', Auth::id())
            ->with(['lessonSession.course', 'lessonSession.teacher'])
            ->latest()
            ->paginate(10);

        return view('student.bookings.index', compact('bookings'));
    }

    public function destroy(Booking $booking)
    {
        // student može da otkaže samo svoj booking
        abort_unless($booking->student_id === Auth::id(), 403);

        $booking->update(['status' => 'cancelled']);

        return redirect()
            ->route('student.bookings.index')
            ->with('success', 'Booking cancelled.');
    }
}

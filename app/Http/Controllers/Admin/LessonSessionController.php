<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LessonSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LessonSessionController extends Controller
{
    public function index(): View
    {
        $sessions = LessonSession::query()
            ->with(['course', 'teacher'])
            ->latest('starts_at')
            ->paginate(10);

        return view('admin.lesson-sessions.index', compact('sessions'));
    }

    public function show(LessonSession $lessonSession): View
    {
        $lessonSession->load(['course', 'teacher', 'bookings.student']);

        return view('admin.lesson-sessions.show', ['session' => $lessonSession]);
    }

    public function destroy(LessonSession $lessonSession): RedirectResponse
    {
        $lessonSession->delete();

        return redirect()
            ->route('admin.lesson-sessions.index')
            ->with('success', 'Session deleted.');
    }
}

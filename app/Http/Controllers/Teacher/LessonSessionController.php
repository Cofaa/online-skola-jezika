<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\LessonSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LessonSessionController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', LessonSession::class);

        $sessions = LessonSession::query()
            ->where('teacher_id', Auth::id())
            ->with('course')
            ->latest('starts_at')
            ->paginate(10);

        return view('teacher.lesson-sessions.index', compact('sessions'));
    }

    public function create()
    {
        Gate::authorize('create', LessonSession::class);

        $courses = Course::orderBy('title')->get(['id', 'title', 'level']);
        return view('teacher.lesson-sessions.create', compact('courses'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create', LessonSession::class);

        $data = $this->validated($request);
        $data['teacher_id'] = Auth::id();

        $session = LessonSession::create($data);

        return redirect()
            ->route('teacher.lesson-sessions.show', $session)
            ->with('success', 'Session created successfully.');
    }

    public function show(LessonSession $lesson_session)
    {
        Gate::authorize('view', $lesson_session);

        $lesson_session->load('course');

        return view('teacher.lesson-sessions.show', [
            'session' => $lesson_session,
        ]);
    }

    public function edit(LessonSession $lesson_session)
    {
        Gate::authorize('update', $lesson_session);

        $courses = Course::orderBy('title')->get(['id', 'title', 'level']);

        return view('teacher.lesson-sessions.edit', [
            'session' => $lesson_session,
            'courses' => $courses,
        ]);
    }

    public function update(Request $request, LessonSession $lesson_session)
    {
        Gate::authorize('update', $lesson_session);

        $data = $this->validated($request);
        unset($data['teacher_id']);

        $lesson_session->update($data);

        return redirect()
            ->route('teacher.lesson-sessions.show', $lesson_session)
            ->with('success', 'Session updated successfully.');
    }

    public function destroy(LessonSession $lesson_session)
    {
        Gate::authorize('delete', $lesson_session);

        $lesson_session->delete();

        return redirect()
            ->route('teacher.lesson-sessions.index')
            ->with('success', 'Session deleted successfully.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'course_id' => 'required|exists:courses,id',
            'starts_at' => 'required|date',
            'duration_minutes' => 'required|integer|min:15|max:240',
            'status' => 'required|in:scheduled,cancelled,completed',
        ]);
    }
}

<?php

namespace App\Policies;

use App\Models\LessonSession;
use App\Models\User;

class LessonSessionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'teacher';
    }

    public function view(User $user, LessonSession $lessonSession): bool
    {
        return $user->role === 'teacher' && $lessonSession->teacher_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->role === 'teacher';
    }

    public function update(User $user, LessonSession $lessonSession): bool
    {
        return $user->role === 'teacher' && $lessonSession->teacher_id === $user->id;
    }

    public function delete(User $user, LessonSession $lessonSession): bool
    {
        return $user->role === 'teacher' && $lessonSession->teacher_id === $user->id;
    }
}

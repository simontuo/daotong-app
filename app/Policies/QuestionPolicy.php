<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function closeComment(User $user, Question $question)
    {
        if ($user->id == $question->user_id || $user->isAdmin()) {
            return true;
        }
    }

    public function isHidden(User $user, Question $question)
    {
        if ($user->id == $question->user_id || $user->isAdmin()) {
            return true;
        }
    }
}

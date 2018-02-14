<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Calligraphy;
use Illuminate\Auth\Access\HandlesAuthorization;

class CalligraphyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function update(User $user, Calligraphy $calligraphy)
    {
        if ($user->id == $calligraphy->user_id || $user->isAdmin()) {
            return true;
        }
    }

    public function closeComment(User $user, Calligraphy $calligraphy)
    {
        if ($user->id == $calligraphy->user_id || $user->isAdmin()) {
            return true;
        }
    }

    public function isHidden(User $user, Calligraphy $calligraphy)
    {
        if ($user->id == $calligraphy->user_id || $user->isAdmin()) {
            return true;
        }
    }
}

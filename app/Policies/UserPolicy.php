<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        if ($user->id == $model->id || $user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if ($user->id == $model->id || $user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->isSuperAdmin();
    }

    public function changePassword(User $user, User $model)
    {
        if ($user->id == $model->id || $user->isAdmin()) {
            return true;
        }
    }

    public function uploadAvatar(User $user, User $model)
    {
        if ($user->id == $model->id || $user->isAdmin()) {
            return true;
        }
    }

    public function uploadWechatCode(User $user, User $model)
    {
        if ($user->id == $model->id || $user->isAdmin()) {
            return true;
        }
    }

    public function uploadAlipayCode(User $user, User $model)
    {
        if ($user->id == $model->id || $user->isAdmin()) {
            return true;
        }
    }

    public function closeComment(User $user)
    {
        return $user->isAdmin();
    }

    public function isHidden(User $user)
    {
        return $user->isAdmin();
    }

    public function viewAdmin(User $user)
    {
        return $user->isAdmin();
    }

    public function viewAdminLog(User $user)
    {
        return $user->isSuperAdmin();
    }

}

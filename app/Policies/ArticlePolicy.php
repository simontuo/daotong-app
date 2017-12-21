<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function view()
    {
        return true;
    }

    public function create()
    {
        return true;
    }

    public function delete(User $user, Article $article)
    {
        if ($user->id == $article->user_id || $user->isAdmin()) {
            return true;
        }
    }

    public function update(User $user, Article $article)
    {
        if ($user->id == $article->user_id || $user->isAdmin()) {
            return true;
        }
    }
}

<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Article;
use App\Models\Calligraphy;
use App\Models\Question;
use App\Policies\UserPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\QuestionPolicy;
use App\Policies\CalligraphyPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model'        => 'App\Policies\ModelPolicy',
        Article::class     => ArticlePolicy::class,
        User::class        => UserPolicy::class,
        Calligraphy::class => CalligraphyPolicy::class,
        Quesion::class     => QuestionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

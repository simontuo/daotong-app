<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Collections\QuestionCollection;
use App\Models\User;
use App\Models\Topic;
use App\Models\Answer;

class Question extends Model
{
    use Traits\PublicOperation;
    use Traits\ActionLog;

    protected $fillable = [
        'user_id', 'title', 'bio'
    ];

    public function newCollection(array $models = [])
    {
        return new QuestionCollection($models);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function follower()
    {
        return $this->belongsToMany(User::class, 'user_question')->withTimestamps();
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}

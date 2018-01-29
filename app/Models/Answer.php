<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Question;
use App\Collections\AnswerCollection;

class Answer extends Model
{
    use Traits\PublicOperation;
    use Traits\ActionLog;

    protected $fillable = [
        'user_id', 'question_id', 'bio', 'markdown_bio', 'votes_count', 'comments_count', 'is_hidden', 'close_comment'
    ];

    public function newCollection(array $models = [])
    {
        return new AnswerCollection($models);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }

    public function dislikes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }
}

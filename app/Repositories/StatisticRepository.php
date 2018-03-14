<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Article;
use App\Models\Calligraphy;
use App\Models\Question;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Motto;
use App\Models\Suggestion;
use App\Models\Topic;
use App\Models\Answer;
use App\Models\Message;

class StatisticRepository
{

    protected $resourceModel = [
        'Article', 'Calligraphy', 'Question', 'Like', 'Comment', 'Topic', 'Answer', 'Message'
    ];

    public function getResourceTotal()
    {
        return collect($this->resourceModel)->map(function($item, $key) {
            return App('App\Models\\'.$item)->count();
        })->sum();
    }

}

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

    protected $visitModel = [
        'Article', 'Calligraphy', 'Question'
    ];

    protected $visitModelLabel = [
        'Article'     => '文章',
        'Calligraphy' => '书法',
        'Question'    => '问题',
    ];

    public function getResourceTotal()
    {
        return collect($this->resourceModel)->map(function($item, $key) {
            return App('App\Models\\'.$item)->count();
        })->sum();
    }

    public function getUserTotal()
    {
        return User::count();
    }

    public function getVisitTotal()
    {
        return collect($this->visitModel)->map(function($item, $key) {
            return App('App\Models\\'.$item)->sum('reads_count');
        })->sum();
    }

    public function getResourceDetail()
    {
        $modelKey = collect($this->resourceModel)->map(function($item, $key) {
            return lcfirst($item);
        });

        $detail = collect($this->resourceModel)->map(function($item, $key) {
            return App('App\Models\\'.$item)->count();
        });

        return $modelKey->combine($detail)->prepend($detail->sum(), 'total');
    }

    public function getUserDetail()
    {

    }

    public function getVisitDetail()
    {
        $opinionData = collect($this->visitModelLabel)->map(function($item, $key) {
            return [
                'name'  => $item,
                'value' => App('App\Models\\'.$key)->sum('reads_count')
            ];
        })->toArray();

        return [
            'opinion'     => array_values($this->visitModelLabel),
            'opinionData' => array_values($opinionData)
        ];
    }

}

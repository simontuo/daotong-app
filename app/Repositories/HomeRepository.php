<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Article;
use App\Models\Calligraphy;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeRepository
{
    protected $quickQueryType = [
        'created_at',  'comments_count', 'votes_count'
    ];

    protected $mergeUserColumn = [
        'users.id as user_id', 'users.name as user_name', 'users.avatar as user_avatar'
    ];

    protected $prefixQuery = [
        'articles' => [
                'is_hidden' => 'F',
            ],
        'calligraphies' => [
                'is_hidden' => 'F',
            ],
        'questions' => [
                'is_hidden' => 'F',
            ],
    ];

    protected $modelColumn = [
        'id', 'user_id', 'title', 'created_at', 'comments_count', 'is_hidden', 'close_comment', 'reads_count'
    ];

    public function search($query, $quickQuery = null, $pageSize, $page, $prefixQueryState = false)
    {
        $quickQueryType = is_null($quickQuery) ? 'created_at' : array_get($this->quickQueryType, $quickQuery, 'created_at');

        $articles      = $this->query('Article', 'articles', $prefixQueryState, $query);
        $calligraphies = $this->query('Calligraphy', 'calligraphies', $prefixQueryState, $query);
        $questions     = $this->query('Question', 'questions', $prefixQueryState, $query);
        $items         = $articles->union($questions)->union($calligraphies)->orderBy($quickQueryType, 'DESC')->get();

        $items = $this->addCreatedTime($items);

        $slice = array_slice($items->toArray(), $pageSize * ($page - 1), $pageSize);

        $result = new LengthAwarePaginator($slice, count($items), $pageSize, $page);

        return $result;

    }

    public function checkPrefixQuery($prefixQueryState, $table)
    {
        $prefixQuery =  $prefixQueryState ? $this->prefixQuery : [];

        return collect($prefixQuery)->filter(function($item, $key) use($table){
            if ($key == $table) {
                return $item;
            }
        })->toArray();
    }

    public function getColumn($table)
    {
        return collect($this->modelColumn)->map(function($item, $key) use($table){
            return $table.'.'.$item;
        })->toArray();
    }

    public function addCreatedTime($items)
    {
        return collect($items)->each(function($item, $key) {
            $item->created_time = $item->created_at->diffForHumans();
            return $item;
        });
    }

    public function query($model, $table, $prefixQueryState, $query)
    {
        $prefixQuery = array_dot($this->checkPrefixQuery($prefixQueryState, $table));

        return app('App\Models\\'.$model)->join('users', function($join) use($table, $prefixQuery){
                        $join->on($table.'.user_id', '=', 'users.id')
                            ->select('users.id', 'users.name', 'user_avatar')
                            ->where($prefixQuery);
                    })->where('users.name', 'like', '%'.$query.'%')
                        ->orWhere($table.'.title', 'like', '%'.$query.'%')
                        ->select(array_merge($this->mergeUserColumn,$this->getColumn($table)))
                        ->selectRaw('? as type', [$table]);
    }
}

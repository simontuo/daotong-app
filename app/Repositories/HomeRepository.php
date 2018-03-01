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
    protected $model = [
        'Article' , 'Calligraphy', 'Question'
    ];

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

        $total = $this->unionModelDataSum($prefixQueryState, $query);

        $items = $this->unionModelQuery($prefixQueryState, $query)->orderBy($quickQueryType, 'DESC')->skip(($page-1) *

        $pageSize)->limit($pageSize)->get();

        $result = new LengthAwarePaginator($this->addCreatedTime($items), $total, $pageSize, $page);

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

    public function modelQuery($model, $prefixQueryState, $query)
    {
        $table = str_plural(lcfirst($model));

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

    public function unionModelDataSum($prefixQueryState, $query)
    {
        return collect($this->model)->map(function($item, $key) use($prefixQueryState, $query){
            return $this->modelQuery($item, $prefixQueryState, $query)->count();
        })->sum();
    }

    public function unionModelQuery($prefixQueryState, $query)
    {
        $unionModelQuery = '';

        foreach ($this->model as $key => $value) {
            if ($key == 0) {
                $unionModelQuery = $this->modelQuery($value, $prefixQueryState, $query);
            }else{
                $unionModelQuery = $unionModelQuery->union($this->modelQuery($value, $prefixQueryState, $query));
            }
        }

        return $unionModelQuery;
    }
}

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
        'id', 'user_id', 'title', 'created_at', 'comments_count', 'is_hidden', 'close_comment'
    ];

    public function search($query, $quickQuery = null, $pageSize, $page, $prefixQueryState = false)
    {
        $quickQueryType = is_null($quickQuery) ? 'created_at' : array_get($this->quickQueryType, $quickQuery, 'created_at');

        $articles      = $this->query('Article', 'articles', $prefixQueryState, $query);
        $calligraphies = $this->query('Calligraphy', 'calligraphies', $prefixQueryState, $query);
        $items         = $this->query('Question', 'questions', $prefixQueryState, $query)
                                ->union($articles)
                                ->union($calligraphies)
                                ->with(['user', 'topics'])
                                ->orderBy($quickQueryType, 'DESC')
                                ->get()
                                ->toArray();

        $slice = array_slice($items, $pageSize * ($page - 1), $pageSize);

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

    public function query($model, $table, $prefixQueryState, $query)
    {
        $prefixQuery = array_dot($this->checkPrefixQuery($prefixQueryState, $table));

        return app('App\Models\\'.$model)->join('users', function($join) use($table, $prefixQuery){
                        $join->on($table.'.id', '=', 'users.id')
                            ->select('users.id', 'users.name')
                            ->where($prefixQuery);
                    })->where('users.name', 'like', '%'.$query.'%')
                        ->orWhere($table.'.title', 'like', '%'.$query.'%')
                        ->select($this->getColumn($table))
                        ->selectRaw('? as type', [$table]);
    }
}

<?php
namespace App\Repositories;

use App\Models\Calligraphy;

class CalligraphyRepository
{
    protected $quickQueryType = [
        'created_at', 'reads_count', 'comments_count', 'likes_count'
    ];

    protected $prefixQuery = [
        'calligraphies.is_hidden' => 'F',
    ];

    protected $modelColumn = [
        'calligraphies.id', 'calligraphies.user_id', 'calligraphies.title', 'calligraphies.images', 'calligraphies.bio', 'calligraphies.created_at', 'calligraphies.comments_count', 'calligraphies.reads_count', 'calligraphies.close_comment', 'calligraphies.is_hidden'
    ];

    public function create(array $attributes)
    {
        return Calligraphy::create($attributes);
    }

    public function index($pageSize)
    {
        return Calligraphy::with(['user', 'likes'])->latest('created_at')->paginate($pageSize);
    }

    public function byId($id)
    {
        return Calligraphy::findOrFail($id);
    }

    public function getRankingList()
    {
        return Calligraphy::select('id', 'user_id', 'title', 'reads_count')->orderBy('reads_count', 'DESC')->with('user')->paginate(5);
    }

    public function getAllCalligraphysCount()
    {
        return Calligraphy::count();
    }

    public function getReadsTotal()
    {
        return Calligraphy::sum('reads_count');
    }

    public function search($query, $quickQuery = null, $pageSize, $prefixQueryState = false)
    {
        $quickQueryType = is_null($quickQuery) ? 'created_at' : array_get($this->quickQueryType, $quickQuery, 'created_at');

        $prefixQuery = $this->checkPrefixQuery($prefixQueryState);

        return Calligraphy::join('users', function ($join) use($prefixQuery){
                $join->on('users.id', '=', 'calligraphies.user_id')
                     ->where($prefixQuery);
            })
            ->select($this->modelColumn)
            ->where('users.name', 'like', '%'.$query.'%')
            ->orWhere('calligraphies.title', 'like', '%'.$query.'%')
            ->with(['user', 'likes'])
            ->orderBy($quickQueryType, 'DESC')
            ->paginate($pageSize);
    }

    public function checkPrefixQuery($prefixQueryState)
    {
        return $prefixQueryState ? $this->prefixQuery : [];
    }
}

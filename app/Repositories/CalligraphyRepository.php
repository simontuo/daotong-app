<?php
namespace App\Repositories;

use App\Models\Calligraphy;

class CalligraphyRepository
{
    protected $quickQueryType = [
        'created_at', 'reads_count', 'comments_count', 'likes_count'
    ];

    public function create(array $attributes)
    {
        return Calligraphy::create($attributes);
    }

    public function index()
    {
        return Calligraphy::with(['user', 'likes'])->latest('created_at')->paginate(30);
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

    public function search($query, $quickQuery = null)
    {
        $quickQueryType = is_null($quickQuery) ? 'created_at' : array_get($this->quickQueryType, $quickQuery, 'created_at');

        return Calligraphy::join('users', 'users.id', '=', 'calligraphies.user_id')
                ->select('calligraphies.id', 'calligraphies.user_id', 'calligraphies.title', 'calligraphies.images', 'calligraphies.bio', 'calligraphies.created_at', 'calligraphies.comments_count', 'calligraphies.reads_count')
                ->where('users.name', 'like', '%'.$query.'%')
                ->orWhere('calligraphies.title', 'like', '%'.$query.'%')
                ->with(['user', 'likes'])
                ->orderBy($quickQueryType, 'DESC')
                ->paginate(30);
    }
}

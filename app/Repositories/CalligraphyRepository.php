<?php
namespace App\Repositories;

use App\Models\Calligraphy;

class CalligraphyRepository
{
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
}

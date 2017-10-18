<?php
namespace App\Repositories;

use App\Models\Calligraphy;

class CalligraphyRepository
{
    /**
     * [create 新增书法]
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function create(array $attributes)
    {
        return Calligraphy::create($attributes);
    }

    /**
     * [index 获取书法]
     * @return [type] [description]
     */
    public function index()
    {
        return Calligraphy::with(['user', 'likes'])->latest('created_at')->paginate(30);
    }

    /**
     * [byId 根据ID获取书法]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function byId($id)
    {
        return Calligraphy::findOrFail($id);
    }

    /**
     * [getRankingList 获取阅读量排行数据]
     * @return [type] [description]
     */
    public function getRankingList()
    {
        return Calligraphy::select('id', 'user_id', 'title', 'reads_count')->orderBy('reads_count', 'DESC')->with('user')->paginate(5);
    }
}

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
        return Calligraphy::with('user')->get();
    }
}

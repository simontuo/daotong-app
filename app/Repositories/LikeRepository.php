<?php
namespace App\Repositories;

use App\Models\Like;

class LikeRepository
{
    /**
     * [getTypeLikeByid 根据type、ID获取likes]
     * @method getTypeLikeByid
     * @param  [type]          $type [description]
     * @param  [type]          $id   [description]
     * @return [type]                [description]
     * @auth   simontuo
     */
    public function getTypeLikeById($type, $id)
    {
        return app('App\Models\\'.$type)->findOrfail($id)->likes()->with('user')->get();
    }

    public function getTypeById($type, $id)
    {
        return app('App\Models\\'.$type)->findOrfail($id);
    }

    public function create(array $attributes)
    {
        return Like::create($attributes);
    }
}

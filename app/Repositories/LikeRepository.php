<?php
namespace App\Repositories;


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
    public function getTypeLikeByid($type, $id)
    {
        return app('App\Models\\'.$type)->findOrfail($id)->likes()->with('user')->get();
    }
}

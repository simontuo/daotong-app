<?php
namespace App\Repositories;

use App\Models\Like;

class LikeRepository
{
    public function getTypeLikeById($type, $id)
    {
        return app('App\Models\\'.$type)->findOrfail($id)->likes()->where('type', 0)->with('user')->get();
    }

    public function getTypeById($type, $id)
    {
        return app('App\Models\\'.$type)->findOrfail($id);
    }

    public function create(array $attributes)
    {
        return Like::create($attributes);
    }

    public function getAllLikesBy($likeableType)
    {
        return Like::where('likeable_type', $likeableType)->count();
    }
}

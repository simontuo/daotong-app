<?php
namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    /**
     * [getCommentsByIdAndType 根据类型ID获评论]
     * @method getCommentsByIdAndType
     * @param  [type]                 $id   [description]
     * @param  [type]                 $type [description]
     * @return [type]                       [description]
     * @auth   simontuo
     */
    public function getCommentsByIdAndType($id, $type)
    {
        return app('App\Models\\'.$type)->findOrFail($id)->comments()->with(['user', 'parent'])->get();
    }

    /**
     * [create 新增评论]
     * @method create
     * @param  array    $attributes [description]
     * @return [type]               [description]
     * @auth   simontuo
     */
    public function create(array $attributes)
    {
        return Comment::create($attributes);
    }

    public function getAllCommnetBy($commentableType)
    {
        return Comment::where('commentable_type', 'App\Models\\'.$commentableType)->count();
    }
}

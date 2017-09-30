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
        return $this->addCreatedTime(app('App\Models\\'.$type)->findOrFail($id)->comments()->with(['user', 'parent'])->get());
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

    /**
     * [addCreatedTime 新增距离时间]
     * @method addCreatedTime
     * @param  [type]         $comments [description]
     * @auth   simontuo
     */
    public function addCreatedTime($comments)
    {
        return collect($comments)->map(function ($comment) {
            $comment->created_time = $comment->created_at->diffForHumans();
            return $comment;
        });
    }
}

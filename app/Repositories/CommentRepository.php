<?php
namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    protected $quickQueryType = [

    ];

    protected $prefixQuery = [
        'comments.is_hidden' => 'F'
    ];

    public function byId($id)
    {
        return Comment::findOrFail($id);
    }

    public function index($pageSize)
    {
        return Comment::with('user')->latest('created_at')->paginate($pageSize);
    }

    public function getCommentsByIdAndType($id, $type)
    {
        $prefixQuery = $this->prefixQuery;

        return app('App\Models\\'.$type)->findOrFail($id)->comments()->where($this->prefixQuery)->with(['user', 'parent'])->get();
    }

    public function create(array $attributes)
    {
        return Comment::create($attributes);
    }

    public function getAllCommnetBy($commentableType)
    {
        return Comment::where('commentable_type', 'App\Models\\'.$commentableType)->count();
    }

    public function search($query, $quickQuery = null, $pageSize)
    {
        $quickQueryType = is_null($quickQuery) ? 'created_at' : array_get($this->quickQueryType, $quickQuery, 'created_at');

        return Comment::join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.id', 'comments.user_id', 'comments.bio', 'comments.created_at')
            ->where('users.name', 'like', '%'.$query.'%')
            ->orWhere('comments.bio', 'like', '%'.$query.'%')
            ->with('user')
            ->orderBy($quickQueryType, 'DESC')
            ->paginate($pageSize);
    }

    public function getModelObject($id, $type)
    {
        return app('App\Models\\'.$type)->findOrFail($id);
    }

    public function closeComment($model)
    {
        return $model->close_comment === 'T';
    }

    public function getCommentsByUser($id)
    {
        return Comment::where($prefixQuery)->where('user_id', $id)->get();
    }
}

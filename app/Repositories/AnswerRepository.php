<?php
namespace App\Repositories;

use App\Models\Answer;

class AnswerRepository
{
    protected $quickQueryType = [
        'created_at',  'comments_count', 'votes_count'
    ];

    protected $prefixQuery = [
        'answers.is_hidden' => 'F'
    ];

    protected $modelColumn = [
        'answers.id', 'answers.user_id', 'answers.question_id', 'answers.created_at', 'answers.comments_count', 'answers.votes_count', 'answers.close_comment', 'answers.is_hidden', 'answers.markdown_bio', 'answers.bio'
    ];

    public function byId(srting $id)
    {
        return Answer::findOrFail($id);
    }

    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }

    public function search($query, $quickQuery = null, $pageSize, $prefixQueryState = false)
    {
        $quickQueryType = is_null($quickQuery) ? 'created_at' : array_get($this->quickQueryType, $quickQuery, 'created_at');

        $prefixQuery = $this->checkPrefixQuery($prefixQueryState);

        return Answer::join('users', function ($join) use ($prefixQuery){
                $join->on('users.id', '=', 'answers.user_id')
                     ->where($prefixQuery);
            })
            ->select($this->modelColumn)
            ->where('users.name', 'like', '%'.$query.'%')
            ->orWhere('answers.markdown_bio', 'like', '%'.$query.'%')
            ->with(['user'])
            ->orderBy($quickQueryType, 'DESC')
            ->paginate($pageSize);
    }

    public function checkPrefixQuery($prefixQueryState)
    {
        return $prefixQueryState ? $this->prefixQuery : [];
    }
}

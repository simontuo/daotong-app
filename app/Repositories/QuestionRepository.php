<?php
namespace App\Repositories;

use App\Models\Question;

class QuestionRepository
{
    protected $quickQueryType = [
        'created_at', 'followers_count', 'comments_count', 'answers_count'
    ];

    protected $prefixQuery = [
        'questions.is_hidden' => 'F'
    ];

    protected $modelColumn = [
        'questions.id', 'questions.user_id', 'questions.title', 'questions.created_at', 'questions.comments_count', 'questions.answers_count', 'questions.followers_count', 'questions.close_comment', 'questions.is_hidden'
    ];

    public function index()
    {
        return Question::with(['user', 'topics', 'answers'])->paginate('30');
    }

    public function create(array $attributes)
    {
        return Question::create($attributes);
    }

    public function byId(string $id)
    {
        return Question::with(['topics'])->findOrFail($id);
    }

    public function search($query, $quickQuery = null, $pageSize, $prefixQueryState = false)
    {
        $quickQueryType = is_null($quickQuery) ? 'created_at' : array_get($this->quickQueryType, $quickQuery, 'created_at');

        $prefixQuery = $this->checkPrefixQuery($prefixQueryState);

        return Question::join('users', function ($join) use ($prefixQuery){
                $join->on('users.id', '=', 'questions.user_id')
                     ->where($prefixQuery);
            })
            ->select($this->modelColumn)
            ->where('users.name', 'like', '%'.$query.'%')
            ->orWhere('questions.title', 'like', '%'.$query.'%')
            ->with(['user', 'answers', 'topics'])
            ->orderBy($quickQueryType, 'DESC')
            ->paginate($pageSize);
    }

    public function checkPrefixQuery($prefixQueryState)
    {
        return $prefixQueryState ? $this->prefixQuery : [];
    }
}

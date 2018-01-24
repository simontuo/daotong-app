<?php
namespace App\Repositories;

use App\Models\Question;

class QuestionRepository
{
    public function index()
    {
        return Question::with(['user', 'topics'])->paginate('30');
    }

    public function create(array $attributes)
    {
        return Question::create($attributes);
    }

    public function byId(string $id)
    {
        return Question::with(['topics'])->findOrFail($id);
    }
}

<?php
namespace App\Repositories;

use App\Models\Answer;

class AnswerRepository
{
    public function byId(srting $id)
    {
        return Answer::findOrFail($id);
    }
    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }
}

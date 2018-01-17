<?php
namespace App\Repositories;

use App\Models\Answer;

class AnswerRepository
{
    public function byId(srting $id)
    {
        return Answer::findOrFail($id);
    }
}

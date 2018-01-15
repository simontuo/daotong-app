<?php
namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class QuestionCollection extends Collection
{
    public function addCreatedTime()
    {
        $this->each(function($question) {
            $question->addCreatedTime();
        });
    }

    public function CombinationField()
    {
        $this->each(function($question) {
            $question->CombinationField();
        });
    }
}

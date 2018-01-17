<?php
namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class AnswerCollection extends Collection
{
    public function addCreatedTime()
    {
        $this->each(function($answer) {
            $answer->addCreatedTime();
        });
    }

    public function CombinationField()
    {
        $this->each(function($answer) {
            $answer->CombinationField();
        });
    }
}

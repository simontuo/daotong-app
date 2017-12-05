<?php
namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class CommentCollection extends Collection
{
    public function addCreatedTime()
    {
        $this->each(function($comment) {
            $comment->addCreatedTime();
        });
    }

    public function CombinationField()
    {
        $this->each(function($comment) {
            $comment->CombinationField();
        });
    }
}

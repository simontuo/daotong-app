<?php
namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class CalligraphyCollection extends Collection
{
    public function addCreatedTime()
    {
        $this->each(function($article) {
            $article->addCreatedTime();
        });
    }
}

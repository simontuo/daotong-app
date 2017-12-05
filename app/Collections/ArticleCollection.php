<?php
namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class ArticleCollection extends Collection
{
    public function addCreatedTime()
    {
        $this->each(function($article) {
            $article->addCreatedTime();
        });
    }

    public function arrayDot()
    {
        $this->each(function($article) {
            $article->arrayDot();
        });
    }
}

<?php
namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class CalligraphyCollection extends Collection
{
    public function addCreatedTime()
    {
        $this->each(function($calligraphy) {
            $calligraphy->addCreatedTime();
        });
    }

    public function CombinationField()
    {
        $this->each(function($calligraphy) {
            $calligraphy->CombinationField();
        });
    }
}

<?php
namespace App\Models\Traits;

trait AddCreatedTime
{
    public function addCreatedTime()
    {
        $this->created_time = $this->created_at->diffForHumans();
    }

    public function CombinationField()
    {
        foreach ($this->combinationField as $key => $value) {
            $group = array_first(explode('.', $value));

            $filed = array_last(explode('.', $value));

            $this->$key = $this->$group->$filed;
        }
    }
}

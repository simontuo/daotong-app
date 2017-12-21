<?php
namespace App\Models\Traits;

trait PublicOperation
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

    public function closeComment()
    {
        return $this->close_comment === 'T';
    }

    public function isHidden()
    {
        return $this->is_hidden === 'T';
    }
}

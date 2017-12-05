<?php
namespace App\Models\Traits;

trait AddCreatedTime
{
    public function addCreatedTime()
    {
        $this->created_time = $this->created_at->diffForHumans();
    }

    public function arrayDot()
    {
        $this->user_name = $this->user->name;
    }
}

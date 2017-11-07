<?php
namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class MessageCollection extends Collection
{
    public function markAsRead()
    {
        $this->each(function($message) {
            if ($message->to_user_id == user('api')->id) {
                $message->markAsRead();
            }
        });
    }

    public function addCreatedTime()
    {
        $this->each(function($message) {
            $message->addCreatedTime();
        });
    }
}

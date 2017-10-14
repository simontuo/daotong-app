<?php
namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    public function create(array $attributes)
    {
        return Message::create($attributes);
    }
}

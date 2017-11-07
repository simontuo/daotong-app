<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Collections\MessageCollection;

class Message extends Model
{
    use Traits\AddCreatedTime;

    protected $fillable = [
        'from_user_id', 'to_user_id', 'bio', 'dialog_id', 'read_at', 'has_read'
    ];

    public function newCollection(array $models = [])
    {
        return new MessageCollection($models);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            $this->forceFill([
                'has_read' => 'T',
                'read_at'  => $this->freshTimestamp(),
            ])->save();
        }
    }

    public function read()
    {
        return $this->has_read === 'T';
    }

    public function unread()
    {
        return $this->has_read === 'F';
    }

    public function shouldAddUnreadClass()
    {
        if (user()->id === $this->from_user_id) {
            return false;
        }
        return $this->unread();
    }
}

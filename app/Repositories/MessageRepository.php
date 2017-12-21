<?php
namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    protected $quickQueryType = [

    ];

    protected $modelColumn = [
        'messages.id', 'messages.from_user_id', 'messages.bio', 'messages.created_at', 'messages.has_read', 'is_hidden'
    ];

    public function byId($id)
    {
        return Message::findOrFail($id);
    }

    public function index($pageSize)
    {
        return Message::with('fromUser')->latest('created_at')->paginate($pageSize);
    }

    public function search($query, $quickQuery = null, $pageSize)
    {
        $quickQueryType = is_null($quickQuery) ? 'created_at' : array_get($this->quickQueryType, $quickType, 'created_at');

        return Message::join('users', 'users.id', '=', 'messages.from_user_id')
            ->select($this->modelColumn)
            ->where('users.name', 'like', '%'.$query.'%')
            ->orWhere('messages.bio', 'like', '%'.$query.'%')
            ->with('fromUser')
            ->orderBy($quickQueryType, 'DESC')
            ->paginate($pageSize);
    }

    public function create(array $attributes)
    {
        return Message::create($attributes);
    }

    public function getUserMessages($id)
    {
        return Message::where('to_user_id', $id)
            ->orWhere('from_user_id', $id)
            ->with(['fromUser', 'toUser'])
            ->latest()
            ->get();
    }

    public function getUserMessageDialog($id, $dialog)
    {
        return Message::where('dialog_id', $dialog)->with(['fromUser', 'toUser'])->get();
    }

    public function isHadDialog($fromUserId, $toUserId)
    {
        return !! Message::where('from_user_id', $fromUserId)
            ->where('to_user_id', $toUserId)
            ->orWhere(function($query) use($fromUserId, $toUserId) {
                $query->where('from_user_id', $toUserId)->where('to_user_id', $fromUserId);
            })->count();
    }

    public function getHadDialog($fromUserId, $toUserId)
    {
        return Message::where('from_user_id', $fromUserId)
            ->where('to_user_id', $toUserId)
            ->orWhere(function($query) use($fromUserId, $toUserId) {
                $query->where('from_user_id', $toUserId)->where('to_user_id', $fromUserId);
            })->first();
    }

    public function getFirstMessageByDialogId($dialogId)
    {
        return Message::where('dialog_id', $dialogId)->first();
    }
}

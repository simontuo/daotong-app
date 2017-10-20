<?php
namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    /**
     * [create 新增信息]
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function create(array $attributes)
    {
        return Message::create($attributes);
    }

    /**
     * [getToUserMessages 获取用户收到的信息]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
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
        return Message::where('to_user_id', $id)->where('dialog_id', $dialog)->with(['fromUser', 'toUser'])->get();
    }

    /**
     * [addCreatedTime 添加距离时间]
     * @param [type] $messages [description]
     */
    public function addCreatedTime($messages)
    {
        return collect($messages)->map(function($message) {
            $message->created_time = $message->created_at->diffForHumans();
            return $message;
        });
    }
}

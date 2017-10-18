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
    public function getToUserMessages($id)
    {
        return Message::where('to_user_id', $id)->with(['fromUser'])->orderBy('created_at', 'DESC')->get();
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

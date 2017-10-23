<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MessageRepository;
use App\Repositories\UserRepository;

class MessagesController extends Controller
{
    protected $message;

    protected $user;

    public function __construct(MessageRepository $message, UserRepository $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * [index description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function index($id)
    {
        $messages = $this->message->addCreatedTime($this->message->getUserMessages($id));

        return response()->json(['messages' => $messages->groupBy('dialog_id')]);
    }

    /**
     * [store description]
     * @return [type] [description]
     */
    public function store()
    {
        if (user('api')->isMyself($this->user->byId(request('user')))) {
            return response()->json(['status' => 'info', 'message' => '不能发私信给自己！']);
        }

        $dialogId = $this->message->isHadDialog(user('api')->id, request('user')) ? $this->message->getHadDialog(user('api')->id, request('user'))->dialog_id  : user('api')->id.request('user');

        $data = [
            'to_user_id'   => request('user'),
            'from_user_id' => user('api')->id,
            'bio'          => request('bio'),
            'dialog_id'    => $dialogId,
        ];

        $message = $this->message->create($data);

        if ($message) {
            return response()->json(['status' => true, 'message' => '发送成功！']);
        }

        return response()->json(['status' => false, 'message' => '发送失败！']);
    }

    /**
     * [userMessageDialog description]
     * @param  [type] $id     [description]
     * @param  [type] $dialog [description]
     * @return [type]         [description]
     */
    public function userMessageDialog($id, $dialog)
    {
        $messages = $this->message->addCreatedTime($this->message->getUserMessageDialog($id, $dialog));

        return response()->json(['messages' => $messages]);
    }

    /**
     * [reply description]
     * @return [type] [description]
     */
    public function reply()
    {
        $message = $this->message->getFirstMessageByDialogId(request('dialog'));

        $toUserId = $message->from_user_id === user('api')->id ? $message->to_user_id : $message->from_user_id;

        $data = [
            'to_user_id'   => $toUserId,
            'from_user_id' => user('api')->id,
            'bio'          => request('bio'),
            'dialog_id'    => request('dialog'),
        ];

        $message = $this->message->create($data);
        $message->from_user = $message->fromUser()->first();
        $message->created_time = $message->created_at->diffForHumans();

        if ($message) {
            return response()->json(['status' => true, 'message' => '发送成功！', 'data' => $message]);
        }

        return response()->json(['status' => false, 'message' => '发送失败！']);
    }
}

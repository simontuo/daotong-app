<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\MessageRepository;
use App\Notifications\NewMessageNotificaiton;

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
        $messages = $this->message->getUserMessages($id);

        $messages->addCreatedTime();

        return response()->json(['messages' => $messages->groupBy('dialog_id')]);
    }

    /**
     * [store description]
     * @return [type] [description]
     */
    public function store()
    {
        $toUser = $this->user->byId(request('user'));

        if (user('api')->isMyself($toUser)) {
            return response()->json(['status' => 'info', 'message' => '不能发私信给自己！']);
        }

        $dialogId = $this->message->isHadDialog(user('api')->id, $toUser->id) ? $this->message->getHadDialog(user('api')->id, $toUser->id)->dialog_id  : user('api')->id.$toUser->id;


        $data = [
            'to_user_id'   => $toUser->id,
            'from_user_id' => user('api')->id,
            'bio'          => request('bio'),
            'dialog_id'    => $dialogId,
        ];

        $message = $this->message->create($data);

        $toUser->notify(new NewMessageNotificaiton());

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
        $messages = $this->message->getUserMessageDialog($id, $dialog);

        $messages->markAsRead();

        $messages->addCreatedTime();

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

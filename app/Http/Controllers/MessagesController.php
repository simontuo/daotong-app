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

    public function index($id)
    {
        $user = $this->user->byId($id);

        $messages = $user->messages()->with('fromUser')->get();

        return response()->json(['messages' => $messages]);
    }

    public function store()
    {
        if (user('api')->isMyself($this->user->byId(request('user')))) {
            return response()->json(['status' => 'info', 'message' => '不能发私信给自己！']);
        }

        $data = [
            'to_user_id' => request('user'),
            'from_user_id' => user('api')->id,
            'bio' => request('bio'),
            'dialog_id' => user('api')->id.request('user'),
        ];

        $message = $this->message->create($data);

        if ($message) {
            return response()->json(['status' => true, 'message' => '发送成功！']);
        }

        return response()->json(['status' => false, 'message' => '发送失败！']);
    }
}

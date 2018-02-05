<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\NotificationsRepository;

class NotificationsController extends Controller
{
    protected $user;

    protected $notification;

    public function __construct(UserRepository $user, NotificationsRepository $notification)
    {
        $this->user = $user;

        $this->notification = $notification;
    }

    public function index($id)
    {
        $user = $this->user->byId($id);

        $notifications = $this->notification->addComponentType($user->notifications);
        
        $notifications = $this->notification->addCreatedTime($user->notifications);

        return response()->json(['notifications' => $notifications]);
    }

    public function noRead()
    {
        $notifications = user('api')->notifications()->whereNull('read_at')->get();

        return response()->json(['notifications' => $notifications]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\NotificationsRepository;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{
    protected $user;

    protected $notification;

    public function __construct(UserRepository $user, NotificationsRepository $notification)
    {
        $this->user = $user;

        $this->notification = $notification;
    }

    public function index()
    {
        $notifications = user('api')->notifications;

        $notifications = $this->notification->addComponentType($notifications);

        $notifications = $this->notification->addCreatedTime($notifications);

        return response()->json(['notifications' => $notifications]);
    }

    public function noRead()
    {
        $notifications = user('api')->notifications()->whereNull('read_at')->get();

        $notifications = $this->notification->addComponentType($notifications);

        $notifications = $this->notification->addCreatedTime($notifications);

        return response()->json(['notifications' => $notifications]);
    }

    public function hasRead()
    {
        $notifications = user('api')->notifications()->whereNotNull('read_at')->get();

        $notifications = $this->notification->addComponentType($notifications);

        $notifications = $this->notification->addCreatedTime($notifications);

        return response()->json(['notifications' => $notifications]);
    }

    public function read($id, DatabaseNotification $notification)
    {
        $notification = user('api')->notifications()->where('id', $id)->get();

        $notification->read_at = now();

        $notification->markAsRead();

        return response()->json(['status' => true]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Notifications\NewUserFollowNotification;

class FollowersController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index($id)
    {
        $user = $this->user->byId($id);
        $followers = $user->followersUser()->pluck('follower_id')->toArray();

        if (in_array(user('api')->id, $followers)) {
            return response()->json(['followed' => true]);
        }

        return response()->json(['followed' => false]);
    }

    public function follow()
    {
        $userToFollow = $this->user->byId(request('user'));

        if (user('api')->isMyself($userToFollow)) {
            return response()->json(['status' => 'info', 'message' => '亲，你不能关注自己哦！']);
        }

        $followed = user('api')->followThisUser($userToFollow->id);

        if (count($followed['attached']) > 0) {

            $userToFollow->notify(new NewUserFollowNotification());

            $userToFollow->increment('followers_count');

            user('api')->actionLog(user('api'), user('api')->name.'关注了'.$userToFollow->name);

            return response()->json(['followed' => true]);
        }

        $userToFollow->decrement('followers_count');

        user('api')->actionLog(user('api'), user('api')->name.'取消关注了'.$userToFollow->name);

        return response()->json(['followed' => false]);
    }
}

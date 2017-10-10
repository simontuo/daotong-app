<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Notifications\NewUserFollowNotification;

class FollowerController extends Controller
{
    /**
     * [protected description]
     * @var [type]
     */
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * [index 判断是否已关注]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function index($id)
    {
        $user = $this->user->byId($id);
        $followers = $user->followersUser()->pluck('follower_id')->toArray();

        if (in_array(user('api')->id, $followers)) {
            return response()->json(['followed' => true]);
        }

        return response()->json(['followed' => false]);
    }

    /**
     * [follow 关注/取消关注]
     * @return [type] [description]
     */
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

            return response()->json(['followed' => true]);
        }

        $userToFollow->decrement('followers_count');

        return response()->json(['followed' => false]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Notifications\BanUserLoginNotification;
use App\Notifications\BanUserCommentNotification;
use Storage;

class UsersController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $pageSize = request('pageSize') ? request('pageSize') : config('page.user');

        $users = $this->user->index($pageSize);

        return response()->json(['users' => $users]);
    }

    public function search()
    {
        $pageSize = request('pageSize') ? request('pageSize') : config('page.user');

        $users = $this->user->search(request('query'), request('quickQuery'), $pageSize);

        return response()->json(['users' => $users]);
    }

    public function banComment($id)
    {
        $user = $this->user->byId($id);

        $state = $user->isBanComment() ? 'F' : 'T';

        $user->is_ban_comment = $state;

        $user->save();

        $user->notify(new BanUserCommentNotification($user));

        return response()->json(['state' => $state]);
    }

    public function banLogin($id)
    {
        $user = $this->user->byId($id);

        $state = $user->isBanLogin() ? 'F' : 'T';

        $user->is_ban_login = $state;

        $user->save();

        $user->notify(new BanUserLoginNotification($user));

        return response()->json(['state' => $state]);
    }

    public function getLog()
    {
        return \File::get(storage_path('logs\loginLog.log'));
    }
}

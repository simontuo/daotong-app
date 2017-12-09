<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

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

        $state = $user->isBanComment() ? 0 : 1;

        $user->is_ban_comment = $state;

        $user->save();

        return response()->json(['state' => $state]);
    }

    public function banLogin($id)
    {
        $user = $this->user->byId($id);

        $state = $user->isBanLogin() ? 0 : 1;

        $user->is_ban_login = $state;

        $user->save();

        return response()->json(['state' => $state]);
    }
}

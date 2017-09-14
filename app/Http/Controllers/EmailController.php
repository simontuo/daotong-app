<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Auth;

class EmailController extends Controller
{

    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * [verify 邮箱验证]
     * @method verify
     * @param  [type]   $token [description]
     * @return [type]          [description]
     * @auth   simontuo
     */
    public function verify($token)
    {
        $user = $this->user->byConfirmationToken($token);

        if (is_null($user)) {
            alert()->error('请重申请重新认证', '邮箱验证失败！')->persistent('Close');

            return redirect('/');
        }

        $user->is_active = 1;
        $user->confirmation_token = str_random(40);
        $user->save();

        Auth::login($user);

        alert()->success('邮箱验证成功！')->persistent('ok');

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * [login 重构登录方法，增加登录flash提示（原方法在AuthenticatesUsers这个trait）]
     * @method login
     * @param  Request  $request [description]
     * @return [type]            [description]
     * @auth   simontuo
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            alert()->success('欢迎回来'.config('app.name'), 'Welcome Black!')->autoclose(2000);

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * [attemptLogin 重构验证方法（原方法在AuthenticatesUsers这个trait）]
     * @method attemptLogin
     * @param  Request      $request [description]
     * @return [type]                [description]
     * @auth   simontuo
     */
    protected function attemptLogin(Request $request)
    {
        // 增加激活验证条件
        $credentials = array_merge($this->credentials($request), ['is_active' => 1]);

        return $this->guard()->attempt(
            $credentials, $request->has('remember')
        );
    }

    /**
     * [logout 重构登出方法，增加登出flash提示（原方法在AuthenticatesUsers这个trait）]
     * @method logout
     * @param  Request  $request [description]
     * @return [type]            [description]
     * @auth   simontuo
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        alert()->success('已成功退出.', 'Good bye!');

        return redirect('/');
    }
}

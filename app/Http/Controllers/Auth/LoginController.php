<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;

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
     * [protected 额外的凭证字段]
     * @var [type]
     */
    protected $additionalCredentials = [
        'is_active'    => 1,
        'is_ban_login' => 'F'
    ];

    protected $type = [
        'email', 'phone'
    ];

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

            user()->loginLog('登入');

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
        $credentials = array_merge($this->credentials($request), $this->additionalCredentials);

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
        user()->loginLog('登出');

        $this->guard()->logout();

        $request->session()->invalidate();

        alert()->success('已成功退出.', 'Good bye!');

        return redirect('/');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        // if (in_array(request()->type, $this->type)) {
        //     return request()->type;
        // }

        return filter_var(request()->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [
            $this->username() => $request->username,
            'password'        => $request->password,
        ];
    }
}

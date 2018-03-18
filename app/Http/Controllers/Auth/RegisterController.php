<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Mailer\UserMailer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Cache;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'             => 'required|string|max:255',
            'phone'            => 'required|numeric|size:11|unique:users',
            'verificationCode' => 'required|numeric|size:6',
            'email'            => 'required|string|email|max:255|unique:users',
            'password'         => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name'               => $data['name'],
            'email'              => $data['email'],
            'phone'              => $data['phone'],
            'password'           => bcrypt($data['password']),
            'avatar'             => gravatar($data['name']),
            'confirmation_token' => str_random(40),
            'settings'           => ['city' => ''],
            'api_token'          => str_random(60),
            'gender'             => 'male',
        ]);

        $this->sendVerifyEmailTo($user);

        alert()->success('请尽快登录邮箱进行认证', '注册成功！')->persistent('ok');

        return $user;
    }

    /**
     * [sendVerifyEmailTo 发送验证邮件]
     * @method sendVerifyEmailTo
     * @param  [type]            $user [description]
     * @return [type]                  [description]
     * @auth   simontuo
     */
    public function sendVerifyEmailTo($user)
    {
        (new UserMailer())->regusterVerify($user);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        if (!$this->verifyRegisterCode($request->phone, $request->verificationCode)) {
            alert()->error('请重新输入', '验证码验证失败！')->persistent('error');
            return back();
        }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function verifyRegisterCode($phone, $verificationCode)
    {
        return Cache::get($phone) == $verificationCode;
    }
}

<?php
namespace App\Mailer;

use App\Mailer\Mailer;
use App\Models\User;

class UserMailer extends Mailer
{
    /**
     * [regusterVerify 注册验证邮箱邮件]
     * @method regusterVerify
     * @param  User           $user [description]
     * @return [type]               [description]
     * @auth   simontuo
     */
    public function regusterVerify(User $user)
    {
        $data = [
            'name' => $user->name,
            'url' => route('email.verify', ['token' => $user->confirmation_token])
        ];

        $this->sendTo('daotong_register_verify', $user->email, $data);
    }

    /**
     * [passwordReset 重置密码邮件]
     * @method passwordReset
     * @param  [type]        $email [description]
     * @param  [type]        $token [description]
     * @auth   simontuo
     */
    public function passwordReset($email, $token)
    {
        $data = [
            'url' => config('app.url').route('password.reset', $token, false)
        ];

        $this->sendTo('daotong_password_reset', $email, $data);
    }

}

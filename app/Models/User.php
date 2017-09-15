<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mailer\UserMailer;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'confirmation_token', 'api_token', 'settings', 'gender', 'phone', 'wechat'
    ];

    /**
     * [protected casts]
     * @var [type]
     */
    protected $casts = [
        'settings' => 'array'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * [protected 允许编辑的字段]
     * @var [type]
     */
    protected $allowed = ['gender', 'name', 'wechat', 'phone', 'settings'];

    /**
     * [protected 允许编辑的settings字段]
     * @var [type]
     */
    protected $allowedSettings = ['city', 'bio'];

    public function owns(Model $model)
    {
        return $this->id == $model->user_id;
    }

    /**
     * [merge 合并允许更新字段]
     * @method merge
     * @param  array    $attributes [description]
     * @return [type]               [description]
     * @auth   simontuo
     */
    public function merge(array $attributes)
    {
        $merge = array_merge($this->only($this->allowed), array_only($attributes, $this->allowed));

        $merge['settings'] = array_merge($merge['settings'], array_only($attributes, $this->allowedSettings));

        return $merge;
    }

    /**
     * [sendPasswordResetNotification 重构重置密码邮件发送（原方法在PasswordBroker）]
     * @method sendPasswordResetNotification
     * @param  [type]                        $token [description]
     * @auth   simontuo
     */
    public function sendPasswordResetNotification($token)
    {
        (new UserMailer())->passwordReset($this->email, $token);
    }
}
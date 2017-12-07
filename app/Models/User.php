<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mailer\UserMailer;
use App\Models\Message;
use App\Models\Comment;
use App\Models\Calligraphy;

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
    protected $allowedSettings = ['city', 'bio', 'wechatCode', 'alipayCode'];

    /**
     * [isMyself 登录用户是否资源所有者]
     * @method isMyself
     * @param  User     $user [description]
     * @return boolean        [description]
     * @auth   simontuo
     */
    public function isMyself(User $user)
    {
        return $this->id == $user->id;
    }

    /**
     * [owns 登录用户是否资源所有者]
     * @method owns
     * @param  Model    $model [description]
     * @return [type]          [description]
     * @auth   simontuo
     */
    public function owns(Model $model)
    {
        return $this->id == $model->user_id;
    }

    public function number()
    {
        return $this->where('id', '<=', $this->id)->count();
    }

    public function isBanComment()
    {
        return !! $this->is_ban_comment;
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

    /**
     * [followers 用户的关注用户]
     * @return [type] [description]
     */
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'follower_id', 'followed_id')->withTimestamps();
    }

    /**
     * [followersUser 用户的被关注用户]
     * @return [type] [description]
     */
    public function followersUser()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'follower_id')->withTimestamps();
    }

    /**
     * [followThisUser 关注用户]
     * @param  [type]  $user [description]
     * @return boolean       [description]
     */
    public function followThisUser($user)
    {
        return $this->followers()->toggle($user);
    }

    /**
     * [messages 用户收到的信息]
     * @return [type] [description]
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'to_user_id');
    }

    /**
     * [comments description]
     * @return [type] [description]
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * [calligraphys description]
     * @return [type] [description]
     */
    public function calligraphys()
    {
        return $this->hasMany(Calligraphy::class);
    }
}

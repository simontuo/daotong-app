<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Calligraphy extends Model
{
    protected $fillable = [
        'user_id', 'title', 'bio', 'images'
    ];

    /**
     * [protected description]
     * @var [type]
     */
    protected $casts = [
        'images' => 'array'
    ];

    /**
     * [user 书法对应用户]
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * [likes 书法点赞多态关系]
     * @return [type] [description]
     */
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }

    /**
     * [comments 书法评论多态关系]
     * @return [type] [description]
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    /**
     * [has_liked 书法是否已点赞]
     * @return boolean [description]
     */
    public function has_liked()
    {
        return !! $this->likes()->where('user_id', user()->id)->count();
    }
}
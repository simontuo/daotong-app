<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Article extends Model
{
    use Traits\Parsedown;

    protected $fillable = [
        'user_id', 'title', 'cover', 'bio', 'markdown_bio',
    ];

    /**
     * [users 创建者关系]
     * @method users
     * @return [type]   [description]
     * @auth   simontuo
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * [authors 作者关系]
     * @method authors
     * @return [type]   [description]
     * @auth   simontuo
     */
    public function authors()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * [likes 文章点赞多态关联]
     * @return [type] [description]
     */
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }

    /**
     * [comments 文章评论多态关系]
     * @method comments
     * @return [type]   [description]
     * @auth   simontuo
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}

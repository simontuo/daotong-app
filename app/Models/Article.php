<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Collections\ArticleCollection;

class Article extends Model
{
    use Traits\Parsedown;
    use Traits\PublicOperation;
    use Traits\ActionLog;

    protected $fillable = [
        'user_id', 'title', 'cover', 'bio', 'markdown_bio', 'author_id'
    ];

    protected $combinationField = [
        'user_name'   => 'user.name',
        'user_avatar' => 'user.avatar'
    ];

    public function newCollection(array $models = [])
    {
        return new ArticleCollection($models);
    }

    /**
     * [users 创建者关系]
     * @method users
     * @return [type]   [description]
     * @auth   simontuo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * [authors 作者关系]
     * @method authors
     * @return [type]   [description]
     * @auth   simontuo
     */
    public function author()
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

    /**
     * [has_liked 文章是否已点赞]
     * @return boolean [description]
     */
    public function has_liked()
    {
        return !! $this->likes()->where('user_id', user()->id)->count();
    }

    /**
     * [topics description]
     * @return [type] [description]
     */
    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Collections\CommentCollection;

class Comment extends Model
{
    use Traits\PublicOperation;
    use Traits\ActionLog;

    protected $fillable = [
        'user_id', 'bio', 'commentable_id', 'commentable_type', 'parent_id'
    ];

    protected $combinationField = [
        'user_name' => 'user.name'
    ];

    public function newCollection(array $models = [])
    {
        return new CommentCollection($models);
    }

    /**
     * [user 用户关系]
     * @method user
     * @return [type]   [description]
     * @auth   simontuo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * [parent 父评论关系]
     * @method parent
     * @return [type]   [description]
     * @auth   simontuo
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    /**
     * [commentable 多太关系]
     * @method commentable
     * @return [type]      [description]
     * @auth   simontuo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function findModelAble()
    {
        $this->commentable;
    }
}

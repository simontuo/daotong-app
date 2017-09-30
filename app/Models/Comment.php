<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'bio', 'commentable_id', 'commentable_type', 'parent_id'
    ];

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
}

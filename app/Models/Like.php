<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Like extends Model
{
    protected $table = 'likes';

    protected $fillable = [
        'user_id', 'likeable_id', 'likeable_type', 'type'
    ];

    /**
     * [likeable 多态关联]
     * @return [type] [description]
     */
    public function likeable()
    {
        return $this->morphTo();
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
}

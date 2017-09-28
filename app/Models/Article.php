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

}

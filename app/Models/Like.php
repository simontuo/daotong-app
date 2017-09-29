<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Like extends Model
{
    protected $table = 'likes';

    protected $fillable = [
        'user_id', 'likeable_id', 'likeable_type'
    ];

    /**
     * [likeable 多态关联]
     * @return [type] [description]
     */
    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

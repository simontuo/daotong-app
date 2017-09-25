<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Traits\Parsedown;

    protected $fillable = [
        'user_id', 'title', 'cover', 'bio'
    ];

}

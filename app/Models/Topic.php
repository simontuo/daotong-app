<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Topic extends Model
{
    protected $fillable = [
        'name', 'bio'
    ];

    /**
     * [articles description]
     * @return [type] [description]
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class)->withTimestamps();
    }
}

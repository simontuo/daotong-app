<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Topic extends Model
{
    use Traits\ActionLog;

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

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }
}

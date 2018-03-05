<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\Calligraphy;

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

    public function calligraphys()
    {
        return $this->belongsToMany(Calligraphy::class)->withTimestamps();
    }
}

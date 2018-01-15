<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Collections\QuestionCollection;
use App\Models\User;
use App\Models\Topic;

class Question extends Model
{
    use Traits\PublicOperation;
    use Traits\ActionLog;

    protected $fillable = [
        'user_id', 'title', 'bio'
    ];

    public function newCollection(array $models = [])
    {
        return new QuestionCollection($models);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }
}

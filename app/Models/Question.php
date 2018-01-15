<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Topic;

class Question extends Model
{
    use Traits\PublicOperation;
    use Traits\ActionLog;

    protected $fillable = [
        'user_id', 'title', 'bio'
    ];

    public function user()
    {
        return belongsTo(User::class);
    }

    public function topics()
    {
        return belongsToMany(Topic::class)->withTimestamps();
    }
}

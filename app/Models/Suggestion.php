<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Collections\SuggestionCollection;

class Suggestion extends Model
{
    use Traits\PublicOperation;
    use Traits\ActionLog;

    protected $fillable = [
        'is_tourist', 'user_id', 'images', 'bio', 'markdown_bio'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    protected $combinationField = [
        'user_name'   => 'user.name',
        'user_avatar' => 'user.avatar'
    ];

    public function newCollection(array $models = [])
    {
        return new SuggestionCollection($models);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

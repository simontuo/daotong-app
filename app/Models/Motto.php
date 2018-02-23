<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Collections\MottoCollection;

class Motto extends Model
{
    use Traits\PublicOperation;
    use Traits\ActionLog;

    protected $fillable = [
        'user_id', 'bio'
    ];

    protected $combinationField = [
        'user_name'   => 'user.name',
        'user_avatar' => 'user.avatar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function newCollection(array $models = [])
    {
        return new MottoCollection($models);
    }
}

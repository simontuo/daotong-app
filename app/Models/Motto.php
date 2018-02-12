<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Motto extends Model
{
    protected $fillable = [
        'user_id', 'bio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

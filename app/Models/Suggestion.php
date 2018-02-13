<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $fillable = [
        'is_tourist', 'user_id', 'images', 'bio', 'markdown_bio'
    ];
}

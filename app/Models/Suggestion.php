<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}

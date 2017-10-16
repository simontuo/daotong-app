<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Calligraphy extends Model
{
    protected $fillable = [
        'user_id', 'title', 'bio', 'images'
    ];

    /**
     * [protected description]
     * @var [type]
     */
    protected $casts = [
        'images' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

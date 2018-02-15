<?php
namespace App\Repositories;

use App\Models\Suggestion;

class SuggestionRepository
{

    public function create(array $attributes)
    {
        return Suggestion::create($attributes);
    }
}

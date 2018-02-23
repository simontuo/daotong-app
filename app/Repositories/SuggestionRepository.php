<?php
namespace App\Repositories;

use App\Models\Suggestion;

class SuggestionRepository
{
    protected $modelColumn = [
        'suggestions.id', 'suggestions.user_id', 'suggestions.created_at', 'suggestions.markdown_bio', 'suggestions.bio'
    ];

    public function create(array $attributes)
    {
        return Suggestion::create($attributes);
    }

    public function search($query, $quickQuery = null, $pageSize, $prefixQueryState = false)
    {
        return Suggestion::select($this->modelColumn)
            ->Where('suggestions.markdown_bio', 'like', '%'.$query.'%')
            ->with(['user'])
            ->orderBy('created_at', 'DESC')
            ->paginate($pageSize);
    }
}

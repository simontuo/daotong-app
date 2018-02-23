<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SuggestionRepository;

class SuggestionsController extends Controller
{
    public function __construct(SuggestionRepository $suggestion)
    {
        return $this->suggestion = $suggestion;
    }

    public function adminSearch(Request $request)
    {
        $this->authorize('viewAdmin', user('api'));

        $pageSize = request('pageSize') ? request('pageSize') : config('page.suggestion');

        $suggestions = $this->suggestion->search($request->get('query'), $request->get('quickQuery'), $pageSize);

        $suggestions->addCreatedTime();

        $suggestions->CombinationField();

        return response()->json(['suggestions' => $suggestions]);
    }
}

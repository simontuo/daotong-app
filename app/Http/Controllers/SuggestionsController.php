<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSuggestionRequest;
use App\Repositories\SuggestionRepository;
use Auth;

class SuggestionsController extends Controller
{
    public function __construct(SuggestionRepository $suggestion)
    {
        return $this->suggestion = $suggestion;
    }

    public function store(StoreSuggestionRequest $request)
    {
        $data = [
            'user_id'      => Auth::check() ? Auth::id() : null,
            'is_tourist'   => Auth::check() ? 'F' : 'T',
            'images'        => $request->images,
            'bio'          => $request->bio,
            'markdown_bio' => $request->markdown_bio,
        ];

        $suggestion = $this->suggestion->create($data);

        alert()->success('提交建议成功！')->autoclose(2000);

        return redirect()->back();
    }

    public function show($id)
    {
        $suggestion = $this->suggestion->byId($id);

        return view('admins.suggestions.show', compact('suggestion'));
    }
}

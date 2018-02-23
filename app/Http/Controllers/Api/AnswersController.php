<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AnswerRepository;

class AnswersController extends Controller
{
    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    public function adminSearch(Request $request)
    {
        $this->authorize('viewAdmin', user('api'));

        $pageSize = request('pageSize') ? request('pageSize') : config('page.answer');

        $answers = $this->answer->search($request->get('query'), $request->get('quickQuery'), $pageSize);

        $answers->addCreatedTime();

        $answers->CombinationField();

        return response()->json(['answers' => $answers]);
    }
}

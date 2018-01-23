<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnswerRepository;
use App\Http\Requests\StoreAnswerRequest;

class AnswersController extends Controller
{
    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    public function store(StoreAnswerRequest $request)
    {
        dd($request->all());
    }
}

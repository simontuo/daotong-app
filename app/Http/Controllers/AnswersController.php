<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnswerRepository;
use App\Repositories\QuestionRepository;
use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;

class AnswersController extends Controller
{
    public function __construct(AnswerRepository $answer, QuestionRepository $question)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->answer   = $answer;
        $this->question = $question;
    }

    public function store(StoreAnswerRequest $request)
    {
        $data = [
            'user_id'      => user()->id,
            'question_id'  => $request->get('id'),
            'bio'          => $request->get('bio'),
            'markdown_bio' => $request->get('markdown_bio'),
        ];

        $answer = $this->answer->create($data);

        $question = $this->question->byId($request->get('id'));

        $question->increment('answers_count');

        $answer->actionLog(user(), '新增了答案');

        user()->increment('answers_count');

        alert()->success('新增了答案成功！')->autoclose(2000);

        return redirect()->route('questions.show', ['id' => $request->get('id')]);
    }
}

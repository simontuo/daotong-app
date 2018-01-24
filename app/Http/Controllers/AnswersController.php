<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnswerRepository;
use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;

class AnswersController extends Controller
{
    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
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

        $answer->actionLog(user(), '新增了答案');

        alert()->success('新增了答案成功！')->autoclose(2000);

        return redirect()->route('questions.show', ['id' => $request->get('id')]);
    }
}

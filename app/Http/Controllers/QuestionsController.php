<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionRequest;
use App\Repositories\TopicRepository;
use App\Repositories\QuestionRepository;

class QuestionsController extends Controller
{
    public function __construct(TopicRepository $topic, QuestionRepository $question)
    {
        $this->topic    = $topic;
        $this->question = $question;
    }

    public function index()
    {
        return view('questions.index');
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(StoreQuestionRequest $request)
    {
        $topics = $this->topic->normalizeTopic($request->get('topics'), 'questions_count');

        $data = [
            'user_id' => user()->id,
            'title'   => $request->get('title'),
            'bio'     => $request->get('bio')
        ];

        $question = $this->question->create($data);

        $question->topics()->attach($topics);

        $question->actionLog(user(), '新增了问题:'.$question->title);

        alert()->success('新增问题 '.$question->title.' 成功！')->autoclose(2000);

        return redirect()->route('questions.show', ['id' => $question->id]);
    }
}

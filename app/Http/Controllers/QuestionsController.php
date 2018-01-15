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
        $this->topic = $topic;
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
        $data = [

        ];

    }
}

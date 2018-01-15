<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\QuestionRepository;

class QuestionsController extends Controller
{
    public function __construct(QuestionRepository $question)
    {
        $this->question = $question;
    }

    public function index()
    {
        $questions = $this->question->index();

        $questions->addCreatedTime();

        return response()->json(['questions' => $questions]);
    }
}

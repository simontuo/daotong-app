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

    public function follow(Request $request)
    {
        $question = $this->question->byId($request->get('question'));

        $followed = $question->follower()->toggle(user('api'));

        if (count($followed['attached']) > 0) {

            $question->increment('followers_count');

            $question->actionLog(user('api'), user('api')->name.'关注了问题'.$question->title);

            return response()->json(['followed' => true]);
        }

        $question->decrement('followers_count');

        $question->actionLog(user('api'), user('api')->name.'取消关注了问题'.$question->title);

        return response()->json(['followed' => false]);
    }

    public function answers($id)
    {
        $question = $this->question->byId($id);

        $answers = $question->answers()->with('user')->latest()->get();

        return response()->json(['answers' => $answers]);
    }
}

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
}

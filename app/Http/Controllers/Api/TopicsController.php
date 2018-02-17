<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TopicRepository;

class TopicsController extends Controller
{
    protected $topic;

    public function __construct(TopicRepository $topic)
    {
        $this->topic = $topic;
    }

    public function index(Request $request)
    {
        $topics = $this->topic->getTopicsByQuery($request->get('query'));

        $topics = $this->topic->setQueryToTopics($topics,$request->get('query'));

        return response()->json(['topics' => $topics]);
    }

    public function hot()
    {
        $topics = $this->topic->hot();

        return response()->json(['topics' => $topics]);
    }
}

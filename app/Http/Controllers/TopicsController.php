<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TopicRepository;

class TopicsController extends Controller
{
    protected $topic;

    public function __construct(TopicRepository $topic)
    {
        $this->topic = $topic;
    }

    /**
     * [index description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        $topics = $this->topic->getTopicsByQuery($request->get('query'));

        $topics = $this->topic->setQueryToTopics($topics,$request->get('query'));

        return response()->json(['topics' => $topics]);
    }
}

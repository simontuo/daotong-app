<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CommentRepository;

class CommentsController extends Controller
{
    protected $comment;

    protected $allowComment = [
        'Article',
    ];

    public function __construct(CommentRepository $comment)
    {
        $this->comment = $comment;
    }

    /**
     * [index description]
     * @method index
     * @param  [type]   $id   [description]
     * @param  [type]   $type [description]
     * @return [type]         [description]
     * @auth   simontuo
     */
    public function index($type, $id)
    {
        if (in_array($type, $this->allowComment)) {
            $comments = $this->comment->getCommentsByIdAndType($id, $type);


            return response()->json(['status' => true, 'comments' => $comments]);
        }

        return response()->json(['status' => false]);
    }

    /**
     * [store 新增评论]
     * @method store
     * @param  Request  $request [description]
     * @return [type]            [description]
     * @auth   simontuo
     */
    public function store(Request $request)
    {
        $data = [
            'user_id'          => user('api')->id,
            'bio'              => $request->get('bio'),
            'commentable_id'   => $request->get('model'),
            'commentable_type' => $this->getModelType($request->get('type')),
            'parent_id'        => $request->get('parentId'),
        ];

        $comment = $this->comment->create($data);
        $comment->user = $comment->user()->first();
        $comment->parent = $comment->parent()->first();
        $comment->created_time = $comment->created_at->diffForHumans();

        return response()->json(['status' => true, 'comment' => $comment]);
    }

    /**
     * [getModelType 获取model类型]
     * @method getModelType
     * @param  [type]       $type [description]
     * @return [type]             [description]
     * @auth   simontuo
     */
    public function getModelType($type)
    {
        return 'App\Models\\'.$type;
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CommentRepository;
use App\Repositories\UserRepository;
use App\Repositories\ArticleRepository;
use App\Notifications\NewCommentNotification;

class CommentsController extends Controller
{
    protected $comment;

    protected $article;

    protected $allowComment = [
        'Article', 'Calligraphy', 'Question', 'Answer'
    ];

    public function __construct(CommentRepository $comment, ArticleRepository $article, UserRepository $user)
    {
        $this->comment = $comment;
        $this->article = $article;
        $this->user = $user;
    }

    public function index()
    {
        $pageSize = request('pageSize') ? request('pageSize') : config('page.comment');

        $comments = $this->comment->index($pageSize);

        $comments->CombinationField();

        return response()->json(['comments' => $comments]);
    }

    public function search()
    {
        $pageSize = request('pageSize') ? request('pageSize') : config('page.comment');

        $comments = $this->comment->search(request('query'), request('quickQuery'), $pageSize);

        $comments->CombinationField();

        return response()->json(['comments' => $comments]);
    }

    public function getCommentsByIdAndType($type, $id)
    {
        if (in_array($type, $this->allowComment)) {
            $comments = $this->comment->getCommentsByIdAndType($id, $type);

            $comments->addCreatedTime();

            return response()->json(['status' => true, 'comments' => $comments]);
        }

        return response()->json(['status' => false]);
    }

    public function store(Request $request)
    {
        if (user('api')->isBanComment()) {
            return response()->json(['status' => false, 'message' => '你已被管理员禁言无法评论！']);
        }

        if ($this->comment->closeComment($this->comment->getModelObject($request->get('model'), $request->get('type')))) {
            return response()->json(['status' => false, 'message' => '该资源关闭了评论！']);
        }

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
        $comment->addCreatedTime();


        $commentable = app($comment->commentable_type)->findOrFail($comment->commentable_id);
        $commentable->increment('comments_count');
        $commentableUser = $this->user->byId($comment->user_id)->notify(new NewCommentNotification());

        $comment->actionLog(user('api'), '新增了评论:'.$comment->bio);

        return response()->json(['status' => true, 'message' => '评论新增成功！', 'comment' => $comment]);
    }

    public function getModelType($type)
    {
        return 'App\Models\\'.$type;
    }

    public function getUserComments($id)
    {
        $comments = $this->comment->getCommentsByUser($id);

        $comments->findModelAble();

        $comments->addCreatedTime();

        $comments->CombinationField();

        return response()->json(['comments' => $comments]);
    }

    public function isHidden($id)
    {
        $this->authorize('isHidden', user('api'));

        $comment = $this->comment->byId($id);

        $state = $comment->isHidden() ? 'F' : 'T';

        $comment->is_hidden = $state;

        $comment->save();

        $action = $comment->isHidden() ? '屏蔽了评论:'.$comment->bio : '取消了屏蔽评论:'.$comment->bio;

        $comment->actionLog(user('api'), $action);

        return response()->json(['state' => $state]);
    }
}

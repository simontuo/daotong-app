<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\ArticleRepository;
use App\Notifications\HiddenNotification;
use App\Notifications\CloseCommentNotification;

class ArticlesController extends Controller
{
    protected $article;

    protected $user;

    public function __construct(ArticleRepository $article, UserRepository $user)
    {
        $this->article = $article;
        $this->user    = $user;
    }

    public function index()
    {
        $pageSize = request('pageSize') ? request('pageSize') : config('page.article');

        $articles = $this->article->index($pageSize);

        $articles->addCreatedTime();

        $articles->CombinationField();

        return response()->json(['articles' => $articles]);
    }

    public function search(Request $request)
    {
        $pageSize = request('pageSize') ? request('pageSize') : config('page.article');

        $articles = $this->article->search($request->get('query'), $request->get('quickQuery'), $pageSize, true);

        $articles->addCreatedTime();

        $articles->CombinationField();

        return response()->json(['articles' => $articles]);
    }

    public function adminSearch(Request $request)
    {
        $this->authorize('viewAdmin', user('api'));

        $pageSize = request('pageSize') ? request('pageSize') : config('page.article');

        $articles = $this->article->search($request->get('query'), $request->get('quickQuery'), $pageSize);

        $articles->addCreatedTime();

        $articles->CombinationField();

        return response()->json(['articles' => $articles]);
    }

    public function rankingList()
    {
        $rankingList = $this->article->getRankingList();

        return response()->json(['rankingList' => $rankingList]);
    }

    public function closeComment($id)
    {
        $article = $this->article->byId($id);

        $this->authorize('closeComment', $article);

        $state = $article->closeComment() ? 'F' : 'T';

        $article->close_comment = $state;

        $article->save();

        $user = $this->user->byId($article->user_id);

        $user->notify(new CloseCommentNotification($article, $user));

        $action = $article->closeComment() ? '关闭了文章评论:'.$article->title : '取消关闭文章的评论:'.$article->title;

        $article->actionLog(user('api'), $action);

        return response()->json(['state' => $state]);
    }

    public function isHidden($id)
    {
        $article = $this->article->byId($id);

        $this->authorize('isHidden', $article);

        $state = $article->isHidden() ? 'F' : 'T';

        $article->is_hidden = $state;

        $article->save();

        $user = $this->user->byId($article->user_id);

        $user->notify(new HiddenNotification($article, $user));

        $action = $article->isHidden() ? '屏蔽了该文章:'.$article->title : '取消屏蔽了该文章:'.$article->title;

        $article->actionLog(user('api'), $action);

        return response()->json(['state' => $state]);
    }

    public function getUserArticles($id)
    {
        $articles = $this->article->getArticlesByUser($id);

        $articles->addCreatedTime();

        $articles->CombinationField();

        return response()->json(['articles' => $articles]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;

class ArticlesController extends Controller
{
    protected $article;

    public function __construct(ArticleRepository $article)
    {
        $this->article = $article;
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

        $state = $article->closeComment() ? 'F' : 'T';

        $article->close_comment = $state;

        $article->save();

        return response()->json(['state' => $state]);
    }

    public function isHidden($id)
    {
        $article = $this->article->byId($id);

        $state = $article->isHidden() ? 'F' : 'T';

        $article->is_hidden = $state;

        $article->save();

        return response()->json(['state' => $state]);
    }
}

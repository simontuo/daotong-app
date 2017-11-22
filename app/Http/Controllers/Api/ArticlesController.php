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
        $articles = $this->article->index();

        $articles->addCreatedTime();

        return response()->json(['articles' => $articles]);
    }

    public function search(Request $request)
    {
        $articles = $this->article->search($request->get('query'));

        return response()->json(['articles' => $articles]);
    }

    public function rankingList()
    {
        $rankingList = $this->article->getRankingList();

        return response()->json(['rankingList' => $rankingList]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Repositories\ArticleRepository;
use App\Repositories\LikeRepository;
use App\Repositories\CommentRepository;
use App\Repositories\CalligraphyRepository;
use Naux\Mail\SendCloudTemplate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleRepository $article, CalligraphyRepository $calligraphy, CommentRepository $comment, LikeRepository $like)
    {
        $this->article     = $article;
        $this->calligraphy = $calligraphy;
        $this->comment     = $comment;
        $this->like        = $like;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articlesCount = $this->article->getAllArticlesCount();
        $articlesReadsTotal = $this->article->getReadsTotal();
        $articlesCommentsCount = $this->comment->getAllCommnetBy('Article');
        $articlesLikesCount = $this->like->getAllLikesBy('Article');

        $calligraphysCount = $this->calligraphy->getAllCalligraphysCount();
        $calligraphysReadsTotal = $this->calligraphy->getReadsTotal();
        $calligraphysCommentsCount = $this->comment->getAllCommnetBy('Calliaphy');
        $calligraphysLikesCount = $this->like->getAllLikesBy('Calligraphy');

        return view('index', compact('articlesReadsTotal', 'articlesCount', 'articlesCommentsCount', 'articlesLikesCount', 'calligraphysReadsTotal', 'calligraphysCount', 'calligraphysCommentsCount', 'calligraphysLikesCount'));
    }

}

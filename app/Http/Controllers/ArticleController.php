<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
use Auth;
use App\Repositories\ArticleRepository;
use App\Repositories\TopicRepository;

class ArticleController extends Controller
{
    protected $article;

    protected $topic;

    public function __construct(ArticleRepository $article, TopicRepository $topic)
    {
        $this->middleware('auth')->except([
            'index', 'show', 'rankingList', 'articleList', 'search'
        ]);
        $this->article = $article;
        $this->topic   = $topic;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $topics = $this->topic->normalizeTopic($request->get('topics'), 'articles_count');

        $data = [
            'user_id'      => Auth::id(),
            'author_id'    => Auth::id(),
            // 'cover'        => $request->get('cover'),
            'title'        => $request->get('title'),
            'bio'          => $request->get('bio'),
            'markdown_bio' => $request->get('markdown_bio'),
        ];

        $article = $this->article->create($data);

        $article->topics()->attach($topics);

        $article->actionLog(user(), '新增了文章:'.$article->title);

        alert()->success('新增文章 '.$article->title.' 成功！')->autoclose(2000);

        return redirect()->route('articles.show', ['article' => $article->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->article->getArticleUserAndAuthorById($id);

        $article->increment('reads_count');

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->article->getArticleUserAndAuthorById($id);

        $this->authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = $this->article->byId($id);

        $this->authorize('update', $article);

        $article->title = $request->get('title');

        $article->bio = $request->get('bio');

        $article->markdown_bio = $request->get('markdown_bio');

        $article->save();

        $topics  = $article->topics()->pluck('topics.id')->toArray();

        $newTopics = collect($request->topics)->reject(function($item, $key) use($topics) {
            return collect($topics)->contains($item);
        })->toArray();

        if (!empty($newTopics)) {
            $article->topics()->sync(array_merge($topics,$this->topic->normalizeTopic($newTopics, 'articles_count')));

            $article->actionLog(user(), '编辑了文章:'.$article->title);
        }

        alert()->success('编辑文章 '.$article->title.' 成功！')->autoclose(2000);

        return redirect()->route('articles.show', ['article' => $article->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

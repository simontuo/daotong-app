<?php
namespace App\Repositories;

use App\Models\Article;
use Carbon\Carbon;

class ArticleRepository
{
    protected $quickQueryType = [
        'created_at', 'reads_count', 'comments_count', 'likes_count'
    ];

    protected $prefixQuery = [
        'articles.is_hidden' => 'F'
    ];

    protected $modelColumn = [
        'articles.id', 'articles.user_id', 'articles.title', 'articles.created_at', 'articles.comments_count', 'articles.reads_count', 'articles.close_comment', 'articles.is_hidden'
    ];

    public function create(array $attributes)
    {
        return Article::create($attributes);
    }

    public function byId($id)
    {
        return Article::findOrFail($id);
    }

    public function getArticleUserAndAuthorById($id)
    {
        return Article::with(['user', 'author', 'topics'])->findOrFail($id);
    }

    public function index($pageSize)
    {
        return Article::with(['user', 'likes'])->latest('created_at')->paginate($pageSize);
    }

    public function getRankingList()
    {
        return Article::select('id', 'user_id', 'title', 'reads_count')->orderBy('reads_count', 'DESC')->with('user')->paginate(5);
    }

    public function getAllArticlesCount()
    {
        return Article::count();
    }

    public function getReadsTotal()
    {
        return Article::sum('reads_count');
    }

    public function search($query, $quickQuery = null, $pageSize, $prefixQueryState = false)
    {
        $quickQueryType = is_null($quickQuery) ? 'created_at' : array_get($this->quickQueryType, $quickQuery, 'created_at');

        $prefixQuery = $this->checkPrefixQuery($prefixQueryState);

        return Article::join('users', function ($join) use ($prefixQuery){
                $join->on('users.id', '=', 'articles.user_id')
                     ->where($prefixQuery);
            })
            ->select($this->modelColumn)
            ->where('users.name', 'like', '%'.$query.'%')
            ->orWhere('articles.title', 'like', '%'.$query.'%')
            ->with(['user', 'likes', 'topics'])
            ->orderBy($quickQueryType, 'DESC')
            ->paginate($pageSize);
    }

    public function checkPrefixQuery($prefixQueryState)
    {
        return $prefixQueryState ? $this->prefixQuery : [];
    }

    public function getArticlesByUser($id)
    {
        if ($id == user('api')->id && \Request::ajax()) {
            $this->prefixQuery = [];
        }
        return Article::where($this->prefixQuery)->where('user_id', $id)->with(['user', 'likes', 'topics'])->get();
    }
}

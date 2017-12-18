<?php
namespace App\Repositories;

use App\Models\Article;
use Carbon\Carbon;

class ArticleRepository
{
    protected $quickQueryType = [
        'created_at', 'reads_count', 'comments_count', 'likes_count'
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
        return Article::with(['user', 'author'])->findOrFail($id);
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

    public function search($query, $quickQuery = null, $pageSize)
    {
        $quickQueryType = is_null($quickQuery) ? 'created_at' : array_get($this->quickQueryType, $quickQuery, 'created_at');

        return Article::join('users', 'users.id', '=', 'articles.user_id')
            ->select('articles.id', 'articles.user_id', 'articles.title', 'articles.created_at', 'articles.comments_count', 'articles.reads_count', 'articles.close_comment', 'articles.is_hidden')
            ->where('users.name', 'like', '%'.$query.'%')
            ->orWhere('articles.title', 'like', '%'.$query.'%')
            ->with(['user', 'likes', 'topics'])
            ->orderBy($quickQueryType, 'DESC')
            ->paginate($pageSize);
    }
}

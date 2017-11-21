<?php
namespace App\Repositories;

use App\Models\Article;
use Carbon\Carbon;

class ArticleRepository
{
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

    public function index()
    {
        return Article::with(['user', 'likes'])->latest('created_at')->paginate(30);
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

    public function search($query)
    {
        return Article::join('users', 'users.id', '=', 'articles.user_id')
                ->select('articles.id', 'user_id', 'title')
                ->where('users.name', 'like', '%'.$query.'%')
                ->orWhere('articles.title', 'like', '%'.$query.'%')
                ->with(['user', 'likes'])
                ->latest('articles.created_at')
                ->paginate(30);
    }
}

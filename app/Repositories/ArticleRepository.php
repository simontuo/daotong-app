<?php
namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    /**
     * [create 创建]
     * @method create
     * @param  array    $attributes [description]
     * @return [type]               [description]
     * @auth   simontuo
     */
    public function create(array $attributes)
    {
        return Article::create($attributes);
    }

    /**
     * [byId 根据ID获取文章]
     * @method byId
     * @param  [type]   $id [description]
     * @return [type]       [description]
     * @auth   simontuo
     */
    public function byId($id)
    {
        return Article::findOrFail($id);
    }

    public function getArticleUserAndAuthorById($id)
    {
        return Article::with(['user', 'author'])->findOrFail($id);
    }

    /**
     * [index 获取文章]
     * @return [type] [description]
     */
    public function index()
    {
        return Article::with('user')->latest('created_at')->get();
    }

    public function getRankingList($page)
    {
        return Article::select('id', 'user_id', 'title', 'reads_count')->orderBy('reads_count', 'DESC')->with('user')->paginate(5);
    }
}

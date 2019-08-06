<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Filters\ArticlesFilters;


class ArticlesController extends Controller
{
    public function index(Category $category, ArticlesFilters $filters)
    {
        $articles = Article::latest('order')->filter($filters);
        $articles = $articles->onShowArticle()->paginate(17);
        session()->flash('flash', '欢迎你');
        return view('articles.index', compact('articles', 'category'));
    }

    public function show(Article $article)
    {
        if ($article->is_show == 0 || $article->category->is_show == 0) {
            return;
        }
        // 获取 “上一篇” 的 ID
        $previousArticleID = Article::onShowArticle()->where('order', '<', $article->order)->max('id');

        // 同理，获取 “下一篇” 的 ID
        $nextArticleId = Article::onShowArticle()->where('order', '>', $article->order)->min('id');

        $replies = $article->replies()->paginate(10);

        return view('articles.show', compact('article', 'previousArticleID', 'nextArticleId', 'replies'));
    }

    public function showWithCategory(Category $category, Article $article)
    {
        if ($article->category_id != $category->id || $article->is_show == 0 || $article->category->is_show == 0) {
            return;
        }
        // 获取 “上一篇” 的 ID
        $previousArticleID = Article::onShowArticle()->where('order', '<', $article->order)->where('category_id', $category->id)->max('id');
        // 同理，获取 “下一篇” 的 ID
        $nextArticleId = Article::onShowArticle()->where('order', '>', $article->order)->where('category_id', $category->id)->min('id');

        $replies = $article->replies()->paginate(10);

        return view('articles.show', compact('article', 'previousArticleID', 'nextArticleId', 'category', 'replies'));
    }
}